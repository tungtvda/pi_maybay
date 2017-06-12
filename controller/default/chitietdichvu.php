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
$data['name_tt7']=tieude_getById(7);
$data['danhmuc']=menu_getById(4);
if(isset($_GET['Id']))
{
    if(is_numeric($_GET['Id']))
    {
        $data['chitiet']=dichvu_getById($_GET['Id']);
        $id_banchay="BanChay=1 and DanhMucId =".$_GET['Id'];
        $data['banchay']=dichvu_sub_getByTop('',$id_banchay,'Id desc');

        $id_noibat="NoiBat=1 and DanhMucId =".$_GET['Id'];
        $data['noibat']=dichvu_sub_getByTop('',$id_noibat,'Id desc');
    }
    else
    {
        redict(SITE_NAME);
    }
}
else
{
    redict(SITE_NAME);
}

if($_SESSION['kiemtra']==1)
{
    $title=($data['chitiet'][0]->Title)?$data['chitiet'][0]->Title:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
}
else
{
    $title=($data['chitiet'][0]->Title_en)?$data['chitiet'][0]->Title_en:'SERVICES LTD - TRANSPORT AND INTERNATIONAL TRAVEL COACH';
}

$description=($data['chitiet'][0]->Description)?$data['chitiet'][0]->Description:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
$keywords=($data['chitiet'][0]->Keyword)?$data['chitiet'][0]->Keyword:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
show_header($title,$description,$keywords,$data);

if(isset($_POST['guiyeucau']))
{
    $data['Name_kt']=  $Name_kt=addslashes(strip_tags($_POST['Name_kt']));
    $data['Name_dp'] =$Name_dp=addslashes(strip_tags($_POST['Name_dp']));
    $data['Email_dp'] =$Email_dp=addslashes(strip_tags($_POST['Email_dp']));


    $data['Phone_dp'] =$Phone_dp=addslashes(strip_tags($_POST['Phone_dp']));
    $data['Address_dp'] =$Address_dp = addslashes(strip_tags($_POST['Address_dp']));
    $data['NoiDung_dp'] =$NoiDung_dp = addslashes(strip_tags($_POST['NoiDung_dp']));

    if($Name_dp==""||$Email_dp==""||$Phone_dp=="")
    {
        if ($_SESSION['kiemtra'] == 1) {

            echo "<script>alert('Quý khách vui lòng điền đầy đủ thông tin được đánh dấu sao')</script>";
        }
        else
        {
            echo "<script>alert('Please enter the full registration information are marked (*)')</script>";
        }

    }
    else
    {
        $new = new datdichvu();

        $new->Name=$Name_dp;
        $new->Email=$Email_dp;
        $new->LoaiDichVu=$Name_kt;
        $new->Phone=$Phone_dp;
        $new->Address=$Address_dp;
        $new->NoiDung=$NoiDung_dp;

        $new->Created=date(DATETIME_FORMAT);
        datdichvu_insert($new);
        $link_web=SITE_NAME.'/dich-vu/';
        if ($_SESSION['kiemtra'] == 1) {

            echo "<script>alert('Quý khách đã đặt dịch vụ thành công, chúng tôi sẽ liên hệ trong thời gian sớm nhất')</script>";
        }
        else
        {
            echo "<script>alert('You have set the service is successful, we will contact you as soon as possible')</script>";
        }
        echo "<script>window.location.href='$link_web';</script>";
    }
}

show_menu($data,'dichvu');
show_chitietdichvu($data);
show_right($data);
show_footer($data,'dichvu');
