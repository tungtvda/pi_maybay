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
$data['danhmuc']=menu_getById(2);



$data['current']=isset($_GET['page'])?$_GET['page']:'1';
$data['pagesize']=20;
$data['count']=venoidia_count('DanhMucId=1');
$data['danhsach']=venoidia_getByPaging($data['current'],$data['pagesize'],'Id DESC','DanhMucId=1');
$data['PAGING'] = showPagingAtLink($data['count'], $data['pagesize'], $data['current'], '' . SITE_NAME . '/ve-noi-dia/');
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
show_menu($data,'venoidia');
show_venoidia($data);
show_right2($data);
show_footer($data,'venoidia');
