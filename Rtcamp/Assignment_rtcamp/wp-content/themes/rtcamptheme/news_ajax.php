<?php
/**
  Theme Name: rtcamptheme
 */
?>
<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');
if (isset($_POST['cnt_news'])) {
    $cnt = $_POST['cnt_news'];
    $dir = $_POST['dir'];
    $total=$_POST['total'];
   
    if($dir=="left_ajax")
    {
        $cnt=$cnt-5;
    }
    if($dir=="left_ajax"&&$cnt==5)
    {
        $cnt=0;
    }   
    if($dir=="right_ajax"&&($total==$cnt))
    {
        $cnt=($total-$cnt)+1;
    }
  
    $q = new WP_Query(array('cat' => get_cat_ID('news')));
    $j = 0;
    $i = 0;
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            $j++;
            if ($j >= $cnt) {

                if ($i <= 4) {
                    ?>

                    <span class="glyphicon glyphicon-forward"></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                    <?php
                    $i++;
                } else {
                    break;
                }
            }
        }
        wp_reset_postdata();
    }
    ?>
    <input type = "hidden" name = "count_news" id = "count_news" value = "<?php echo $j + 1; ?>">
    <br>
    <?php
}
?>