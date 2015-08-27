jQuery(document).ready(function () {
    jQuery('#add_btn').click(function () {
        res = jQuery('#you_link').val();
        if(res.indexOf('youtube')==-1)
        {
            alert("Please insert youtube video link")
        }
        else
        {
        id = res.split("=");
        link = "<div class='"+id[1]+"0'><center><input type='hidden' value='" + id[1] + "' id='" + id[1] + "' name='" + id[1] + "'/>\n\
 <div class='left' style='margin:30px;'><img style='width:100px;height:100px;' src='http://img.youtube.com/vi/"+id[1]+"/default.jpg'>\n\
<br><a class='del' id='"+id[1]+"0'><span class='glyphicon glyphicon-remove'></span></a></div>\n\
</div>";
        jQuery('#result').append(link);
        jQuery('#you_link').val("");
    }
    });
    jQuery('.del').click(function(){
       id=jQuery(this).attr('id');
       jQuery('.'+id).remove();
    });

    jQuery('#upload_image_button').click(function () {
        formfield = jQuery('#upload_image').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });

    window.send_to_editor = function (html) {
        imgurl = jQuery('img', html).attr('src');
        tb_remove();
        i = "img_disp" + jQuery('#i').val();
        j = jQuery('#i').val() + 1;
        jQuery('#i').val(j);
        img_name = imgurl.replace(/^.*[\\\/]/, '');
        var arr = imgurl.split('/');
        var url = arr[arr.length - 4] + "/" + arr[arr.length - 3] + "/" + arr[arr.length - 2] + "/" + arr[arr.length - 1];
        tag = " <input type='hidden' id='" + img_name + "' name='" + img_name + "' value='" + url + "'/> <img style='width:240px;height:240px;margin:20px;' src='" + imgurl + "' />";
        jQuery('#result').append(tag);

    }
    jQuery('#upload_image_del_button').click(function () {

        jQuery('#targetDiv img').first().remove();
        if (jQuery('#targetDiv :hidden').attr('id') == "i")
        {
            jQuery('#targetDiv :hidden :nth-child(2)').remove();
        }
        else
        {
            jQuery('#targetDiv :hidden').first().remove();
        }


    });



});
$(document).ready(function () {
    $('.ajax_news').click(function () {
        cnt_news = $('#count_news').val(); 
        dir=$(this).attr('id');
        total=$('#total_news').val(); 
        $.ajax({
            type: "POST",
            url: "./wp-content/themes/rtcamptheme/news_ajax.php",
            data: {cnt_news: cnt_news,dir:dir,total:total},
            success: function (data) {
                $(".res_news").html(data);                
            }
        });
    });
    
   
});


$(function () {
    $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).first().stop(true, true).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function () {
                $('.dropdown-menu', this).first().stop(true, true).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            });
});



(function () {
    var cx = '009198608436186946878:gm4saa-gtfy';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
            '//cse.google.com/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
})();



(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));







    