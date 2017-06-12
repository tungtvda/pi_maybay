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
$data['config']=config_getByTop(1,'','');

$data['name_tt6']=tieude_getById(6);
$data['danhmuc']=menu_getById(14);





if(isset($_POST['giatri']))
{
    if($_POST['giatri']!="")
    {
        $key=addslashes(strip_tags($_POST['giatri']));

        if($_SESSION['kiemtra']==1)
        {
            $dieukien="Name like '%".$key."%'". " or Title like '%".$key."%'";
        }
        else
        {
            $dieukien="Name_en like '%".$key."%'". " or Title_en like '%".$key."%'";
        }
        $data['danhsach']=tinkhuyenmai_getByTop('',$dieukien,'Id desc');

        $data['name']=$key;
    }
    else
    {
        $key=addslashes(strip_tags($_POST['giatri']));

        $dieukien="Name ="."";

        $data['danhsach']=tinkhuyenmai_getByTop('',$dieukien,'Id desc');

        $data['name']=$key;
    }



}
else
{
    redict(SITE_NAME);
}


if($_SESSION['kiemtra']==1)
{
    $title=($data['danhmuc'][0]->Title)?$data['danhmuc'][0]->Title:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
}
else
{
    $title=($data['danhmuc'][0]->Title_en)?$data['danhmuc'][0]->Title_en:'SERVICES LTD - TRANSPORT AND INTERNATIONAL TRAVEL COACH';
}
$description=($data['danhmuc'][0]->Description)?$data['danhmuc'][0]->Description:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
$keywords=($data['danhmuc'][0]->Keyword)?$data['danhmuc'][0]->Keyword:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
show_header($title,$description,$keywords,$data);
//
show_menu($data,'timkiem');
show_timkiem($data);
show_right($data);
show_footer($data,'timkiem');
