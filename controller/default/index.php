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

$data['gioithieu']=gioithieu_getByTop(1,'','');
$data['quangcao']=quangcao_getByTop(1,'','');
$data['mangxahoi']=mangxahoi_getById(1);
$data['tieuchi']=tieuchi_getByTop(3,'','Id asc');
$data['danhmuchotro']=danhmuchotro_getByTop('','','Id desc');
$data['dichvu']=dichvu_getByTop('','','ViTri asc');
$data['hinhthucthanhtoan']=hinhthucthanhtoan_getByTop('','','Id asc');

$data['venoidia_index']=venoidia_getByTop(7,'DanhMucId=1','Id desc');
$data['vequocte_index']=venoidia_getByTop(7,'DanhMucId=2','Id desc');

$data['tinkhuyenmai']=tinkhuyenmai_getByTop('','NoiBat=1','Id desc');
if($_SESSION['kiemtra']==1)
{
    $title=($data['config'][0]->Title)?$data['config'][0]->Title:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
}
else
{
    $title=($data['config'][0]->Title_en)?$data['config'][0]->Title_en:'SERVICES LTD - TRANSPORT AND INTERNATIONAL TRAVEL COACH';
}

$description=($data['config'][0]->Description)?$data['config'][0]->Description:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
$keywords=($data['config'][0]->Keyword)?$data['config'][0]->Keyword:'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
show_header($title,$description,$keywords,$data);
//
show_menu($data,'trangchu');
show_index($data);
show_footer($data,'trangchu');
