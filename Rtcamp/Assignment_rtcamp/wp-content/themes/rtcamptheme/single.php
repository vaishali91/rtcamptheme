<?php
/**
  Template Name: single
 */
?>
<?php get_header(); ?>
<div id="" class="container">
    <?php
    if (isset($_POST['title'])) {
        $my_postid = $_POST['title']; //This is page id or post id
        $content_post = get_post($my_postid);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;
    }
    ?>
    <?php if (have_posts()) {
        while (have_posts()) : the_post();
            ?>
            <h3><?php the_title(); ?></h3>
            <?php the_content(); ?>
        <?php endwhile;
    } // end of the loop. ?>
</div>
<?php get_footer(); ?>
