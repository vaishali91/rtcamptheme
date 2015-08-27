<?php
/*
  Template Name: exhibition Template
 */
?>
<?php get_header(); ?>
<div class='container'>
    <h2>This is Single Custom Post</h2>
    <?php
    if (isset($_GET['id'])) {
        $my_postid = $_GET['id']; //This is page id or post id
        ?>
    <div>
    <div class="left" style='width:30%;margin:10px;'><?php
        echo get_the_post_thumbnail($my_postid);?></div>
    <div class='right' style='width:50%;padding-top: 30px;padding-left:1px;'><?php
      
        $content_post = get_post($my_postid);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;
    }
    ?></div>
    </div>
    

</div>

<?php get_footer(); ?>