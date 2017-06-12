<?php
/**
 * Created by PhpStorm.
 * User: nhansay
 * Date: 30/07/2015
 * Time: 12:46 SA
 */

if ( !defined( 'SITE_NAME' ) ) {
	require_once '../../config.php';
}

require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/upload_image.php';
require_once( DIR . "/common/hash_pass.php" );
require_once( DIR . "/common/redict.php" );


function redirect_one_pay_inland( $data = array(), $_post = array(), $return_url ) {

	$one_pay = array();

	$virtualPaymentClientURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op';
	$SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";
	$one_pay['Title'] = 'VPC 3-Party';

	// Merchant ID được cấp bởi one pay
	$one_pay['vpc_Merchant'] = 'TESTONEPAY';
	// Merchant AccessCode được cấp bởi one pay
	$one_pay['vpc_AccessCode'] = '6BEB2546';
	// ID giao dịch, random, khác nhau mỗi lần thanh toán, tối đa 40 ký tự
	$one_pay['vpc_MerchTxnRef'] = date( 'YmdHis' ) . rand();
	// tên hóa đơn, tối đa 34 ký tự
	$one_pay['vpc_OrderInfo'] = $data->Id;
	// Số tiền cần thanh toán,Đã được nhân với 100. VD: 100=1VND
	$one_pay['vpc_Amount'] = $data->TicketPrice*100;
	// Url nhận kết quả trả về sau khi giao dịch hoàn thành
	$one_pay['vpc_ReturnURL'] = $return_url;
	// Phiên bản modul (cố định)
	$one_pay['vpc_Version'] = '2';
	// Loại request (cố định)
	$one_pay['vpc_Command'] = 'pay';
	// Ngôn ngữ hiện thị trên cổng (vn/en)
	$one_pay['vpc_Locale'] = 'vn';
	// Loại tiền tệ (VND)
	$one_pay['vpc_Currency'] = 'VND';
	// IP address
	$one_pay['vpc_TicketNo'] = $_SERVER ['REMOTE_ADDR'];
	// Địa chỉ gửi hàng
	$one_pay['vpc_SHIP_Street01'] = $_post['diachi_lienhe'];
	// Quận Huyện(địa chỉ gửi hàng)
	$one_pay['vpc_SHIP_Provice'] = '';
	// Tỉnh/thành phố (địa chỉ khách hàng)
	$one_pay['vpc_SHIP_City'] = '';
	// Quốc gia(địa chỉ khách hàng)
	$one_pay['vpc_SHIP_Country'] = 'Viet Nam';
	// Số điện thoại khách hàng
	$one_pay['vpc_Customer_Phone'] = $_post['sdt_lienhe'];
	// Email KH
	$one_pay['vpc_Customer_Email'] = $_post['email_lienhe'];
	// Tên tài khoản khách hàng trên hệ thống
	$one_pay['vpc_Customer_Id'] = '';

// add the start of the vpcURL querystring parameters
// *****************************Lấy giá trị url cổng thanh toán*****************************
	$vpcURL = $virtualPaymentClientURL . "?";

//$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
	$stringHashData = "";
// sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
// arrange array data a-z before make a hash
	ksort( $one_pay );

// set a parameter to show the first pair in the URL
// đặt tham số đếm = 0
	$appendAmp = 0;

	foreach ( $one_pay as $key => $value ) {

		// create the md5 input and URL leaving out any fields that have no value
		// tạo chuỗi đầu dữ liệu những tham số có dữ liệu
		if ( strlen( $value ) > 0 ) {
			// this ensures the first paramter of the URL is preceded by the '?' char
			if ( $appendAmp == 0 ) {
				$vpcURL .= urlencode( $key ) . '=' . urlencode( $value );
				$appendAmp = 1;
			} else {
				$vpcURL .= '&' . urlencode( $key ) . "=" . urlencode( $value );
			}
			//$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
			if ( ( strlen( $value ) > 0 ) && ( ( substr( $key, 0, 4 ) == "vpc_" ) || ( substr( $key, 0, 5 ) == "user_" ) ) ) {
				$stringHashData .= $key . "=" . $value . "&";
			}
		}
	}
//*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
	$stringHashData = rtrim( $stringHashData, "&" );
// Create the secure hash and append it to the Virtual Payment Client Data if
// the merchant secret has been provided.
// thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
	if ( strlen( $SECURE_SECRET ) > 0 ) {
		//$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
		// *****************************Thay hàm mã hóa dữ liệu*****************************
		$vpcURL .= "&vpc_SecureHash=" . strtoupper( hash_hmac( 'SHA256', $stringHashData, pack( 'H*', $SECURE_SECRET ) ) );
	}

// FINISH TRANSACTION - Redirect the customers using the Digital Order
// ===================================================================
// chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
	echo $vpcURL;exit();
	header( "Location: " . $vpcURL );

// *******************
// END OF MAIN PROGRAM
// *******************
	
}