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

if(isset($_POST['FromPlace']))
{
    if(isset( $_POST['RoundTrip']) && $_POST['RoundTrip'] == 'true')
        $data['roundTrip']=$roundTrip = "true";
    else
        $data['roundTrip']= $roundTrip = "false";

    $data['FromPlace']=$FromPlace = $_POST['FromPlace'];
    $data['TFromPlace']=$TFromPlace = $_POST['TFromPlace'];
    $data['ToPlace']=$ToPlace = $_POST['ToPlace'];
    $data['TToPlace']=$TToPlace = $_POST['TToPlace'];

    $data['DepartDate']= $_POST['DepartDate'];
	$data['ReturnDate']= $_POST['ReturnDate'];
    $data['adult']=$_POST['adult'];
	$data['child']=$_POST['child'];
	$data['infant']=$_POST['infant'];

    $data_post = '{
	"RoundTrip": '.$roundTrip.',
	"FromPlace": "'.$FromPlace.'",
	"ToPlace": "'.$_POST['ToPlace'].'",
	"DepartDate": "'.$_POST['DepartDate'].'T00:00:00",
	"ReturnDate": "'.$_POST['ReturnDate'].'T00:00:00",
	"CurrencyType": "VND",
	"Adult": '.$_POST['adult'].',
	"Child": '.$_POST['child'].',
	"Infant": '.$_POST['infant'].',
	"Sources": "VietJetAir,JetStar,Abacus"
	}';
//"Sources": "VietJetAir,VietnamAirlines,JetStar" -  Muốn tìm bao nhiêu hãng thì thêm vào cách nhau dấu ','
    $username = 'sanve24h.com'; $password = 'sanve@admin';

    $ch = curl_init();

    $url = 'http://api.atvietnam.vn/oapi/airline/Flights/Find?$expand=TicketPriceDetails,TicketOptions,Details';
// expand thêm 3 trường TicketPriceDetails,Details,TicketOptions (có thể chỉ chọn 1 hay nhiều )
// TicketPriceDetails : Chi tiết giá Net , thuế phí của người lớn, trẻ em ...
// Details : Chi tiết các chặng dừng
// TicketOptions : Các hạng mục vé khác ( nếu có ), vd VNAirline có Economy Save, Economy Standard ...

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//curl_setopt($ch, CURLINFO_HEADER_OUT, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json' )
    );

    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);    		  //  curl authentication

    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");		//  curl authentication

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_post);

    $str=  curl_exec($ch);

    curl_close($ch);

//echo $str;

    $data12 = json_decode($str);


//$data['danhsach']=$data = json_decode($str);			// Dữ liệu trả về là kiểu stdClass Object

//print_r($data12);				// dữ liệu chưa xử lý.
//
//echo 'record : '.count($data->value).'<br />';
}
else
{
//    redict(SITE_NAME);
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
$data12="";
show_menu($data,'timkiem');
show_timkiemchuyenbayquocte($data,$data12);
//show_right($data);
show_footer($data);
