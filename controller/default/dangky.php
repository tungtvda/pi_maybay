<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}

require_once DIR.'/controller/default/public.php';
require_once DIR.'/common/upload_image.php';
require_once(DIR."/common/hash_pass.php");
require_once(DIR."/common/redict.php");
$data['config']=config_getByTop(1,'','');

$data['danhmuc']=menu_getById(12);

$data['name_tt8']=tieude_getByTop(1,'Id=8','');




if($_SESSION['kiemtra']==1)
{
    $data['cungloai']="Tin liên quan";
    $data['NoiDung']="";
    $data['Name']="";
    $data['Name_dm']=$data['danhmuc'][0]->Name;
    $data['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Trang chủ</a> <i class="fa fa-angle-right"></i>  <span>'.$data['Name_dm'].'</span>';
    $title=($data['danhmuc'][0]->Title)?$data['danhmuc'][0]->Title:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
}
else
{
    $data['cungloai']="Related news";
    $data['NoiDung']="";
    $data['Name']="";
    $data['Name_dm']=$data['danhmuc'][0]->Name_en;
    $data['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i>  <span>'.$data['Name_dm'].'</span>';
    $title=($data['danhmuc'][0]->Title_en)?$data['danhmuc'][0]->Title_en:'SERVICES LTD - TRANSPORT AND INTERNATIONAL TRAVEL COACH';
}

$description=($data['danhmuc'][0]->Description)?$data['danhmuc'][0]->Description:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
$keywords=($data['danhmuc'][0]->Keyword)?$data['danhmuc'][0]->Keyword:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
show_header($title,$description,$keywords,$data);
if(isset($_POST['dangkytv']))
{
    $data['Name_user']=  $Name=addslashes(strip_tags($_POST['Name_us']));
    $data['DienThoai_user']= $DienThoai=addslashes(strip_tags($_POST['Phone_us']));
    $data['Email_user'] =$Email=addslashes(strip_tags($_POST['Email_us']));
    $data['Address_user'] =$Address=addslashes(strip_tags($_POST['Address_us']));
    $QuyDanh=addslashes(strip_tags($_POST['QuyDanh']));
    $MatKhau=addslashes(strip_tags($_POST['MatKhau1']));
    $MatKhau2=addslashes(strip_tags($_POST['MatKhau2']));



    if($Name==""||$MatKhau==""||$MatKhau2==""||$Email==""||$Address=="")
    {
        if ($_SESSION['kiemtra'] == 1) {

            echo "<script>alert('Quý khách vui lòng nhập đầy đủ thông tin đăng ký được đánh dấu (*)')</script>";
        }
        else
        {
            echo "<script>alert('Please enter the full registration information are marked (*)')</script>";
        }

    }
    else
    {
        if(isset($_POST['dieukhoan']))
        {
            if($MatKhau!=$MatKhau2)
            {
                if ($_SESSION['kiemtra'] == 1) {

                    echo "<script>alert('Hai mật khẩu không khớp')</script>";
                }
                else
                {
                    echo "<script>alert('The passwords do not match')</script>";
                }

            }
            else
            {
                $dk2='Email='.'"'.$Email.'"';
                $data['kiemtra_email']=user_count($dk2);
                if($data['kiemtra_email']>0)
                {
                    if ($_SESSION['kiemtra'] == 1) {

                        echo "<script>alert('Email đã tồn tại trong hệ thống')</script>";
                    }
                    else
                    {
                        echo "<script>alert('Email already exists in the system')</script>";
                    }

                }
                else
                {
                    $new = new user();

                    $new->Name=$Name;
                    $new->Email=$Email;
                    $new->Address=$Address;
                    $new->QuyDanh=$QuyDanh;
                    $new->MatKhau=hash_pass($MatKhau);
                    $new->Created=date(DATETIME_FORMAT);
                    user_insert($new);
                    $link_web=SITE_NAME.'/dang-ky-thanh-cong/'.$Email.'/'.$MatKhau;


                    echo "<script>window.location.href='$link_web';</script>";
                }
            }
        }
        else
        {
            if ($_SESSION['kiemtra'] == 1) {

                echo "<script>alert('Bạn vui lòng đồng ý với các điều khoản của Tourcoach')</script>";
            }
            else
            {
                echo "<script>alert('Would you please agree to the terms of Tourcoach')</script>";
            }
        }

    }
}


if(isset($_POST['xoatv']))
{
    $data['Name_user']=  "";
    $data['DienThoai_user']= "";
    $data['Email_user'] ="";
    $data['Address_user'] ="";




}

show_menu($data,'');
show_dangky($data);

show_footer($data,'');
