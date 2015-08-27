<?php
add_image_size('companies_thumb', 120, 120, true);
the_post_thumbnail('companies_thumb');

//function for logo
function logo_register($wp_customize) {

    $wp_customize->add_section('change_logo', array(
        'title' => 'Logo',
        'priority' => 120,
    ));

    $wp_customize->add_setting('change_logo', array(
        'default' => get_bloginfo('template_directory') . '/images/sitelogo.png',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'change_logo', array(
        'label' => 'Upload Image',
        'section' => 'change_logo',
        'settings' => 'change_logo',
    )));
}

add_action('customize_register', 'logo_register');

//function for slider image option
function slider_get_default_options() {
    $options = array(
        'default' => 'slider-img1.jpg',
        'default1' => 'slider-img2.jpg'
    );
    return $options;
}

function options_init() {

    $slider_options = get_option('theme_slider_options');
    if (false === $slider_options) {
        $slider_options = slider_get_default_options();
        add_option('theme_slider_options', $slider_options);
    }
}

add_action('admin_init', 'options_init');

function add_theme_option() {
    add_menu_page('Slider Image settings', 'Slider Image settings', 'manage_options', 'theme_settings', 'slider_image');
}

function slider_image() {
    include 'slider_img.php';
}

add_action('admin_menu', 'add_theme_option');

function my_admin_scripts() {

    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', get_template_directory_uri() . '/js/rtcamp.js', array('jquery', 'media-upload', 'thickbox'));
    wp_enqueue_script('my-upload');
}

function my_admin_styles() {
    wp_enqueue_style('thickbox');
    wp_register_style('my-bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('my-bootstrap');
    wp_register_style('my-bootstrap_min', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('my-bootstrap_min');
    wp_register_style('rtcamp', get_template_directory_uri() . '/css/rtcamp.css');
    wp_enqueue_style('rtcamp');
}

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

//function for cutom Post type
// Our custom post type function
add_theme_support('post-thumbnails', array('post', 'work', 'custom_post'));
set_post_thumbnail_size(140, 140, true);

function create_posttype() {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(80, 80, true);
    register_post_type('glimpse', array(
        'labels' => array(
            'name' => __('Glimpses of Exhibition'),
            'singular_name' => __('Glimpses of Exhibition'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Exhibition'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Exhibition'),
            'new_item' => __('New Exhibition'),
            'view' => __('View Exhibition'),
            'view_item' => __('View Exhibition'),
            'search_items' => __('Search Exhibition'),
            'not_found' => __('No Exhibition found'),
            'not_found_in_trash' => __('No Exhibition found in Trash'),
            'parent' => __('Parent Exhibition'),
        ),
        'supports' => array('thumbnail', 'title', 'editor'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'glimpse'),
        'taxonomies' => array('category', 'post_tag')
            )
    );
}

add_action('init', 'create_posttype');

//function for slider_custom_post type

function slider_create_posttype() {
    register_post_type('partners', array(
        'labels' => array(
            'name' => __('Partners'),
            'singular_name' => __('Partners'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Partners'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Partners'),
            'new_item' => __('New Partners'),
            'search_items' => __('Search Partners'),
            'not_found' => __('No Partners found'),
            'not_found_in_trash' => __('No Partners found in Trash'),
            'parent' => __('Parent Partners'),),
        'supports' => array('thumbnail', 'title', 'editor'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'partners'),
        'taxonomies' => array('category', 'post_tag'))
    );
}

add_action('init', 'slider_create_posttype');

//To add footpar page widget



class Footbar_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'footbar_widget', // Base ID
                __('Footbar Page Link', 'text_domain'), // Name
                array('description' => __('A Footbar Widget', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $cnt = 1;
        while ($cnt <= 5) {
            if (!empty($instance['page-dropdown' . $cnt])) {
                $res = apply_filters('widget_title', $instance['page-dropdown' . $cnt]);
                $pages = get_pages();
                foreach ($pages as $page) {
                    if ($page->post_title == $res) {
                        echo "<div><span class='glyphicon glyphicon-forward'></span><a href='" . get_page_link($page->ID) . "'>" . $res . "</a></div>";
                    }
                }
            }
            $cnt++;
        }
        echo $args['after_widget'];
    }

    public function form($instance) {
        $cnt = 1;
        while ($cnt <= 5) {

            $page_name = !empty($instance['page-dropdown' . $cnt]) ? $instance['page-dropdown' . $cnt] : "Select Page";
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('page-dropdown' . $cnt); ?>"><?php _e('Page' . $cnt . ':'); ?></label> 
                <select name="<?php echo $this->get_field_name('page-dropdown' . $cnt); ?>" id="<?php echo $this->get_field_id('page-dropdown' . $cnt); ?>"> 
                    <option>
                        <?php echo esc_attr($page_name); ?></option> 
                    <?php
                    $pages = get_pages();
                    foreach ($pages as $page) {
                        $option = "<option " . selected($instance['page-dropdown' . $cnt], $page->post_title) . "value='" . $page->post_title . "'>";
                        $option .= $page->post_title;
                        $option .= '</option>';
                        echo $option;
                    }
                    ?>
                </select>            
            </p>
            <?php
            $cnt++;
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $cnt = 1;
        while ($cnt <= 5) {

            $instance['page-dropdown' . $cnt] = (!empty($new_instance['page-dropdown' . $cnt]) ) ? strip_tags($new_instance['page-dropdown' . $cnt]) : 'Select Page';
            $cnt++;
        }
        return $instance;
    }

}

function footbar_widgets_init() {
    register_sidebar(array(
        'name' => 'Footbar Page',
        'id' => 'footbar_sidebar',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ));
    register_widget('Footbar_Widget');
}

add_action('widgets_init', 'footbar_widgets_init');

//To add footpar link widget



class Footbar_Link_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'footbar_link_widget', // Base ID
                __('Footbar Link', 'text_domain'), // Name
                array('description' => __('A Footbar Link Widget', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {

        $cnt = 1;
        echo "</div></div>
        <div class='ilinks footer_format_link right'>
            <div><h3>Important Links</h3> <hr style='color:black !important;'></div>";
           
        while ($cnt <= 5) {
            if (!empty($instance['link' . $cnt])) {
                $res = apply_filters('widget_title', $instance['link' . $cnt]);
                echo "<div><span class='glyphicon glyphicon-forward'></span><a target='_blank' href='" . $res . "'>" . $res . "</a></div>";
            }
            $cnt++;
        }
        echo "</div> </div>
        
        <div class='footer_logo right footer_format' style='width:31%'>";
    }

    public function form($instance) {
        $cnt = 1;
        while ($cnt <= 5) {

            $link_name = !empty($instance['link' . $cnt]) ? $instance['link' . $cnt] : "";
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('link' . $cnt); ?>"><?php _e('Page' . $cnt . ':'); ?></label> 
                <input type="text" value=" <?php echo esc_attr($link_name); ?>" name="<?php echo $this->get_field_name('link' . $cnt); ?>" id="<?php echo $this->get_field_id('link' . $cnt); ?>"/>                    
            </p>
            <?php
            $cnt++;
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $cnt = 1;
        while ($cnt <= 5) {

            $instance['link' . $cnt] = (!empty($new_instance['link' . $cnt]) ) ? strip_tags($new_instance['link' . $cnt]) : 'Enter URL';
            $cnt++;
        }
        return $instance;
    }

}

function footbar_link_widgets_init() {
    register_widget('Footbar_Link_Widget');
}

add_action('widgets_init', 'footbar_link_widgets_init');

//create shortcode for footer
function load_term($atts) {
    extract(shortcode_atts(array(
        'url' => "#",
        'title' => "Terms of Use",
                    ), $atts));
    return "<div>
               <a href='" . $url . "'> <center> " . $title . " | Privacy Policy |Designed by Vaishali</center></a>
            </div>";
}

add_shortcode('rt-link', 'load_term');

//create sidebar widget for date and time
function date_widget_init() {
    register_sidebar(array(
        'name' => 'Date and Weather',
        'id' => 'date_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="rounded">',
        'after_title' => '</h2>',
    ));
    register_widget('Date_Widget');
}

add_action('widgets_init', 'date_widget_init');

class Date_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'date_widget', // Base ID
                __('Date and Time', 'text_domain'), // Name
                array('description' => __('A Date and Time Widget', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {

        if (!empty($instance['date_widget'])) {
            $res = apply_filters('widget_title', $instance['date_widget']);
            if ($res == "Dubai") {
                $timezone = "Asia/Dubai";
            } else if ($res == "Amity") {
                $timezone = "Australia/Brisbane";
            } else if ($res == "Ellensburg") {
                $timezone = "Pacific/Efate";
            } else {
                $timezone = "Asia/Kolkata";
            }
            $date = new DateTime('now', new DateTimeZone($timezone));
            $localday = $date->format('l,d M');
            $localtime = $date->format('h:i:s a');
            echo " <div class='front'>                   
            </div>
            <div>
                <div class='panel-heading'>
                    Date and Time
                </div>
            </div> <div><br>
                <h4>" . $localday . "</h4>  </div>
            <div>   <h1>" . $localtime . "</h1></div>";
        }
    }

    public function form($instance) {
        $city = array("Mumbai", "Dubai", "Surat", "Kolkata", "Amity", "Ellensburg");

        $dateandtime = !empty($instance['date_widget']) ? $instance['date_widget'] : "Select City";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('date_widget'); ?>"><?php _e('City:'); ?></label> 
            <select name="<?php echo $this->get_field_name('date_widget'); ?>" id="<?php echo $this->get_field_id('date_widget'); ?>"> 
                <option>
                    <?php echo esc_attr($dateandtime); ?></option> 
                <?php
                $option = "";

                foreach ($city as $name) {
                    $option .= "<option " . selected($instance['date_widget'], $name) . "value='" . $name . "'>" . $name . "</option>";
                }
                echo $option;
                ?>
            </select>            
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();

        $instance['date_widget'] = (!empty($new_instance['date_widget']) ) ? strip_tags($new_instance['date_widget']) : 'Enter URL';

        return $instance;
    }

}

//for Weather Widget
function weather_widget_init() {

    register_widget('Weather_Widget');
}

add_action('widgets_init', 'weather_widget_init');

class Weather_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'weather_widget', // Base ID
                __('Weather', 'text_domain'), // Name
                array('description' => __('A Weather Widget', 'text_domain'),) // Args
        );
    }

    public function widget($args, $instance) {

        if (!empty($instance['weather_widget'])) {
            $res = apply_filters('widget_title', $instance['weather_widget']);
            if ($res == "Dubai") {
                $q = "Dubai";
            } else if ($res == "Amity") {
                $q = "Australia,Amity";
            } else if ($res == "Ellensburg") {
                $q = "Pacific,Ellensburg";
            } else if ($res == "Mumbai") {
                $q = "India,Mumbai";
            } else if ($res == "Surat") {
                $q = "India,Surat";
            } else {
                $q = "India,Kolkata";
            }

//            $json_string = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $q);
//          
//            $parsed_json = json_decode($json_string);

            $c = "38";
            $f = "82";


//            foreach ($parsed_json as $value) {
//                if ($value->{"temp"}) {
//                    $kelvin = $value->{"temp"};
//                    $c = round($kelvin - 273.15);
//                    $f = round((($kelvin) * (9 / 5)) - 459.67);
//                    break;
//                }
//            }

            echo"  <hr>
        <div class='right news'>
            <div class='front'>                   
            </div>
            <div>
                <div class='panel-heading'>
                    Weather
                </div>
            </div>
            <div>              
                    <center><div class='weather_img'><h3>Today Weather:</h3><br><h1>" . $c . "<sup>	&ordm;</sup>  /  " . $f . "<sup>	&ordm;</sup></h1><div></center>
            </div>
        </div>       
        <hr>";
        }
    }

    public function form($instance) {
        $city = array("Mumbai", "Dubai", "Surat", "Kolkata", "Amity", "Ellensburg");

        $dateandtime = !empty($instance['weather_widget']) ? $instance['weather_widget'] : "Select City";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('weather_widget'); ?>"><?php _e('City:'); ?></label> 
            <select name="<?php echo $this->get_field_name('weather_widget'); ?>" id="<?php echo $this->get_field_id('weather_widget'); ?>"> 
                <option>
                    <?php echo esc_attr($dateandtime); ?></option> 
                <?php
                $option = "";

                foreach ($city as $name) {
                    $option .= "<option " . selected($instance['weather_widget'], $name) . "value='" . $name . "'>" . $name . "</option>";
                }
                echo $option;
                ?>
            </select>            
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();

        $instance['weather_widget'] = (!empty($new_instance['weather_widget']) ) ? strip_tags($new_instance['weather_widget']) : 'Enter URL';

        return $instance;
    }

}

//youtube video link theme option
function add_theme_option_video() {
    add_menu_page('Video Settings', 'Video Settings', 'manage_options', 'video_settings', 'video_disp');
}

function video_disp() {
    include 'video_link.php';
}

add_action('admin_menu', 'add_theme_option_video');

//static page content after menu
function add_theme_option_static() {
    add_menu_page('User Page Settings', 'User Page Settings', 'manage_options', 'user_settings', 'page_disp');
}

function page_disp() {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $option = array();
        foreach ($_POST as $key => $value) {
            $option[$key] = $value;
        }

        delete_option("theme_static_page_options");
        add_option('theme_static_page_options', $option);
    }
    ?>
    <h1>Select Page for Content Display</h1>
    <form method="post" action="./admin.php?page=user_settings">
        <div>
            <div class='float' style='width:20%'>
                Select Page:
            </div>
            <div class='float'>
                <select style='width:40%' id='static_content' name='static_content'>
                    <?php
                    $option = get_option("theme_static_page_options");
                    $val = "";
                    if ($option) {
                        foreach ($option as $key => $value) {
                            $val = $value;
                        }
                    } else {
                        ?>
                        <option></option>
                        <?php
                    }
                    $pages = get_pages();
                    foreach ($pages as $page) {
                        if ($val == $page->ID) {
                            $option = "<option selected='selected' value='" . $page->ID . "'>";
                            $option .= $page->post_title;
                            $option .= '</option>';
                        } else {
                            $option = "<option value='" . $page->ID . "'>";
                            $option .= $page->post_title;
                            $option .= '</option>';
                        }
                        echo $option;
                    }
                    ?>
                </select>
            </div>
        </div><br><br>
        <input class="btn btn-lg btn-primary" type="submit" value="Save" id="submit"/>
    </form>
    <?php
    $option = get_option("theme_static_page_options");
    if ($option) {
        foreach ($option as $key => $value) {
            $page_data = get_page($value);
            echo "<div><h2>" . $page_data->post_title . "</h2><br>" . apply_filters('the_content', $page_data->post_content) . "</div>";
        }
    }
}

add_action('admin_menu', 'add_theme_option_static');

//menu
class themeslug_walker_nav_menu extends Walker_Nav_Menu {

// add classes to ul sub-menus
    function start_lvl(&$output, $depth = 0, $args = array()) {
        // depth dependent classes
        $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            '',
            ( $display_depth >= 2 ? 'dropdown-menu' : 'dropdown-menu' )
        );
        $class_names = implode(' ', $classes);

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

// add main/sub classes to li's and links
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;

        $display_depth = ( $depth + 1);
        $classes = array(
            '',
            ( ($args->has_children) ? 'dropdown-submenu' : '' ),
        );
        $class_names = implode(' ', $classes);

        // build html
        $output .= $indent . '<li class="dropdown ' . $class_names . '">';

        // link attributes
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';


        $item_output = sprintf('%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s', $args->before, $attributes, $args->link_before, apply_filters('the_title', $item->title, $item->ID), $args->link_after, $args->after
        );

        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}
?>