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

$data['danhmuc']=menu_getById(5);
if(isset($_GET['Id']))
{
    if(is_numeric($_GET['Id']))
    {
        $data['chitiet']=tinkhuyenmai_getById($_GET['Id']);

        $id_noibat="Id !=".$_GET['Id'];
        $data['baivietkhac']=tinkhuyenmai_getByTop(10,$id_noibat,'Id desc');
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
    $data['cungloai']="Tin liên quan";
    $data['NoiDung']=$data['chitiet'][0]->NoiDung;
    $data['Name']=$data['chitiet'][0]->Name;
    $data['Name_dm']=$data['danhmuc'][0]->Name;
    $data['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Trang chủ</a> <i class="fa fa-angle-right"></i> <a href="'.SITE_NAME.'/tin-khuyen-mai/">Tin khuyến mãi</a> <i class="fa fa-angle-right"></i> <span>'.$data['Name'].'</span>';
    $title=($data['chitiet'][0]->Title)?$data['chitiet'][0]->Title:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
}
else
{
    $data['cungloai']="Related news";
    $data['NoiDung']=$data['chitiet'][0]->NoiDung_en;
    $data['Name']=$data['chitiet'][0]->Name_en;
    $data['Name_dm']=$data['danhmuc'][0]->Name_en;
    $data['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> <a href="'.SITE_NAME.'/tin-khuyen-mai/">Promotion</a> <i class="fa fa-angle-right"></i> <span>'.$data['Name'].'</span>';
    $title=($data['chitiet'][0]->Title_en)?$data['chitiet'][0]->Title_en:'SERVICES LTD - TRANSPORT AND INTERNATIONAL TRAVEL COACH';
}

$description=($data['chitiet'][0]->Description)?$data['chitiet'][0]->Description:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
$keywords=($data['chitiet'][0]->Keyword)?$data['chitiet'][0]->Keyword:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
show_header($title,$description,$keywords,$data);


show_menu($data,'tinkhuyenmai');
show_chitiet($data);
show_right($data);
show_footer($data,'tinkhuyenmai');
