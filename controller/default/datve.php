<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if (!defined('SITE_NAME')) {
    require_once '../../config.php';
}
function returnnumber($num)
{
    if ($num > 10) {
        return $num;
    } else {
        return '0' . $num;
    }
}

function separateToFirstAndLastName($fullName)
{
    $realName = removeRedundantSpaces($fullName);
    $wordArray = explode(' ', $realName);
    $middleName = " ";
    if (count($wordArray) > 2) {
        reset($wordArray);
        $firstName = key($wordArray);
        end($wordArray);
        $lastName = key($wordArray);
        array_shift($wordArray);
        array_pop($wordArray);
        if (count($wordArray) >= 1)
            $middleName = implode(" ", $wordArray);
    }
    return array($firstName, $middleName, $lastName);
}

function removeRedundantSpaces($fullName)
{
    $Result = NULL;
    for ($i = 0; $i < strlen($fullName); $i++) {
        if (substr($fullName, $i, 1) != ' ') {
            $Result .= trim(substr($fullName, $i, 1));
        } else {
            while (substr($fullName, $i, 1) == ' ') {
                $i++;
            }
            $Result .= ' ';
            $i--;
        }
    }
    return trim($Result);
}

//var_dump(separateToFirstAndLastName('Văn Tiến Công'));
//var_dump(removeRedundantSpaces("Văn Tiến Công"));

require_once DIR . '/controller/default/public.php';
require_once DIR . '/common/redict.php';
require_once(DIR . "/common/Mail.php");
$data['config'] = config_getByTop(1, '', '');

$data['name_tt6'] = tieude_getById(6);
$data['danhmuc'] = menu_getById(15);
$data['nganhang'] = nganhang_getByTop('', '', 'Id desc');
$data['vanphong'] = vanphong_getByTop('', '', 'Id desc');

$sessionid = isset($_SESSION['giatri_ss']) ? $_SESSION['giatri_ss'] : "";
if (isset($_SESSION['s' . $sessionid])) {
    $dataarray = $_SESSION['s' . $sessionid];
} else {
    $dataarray = "";
}
if (isset($_POST['bntDatVe'])) {
    $Blockfalse = isset($_POST['Blockfalse']) ? str_replace(" ", "", $_POST['Blockfalse']) : "";
    $Blocktruelanding = isset($_POST['Blocktruelanding']) ? str_replace(" ", "", $_POST['Blocktruelanding']) : "";
    $Blocktruedepart = isset($_POST['Blocktruedepart']) ? str_replace(" ", "", $_POST['Blocktruedepart']) : "";
    if ($dataarray['RoundTrip'] == 'true') {
        $link = SITE_NAME . '/dat-ve/?sessionid=' . $sessionid . '&outbound=' . $Blocktruelanding . '&inbound=' . $Blocktruedepart;;
    } else {
        $link = SITE_NAME . '/dat-ve/?sessionid=' . $sessionid . '&outbound=' . $Blockfalse;
    }
    echo "<script>window.location.href='$link'</script>";
}

if (isset($_SESSION['dulieu_tk'])) {
    $data_dulieu = $_SESSION['dulieu_tk'];
}
//var_dump($data_dulieu);
$data_post_depart = '';
if (isset($_POST['thanh-toan-tainha']) || isset($_POST['thanh-toan-vanphong']) || isset($_POST['thanh-toan-nganhang']) || isset($_POST['onepay-noidia']) || isset($_POST['onepay-quocte'])) {
    foreach ($data_dulieu->value as $val) {
        $data_post_landing = '';
        if (isset($_GET['outbound']) && str_replace(" ", "", $val->FlightNumber) == $_GET['outbound']) {
            $data_post_depart .= '{
                "CurrencyType": "VND",
                "Brand": "' . str_replace(" ", "", $val->Airline) . '",
                "RoundTrip":' . $dataarray['RoundTrip'] . ',
                "FromPlaceCode": "' . $dataarray['FromPlace'] . '",
                "ToPlaceCode": "' . $dataarray['ToPlace'] . '",
                "CallBackUrl": "http://tourcoach.com/test",
                "Adult": ' . $dataarray['Adult'] . ',
                "Child": ' . $dataarray['Child'] . ',
                "Infant": ' . $dataarray['Infant'] . ',
                "DepartDate": "' . $val->DepartTime . '",
                "FlightNumber": "' . $_GET['outbound'] . '",'
                . ($val->Airline == "VietnamAirlines" ? '"FareBasis" : "' . $val->FareBasis . '",' : '') .
                '"TicketPrice": "' . number_format($val->Price, 0, ',', '') . '",
                "TicketType": "' . $val->TicketType . '"';
            if ($dataarray['RoundTrip'] == "true") {
                foreach ($data_dulieu->value as $val2) {
                    if (isset($_GET['inbound']) && str_replace(" ", "", $val2->FlightNumber) == $_GET['inbound']) {
                        $data_post_depart .= ',
                        "ReturnDate" : "' . $val->LandingTime . '",
                        "ReturnFlightNumber" : "' . $_GET['inbound'] . '",'
                            . ($val2->Airline == "VietnamAirlines" ? '"ReturnFareBasis" : "' . $val2->FareBasis . '",' : '') .
                            '"ReturnTicketPrice" : "' . number_format($val2->Price, 0, ',', '') . '",
                        "ReturnTicketType" : "' . $val2->TicketType . '"';
                    }
                }
            }
            $data_post_depart .= ',"BookingPassengers": [';
            for ($i = 1; $i <= $dataarray["Adult"]; $i++) {
                if ($i == 1) {
                    $data_post_depart .= '{
                        "PassengerType": 0,
                        "Title": "' . $_POST['quydanh_nl_' . $i] . '",
                        "Gender": 1,
                        "FirstName":"' . strtoupper($_POST['ho_nl_' . $i]) . '",
                        "LastName":"' . strtoupper($_POST['ten_nl_' . $i]) . '",
                        "MiddleName":"' . strtoupper($_POST['tenlot_nl_' . $i]) . '",
                        "MobileNumber": "' . $_POST['sdt_lienhe'] . '",
                        "BirthDay": "' . $_POST['nam_nl_' . $i] . '-' . returnnumber($_POST['thang_nl_' . $i]) . '-' . returnnumber($_POST['ngaysinh_nl_' . $i]) . 'T00:00:00",
                        "Email": "' . $_POST['email_lienhe'] . '",
                        "Country" : "VN",
                        "City" : "HCM",
                        "Province" : "10241",
                        "Address" : "' . $_POST['email_lienhe'] . '",
                        "Baggage": 0';
                    if ($dataarray['RoundTrip'] == "true") {
                        foreach ($data_dulieu->value as $val2) {
                            if (isset($_GET['inbound']) && str_replace(" ", "", $val2->FlightNumber) == $_GET['inbound']) {
                                $data_post_depart .= ',"ReturnBaggage" : 0';
                            }
                        }
                    }
                    $data_post_depart .= '}';
                } else {
                    $data_post_depart .= ',{
                        "PassengerType": 0,
                        "Gender": 1,
                        "Title": "' . $_POST['quydanh_nl_' . $i] . '",
                        "FirstName":"' . strtoupper($_POST['ho_nl_' . $i]) . '",
                        "LastName":"' . strtoupper($_POST['ten_nl_' . $i]) . '",
                        "MiddleName":"' . strtoupper($_POST['tenlot_nl_' . $i]) . '",
                        "Baggage": 0,
                        "BirthDay": "' . $_POST['nam_nl_' . $i] . '-' . returnnumber($_POST['thang_nl_' . $i]) . '-' . returnnumber($_POST['ngaysinh_nl_' . $i]) . 'T00:00:00"
                    }';
                }
            }
            for ($i = 1; $i <= $dataarray["Child"]; $i++) {
                $data_post_depart .= ',{
                    "PassengerType": 1,
                    "Gender": 1,
                    "Title": "' . $_POST['quydanh_te_' . $i] . '",
                    "FirstName": "' . strtoupper($_POST['ho_te_' . $i]) . '",
                    "LastName": "' . strtoupper($_POST['ten_te_' . $i]) . '",
                    "MiddleName": "' . strtoupper($_POST['tenlot_te_' . $i]) . '",
                    "BirthDay": "' . $_POST['nam_te_' . $i] . '-' . returnnumber($_POST['thang_te_' . $i]) . '-' . returnnumber($_POST['ngaysinh_te_' . $i]) . 'T00:00:00",
                    "Baggage": 0
                }';
            }
            for ($i = 1; $i <= $dataarray["Infant"]; $i++) {
                $data_post_depart .= ',{
                    "PassengerType": 2,
                    "Title": "' . strtoupper($_POST['quydanh_ss_' . $i]) . '",
                    "Gender": 1,
                    "FirstName":"' . strtoupper($_POST['ten_ss_' . $i]) . '",
                    "LastName":"' . strtoupper($_POST['ten_ss_' . $i]) . '",
                    "MiddleName":"' . strtoupper($_POST['tenlot_ss_' . $i]) . '",
                    "BirthDay": "' . $_POST['nam_ss_' . $i] . '-' . returnnumber($_POST['thang_ss_' . $i]) . '-' . returnnumber($_POST['ngaysinh_ss_' . $i]) . 'T00:00:00"
                }';
            }
            $data_post_depart .= ']}';
            //var_dump($data_post_depart);
            $username = 'sanve24h.com';
            $password = 'sanve@admin';
            $ch = curl_init();
            $url = 'http://api.atvietnam.vn/oapi/airline/Bookings';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json')
            );
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); //  curl authentication
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password"); //  curl authentication
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post_depart);
            $str = curl_exec($ch);
            curl_close($ch);
            //echo $str;
            $data_datve = json_decode($str); // Dữ liệu trả về là kiểu stdClass Object

            $_SESSION['d' . $data_datve->Id] = $data_datve;

            $datve = new datve();
            $datve->TrangThaiThanhToan = 1;
            $datve->MaDatVe = $data_datve->Id;
            $datve->HangBay = $data_datve->Brand;
            $datve->LoaiVe = $data_datve->TicketType;
            $datve->ChieuDi = $data_datve->ToPlace;
            $datve->ChieuVe = $data_datve->FromPlace;
            $datve->NgayDi = date("d/m/Y", strtotime($data_datve->DepartDate));
            if ($data_datve->RoundTrip == "true") {
                $datve->NgayVe = date("d/m/Y", strtotime($data_datve->ReturnDate));
            } else {
                $datve->NgayVe = "Vé một chiều";
            }
            $datve->SoNguoiLon = $data_datve->Adult;
            $datve->SoTreEm = $data_datve->Child;
            $datve->TreSoSinh = $data_datve->Infant;
            $datve->ThanhTien = $data_datve->TicketPrice;
            $datve->NguoiDaiDien = $_POST['hoten_lienhe'];
            $datve->Phone = $_POST['sdt_lienhe'];
            $datve->Email = $_POST['email_lienhe'];
            $datve->Address = $_POST['diachi_lienhe'];
            $datve->YeuCau = $_POST['yeucau_lienhe'];
            if (isset($_POST['xuathoadon']) && $_POST['xuathoadon'] == 'true') {
                $datve->MaSoThue = $_POST['masothue'];
                $datve->TenCongTy = $_POST['tencongty'];
                $datve->DiaChiCongTy = $_POST['diachicongty'];
                $datve->DiaChiNhanHoaDon = $_POST['diachinhanhoadon'];
            } else {
                $datve->MaSoThue = '';
                $datve->TenCongTy = '';
                $datve->DiaChiCongTy = '';
                $datve->DiaChiNhanHoaDon = '';
            }
            $datve->NgayDat = date("H:i-d/m/Y", time());
            $logo_lh = $data['config'][0]->Logo;
            $message ="";
            $message .= '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <div style="background:#e3f5ff;padding:10px;float:left;font-size:12px;font-family:arial,tahoma;width:680px">
            <span style="float:right;font-size:11px;padding-bottom:3px"></span>
            <table style="border:1px solid #aad3e9;background:#fff;width:680px" cellpadding="0" cellspacing="0"><tbody><tr>
            <td colspan="3" style="padding:5px 0;text-align:center">
                <a href="" style="font-size:50px;color:#2384b3;text-decoration:none;font-weight:bold"target="_blank"><span>';
                $message .= ' <img src="http://sanve24h.com/' . $logo_lh . '"style="border:none" class="CToWUd"></span></a></td>';
            $message .= '<td colspan="4" style="font-size:24px;font-weight:bold;color:#ff8c00;text-align:center">Cam kết giá tốt nhất</td></tr><tr>
            <td colspan="7" style="padding:7px 10px;font-size:12px">';
             $message .= '<p> Chào quý khách, <b>'.$_POST['hoten_lienhe'].'</b>!</p>';
            $message .= '<p style="padding-bottom:10px;border-bottom:1px dashed #dcdcdc;line-height:28px">
            <b style="color:#143a83">Xin cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi !</b>
            <br> <span style="color:red;font-weight:bold">Xin quý khách lưu ý: Đây là email được hệ thống gửi tự động đến địa chỉ';
           $message .= ' <a href="mailto:'.$_POST['email_lienhe'].'" target="_blank">'.$_POST['email_lienhe'].'</a>, xin quý khách không trả lời email này. Mọi thông tin phản hồi, khiếu nại hoặc đóng góp ý kiến xin liên hệ trực tiếp vào số Hotline '.$data['config'][0]->Hotline.' hoặc tại form <a href="'.SITE_NAME.'/lien-he.html" target="_blank">liên hệ</a>. Xin cảm ơn!</span></p>';

            $message .= '<h3 style="font-family:arial,tahoma;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:5px;padding-right:0px;padding-bottom:10px;padding-left:0px;color:#143a83;font-size:12px">
            Thông tin đơn hàng
            </h3>
            <table style="width:648px" border="0" cellpadding="1" cellspacing="1">
            <tbody> <tr>
            <td width="108">
             <span style="font-size:12px">Mã đơn hàng:<span style="white-space:pre-wrap"> </span></span>
            </td>
            <td width="250">';
            $message .= ' <span style="font-size:12px;font-weight:bold">'.$data_datve->Id.'</span>';
            $message .= '</td><td rowspan="4"></td></tr><tr>
        <td>
            <span style="font-size:12px">Trạng thái:&nbsp;</span>
        </td>
        <td>
            <span style="font-size:12px;font-weight:bold">Chờ xác nhận</span>
        </td>
        </tr>
        <tr>
        <td style="padding-bottom:5px">
            <span style="font-size:12px">Loại vé :&nbsp;</span>
        </td>
        <td style="padding-bottom:5px">';
            $message .= '<span style="font-size:12px;font-weight:bold">'.$data_datve->TicketType.'&nbsp;</span></td></tr><tr>';
            $message .= '<td>
            <span style="font-size:12px">Tổng giá : &nbsp;<span style="color:#ff8c00"></span></span>
            </td>
         <td style="padding-bottom:5px;color:#fd5304">
            <b>&nbsp;'.$data_datve->TicketPrice.' VNĐ</b>
         </td></tr></tbody>';
            $message .= '</table>
            <h3 style="font-family:arial,tahoma;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:5px;padding-right:0px;padding-bottom:10px;padding-left:0px;color:#143a83;font-size:12px">
            Thông tin Liên hệ</h3>

            <table border="0" cellpadding="1" cellspacing="1">
             <tbody><tr><td style="width:110px">Họ tên</td>
            <td style="width:300px">'.$_POST['hoten_lienhe'].'</td></tr><tr> <td>Số điện thoại</td><td>'.$_POST['sdt_lienhe'].'</td></tr></tbody>
            </table>
            <h3 style="font-family:arial,tahoma;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:5px;padding-right:0px;padding-bottom:10px;padding-left:0px;color:#143a83;font-size:12px">
            Thông tin Hành khách</h3>
            <table style="width:648px" border="0" cellpadding="1" cellspacing="1">
            <tbody>
    <tr>
        <td width="108"><span style="font-size:12px">Ông</span></td>
        <td width="516"><span style="font-size:12px">'.$_POST['hoten_lienhe'].'</span></td>
    </tr>
    </tbody>
    </table>
    <h3 style="font-family:arial,tahoma;margin-top:0px;margin-right:0px;margin-bottom:0px;margin-left:0px;padding-top:5px;padding-right:0px;padding-bottom:10px;padding-left:0px;color:#143a83;font-size:12px">
    Thông tin chuyến bay</h3>
    <table style="width:648px" border="0" cellpadding="1" cellspacing="1">
    <tbody>
    <tr>
        <td width="108">
            <span style="font-size:12px">Điểm đi:</span>
        </td>
        <td width="226">
            <span style="font-size:12px;font-weight:bold">'.$data_datve->ToPlace.'</span>
        </td>
        <td width="63">
            <span style="font-size:12px">Điểm Đến:</span>
        </td>
        <td width="238">
            <span style="font-size:12px;font-weight:bold">'.$data_datve->FromPlace.'</span>
        </td>
    </tr>
    <tr>';

            $message .= '<td width="108">
            <span style="font-size:12px">Ngày xuất phát:</span>
        </td>
        <td width="226">';
            $message .= '<span style="font-size:12px;font-weight:bold">'. date("d/m/Y", strtotime($data_datve->DepartDate)).'</span>
        </td>';
            if ($data_datve->RoundTrip == "true") {
                $message .= '<td width="63">
            <span style="font-size:12px">Ngày về:</span>
        </td>
        <td width="238">
            <span style="font-size:12px;font-weight:bold">'.date("d/m/Y", strtotime($data_datve->ReturnDate)).'</span>
        </td>';

            }
            $message .= '</tr>
    <tr>
        <td width="108">
            <span style="font-size:12px">Hãng hàng không:</span>
        </td>
        <td width="226">
            <span style="font-size:12px;font-weight:bold">'.$data_datve->Brand.'</span>
        </td>
        <td width="63">
            &nbsp;
        </td>
        <td width="238">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td width="108">
            <span style="font-size:12px">Hình thức thanh toán:</span>
        </td>
        <td width="226">';
            if (isset($_POST['thanh-toan-tainha'])) {
                $message .= ' <span style="font-size:12px;font-weight:bold">Thanh toán tại nhà</span>';
            }
            if (isset($_POST['thanh-toan-vanphong'])) {
                $message .= ' <span style="font-size:12px;font-weight:bold">Thanh toán tại văn phòng TourCoach</span>';
            }
            if (isset($_POST['thanh-toan-nganhang'])) {
                $message .= ' <span style="font-size:12px;font-weight:bold">Thanh toán qua ngân hàng</span>';
            }
            if (isset($_POST['onepay-noidia'])) {
                $message .= ' <span style="font-size:12px;font-weight:bold">Thanh toán qua Onepay Nội địa</span>';
            }
            if (isset($_POST['onepay-quocte'])) {
                $message .= ' <span style="font-size:12px;font-weight:bold">Thanh toán qua Onepay quốc tế</span>';
            }

            $message .= '</td>
        <td width="63">
            &nbsp;
        </td>
        <td width="238">
            &nbsp;
        </td>
    </tr>

    <tr>
        <td colspan="4">
        </td>
    </tr>
    <tr>
        <td colspan="4">
            * <b><a style="font-style:italic" href=""target="_blank">Xem chi tiết chuyến bay</a></b>
            <br>


            <div style="border:1px solid gray;background:whitesmoke;margin-top:10px">
                <div style="padding:10px;color:#fd5304;font-weight:bold">Chúng tôi xin lưu ý với quý khách đây là yêu
                    cầu đặt vé chứ chưa phải xác nhận về giá và chỗ.<br> Chúng tôi sẽ xử lý yêu cầu này và xác nhận lại
                    với quý khách trong thời gian sớm nhất
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>

</td>
</tr>
</tbody>
</table>
<div class="yj6qo"></div>
<div class="adL">
</div>
</div>';
            $subject = "Thông báo đặt vé tại Tourcoach";
            $email = $_POST['email_lienhe'];
            if (isset($_POST['thanh-toan-tainha'])) {
                $datve->HTTT = 'Thanh toán tại nhà';
                datve_insert($datve);
//                $message .= "<p>Hình thức thanh toán:  <span style='color: #4010ff'>Thanh toán tại nhà</span></p>";
                SendMail($email, $message, $subject);
                $link = SITE_NAME . '/confirmation/?orderid=' . $data_datve->Id . '&method=1';
                echo "<script>window.location.href='$link'</script>";
            }
            if (isset($_POST['thanh-toan-vanphong'])) {
                $datve->HTTT = 'Thanh toán tại văn phòng';
                datve_insert($datve);
//                $message .= "<p>Hình thức thanh toán:  <span style='color: #4010ff'>Thanh toán tại văn phòng TourCoach</span></p>";
                SendMail($email, $message, $subject);
                $link = SITE_NAME . '/confirmation/?orderid=' . $data_datve->Id . '&method=2';
                echo "<script>window.location.href='$link'</script>";
            }
            if (isset($_POST['thanh-toan-nganhang'])) {
                $datve->HTTT = 'Thanh toán qua ngân hàng';
                datve_insert($datve);
//                $message .= "<p>Hình thức thanh toán:  <span style='color: #4010ff'>Thanh toán qua ngân hàng</span></p>";
                SendMail($email, $message, $subject);
                $link = SITE_NAME . '/confirmation/?orderid=' . $data_datve->Id . '&method=3';
                echo "<script>window.location.href='$link'</script>";
            }
            if (isset($_POST['onepay-noidia'])) {
                //var_dump($data_datve);
                $datve->HTTT = 'Thanh toán qua Onepay Nội địa';
                datve_insert($datve);
//                $message .= "<p>Hình thức thanh toán:  <span style='color: #4010ff'>Thanh toán qua Onepay Nội địa</span></p>";
                SendMail($email, $message, $subject);

                // code by nhan say
                require_once DIR . '/controller/default/one_pay_inland.php';
                //controller sẽ nhận kết quả trả về của one pay để xử lý
                $return_url = SITE_NAME . '/confirmation/?orderid=' . $data_datve->Id . '&method=4';

                // lấy các tham số để redirect sang one pay
                redirect_one_pay_inland($data_datve, $_POST, $return_url);
            }

            if (isset($_POST['onepay-quocte'])) {
                $datve->HTTT = 'Thanh toán qua Onepay Quốc tế';
                datve_insert($datve);
//                $message .= "<p>Hình thức thanh toán:  <span style='color: #4010ff'>Thanh toán qua Onepay Quốc tế</span></p>";
                SendMail($email, $message, $subject);

                // code by nhan say
                require_once DIR . '/controller/default/one_pay_inter.php';

                // controller sẽ nhận kết quả trả về của one pay để xử lý
                $return_url = SITE_NAME . '/confirmation/?orderid=' . $data_datve->Id . '&method=5';

                // lấy các tham số để redirect sang one pay
                redirect_one_pay_inter($data_datve, $_POST, $return_url);
            }
        }
    }
}

if ($_SESSION['kiemtra'] == 1) {
    $title = ($data['danhmuc'][0]->Title) ? $data['danhmuc'][0]->Title : 'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
} else {
    $title = ($data['danhmuc'][0]->Title_en) ? $data['danhmuc'][0]->Title_en : 'SERVICES LTD - TRANSPORT AND INTERNATIONAL TRAVEL COACH';
}
$description = ($data['danhmuc'][0]->Description) ? $data['danhmuc'][0]->Description : 'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
$keywords = ($data['danhmuc'][0]->Keyword) ? $data['danhmuc'][0]->Keyword : 'CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH';
show_header($title, $description, $keywords, $data);

show_menu($data, 'datve');
show_datve($data);

show_footer($data, '');