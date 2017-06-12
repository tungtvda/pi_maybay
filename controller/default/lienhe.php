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

$data['danhmuc']=menu_getById(6);

$data['name_tt8']=tieude_getByTop(1,'Id=11','');

$data['name_tt12']=tieude_getByTop(1,'Id=12','');



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

if(isset($_POST['guiyeucau']))
{
    $data['Name_user']=  $Name=addslashes(strip_tags($_POST['Name_lh']));
    $data['DienThoai_user']= $DienThoai=addslashes(strip_tags($_POST['Phone_lh']));
    $data['Email_user'] =$Email=addslashes(strip_tags($_POST['Email_lh']));
    $data['Address_user'] =$Address=addslashes(strip_tags($_POST['Address_lh']));
    $data['Address_user'] = $NoiDung=addslashes(strip_tags($_POST['NoiDung_lh']));
    $QuyDanh=addslashes(strip_tags($_POST['QuyDanh']));





    if($Name==""||$DienThoai==""||$Email==""||$Address=="")
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

        $new = new lienhe();

        $new->Name=$Name;
        $new->Email=$Email;
        $new->Address=$Address;
        $new->QuyDanh=$QuyDanh;
        $new->NoiDung=$NoiDung;
        $new->Created=date(DATETIME_FORMAT);
        lienhe_insert($new);
        $link_web=SITE_NAME;
        if ($_SESSION['kiemtra'] == 1) {

            echo "<script>alert('Qúy khách liên hệ thành công')</script>";
        }
        else
        {
            echo "<script>alert('Guest contact successful')</script>";
        }

        echo "<script>window.location.href='$link_web';</script>";


    }
}


show_menu($data,'');
show_lienhe($data);

show_footer($data,'');
