<?php
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}
require_once(DIR."/common/hash_pass.php");
require_once(DIR."/model/userService.php");
if(isset($_GET['email'])&&isset($_GET['pass']))
{


    $TenDangNhap=addslashes(strip_tags($_GET['email']));
    $MatKhau=addslashes(strip_tags($_GET['pass']));


    if($TenDangNhap==""||$MatKhau=="")
    {
        if ($_SESSION['kiemtra'] == 1) {

            echo "<script>alert('Quý khách vui lòng nhập đầy đủ thông tin đăng nhập')</script>";
        }
        else
        {
            echo "<script>alert('Please enter the full login information')</script>";
        }

    }
    else
    {
        $mk=hash_pass($MatKhau);
        $dk1='Email='.'"'.$TenDangNhap.'"'. ' and MatKhau='.'"'.$mk.'"';
        $data['kiemtra_user']=user_getByTop('',$dk1,'');
        if(count($data['kiemtra_user'])>0)
        {
            if($data['kiemtra_user'][0]->TrangThai==0)
            {
                if ($_SESSION['kiemtra'] == 1) {

                    echo "<script>alert('Tài khoản của bạn chưa được kích hoạt')</script>";
                }
                else
                {
                    echo "<script>alert('Your account has not been activated')</script>";
                }
            }
            else
            {

                $_SESSION['user_id']= $data['kiemtra_user'][0]->Id;
                $_SESSION['user_name']= $data['kiemtra_user'][0]->Name;
                echo "<script>location.reload(true)</script>";
            }





        }
        else
        {
            if ($_SESSION['kiemtra'] == 1) {

                echo "<script>alert('Sai thông tin đăng nhập')</script>";
            }
            else
            {
                echo "<script>alert('False login information')</script>";
            }
        }

    }


}
?>