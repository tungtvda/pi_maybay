<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_chitietdichvu($data = array())
{
    $asign = array();
    $asign['tieude']="";
    $asign['Img']=$data['chitiet'][0]->Img;
    $asign['Avatar']=$data['chitiet'][0]->Avatar;
    $asign['Skype']=$data['chitiet'][0]->Skype;
    $asign['Yahoo']=$data['chitiet'][0]->Yahoo;
    $asign['Email']=$data['chitiet'][0]->Email;
    $asign['Name_ht']=$data['chitiet'][0]->Name_ht;
    $asign['Phone']=$data['chitiet'][0]->Phone;
    if($_SESSION['kiemtra']==1)
    {
        $asign['banchay_td']="TỐP KHÁCH SẠN BÁN CHẠY NHẤT";
        $asign['datdv_td']="HỖ TRỢ ĐẶT DỊCH VỤ";
        $asign['noibat_td']="KHÁCH SẠN NỔI BẬT";
        $asign['guiyc_td']="GỬI YÊU CẦU CỦA BẠN CHO CHÚNG TÔI";
        $asign['NoiDung']=$data['chitiet'][0]->NoiDung;
        $name=$asign['name']=$data['chitiet'][0]->Name;
        $asign['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Trang chủ</a> <i class="fa fa-angle-right"></i> <a href="'.SITE_NAME.'/dich-vu/">Dịch vụ</a> <i class="fa fa-angle-right"></i> <span>'.$name.'</span>';
        $asign['MoTaNgan_ht']=$data['chitiet'][0]-> MoTaNgan_ht;
        $asign['name_tt7'] = $data['name_tt7'][0]->Name;

        $asign['tendv_td']="Tên dịch vụ";
        $asign['ten_td']="Họ và tên";
        $asign['dt_td']="Điện thoại";
        $asign['dc_td']="Địa chỉ";
        $asign['yc_td']="Yêu cầu";
        $asign['bnt_td']="Gửi yêu cầu";

    }
    else
    {
        $asign['banchay_td']="BEST-SELLING TOP HOTEL";
        $asign['datdv_td']="SUPPORT BOOKING SERVICE";
        $asign['noibat_td']="FEATURED HOTEL";
        $asign['guiyc_td']="SEND YOUR REQUEST FOR OUR";
        $asign['NoiDung']=$data['chitiet'][0]->NoiDung_en;
        $name=$asign['name']=$data['chitiet'][0]->Name_en;
        $asign['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> <a href="'.SITE_NAME.'/dich-vu/">Services</a> <i class="fa fa-angle-right"></i> <span>'.$name.'</span>';
        $asign['MoTaNgan_ht']=$data['chitiet'][0]-> MoTaNgan_ht_en;
        $asign['name_tt7'] = $data['name_tt7'][0]->Name_en;
        $asign['tendv_td']="Service name";
        $asign['ten_td']="Full name";
        $asign['dt_td']="Phone";
        $asign['dc_td']="Address";
        $asign['yc_td']="Request";
        $asign['bnt_td']="Send request";
    }

    $asign['banchay'] = "";
    if (count($data['banchay']) > 0) {
        $asign['banchay'] = print_item('dichvu_sub', $data['banchay']);
    }
    else
    {
        $asign['an']="hidden";
    }
    $asign['noibat'] = "";
    if (count($data['noibat']) > 0) {
        $asign['noibat'] = print_item('dichvu_sub_noibat', $data['noibat']);
    }
    else
    {
        $asign['an1']="hidden";
    }



    $asign['Name_kt']="";
    if(isset($data['Name_kt']))
    {
        $asign['Name_kt']=$data['Name_kt'];
    }

    $asign['Name_dp']="";
    if(isset($data['Name_dp']))
    {
        $asign['Name_dp']=$data['Name_dp'];
    }
    $asign['Email_dp']="";
    if(isset($data['Email_dp']))
    {
        $asign['Email_dp']=$data['Email_dp'];
    }
    $asign['Phone_dp']="";
    if(isset($data['Phone_dp']))
    {
        $asign['Phone_dp']=$data['Phone_dp'];
    }
    $asign['Address_dp']="";
    if(isset($data['Address_dp']))
    {
        $asign['Address_dp']=$data['Address_dp'];
    }
    $asign['NoiDung_dp']="";
    if(isset($data['NoiDung_dp']))
    {
        $asign['NoiDung_dp']=$data['NoiDung_dp'];
    }
    print_template($asign, 'chitietdichvu');
}