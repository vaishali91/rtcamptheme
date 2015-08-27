<?php
if ($_SERVER['REQUEST_METHOD']=="POST") {
    $option = array();
    foreach ($_POST as $key => $value) {
        if ($key != "i") {
            $option[$key] = $value;
        }
    }
  
    if(empty($option))
    {
        $option['default']='slider-img1.jpg';
        $option['default1']='slider-img2.jpg';         
    }
    delete_option("theme_slider_options");
    add_option('theme_slider_options', $option);
}
?>
<h1>Slider Image Option</h1>
<?php
if ($_SERVER['REQUEST_METHOD']=="POST") { ?>
<div class="alert alert-success">Slider Image Saved</div>
  <?php  }
?>
<form method="post" action="./admin.php?page=theme_settings">
    <table>
        <tr valign="top">
            <th scope="row">Upload Image</th>
            <td>
                <div>
                    <div><center> <button id="upload_image_button" name="upload_image_button" class="btn btn-success" >+</button></center></div>


                    <div style="float:left;" id="targetDiv">
                        <?php
                        $slider_options = get_option('theme_slider_options');
                        $i = 0;
                        if ($slider_options) {

                            foreach ($slider_options as $key => $img_name) {
                                $i++;
                                $id = "img_disp" . $i;
                                ?>
                                <input type="hidden" id="<?php echo $id ?>" name="<?php echo $id ?>" value="<?php echo $img_name; ?>"/>
                                <?php if (preg_match('/uploads/', $img_name) == 0) { ?>
                                    <img style="width:240px;height:240px;margin:20px;" src="<?php echo bloginfo('template_url') ?>/images/<?php echo $img_name; ?>" />
                                <?php
                                } else {
                                    $uploaddir = wp_upload_dir('uploads');
                                    ?>
                                    <img style="width:240px;height:240px;margin:20px;" src="<?php echo $uploaddir['baseurl']; ?>/<?php echo substr($img_name, 7); ?>" />
                                    <?php
                                }
                            }
                        }
                        $i++
                        ?>
                        <input type="hidden" id="i" name="i" value="<?php echo $i; ?>"/>
                  
                    <div style="float:right;" name="result" id="result"></div>
                   
                </div>
                    <div>
                         <center> <input type="button" class="btn btn-success" id="upload_image_del_button" value="-" name="upload_image_del_button"></center>
                    </div>
                    </div>
            </td>
        </tr>
    </table>
    <input class="btn btn-lg btn-primary" type="submit" value="Save" id="submit"/>
</form>