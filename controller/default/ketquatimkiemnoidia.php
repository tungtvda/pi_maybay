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
require_once DIR.'/common/redict.php';
$data['config']=config_getByTop(1,'','');

$data['name_tt6']=tieude_getById(6);
$data['danhmuc']=menu_getById(14);

$_SESSION['giatri_ss']=$sessionid = $_GET['sessionid'];
if(isset($_SESSION['s'.$sessionid])) {
    $dataarray = $_SESSION['s'.$sessionid];
}
else {
    $dataarray="";
}

$data['RoundTrip']=$RoundTrip= $dataarray['RoundTrip'];
$data['FromPlace']=$FromPlace = $dataarray['FromPlace'];
$data['TFromPlace']=$TFromPlace = $dataarray['TFromPlace'];
$data['ToPlace']=$ToPlace = $dataarray['ToPlace'];
$data['TToPlace']=$TToPlace = $dataarray['TToPlace'];
$data['DepartDate']=$DepartDate = $dataarray['DepartDate'];
$data['ReturnDate']=$ReturnDate = $dataarray['ReturnDate'];
$data['Adult']=$Adult = $dataarray['Adult'];
$data['Child']=$Child = $dataarray['Child'];
$data['Infant']=$Infant = $dataarray['Infant'];
$data_post = '{
	"RoundTrip": '.$RoundTrip.',
	"FromPlace": "'.$FromPlace.'",
	"TFromPlace": "'.$TFromPlace.'",
	"ToPlace": "'.$ToPlace.'",
	"TToPlace": "'.$TToPlace.'",
	"DepartDate": "'.$DepartDate.'",
	"ReturnDate": "'.$ReturnDate.'",
	"CurrencyType": "VND",
	"Adult": '.$Adult.',
	"Child": '.$Child.',
	"Infant": '.$Infant.',
	"Sources": "Abacus"
	}';

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

show_menu($data,'timkiem');

show_timkiemchuyenbay($data,$data_post);

show_footer($data,'timkiem');
