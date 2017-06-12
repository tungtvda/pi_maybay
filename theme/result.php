<?php
if(isset( $_POST['RoundTrip']) && $_POST['RoundTrip'] == 'true')
	$roundTrip = "true";
else
	$roundTrip = "false";
$FromPlace = $_POST['FromPlace'];
$TFromPlace = $_POST['TFromPlace'];
$ToPlace = $_POST['ToPlace'];
$TToPlace = $_POST['TToPlace'];
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
	"Sources": "VietJetAir,VietnamAirlines,JetStar"
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

$data = json_decode($str);			// Dữ liệu trả về là kiểu stdClass Object

//print_r($data->value);				// dữ liệu chưa xử lý.
//
//echo 'record : '.count($data->value).'<br />';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Kết quả tìm kiếm</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />

	<link rel="stylesheet" href="css/rs-wp-v1.2.css" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<!--	<link rel="stylesheet/less" href="style.css" type="text/css" />-->
	<link rel="stylesheet/less" href="style.less" type="text/css" />


	<script type="text/javascript" src="js/jquery-1.11.0.js"></script>
	<script type="text/javascript" src="js/custom-script.js"></script>
	<script type="text/javascript" src="js/bootstrap3-typeahead.min.js"></script>
	<script type="text/javascript" src="js/less.min.js"></script>
	<script type="text/javascript" src="js/core.0.5.0.min.js"></script>
	<script type="text/javascript" src="css/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>

	<!-- Jquery UI -->
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<link href="css/jquery-ui.css" type="text/css" />

	<!-- Font Awesome -->
	<link rel="stylesheet" href="js/font-awesome/css/font-awesome.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


	<!-- Owl Carousel Assets -->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<link href="css/owl.theme.css" rel="stylesheet">
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>

</head>
<body>
<header id="header">
	<div class="top-nav">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12 col-lg-6 col-sm-12">
					<h2>Vé máy bay, đặt mua vé máy bay tại đại lý vé máy bay Tourcoach cam kết giá rẻ nhất</h2>
				</div>
				<div class="col-md-6 col-xs-12 col-sm-12">
					<ul class="menu-right">
						<li><a href="#"><i class="fa fa-user"></i> Về chúng tôi</a></li>
						<li><a href="#"><i class="fa fa-envelope"></i> Liên hệ</a></li>
						<li><a href="#"><i class="fa fa-comment"></i> Hỏi đáp</a></li>
					</ul>
					<div class="top-search">
						<input type="text" class="text-search" value="" placeholder="Tìm kiếm" />
						<input type="button" class="bnt-search" value="Tìm kiếm" />
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="top-header">
		<div class="container">
			<div class="toogle-menu">
				Menu
				<a href="#">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
			<div class="logo">
				<a href="#"><img src="images/logo.jpg" alt="" /> </a>
			</div>
			<div class="hot-line">
				<p>Hotline đặt vé 24/7<span>043-2222-143</span></p>
			</div>
			<div class="main-menu">
				<ul>
					<li class="active"><a href="#">Trang chủ</a></li>
					<li><a href="#">Giới thiệu</a></li>
					<li><a href="#">Vé nội địa</a></li>
					<li><a href="#">Vé quốc tế</a></li>
					<li><a href="#">Dịch vụ</a></li>
					<li><a href="#">Tin khuyến mại</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</header>
<section class="content-area container">
	<div class="breadcrumbs">
		Home
	</div>
	<div class="main-content">
		<div class="result">
			<div class="info-result">
				<div class="hanh-trinh-title">
					<span>Hành trình chuyến đi</span>
				</div>
				<div class="hanh-trinh-info">
					<div class="chieu-bay">
						<p class="chieu-di"><?php echo $TFromPlace;?></p><p class="chieu-ve"><?php echo $TToPlace;?></p>
					</div>
					<p class="loai-ve">Loại vé: <span>Một chiều</span></p><p class="ngay-xuat-phat">Ngày xuất phát: <span><?echo $_POST['DepartDate']; ?></span></p><p class="so-hanh-khach">Số hành khách: <span>2 người lớn, 1 trẻ em</span></p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="date-change">
				<p>15/6/2015</p>
			</div>
			<div class="list-result">
				<form class="form-ve" action="booking.php" method="post">
					<table class="list-ve" width="100%" cellspacing="0" cellpadding="0">
						<thead>
						<tr>
							<th>Chuyến bay</th>
							<th>Khởi hành</th>
							<th></th>
							<th>Đến</th>
							<th>Giá vé</th>
							<th></th>
							<th>Chi tiết</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$temp = 1;
							foreach($data->value as $val) {
								?>
								<tr class="i-result">
									<td class="logo-air"><img src="images/<?=$val->AirlineCode?>.png" alt="" /><p><?=$val->FlightNumber?></p></td>
									<td class="den-di"><p><?php echo date("h:i", strtotime($val->DepartTime)); ?><span>(<?php echo $FromPlace;?>)</span></p></td>
									<td class="thoi-gian"><span>02:05</span></td>
									<td class="den-di"><p><?php echo date("h:i", strtotime($val->LandingTime)); ?><span>(<?php echo $ToPlace;?>)</span></p></td>
									<td class="gia"><p><?=number_format($val->Price)?> <sup>vnđ</sup></p></td>
									<td class="check-ve">
										<input type="radio" id="air-<?php echo $temp; ?>" flightref="<?=$val->FlightNumber?>" name="Block<?=$roundTrip?>" value="<?=$val->FlightNumber?>" recec="0" />
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
													<p>Thời gian: <span class="color-blue"><?php echo date("h:i", strtotime($val->DepartTime)); ?></span>, <?php echo date("d/m/Y", strtotime($val->DepartTime)); ?></p>
												</td>
												<td valign="top">
													<h4>Điểm đến</h4>
													<p>Tới <span class="color-blue"><?php echo $TToPlace;?>, </span>Việt Nam</p>
													<p>Sân bay: <span><?php echo $TToPlace;?> (<?php echo $ToPlace;?>)</span></p>
													<p>Thời gian: <span class="color-blue"><?php echo date("h:i", strtotime($val->LandingTime)); ?></span>, <?php echo date("d/m/Y", strtotime($val->LandingTime)); ?></p>
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
											<?php
											foreach($val->TicketPriceDetails as $pricedetail) {

											}
											?>
											<tr>
												<td align="center" class="pax">Người lớn</td>
												<td align="center" class="pax">1</td>
												<td align="center" class="pax pb-price">1,030,000 VNĐ</td>
												<td align="center" class="pax pb-price">473,000 VNĐ</td>
												<td align="center" style="display:none;" class="pax pb-price">0 VNĐ</td>
												<td align="center" class="pax pb-price">1,503,000 VNĐ</td>
											</tr>
											<tr>
												<td align="center" class="pax">Người lớn</td>
												<td align="center" class="pax">1</td>
												<td align="center" class="pax pb-price">1,030,000 VNĐ</td>
												<td align="center" class="pax pb-price">473,000 VNĐ</td>
												<td align="center" style="display:none;" class="pax pb-price">0 VNĐ</td>
												<td align="center" class="pax pb-price">1,503,000 VNĐ</td>
											</tr>
											<tr class="total-b">
												<td align="right" class="footer" colspan="3"></>
												<td align="right" class="footer">
													<p>Tổng cộng </p>
												<td align="center" class="footer pb-price" colspan="2">
													<p>1,503,000 VNĐ</p>
												</td>
											</tr>
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
							<?php $temp++;}
						?>
						</tbody>
					</table>
					<div class="send">
						<label for="dat-ve"><input type="submit" value="Tiếp tục" /></label>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="right-sidebar">
		Right sidebar
	</div>
	<div class="clearfix"></div>
	<div class="doi-tac box">
		<h2 class="title">Đối tác hàng không</h2>
		<div class="owl-carousel owl-theme doi-tac-slider" id="doi-tac-slider">
			<div class="item"><a href="#"><img src="images/dt-vietnamairline.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-jetstar.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-vietjet.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-thai.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-tigerair.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-airasia.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-vietnamairline.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-jetstar.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-vietjet.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-thai.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-tigerair.jpg" alt="" /></a></div>
			<div class="item"><a href="#"><img src="images/dt-airasia.jpg" alt="" /></a></div>
		</div>
	</div>
</section>
<footer>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<h2 class="title">Về chúng tôi</h2>
					<div class="ft-content">
						<a class="footer-logo" href="#"><img src="images/footer-logo.jpg" alt="" /></a>
						<p class="line">Địa chỉ: <span>B44, phố Nguyễn Thị Định, Trung Hòa - Nhân Chính, Hà Nội</span></p>
						<p class="line">Hotline: <span>094.998.0762/094.998.0762</span></p>
						<p class="line">Email: <a href="mailto:tourcoach2013@gmail.com">tourcoach2013@gmail.com</a></p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<h2 class="title">Thông tin</h2>
					<div class="ft-content ft-menu">
						<ul>
							<li><a href="#">Về chúng tôi</a></li>
							<li><a href="#">Dịch vụ</a></li>
							<li><a href="#">Điều khoản & điều kiện</a></li>
							<li><a href="#">Chính sách riêng tư</a></li>
							<li><a href="#">Hướng dẫn thanh toán</a></li>
							<li><a href="#">Thông tin chuyển khoản</a></li>
							<li><a href="#">Câu hỏi thường gặp</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<h2 class="title">Vé nội địa</h2>
					<div class="ft-content ft-menu">
						<ul>
							<li><a href="#">Vé máy bay đi Nha Trang</a></li>
							<li><a href="#">Vé máy bay đi Đà Nẵng</a></li>
							<li><a href="#">Vé máy bay đi Đà Lạt</a></li>
							<li><a href="#">Vé máy bay đi Hải Phòng</a></li>
							<li><a href="#">Vé máy bay đi Hà Nội</a></li>
							<li><a href="#">Vé máy bay đi Phú Quốc</a></li>
							<li><a href="#">Vé máy bay đi Sài Gòn</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<h2 class="title">Đăng ký nhận bản tin</h2>
					<div class="ft-content">
						<p>Hãy đăng ký email của bạn để nhận được các tin khuyến mãi mới nhất từ TOURCOACH</p>
						<div class="mail-register">
							<input class="enter-mail" type="text" value="" placeholder="Email" />
							<input class="bnt-register" type="button" value="Đăng Ký" />
							<div class="clearfix"></div>
						</div>
						<div class="sub-list social-list">
							<h3>Kết nối với TOURCOACH</h3>
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-youtube"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="site-info">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<h2>Công ty TNHH dịch vụ  - vận tải và lữ hành quốc tế coach</h2>
					<p>Bản quyền 2015 Tourcoach.net - Là thành viên của Tourcoach Travel</p>
					<p>Giấy chứng nhận Đăng ký kinh doanh  số 12345678</p>
					<p>Do Sở kế hoạch và Đầu tư Thành phố Hà Nội cấp ngày 10/03/2014</p>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="sub-list thanh-toan-list">
						<h3>Thanh toán an toàn tại TOURCOACH</h3>
						<ul class="row">
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-onepay.jpg" /></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-visa.jpg" /></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-mastercard.jpg" /></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-american.jpg" /></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-paypal.jpg" /></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-jcb.jpg" /></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-discover.jpg" /></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="images/tt-uniconpay.jpg" /></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-menu">
		<div class="container">
			<ul>
				<li><a href="#">Trang chủ</a></li>
				<li><a href="#">Giới thiệu</a></li>
				<li><a href="#">Vé nội địa</a></li>
				<li><a href="#">Vé quốc tế</a></li>
				<li><a href="#">Tin khuyến mãi</a></li>
				<li><a href="#">Dịch vụ</a></li>
				<li><a href="#">Liên hệ</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
</footer>
</body>
</html>