<?php
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}

if(isset( $_POST['RoundTrip']) && $_POST['RoundTrip'] == 'true')
    $RoundTrip = "true";
else
    $RoundTrip = "false";

$Source = $_GET['source'];
$Type = $_GET['type'];
$SapXep = $_GET['sapxep'];
$FromPlace = $_POST['FromPlace'];
$TFromPlace = $_POST['TFromPlace'];
$ToPlace = $_POST['ToPlace'];
$TToPlace = $_POST['TToPlace'];
$Adult = $_POST['Adult'];
$Child = $_POST['Child'];
$Infant = $_POST['Infant'];
$DepartDate = date("Y-m-d", strtotime(str_replace("/","-", $_POST['DepartDate'])));
$ReturnDate = date("Y-m-d", strtotime(str_replace("/","-", $_POST['ReturnDate'])));
$data_post = '{
	"RoundTrip": "'.$RoundTrip.'",
	"FromPlace": "'.$FromPlace.'",
	"ToPlace": "'.$ToPlace.'",
	"DepartDate": "'.$DepartDate.'T00:00:00",
	"ReturnDate": "'.$ReturnDate.'T00:00:00",
	"CurrencyType": "VND",
	"Adult": '.$Adult.',
	"Child": '.$Child.',
	"Infant": '.$Infant.',
	"Sources": "'.$Source.'"
	}';

if(isset($_SESSION['dulieu_tk']))
{
    $data=$_SESSION['dulieu_tk'];
}
else
{
    //"Sources": "VietJetAir,VietnamAirlines,JetStar" -  Muốn tìm bao nhiêu hãng thì thêm vào cách nhau dấu ','
    $username = 'sanve24h.com'; $password = 'sanve@admin';
    $ch = curl_init();
    $url = 'http://api.atvietnam.vn/oapi/airline/Flights/Find?$expand=TicketPriceDetails,TicketOptions,PriceSummaries,Details';
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
    $data = json_decode($str);			// Dữ liệu trả về là kiểu stdClass Object
    unset($_SESSION['dulieu_tk']);
    $_SESSION['dulieu_tk'] = $data;
}
if(count($data)>0) {
    if ( $SapXep == "Price" ) {
        function mySort( $a, $b ) {
            return (number_format((float)($a->Price), 2, '.', '') - number_format((float)($b->Price), 2, '.', ''));
        }
    }
    if ( $SapXep == "DepartTime" ) {
        function mySort( $a, $b ) {
            return ( strcmp( $a->DepartTime, $b->DepartTime ) );
        }
    }
    if ( $SapXep == "1" ) {
        function mySort( $a, $b ) {
            return ( strcmp( $a->AirlineCode, $b->AirlineCode ) );
        }
    }
    if ( $SapXep == "VN" ) {
        function mySort( $a, $b ) {
            return ( strcmp( number_format( $a->Price ), number_format( $b->Price ) ) );
        }
    }
    if ( $SapXep == "VN" ) {
        $kiemtra_hang = $Source;
    } else {
        $kiemtra_hang = "";
    }
    uasort( $data->value, 'mySort' );
    $temp = 1;
    foreach($data->value as $val) {
        $departTime = strtotime($val->DepartTime);
        $landingTime = strtotime($val->LandingTime);
        $timeSpan = $landingTime - $departTime;
        $gio = ($timeSpan-$timeSpan%3600)/3600<10?'0'.($timeSpan-$timeSpan%3600)/3600:($timeSpan-$timeSpan%3600)/3600;
        $phut = (($timeSpan%3600)-($timeSpan%3600)%60)/60<10?'0'.(($timeSpan%3600)-($timeSpan%3600)%60)/60:(($timeSpan%3600)-($timeSpan%3600)%60)/60;
        if(date("d/m/Y", strtotime($_POST['ReturnDate'])) != date("d/m/Y", strtotime($_POST['DepartDate']))) {
            if($kiemtra_hang !="")
            {
                if($kiemtra_hang==$val->AirlineCode)
                {
                    if($RoundTrip == "true") {
                        if($Type == "depart") {
                            if(date("d/m/Y", $departTime) == date("d/m/Y", strtotime($_POST['DepartDate']))) { ?>
                                <tr class="i-result">
                                    <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                    <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                    <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                    <td class="check-ve">
                                        <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>depart" value="<?=$val->FlightNumber?>" recec="0" />
                                        <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                    </td>
                                    <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                                </tr>
                                <tr style="" class="flight-info-detail">
                                    <td class="flight-detail-content" colspan="8">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody class="view-detail-flight">
                                            <tr>
                                                <td valign="top">
                                                    <h4>Chuyến bay</h4>
                                                    <p><span><?=$val->AirlineCode?></span></p>
                                                    <p><span><?=$val->FlightNumber?></b></span></p>
                                                    <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Khởi hành</h4>
                                                    <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Điểm đến</h4>
                                                    <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" class="price-break">
                                            <tbody>
                                            <tr class="title-b">
                                                <td nowrap="" align="center" class="header">Hành khách</td>
                                                <td nowrap="" align="center" class="header">Số lượng vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                                <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                            </tr>
                                            <!-- content -->
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                            <colgroup><col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành Lý Xách Tay</td>
                                                <td>7 kg</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành lý ký gửi</td>
                                                <td>Vui lòng chọn ở bước sau</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                            <colgroup>
                                                <col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                            </tr>
                                            <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                            <tr style="display:none;" class="title">
                                                <td colspan="2">Điều kiện chung:</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td colspan="2">{GeneralRule}</td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                            <?php }
                        }
                        else if($Type == "landing") {
                            if(date("d/m/Y", $departTime) != date("d/m/Y", strtotime($_POST['DepartDate']))) { ?>
                                <tr class="i-result">
                                    <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                    <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                    <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                    <td class="check-ve">
                                        <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>landing" value="<?=$val->FlightNumber?>" recec="0" />
                                        <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                    </td>
                                    <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                                </tr>
                                <tr style="" class="flight-info-detail">
                                    <td class="flight-detail-content" colspan="8">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody class="view-detail-flight">
                                            <tr>
                                                <td valign="top">
                                                    <h4>Chuyến bay</h4>
                                                    <p><span><?=$val->AirlineCode?></span></p>
                                                    <p><span><?=$val->FlightNumber?></b></span></p>
                                                    <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Khởi hành</h4>
                                                    <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Điểm đến</h4>
                                                    <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" class="price-break">
                                            <tbody>
                                            <tr class="title-b">
                                                <td nowrap="" align="center" class="header">Hành khách</td>
                                                <td nowrap="" align="center" class="header">Số lượng vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                                <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                                <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                            </tr>
                                            <!-- content -->
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                            <colgroup><col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành Lý Xách Tay</td>
                                                <td>7 kg</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành lý ký gửi</td>
                                                <td>Vui lòng chọn ở bước sau</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                            <colgroup>
                                                <col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                            </tr>
                                            <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                            <tr style="display:none;" class="title">
                                                <td colspan="2">Điều kiện chung:</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td colspan="2">{GeneralRule}</td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                            <?php }
                        }
                        $temp++;}
                    else { ?>
                        <tr class="i-result">
                            <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                            <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                            <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                            <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                            <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                            <td class="check-ve">
                                <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>" value="<?=$val->FlightNumber?>" recec="0" />
                                <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                            </td>
                            <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                        </tr>
                        <tr style="" class="flight-info-detail">
                            <td class="flight-detail-content" colspan="8">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody class="view-detail-flight">
                                    <tr>
                                        <td valign="top">
                                            <h4>Chuyến bay</h4>
                                            <p><span><?=$val->AirlineCode?></span></p>
                                            <p><span><?=$val->FlightNumber?></b></span></p>
                                            <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                        </td>
                                        <td valign="top">
                                            <h4>Khởi hành</h4>
                                            <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                            <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                            <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                        </td>
                                        <td valign="top">
                                            <h4>Điểm đến</h4>
                                            <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                            <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                            <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table width="100%" class="price-break">
                                    <tbody>
                                    <tr class="title-b">
                                        <td nowrap="" align="center" class="header">Hành khách</td>
                                        <td nowrap="" align="center" class="header">Số lượng vé</td>
                                        <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                        <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                        <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                        <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                    </tr>
                                    <!-- content -->
                                    </tbody>
                                </table>
                                <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                    <colgroup><col width="170">
                                        <col width="450">
                                    </colgroup>
                                    <tbody>
                                    <tr class="title">
                                        <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Hành Lý Xách Tay</td>
                                        <td>7 kg</td>
                                    </tr>
                                    <tr>
                                        <td class="name">Hành lý ký gửi</td>
                                        <td>Vui lòng chọn ở bước sau</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                    <colgroup>
                                        <col width="170">
                                        <col width="450">
                                    </colgroup>
                                    <tbody>
                                    <tr class="title">
                                        <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                    </tr>
                                    <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                    <tr style="display:none;" class="title">
                                        <td colspan="2">Điều kiện chung:</td>
                                    </tr>
                                    <tr style="display:none;">
                                        <td colspan="2">{GeneralRule}</td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>
                    <?php }
                }
            }
            else
            {
                if($RoundTrip == "true") {
                    if($Type == "depart") {
                        if(date("d/m/Y", $landingTime) == date("d/m/Y", strtotime($_POST['DepartDate']))) { ?>
                            <tr class="i-result">
                                <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                <td class="check-ve">
                                    <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>depart" value="<?=$val->FlightNumber?>" recec="0" />
                                    <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                </td>
                                <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                            </tr>
                            <tr style="" class="flight-info-detail">
                                <td class="flight-detail-content" colspan="8">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody class="view-detail-flight">
                                        <tr>
                                            <td valign="top">
                                                <h4>Chuyến bay</h4>
                                                <p><span><?=$val->AirlineCode?></span></p>
                                                <p><span><?=$val->FlightNumber?></b></span></p>
                                                <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Khởi hành</h4>
                                                <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Điểm đến</h4>
                                                <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" class="price-break">
                                        <tbody>
                                        <tr class="title-b">
                                            <td nowrap="" align="center" class="header">Hành khách</td>
                                            <td nowrap="" align="center" class="header">Số lượng vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                            <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                            <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                        </tr>
                                        <!-- content -->
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                        <colgroup><col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành Lý Xách Tay</td>
                                            <td>7 kg</td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành lý ký gửi</td>
                                            <td>Vui lòng chọn ở bước sau</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                        <colgroup>
                                            <col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                        </tr>
                                        <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                        <tr style="display:none;" class="title">
                                            <td colspan="2">Điều kiện chung:</td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td colspan="2">{GeneralRule}</td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                        <?php }
                    }
                    else if($Type == "landing") {
                        if(date("d/m/Y", $departTime) != date("d/m/Y", strtotime($_POST['DepartDate']))) { ?>
                            <tr class="i-result">
                                <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                <td class="check-ve">
                                    <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>landing" value="<?=$val->FlightNumber?>" recec="0" />
                                    <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                </td>
                                <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                            </tr>
                            <tr style="" class="flight-info-detail">
                                <td class="flight-detail-content" colspan="8">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody class="view-detail-flight">
                                        <tr>
                                            <td valign="top">
                                                <h4>Chuyến bay</h4>
                                                <p><span><?=$val->AirlineCode?></span></p>
                                                <p><span><?=$val->FlightNumber?></b></span></p>
                                                <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Khởi hành</h4>
                                                <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Điểm đến</h4>
                                                <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" class="price-break">
                                        <tbody>
                                        <tr class="title-b">
                                            <td nowrap="" align="center" class="header">Hành khách</td>
                                            <td nowrap="" align="center" class="header">Số lượng vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                            <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                            <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                        </tr>
                                        <!-- content -->
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                        <colgroup><col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành Lý Xách Tay</td>
                                            <td>7 kg</td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành lý ký gửi</td>
                                            <td>Vui lòng chọn ở bước sau</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                        <colgroup>
                                            <col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                        </tr>
                                        <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                        <tr style="display:none;" class="title">
                                            <td colspan="2">Điều kiện chung:</td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td colspan="2">{GeneralRule}</td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                        <?php }
                    }
                    $temp++;}
                else { ?>
                    <tr class="i-result">
                        <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                        <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                        <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                        <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                        <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                        <td class="check-ve">
                            <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>" value="<?=$val->FlightNumber?>" recec="0" />
                            <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                        </td>
                        <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                    </tr>
                    <tr style="" class="flight-info-detail">
                        <td class="flight-detail-content" colspan="8">
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tbody class="view-detail-flight">
                                <tr>
                                    <td valign="top">
                                        <h4>Chuyến bay</h4>
                                        <p><span><?=$val->AirlineCode?></span></p>
                                        <p><span><?=$val->FlightNumber?></b></span></p>
                                        <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                    </td>
                                    <td valign="top">
                                        <h4>Khởi hành</h4>
                                        <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                        <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                        <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                    </td>
                                    <td valign="top">
                                        <h4>Điểm đến</h4>
                                        <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                        <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                        <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table width="100%" class="price-break">
                                <tbody>
                                <tr class="title-b">
                                    <td nowrap="" align="center" class="header">Hành khách</td>
                                    <td nowrap="" align="center" class="header">Số lượng vé</td>
                                    <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                    <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                    <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                    <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                </tr>
                                <?php if($val->AirlineCode == "VietJetAir" || $val->AirlineCode == "JetStar") {
                                    $Quantity_ATD = 0;
                                    $price_ATD = 0;
                                    $ThuePhi_ATD = 0;
                                    $Total_ATD = 0;
                                    $Price_Total = 0;
                                    foreach($val->PriceSummaries as $PriSumm) {
                                        if($PriSumm->Code == "NET" && $PriSumm->PassengerType == 'ADT') {
                                            $Quantity_ATD = $PriSumm->Quantity;
                                            $price_ATD = $PriSumm->Price;
                                            $Total_ATD += $price_ATD*$Quantity_ATD;
                                        }
                                        if($PriSumm->Code == "TAX" && $PriSumm->PassengerType == 'ADT') {
                                            $ThuePhi_ATD = $PriSumm->Price;
                                            $Total_ATD += $ThuePhi_ATD*$Quantity_ATD;
                                        }
                                    }
                                    $Price_Total += $Total_ATD;
                                    ?>
                                    <tr>
                                        <td align="center" class="pax">Người lớn</td>
                                        <td align="center" class="pax"><?php echo $Quantity_ATD; ?></td>
                                        <td align="center" class="pax pb-price"><?=number_format($price_ATD, 0, ',','.')?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($ThuePhi_ATD, 0, ',','.'); ?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($Total_ATD, 0, ',','.'); ?> vnđ</td>
                                    </tr>
                                    <?php
                                    $Quantity_CHD = 0;
                                    $price_CHD = 0;
                                    $ThuePhi_CHD = 0;
                                    $Total_CHD = 0;
                                    $price_total = 0;
                                    foreach($val->PriceSummaries as $PriSumm) {
                                        if($PriSumm->Code == "NET" && $PriSumm->PassengerType == 'CHD') {
                                            $Quantity_CHD = $PriSumm->Quantity;
                                            $price_CHD = $PriSumm->Price;
                                            $Total_CHD += $price_CHD*$Quantity_CHD;
                                        }
                                        if($PriSumm->Code == "TAX" && $PriSumm->PassengerType == 'CHD') {
                                            $ThuePhi_CHD = $PriSumm->Price;
                                            $Total_CHD += $ThuePhi_ATD*$Quantity_CHD;
                                        }
                                    }
                                    $Price_Total += $Total_CHD;
                                    ?>
                                    <tr>
                                        <td align="center" class="pax">Trẻ em</td>
                                        <td align="center" class="pax"><?php echo $Quantity_CHD; ?></td>
                                        <td align="center" class="pax pb-price"><?=number_format($price_CHD, 0, ',','.')?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($ThuePhi_CHD, 0, ',','.'); ?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($Total_CHD, 0, ',','.'); ?> vnđ</td>
                                    </tr>
                                <?php }
                                if($val->AirlineCode == "VietnamAirlines") {
                                    $Quantity_ATD = 0;
                                    $price_ATD = 0;
                                    $ThuePhi_ATD = 0;
                                    $Total_ATD = 0;
                                    $Price_Total = 0;
                                    foreach($val->PriceSummaries as $PriSumm) {
                                        if($PriSumm->Code == "NET" && $PriSumm->PassengerType == 'ADT') {
                                            $Quantity_ATD = $PriSumm->Quantity;
                                            $price_ATD = $PriSumm->Price;
                                            $Total_ATD += $price_ATD*$Quantity_ATD;
                                        }
                                        if($PriSumm->Code == "TAX" && $PriSumm->PassengerType == 'ADT') {
                                            $ThuePhi_ATD = $PriSumm->Price;
                                            $Total_ATD += $ThuePhi_ATD*$Quantity_ATD;
                                        }
                                    }
                                    $Price_Total += $Total_ATD;
                                    ?>
                                    <tr>
                                        <td align="center" class="pax">Người lớn</td>
                                        <td align="center" class="pax"><?php echo $Quantity_ATD; ?></td>
                                        <td align="center" class="pax pb-price"><?=number_format($price_ATD, 0, ',','.')?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($ThuePhi_ATD, 0, ',','.'); ?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($Total_ATD, 0, ',','.'); ?> vnđ</td>
                                    </tr>
                                    <?php
                                    $Quantity_CHD = 0;
                                    $price_CHD = 0;
                                    $ThuePhi_CHD = 0;
                                    $Total_CHD = 0;
                                    $price_total = 0;
                                    foreach($val->PriceSummaries as $PriSumm) {
                                        if($PriSumm->Code == "NET" && $PriSumm->PassengerType == 'CHD') {
                                            $Quantity_CHD = $PriSumm->Quantity;
                                            $price_CHD = $PriSumm->Price;
                                            $Total_CHD += $price_CHD*$Quantity_CHD;
                                        }
                                        if($PriSumm->Code == "TAX" && $PriSumm->PassengerType == 'CHD') {
                                            $ThuePhi_CHD = $PriSumm->Price;
                                            $Total_CHD += $ThuePhi_ATD*$Quantity_CHD;
                                        }
                                    }
                                    $Price_Total += $Total_CHD;
                                    ?>
                                    <tr>
                                        <td align="center" class="pax">Trẻ em</td>
                                        <td align="center" class="pax"><?php echo $Quantity_CHD; ?></td>
                                        <td align="center" class="pax pb-price"><?=number_format($price_CHD, 0, ',','.')?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($ThuePhi_CHD, 0, ',','.'); ?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($Total_CHD, 0, ',','.'); ?> vnđ</td>
                                    </tr>
                                    <?php
                                    $Quantity_INF = 0;
                                    $price_INF = 0;
                                    $ThuePhi_INF = 0;
                                    $Total_INF = 0;
                                    $price_total = 0;
                                    foreach($val->PriceSummaries as $PriSumm) {
                                        if($PriSumm->Code == "NET" && $PriSumm->PassengerType == 'INF') {
                                            $Quantity_INF = $PriSumm->Quantity;
                                            $price_INF = $PriSumm->Price;
                                            $Total_INF += $price_INF*$Quantity_INF;
                                        }
                                        if($PriSumm->Code == "TAX" && $PriSumm->PassengerType == 'INF') {
                                            $ThuePhi_INF = $PriSumm->Price;
                                            $Total_INF += $ThuePhi_ATD*$Quantity_INF;
                                        }
                                    }
                                    $Price_Total += $Total_INF;
                                    ?>
                                    <tr>
                                        <td align="center" class="pax">Trẻ sơ sinh</td>
                                        <td align="center" class="pax"><?php echo $Quantity_INF; ?></td>
                                        <td align="center" class="pax pb-price"><?=number_format($price_INF, 0, ',','.')?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($ThuePhi_INF, 0, ',','.'); ?> vnđ</td>
                                        <td align="center" class="pax pb-price"><?php echo number_format($Total_INF, 0, ',','.'); ?> vnđ</td>
                                    </tr>
                                    <tr class="total-b">
                                        <td align="right" class="footer" colspan="3"></>
                                        <td align="right" class="footer">
                                            <p>Tổng cộng </p>
                                        <td align="center" class="footer pb-price" colspan="2">
                                            <p><?php echo number_format($Price_Total); ?> vnđ</p>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                <colgroup><col width="170">
                                    <col width="450">
                                </colgroup>
                                <tbody>
                                <tr class="title">
                                    <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                </tr>
                                <tr>
                                    <td class="name">Hành Lý Xách Tay</td>
                                    <td>7 kg</td>
                                </tr>
                                <tr>
                                    <td class="name">Hành lý ký gửi</td>
                                    <td>Vui lòng chọn ở bước sau</td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                <colgroup>
                                    <col width="170">
                                    <col width="450">
                                </colgroup>
                                <tbody>
                                <tr class="title">
                                    <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                </tr>
                                <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                <tr style="display:none;" class="title">
                                    <td colspan="2">Điều kiện chung:</td>
                                </tr>
                                <tr style="display:none;">
                                    <td colspan="2">{GeneralRule}</td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>
                <?php }
            }
        } else {
            if($kiemtra_hang !="")
            {
                if($kiemtra_hang==$val->AirlineCode)
                {
                    if($RoundTrip == "true") {
                        if($Type == "depart") {
                            if($val->FromPlace == $_POST['TFromPlace']) { ?>
                                <tr class="i-result">
                                    <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                    <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                    <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                    <td class="check-ve">
                                        <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>depart" value="<?=$val->FlightNumber?>" recec="0" />
                                        <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                    </td>
                                    <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                                </tr>
                                <tr style="" class="flight-info-detail">
                                    <td class="flight-detail-content" colspan="8">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody class="view-detail-flight">
                                            <tr>
                                                <td valign="top">
                                                    <h4>Chuyến bay</h4>
                                                    <p><span><?=$val->AirlineCode?></span></p>
                                                    <p><span><?=$val->FlightNumber?></b></span></p>
                                                    <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Khởi hành</h4>
                                                    <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Điểm đến</h4>
                                                    <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" class="price-break">
                                            <tbody>
                                            <tr class="title-b">
                                                <td nowrap="" align="center" class="header">Hành khách</td>
                                                <td nowrap="" align="center" class="header">Số lượng vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                                <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                                <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                            </tr>
                                            <!-- content -->
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                            <colgroup><col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành Lý Xách Tay</td>
                                                <td>7 kg</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành lý ký gửi</td>
                                                <td>Vui lòng chọn ở bước sau</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                            <colgroup>
                                                <col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                            </tr>
                                            <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                            <tr style="display:none;" class="title">
                                                <td colspan="2">Điều kiện chung:</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td colspan="2">{GeneralRule}</td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                            <?php }
                        }
                        else if($Type == "landing") {
                            if($val->FromPlace != $_POST['TFromPlace']) { ?>
                                <tr class="i-result">
                                    <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                    <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                    <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                    <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                    <td class="check-ve">
                                        <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>landing" value="<?=$val->FlightNumber?>" recec="0" />
                                        <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                    </td>
                                    <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                                </tr>
                                <tr style="" class="flight-info-detail">
                                    <td class="flight-detail-content" colspan="8">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tbody class="view-detail-flight">
                                            <tr>
                                                <td valign="top">
                                                    <h4>Chuyến bay</h4>
                                                    <p><span><?=$val->AirlineCode?></span></p>
                                                    <p><span><?=$val->FlightNumber?></b></span></p>
                                                    <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Khởi hành</h4>
                                                    <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                                </td>
                                                <td valign="top">
                                                    <h4>Điểm đến</h4>
                                                    <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                    <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                    <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table width="100%" class="price-break">
                                            <tbody>
                                            <tr class="title-b">
                                                <td nowrap="" align="center" class="header">Hành khách</td>
                                                <td nowrap="" align="center" class="header">Số lượng vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                                <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                                <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                                <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                            </tr>
                                            <!-- content -->
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                            <colgroup><col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành Lý Xách Tay</td>
                                                <td>7 kg</td>
                                            </tr>
                                            <tr>
                                                <td class="name">Hành lý ký gửi</td>
                                                <td>Vui lòng chọn ở bước sau</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                            <colgroup>
                                                <col width="170">
                                                <col width="450">
                                            </colgroup>
                                            <tbody>
                                            <tr class="title">
                                                <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                            </tr>
                                            <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                            <tr style="display:none;" class="title">
                                                <td colspan="2">Điều kiện chung:</td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td colspan="2">{GeneralRule}</td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                            <?php }
                        }
                        $temp++;}
                    else { ?>
                        <tr class="i-result">
                            <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                            <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                            <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                            <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                            <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                            <td class="check-ve">
                                <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>" value="<?=$val->FlightNumber?>" recec="0" />
                                <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                            </td>
                            <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                        </tr>
                        <tr style="" class="flight-info-detail">
                            <td class="flight-detail-content" colspan="8">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody class="view-detail-flight">
                                    <tr>
                                        <td valign="top">
                                            <h4>Chuyến bay</h4>
                                            <p><span><?=$val->AirlineCode?></span></p>
                                            <p><span><?=$val->FlightNumber?></b></span></p>
                                            <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                        </td>
                                        <td valign="top">
                                            <h4>Khởi hành</h4>
                                            <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                            <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                            <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                        </td>
                                        <td valign="top">
                                            <h4>Điểm đến</h4>
                                            <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                            <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                            <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table width="100%" class="price-break">
                                    <tbody>
                                    <tr class="title-b">
                                        <td nowrap="" align="center" class="header">Hành khách</td>
                                        <td nowrap="" align="center" class="header">Số lượng vé</td>
                                        <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                        <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                        <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                        <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                    </tr>
                                    <!-- content -->
                                    </tbody>
                                </table>
                                <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                    <colgroup><col width="170">
                                        <col width="450">
                                    </colgroup>
                                    <tbody>
                                    <tr class="title">
                                        <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Hành Lý Xách Tay</td>
                                        <td>7 kg</td>
                                    </tr>
                                    <tr>
                                        <td class="name">Hành lý ký gửi</td>
                                        <td>Vui lòng chọn ở bước sau</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                    <colgroup>
                                        <col width="170">
                                        <col width="450">
                                    </colgroup>
                                    <tbody>
                                    <tr class="title">
                                        <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                    </tr>
                                    <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                    <tr style="display:none;" class="title">
                                        <td colspan="2">Điều kiện chung:</td>
                                    </tr>
                                    <tr style="display:none;">
                                        <td colspan="2">{GeneralRule}</td>
                                    </tr>
                                    </tbody></table>
                            </td>
                        </tr>
                    <?php }
                }
            }
            else
            {
                if($RoundTrip == "true") {
                    if($Type == "depart") {
                        if($val->FromPlace == $_POST['TFromPlace']) { ?>
                            <tr class="i-result">
                                <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                <td class="check-ve">
                                    <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>depart" value="<?=$val->FlightNumber?>" recec="0" />
                                    <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                </td>
                                <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                            </tr>
                            <tr style="" class="flight-info-detail">
                                <td class="flight-detail-content" colspan="8">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody class="view-detail-flight">
                                        <tr>
                                            <td valign="top">
                                                <h4>Chuyến bay</h4>
                                                <p><span><?=$val->AirlineCode?></span></p>
                                                <p><span><?=$val->FlightNumber?></b></span></p>
                                                <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Khởi hành</h4>
                                                <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Điểm đến</h4>
                                                <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" class="price-break">
                                        <tbody>
                                        <tr class="title-b">
                                            <td nowrap="" align="center" class="header">Hành khách</td>
                                            <td nowrap="" align="center" class="header">Số lượng vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                            <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                            <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                        </tr>
                                        <!-- content -->
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                        <colgroup><col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành Lý Xách Tay</td>
                                            <td>7 kg</td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành lý ký gửi</td>
                                            <td>Vui lòng chọn ở bước sau</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                        <colgroup>
                                            <col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                        </tr>
                                        <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                        <tr style="display:none;" class="title">
                                            <td colspan="2">Điều kiện chung:</td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td colspan="2">{GeneralRule}</td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                        <?php }
                    }
                    else if($Type == "landing") {
                        if($val->FromPlace != $_POST['TFromPlace']) { ?>
                            <tr class="i-result">
                                <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                                <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                                <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                                <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                                <td class="check-ve">
                                    <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>landing" value="<?=$val->FlightNumber?>" recec="0" />
                                    <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                                </td>
                                <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                            </tr>
                            <tr style="" class="flight-info-detail">
                                <td class="flight-detail-content" colspan="8">
                                    <table width="100%" cellspacing="0" cellpadding="0">
                                        <tbody class="view-detail-flight">
                                        <tr>
                                            <td valign="top">
                                                <h4>Chuyến bay</h4>
                                                <p><span><?=$val->AirlineCode?></span></p>
                                                <p><span><?=$val->FlightNumber?></b></span></p>
                                                <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Khởi hành</h4>
                                                <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                            </td>
                                            <td valign="top">
                                                <h4>Điểm đến</h4>
                                                <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                                <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                                <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table width="100%" class="price-break">
                                        <tbody>
                                        <tr class="title-b">
                                            <td nowrap="" align="center" class="header">Hành khách</td>
                                            <td nowrap="" align="center" class="header">Số lượng vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                            <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                            <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                            <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                        </tr>
                                        <!-- content -->
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                        <colgroup><col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành Lý Xách Tay</td>
                                            <td>7 kg</td>
                                        </tr>
                                        <tr>
                                            <td class="name">Hành lý ký gửi</td>
                                            <td>Vui lòng chọn ở bước sau</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                        <colgroup>
                                            <col width="170">
                                            <col width="450">
                                        </colgroup>
                                        <tbody>
                                        <tr class="title">
                                            <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                        </tr>
                                        <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                        <tr style="display:none;" class="title">
                                            <td colspan="2">Điều kiện chung:</td>
                                        </tr>
                                        <tr style="display:none;">
                                            <td colspan="2">{GeneralRule}</td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                        <?php }
                    }
                    $temp++;}
                else { ?>
                    <tr class="i-result">
                        <td class="logo-air"><img src="<?php echo SITE_NAME ?>/view/default/theme/images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
                        <td class="den-di"><p><?php echo date("H:i", strtotime($val->DepartTime)); ?><span>(<?=$val->FromPlace;?>)</span></p></td>
                        <td class="thoi-gian"><span><?php echo $gio.":".$phut ?></span></td>
                        <td class="den-di"><p><?php echo date("H:i", strtotime($val->LandingTime)); ?><span>(<?=$val->ToPlace;?>)</span></p></td>
                        <td class="gia"><p><?=number_format($val->Price, 0, ',','.')?> <sup>vnđ</sup></p><div class="TicketPrice" style="display: none; "><?=number_format($val->Price, 0, ',','.')?></div></td>
                        <td class="check-ve">
                            <input type="radio" class="check-ve-radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$RoundTrip?>" value="<?=$val->FlightNumber?>" recec="0" />
                            <label for="air-<?php echo $temp; ?>"><span></span>&nbsp</label>
                        </td>
                        <td class="chi-tiet"><a href="#">Xem chi tiết</a></td>
                    </tr>
                    <tr style="" class="flight-info-detail">
                        <td class="flight-detail-content" colspan="8">
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tbody class="view-detail-flight">
                                <tr>
                                    <td valign="top">
                                        <h4>Chuyến bay</h4>
                                        <p><span><?=$val->AirlineCode?></span></p>
                                        <p><span><?=$val->FlightNumber?></b></span></p>
                                        <p>Loại vé: <span><?=$val->TicketType?></span></p>
                                    </td>
                                    <td valign="top">
                                        <h4>Khởi hành</h4>
                                        <p>Từ <span class="color-blue"><?php echo $TFromPlace;?>, </span>Việt Nam</p>
                                        <p>Sân bay: <span><?php echo $TFromPlace;?> (<?php echo $FromPlace;?>)</span></p>
                                        <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $departTime); ?></span>, <?php echo date("d/m/Y", $departTime); ?></p>
                                    </td>
                                    <td valign="top">
                                        <h4>Điểm đến</h4>
                                        <p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
                                        <p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
                                        <p>Thời gian: <span class="color-blue"><?php echo date("H:i", $landingTime); ?></span>, <?php echo date("d/m/Y", $landingTime); ?></p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table width="100%" class="price-break">
                                <tbody>
                                <tr class="title-b">
                                    <td nowrap="" align="center" class="header">Hành khách</td>
                                    <td nowrap="" align="center" class="header">Số lượng vé</td>
                                    <td nowrap="" align="center" class="header pb-price">Giá mỗi vé</td>
                                    <td nowrap="" align="center" class="header pb-price">Thuế &amp; Phí</td>
                                    <td nowrap="" align="center" style="display:none;" class="header pb-price">Giảm giá</td>
                                    <td nowrap="" align="center" class="header pb-price">Tổng giá</td>
                                </tr>
                                <!-- content -->
                                </tbody>
                            </table>
                            <table class="dieu-kien" width="90%" cellspacing="0" cellpadding="0">
                                <colgroup><col width="170">
                                    <col width="450">
                                </colgroup>
                                <tbody>
                                <tr class="title">
                                    <td colspan="2"><h4>Điều kiện hành lý</h4></td>
                                </tr>
                                <tr>
                                    <td class="name">Hành Lý Xách Tay</td>
                                    <td>7 kg</td>
                                </tr>
                                <tr>
                                    <td class="name">Hành lý ký gửi</td>
                                    <td>Vui lòng chọn ở bước sau</td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="dieu-kien" cellspacing="0" cellpadding="0" width="90%">
                                <colgroup>
                                    <col width="170">
                                    <col width="450">
                                </colgroup>
                                <tbody>
                                <tr class="title">
                                    <td colspan="2"><h4>Điều kiện về vé</h4></td>
                                </tr>
                                <tr><td valign="top" class="name">Hoàn Vé</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Đổi Tên Hành Khách</td><td valign="top">Được phép - Thu phí: 352,000 VND</td></tr><tr><td valign="top" class="name">Đổi Hành Trình</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có). Đổi đồng hạng hoặc nâng hạng tương ứng của hành trình mới.</td></tr><tr><td valign="top" class="name">Đổi Ngày Giờ Chuyến Bay</td><td valign="top">Được phép - Thu phí: 352.000 VND + Giá vé chênh lệch (nếu có).</td></tr><tr><td valign="top" class="name">Bảo lưu</td><td valign="top">Không được phép</td></tr><tr><td valign="top" class="name">Thời hạn thay đổi (bao gồm thay đổi tên, ngày/chuyến bay)</td><td valign="top">Trước giờ khởi hành 12 tiếng.</td></tr>
                                <tr style="display:none;" class="title">
                                    <td colspan="2">Điều kiện chung:</td>
                                </tr>
                                <tr style="display:none;">
                                    <td colspan="2">{GeneralRule}</td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>
                <?php }
            }
        }
    }
}
else
{
    echo "Không có kết quả tìm kiếm";
}
?>