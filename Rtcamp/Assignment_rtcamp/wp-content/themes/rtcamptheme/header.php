<html>
    <head>
        <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
           <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rtcamp.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/thickbox.js"></script>

        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
         <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/thickbox.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/rtcamp.css">
         <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/thickbox.css">
      

  
    </head>
    <body>
        <div id="header" class=" container">
            <div class="top-right">
                <?php
                $menu_secondary = wp_get_nav_menu_object('Secondary Menu');
                $menu_items_secondary = wp_get_nav_menu_items($menu_secondary->term_id);
                $link_menu = "";
                $i = 0;
                foreach ((array) $menu_items_secondary as $key => $menu_item_secondary) {
                    $title_secondary = $menu_item_secondary->title;
                    $url_secondary = $menu_item_secondary->url;
                    if ($i == 0) {
                        $link_menu.="<a href='" . $url_secondary . "'>" . $title_secondary . "</a>";
                        $i++;
                    } else {
                        $link_menu.=" | <a href='" . $url_secondary . "'>" . $title_secondary . "</a>";
                    }
                }
                echo $link_menu;
                ?>              

            </div>
            <div class="page-header">
                <div class="logo">
                    <img src="<?php
                if (get_theme_mod('change_logo')) : echo get_theme_mod('change_logo');
                else: echo get_template_directory_uri() . '/images/sitelogo.png';
                endif;
                ?>">
                </div>
                <div class="gsearch">
                    <gcse:search></gcse:search>
                </div>
            </div>


        </div>

        <div class="collapse navbar-collapse menu" id="bs-example-navbar-collapse-1">
            
           
<?php

 wp_nav_menu(array(
        'menu'    => 'Menu', //menu id
     'menu_class'=>'nav navbar-nav',
        'walker'  => new themeslug_walker_nav_menu() //use our custom walker
    ));

?>
           
        </div>



