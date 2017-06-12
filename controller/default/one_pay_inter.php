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

function redirect_one_pay_inter( $data = array(), $_post = array(), $return_url ) {
	$one_pay = array();

	$SECURE_SECRET = "6D0870CDE5F24F34F3915FB0045120DB";
	$virtualPaymentClientURL = 'https://mtf.onepay.vn/vpcpay/vpcpay.op';
	$one_pay['Title'] = 'VPC 3-Party';
	$one_pay['vpc_Merchant'] = 'TESTONEPAY';
	$one_pay['vpc_AccessCode'] = '6BEB2546';
	$one_pay['vpc_MerchTxnRef'] = date('YmdHis') . rand();
	$one_pay['vpc_OrderInfo'] = $data->Id;
	$one_pay['vpc_Amount'] = $data->TicketPrice*100;
	$one_pay['vpc_ReturnURL'] = $return_url;
	$one_pay['vpc_Version'] = '2';
	$one_pay['vpc_Command'] = 'pay';
	$one_pay['vpc_Locale'] = 'en';
	$one_pay['vpc_TicketNo'] = $_SERVER ['REMOTE_ADDR'];
	$one_pay['vpc_SHIP_Street01'] = '';
	$one_pay['vpc_SHIP_Provice'] = '';
	$one_pay['vpc_SHIP_City'] = '';
	$one_pay['vpc_SHIP_Country'] = 'Viet Nam';
	$one_pay['vpc_Customer_Phone'] = $_post['sdt_lienhe'];
	$one_pay['vpc_Customer_Email'] = $_post['email_lienhe'];
	$one_pay['vpc_Customer_Id'] = '';
	$one_pay['AVS_Street01'] = $_post['diachi_lienhe'];
	$one_pay['AVS_City'] = '';
	$one_pay['AVS_StateProv'] = '';
	$one_pay['AVS_PostCode'] = '';
	$one_pay['AVS_Country'] = 'VN';
	$one_pay['AVS_Country'] = 'VN';
	$one_pay['display'] = '';

// add the start of the vpcURL querystring parameters
	$vpcURL = $virtualPaymentClientURL . "?";

	$one_pay['AgainLink'] = urlencode( $_SERVER['HTTP_REFERER'] );

//$md5HashData = $SECURE_SECRET; Khởi tạo chuỗi dữ liệu mã hóa trống
	$md5HashData = "";

	ksort( $one_pay );

// set a parameter to show the first pair in the URL
	$appendAmp = 0;

	foreach ( $one_pay as $key => $value ) {

		// create the md5 input and URL leaving out any fields that have no value
		if ( strlen( $value ) > 0 ) {

			// this ensures the first paramter of the URL is preceded by the '?' char
			if ( $appendAmp == 0 ) {
				$vpcURL .= urlencode( $key ) . '=' . urlencode( $value );
				$appendAmp = 1;
			} else {
				$vpcURL .= '&' . urlencode( $key ) . "=" . urlencode( $value );
			}
			//$md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
			if ( ( strlen( $value ) > 0 ) && ( ( substr( $key, 0, 4 ) == "vpc_" ) || ( substr( $key, 0, 5 ) == "user_" ) ) ) {
				$md5HashData .= $key . "=" . $value . "&";
			}
		}
	}
//xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa
	$md5HashData = rtrim( $md5HashData, "&" );
// Create the secure hash and append it to the Virtual Payment Client Data if
// the merchant secret has been provided.
	if ( strlen( $SECURE_SECRET ) > 0 ) {
		//$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));
		// Thay hàm mã hóa dữ liệu
		$vpcURL .= "&vpc_SecureHash=" . strtoupper( hash_hmac( 'SHA256', $md5HashData, pack( 'H*', $SECURE_SECRET ) ) );
	}

// FINISH TRANSACTION - Redirect the customers using the Digital Order
// ===================================================================
	header( "Location: " . $vpcURL );

}