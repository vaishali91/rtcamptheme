<?php
/**
  Theme Name: rtcamptheme
 */
?>

<?php
get_header();
?>

<div id="content1" class="container">
    <div style="float: left;width: 62%;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->

            <ol class="carousel-indicators">
                <?php
                $option = get_option("theme_slider_options");
                $n = sizeof($option);
                $i = 0;
                for ($i = 0; $i < $n; $i++) {
                    if ($i == 0) {
                        ?>
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <?php } else { ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"></li>  
                        <?php
                    }
                }
                ?>
            </ol>

            <div class="carousel-inner img_slider" style="height:376px;" role="listbox">
                <?php
                $i = 0;
                $uploaddir = wp_upload_dir('uploads');
                foreach ($option as $key => $img_name) {
                    if ($i == 0) {
                        $i++;
                        if (preg_match('/uploads/', $img_name) == 0) {
                            ?>
                            <div class="item active">
                                <img src="<?php echo bloginfo('template_url') ?>/images/<?php echo $img_name; ?>" alt="s1" height="376px;" >
                            </div>
                        <?php } else { ?>
                            <div class="item active">
                                <img  src="<?php echo $uploaddir['baseurl']; ?>/<?php echo substr($img_name, 7); ?> "alt="s1" height="376px;">
                            </div>
                            <?php
                        }
                    } else {
                        if (preg_match('/uploads/', $img_name) == 0) {
                            ?>
                            <div class="item">
                                <img src="<?php echo bloginfo('template_url') ?>/images/<?php echo $img_name; ?>" alt="s2" height="376px;" >
                            </div>
                        <?php } else { ?>
                            <div class="item">
                                <img  src="<?php echo $uploaddir['baseurl']; ?>/<?php echo substr($img_name, 7); ?>" alt="s2" height="376px;">
                            </div>
                            <?php
                        }
                    }
                }
                ?>


            </div>
        </div>
    </div>
    <div id='user' style="float:right;width:36%">
        <?php
        $option = get_option("theme_static_page_options");
        if ($option) {
            foreach ($option as $key => $value) {
                $page_data = get_page($value);
                echo "<div>" . apply_filters('the_content', $page_data->post_content) . "</div>";
            }
        }
        ?>
    </div>    
</div>
<div class='section_4 container'>


    <hr>

    <div class="span9">
        <br>
        <div id="myCarousel_video" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner video" role="listbox">
                <?php
                $option = array();
                $i = 0;
                $j = 0;
                $option = get_option("theme_video_options");
                if ($option) {
                    foreach ($option as $key => $img_name) {
                        if ($i == 0) {
                            if ($j == 0) {
                                $j++;
                                ?>
                                <div class="item active">
                                <?php } else { ?>
                                    <div class="item">
                                    <?php } ?>
                                    <div class="span9">
                                    <?php }
                                    ?>

                                    <a title='Youtube Video' href='https://www.youtube.com/embed/<?php echo $img_name; ?>?wmode=transparent&TB_iframe=true' class="thickbox">
                                        <span class="glyphicon glyphicon-play-circle" style=" left:65px;" aria-hidden="true">   </span> 
                                        <img class="img img-thumbnail" src="http://img.youtube.com/vi/<?php echo $img_name; ?>/default.jpg">

                                    </a>

                                    <?php
                                    if ($i == 4) {
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            $i++;
                            if ($i == 5) {

                                $i = 0;
                            }
                        }
                        if ($i != 0) {
                            ?>
                        </div></div>
                    <?php
                }
            }
            ?>                  
        </div>
        <!-- Left and right controls -->
        <div style="margin-right: 20px;">
            <a class="left carousel-control"  href="#myCarousel_video" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" style="margin-right: 10px;" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
        </div>
        <a class="right carousel-control" href="#myCarousel_video" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div> </div><br>
<hr>
<br><br>

</div>


<div id="section_3" class="container">
    <div class='left' style='width:68%'>
        <div class="exi left">
            <div class="front">                   
            </div>
            <div>
                <div class="panel-heading">
                    Glimpses of Exhibition
                </div>
                <br>
                <?php
                $i = 0;
                $args = array('post_type' => 'glimpse', 'posts_per_page' => 10);
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $i++;
                        $the_query->the_post();
                        if (has_post_thumbnail()) {
                            $id = get_the_ID();
                            ?>
                            <div class="left"><a href="./exhibition?id=<?php echo $id; ?>"><?php the_post_thumbnail(); ?></a><br><div class="exi_div"><?php the_title(); ?></div></div>
                        <?php } else { ?> 
                            <div class="left"><a href="./exhibition?id=<?php echo $id; ?>"><img class="img-thumbnail" src="<?php bloginfo('template_url') ?>/images/glimse-img1.jpg"></a><br><div class="exi_div">Golf</div></div>
                            <?php
                        }
                    }
                }
                while ($i < 8) {
                    $i++;
                    ?>
                    <div class="left"><a href=""><img class="img-thumbnail" src="<?php bloginfo('template_url') ?>/images/glimse-img2.jpg"></a><br><div class="exi_div">Tennis</div></div>
                    <?php
                }
                ?>
            </div>
        </div>
        .<br>
        <hr>   

        <div class="left twitt">
            <div class="front">                   
            </div>
            <div>
                <div class="panel-heading">
                    Latest Tweets
                </div>
            </div>
            <div>
                <a class="twitter-timeline" href="https://twitter.com/VMangukiya" data-widget-id="636468698501398532" data-tweet-limit="3">Tweets by @VMangukiya</a>
                <script>!function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https'; if (!d.getElementById(id)){js = d.createElement(s); js.id = id; js.src = p + "://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs); }}(document, "script", "twitter-wjs");</script>
            </div>
        </div>
        <div class="facebook_vr">  
        </div>
        <div class="left fb">
            <div class="front">                   
            </div>
            <div>
                <div class="panel-heading">
                    Follow us on Facebook
                </div>
            </div>
            <div style="width:160px;">
                <div class="fb-like"  data-href="https://www.facebook.com/rtCamp.solutions?fref=ts" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
            </div>
        </div>
    </div>
    <div class="before_news_vr left">  
    </div>
    <div class='right' style='width:29%'>
        <div class="news right">
            <div class="front">                   
            </div>
            <div class="panel-heading">
                News
            </div>
            <div>
                <div class="left news_logo">

                    <?php
                    $queried_post = get_page_by_title('Sticky Post', OBJECT, 'post');
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($queried_post->ID), 'Sticky Post');
                    ?>
                    <div class="left" style="width:40%"> <img class="img-thumbnail" src="<?php echo $image[0]; ?>"></div>                 

                    <div class="right" style="width:60%"><?php echo $queried_post->post_content; ?></div>
                </div>
                <div class="res_news">
                    <?php
                    // create a query to grab our posts in category of ID $postcat
                    $q = new WP_Query(array('cat' => get_cat_ID('news')));
                    $cnt = 0;
                    $total = 0;
                    if ($q->have_posts()) {
                        while ($q->have_posts()) {
                            $q->the_post();
                            if ($cnt <= 4) {
                                ?>
                                <span class="glyphicon glyphicon-forward"></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                                <?php
                                $cnt++;
                            }
                            $total++;
                        }
                        wp_reset_postdata();
                    }
                    ?>
                    <input type="hidden" name="count_news" id="count_news" value="<?php echo $cnt + 1; ?>">
                    <br>
                </div>
                <input type="hidden" name="total_news" id="total_news" value="<?php echo $total + 1; ?>">
                <div>
                    <div class="left">
                        <a><span id='left_ajax' class="ajax_news glyphicon glyphicon-circle-arrow-left"></span></a>
                        <a> <span id='right_ajax' class="ajax_news glyphicon glyphicon-circle-arrow-right"></span></a>
                    </div>
                    <div class="right">
                        <a>
                            More News
                        </a>
                    </div>
                </div>
            </div>
        </div>
        .<br>

        <div class='right news'>

            <?php get_sidebar('date-weather'); ?>

        </div>
    </div>

</div>

<div class='section_4 container'>
    <hr>
    <div class="front">                   
    </div>
    <div>
        <div class="panel-heading">
            Our Partners
        </div>
    </div>
    <div class="span9">
        <br>
        <div id="myCarousel_post" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner partner" role="listbox">
                <?php
                $i = 0;
                $j = 0;
                $args = array('post_type' => 'partners', 'posts_per_page' => 10);
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        if (has_post_thumbnail()) {
                            if ($i == 0) {
                                if ($j == 0) {
                                    $j++;
                                    ?>
                                    <div class="item active">
                                    <?php } else { ?>
                                        <div class="item">
                                        <?php } ?>
                                        <div class="span9">
                                            <?php
                                        }

                                        the_post_thumbnail();
                                        if ($i == 4) {
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                $i++;
                                if ($i == 5) {
                                    $i = 0;
                                }
                            }
                        }
                        if ($i != 0) {
                            ?>
                        </div></div>
                    <?php
                }
            }
            ?>                  


            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel_post" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel_post" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <hr>
    <br><br>
</div>
</div>
<?php get_footer(); ?>