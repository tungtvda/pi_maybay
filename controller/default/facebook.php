<?php
if(!defined('DIR')) require_once '../../config.php';
require_once DIR.'/common/messenger.php';
require_once DIR.'/common/redict.php';
require_once DIR.'/common/facebook/facebook.php';
require_once DIR.'/model/userService.php';
require_once DIR.'/controller/default/public.php';
$data['config']=config_getByTop(1,'','');
$title="Đăng nhập facebook";
$description="Đăng nhập facebook";
$keywords="Đăng nhập facebook";
show_header($title,$description,$keywords,$data);
//
    LoginWithFacebook(SITE_NAME.'/controller/default/facebook.php');
//
function LoginWithFacebook($RerurnURL)//login với facebook
{
    $config=array();
    $config['appId']='487430091415856';
    $config['secret']='5d707964e534538158ab366a3d7e7883';
    $config['cookie']=true;
    $facebook=new Facebook($config);
    $user=$facebook->getUser();
    $LoginUrl= $facebook->getLoginUrl(array('scope'=>'email,friends_likes,read_stream','redirect_uri' => $RerurnURL));
    if ($user)
    {
        $user_profile = $facebook->api('/me');
        $ListLoginUser=user_getByTop(1,"email='".$user_profile['email']."'",'');
        if(count($ListLoginUser)>0)
        {
            if($ListLoginUser[0]->TrangThai==0)
            {
                if(isset($_SESSION['lang']))
                {

                    if($_SESSION['lang']==1)
                    {
                        echo "<script>alert('Tài khoản của bạn chưa được kích hoạt, bạn vui lòng chờ hệ thống kích hoạt tài khoản')</script>";
                    }
                    else
                    {
                        echo "<script>alert('Your account has not been activated, please awaiting account activation system')</script>";
                    }
                }
                else
                {
                    echo "<script>alert('Tài khoản của bạn chưa được kích hoạt, bạn vui lòng chờ hệ thống kích hoạt tài khoản')</script>";
                }
                echo "<script>window.location= '".SITE_NAME."';</script>";
            }
            else

            {
                $_SESSION['user_id']=$ListLoginUser[0]->Id;
                $_SESSION["email"]=$ListLoginUser[0]->Email;
                $_SESSION['User_Tendn']=$ListLoginUser[0]->Name;

                echo "<script>window.location= '".SITE_NAME."';</script>";
            }


        }
        else
        {
            $new_user=new user();
            $new_user->Email=$user_profile['email'];
            $new_user->Name=$user_profile['name'];

            $new_user->Created=date(DATETIME_FORMAT);
            $new_user->TrangThai=0;
            user_insert($new_user);
            $link_web=SITE_NAME;
            if(isset($_SESSION['lang']))
            {

                if($_SESSION['lang']==1)
                {
                    echo "<script>alert('Quý khách đã đăng ký thành công, Xin cảm ơn')</script>";
                    echo "<script>window.location.href='$link_web';</script>";
                }
                else
                {
                    echo "<script>alert('You have successfully registered, Thank you')</script>";
                    echo "<script>window.location.href='$link_web';</script>";
                }
            }
            else
            {
                echo "<script>alert('Quý khách đã đăng ký thành công, Xin cảm ơn')</script>";
                echo "<script>window.location.href='$link_web';</script>";
            }

            echo "<script>window.location= '".SITE_NAME."';</script>";
        }
    }
    else
    {
        echo "<script>window.location= '".$LoginUrl."';</script>";
    }
}