<?php ob_start("ob_gzhandler");?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <?php
    require_once("../../config.php");
    require_once(DIR."/common/hash_pass.php");
    require_once DIR."/model/adminService.php";

    if(isset($_POST["UserName"])&&isset($_POST["Pass"]))
    {
        @session_start();
        $UserName=$_POST["UserName"];
        $Pass=hash_pass($_POST["Pass"]);
//        $_SESSION["Admin"]='admin';
//        header('Location: '.SITE_NAME.'/controller/admin/index.php');
        if(checkLogin($UserName)&&checkLogin($Pass))
        {
            $result=admin_Get("select * from admin where TenDangNhap='".$UserName."' and MatKhau='".$Pass."'");
            if(count($result)>0)
            {
                if($result[0]->MatKhau==$Pass)
                {
                    $_SESSION["username"]=$UserName;
                    $_SESSION["UserName"]=$result[0]->Full_name;
                    $_SESSION["UserId"]=$result[0]->Id;
                    $_SESSION["UserEmail"]=$result[0]->Email;
                    $_SESSION['user']=$UserName;
                    $_SESSION['userid']=$result[0]->Id;
                    $_SESSION["Admin"]=$UserName;
                    header('Location: '.SITE_NAME.'/controller/admin/index.php');
                }
                else
                {
                    echo "<script type=\"text/javascript\">alert(\"Bạn vui lòng kiểm tra lại thông tin đăng nhập\")</script>";
                }
            }
            else
            {
                echo "<script type=\"text/javascript\">alert(\"Bạn vui lòng kiểm tra lại thông tin đăng nhập\")</script>";
            }
        }
        else
        {
            echo "<script type=\"text/javascript\">alert(\"Bạn vui lòng kiểm tra lại thông tin đăng nhập\")</script>";
        }


    }
    function checkLogin($string)
    {
        if(strrpos($string,"'")||strrpos($string,"=")||strrpos($string,"(")||strrpos($string,")")||strrpos($string,">")||strrpos($string,"<")||strrpos($string,"\\")||strrpos($string,"\""))
        {
            return false;
        }
        else return true;

    }
    ?>


    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hệ thống đăng nhập quản trị</title>
    <link rel="stylesheet" href="<?php echo SITE_NAME ?>/view/admin/Themes/css/style.default.css" type="text/css"/>
    <script type="text/javascript" src="<?php echo SITE_NAME ?>/view/admin/Themes/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript"
            src="<?php echo SITE_NAME ?>/view/admin/Themes/js/jquery-migrate-1.1.1.min.js"></script>
</head>

<body class="loginbody">

<div class="loginwrapper">
    <div class="loginwrap zindex100 animate2 bounceInDown">
        <h1 class="logintitle"><span class="iconfa-lock"></span> Login <span class="subtitle">Hello! Sign in to get you started!</span>
        </h1>

        <div class="loginwrapperinner">
            <form id="loginform" action="" method="post">
                <p class="animate4 bounceIn"><input type="text" id="username" name="UserName"
                                                    placeholder="Tên đăng nhập"/></p>

                <p class="animate5 bounceIn"><input type="password" id="password" name="Pass" placeholder="Mật khẩu"
                                                    /></p>

                <p class="animate6 bounceIn">
                    <button class="btn btn-default btn-block">ĐĂNG NHẬP</button>
                </p>

            </form>
        </div>
        <!--loginwrapperinner-->
    </div>
    <div class="loginshadow animate3 fadeInUp"></div>
</div>
<!--loginwrapper-->

<script type="text/javascript">
    jQuery.noConflict();

    jQuery(document).ready(function () {

        var anievent = (jQuery.browser.webkit) ? 'webkitAnimationEnd' : 'animationend';
        jQuery('.loginwrap').bind(anievent, function () {
            jQuery(this).removeClass('animate2 bounceInDown');
        });

        jQuery('#username,#password').focus(function () {
            if (jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
        });

        jQuery('#loginform button').click(function () {
            if (!jQuery.browser.msie) {
                if (jQuery('#username').val() == '' || jQuery('#password').val() == '') {
                    if (jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
                    if (jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
                    jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent, function () {
                        jQuery(this).removeClass('animate0 wobble');
                    });
                } else {
                    jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent, function () {
                        jQuery('#loginform').submit();
                    });
                }
                return false;
            }
        });
    });
</script>
</body>

<!-- Mirrored from demo.themepixels.com/webpage/katniss/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2015 09:16:47 GMT -->
</html>
