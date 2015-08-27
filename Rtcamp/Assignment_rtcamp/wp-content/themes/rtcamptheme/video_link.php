<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $option = array();
  
    foreach ($_POST as $key => $value) {
        if ($key != "you_link") {
            $option[$key] = $value;
        }
    }

    delete_option("theme_video_options");
    add_option('theme_video_options', $option);
}
?>
<h1>Youtube Video Option</h1>
<?php if ($_SERVER['REQUEST_METHOD'] == "POST") { ?>
    <div class="alert alert-success">Youtube Video Saved</div>
<?php }
?>
<form method="post" action="./admin.php?page=video_settings">
    <table>
        <tr align="top">
            <th scope="row">Add Video Link</th>
        </tr>
        <tr>
            <td>
                <br><br>
                <div>
                    <div class="left">
                        <label>Video Link : </label>
                    </div>
                    <div class="left" style="margin-left: 20px;">
                        <input style="width:450px;" type="text" name="you_link" id="you_link" >
                    </div>
                    <div class="left" style="margin-left: 20px;">
                        <input class="btn btn-success" type="button" name="add_btn" id="add_btn" value="add">  
                    </div>
                </div><br><br>
            </td>
        </tr>
        <tr>
            <td><div id="result1">
                    <?php
                    $video_options = get_option('theme_video_options');
                    if ($video_options) {
                        $k = 0;
                        foreach ($video_options as $key => $video_name) {
                            if ($k == 0) {
                                echo " <div style='width:1000px;'>";
                                 } ?>
                    <div class='<?php echo $video_name.$k ?>'>
                                <input type="hidden" name="<?php echo $video_name; ?>" id="<?php echo $video_name; ?>" value="<?php echo $video_name; ?>"/>
                                <div class="left" style='margin:30px;'><img style='width:100px;height:100px;' src="http://img.youtube.com/vi/<?php echo $video_name; ?>/default.jpg">
                                    <br><a class='del' id='<?php echo $video_name.$k ?>'><span class='glyphicon glyphicon-remove'></span></a></div>
                    </div>
                                <?php
                                if ($k == 5) {
                                    echo "</div>";
                                }
                                $k++;
                                if ($k == 6) {
                                    $k = 0;
                                }
                            }
                        }
                        ?>
                </div><br>
                <div id='result'></div>
            </td>
        </tr>
    </table>
    <input class="btn btn-lg btn-primary" type="submit" value="Save" id="submit"/>
</form>