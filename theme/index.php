<?php
//san77461_vemaybay
//san77461_datve
//d?6XCSb-#4P_
//FTP
//ftp.sanve24h.com
//user2@sanve24h.com
//dPb4l5HBbs)u
	$three_day = time() + 3*24*60*60;
	//$three_day = time();
	$three_day = date("d/m/Y",$three_day);
	$six_day = time() + 4*24*60*60;
	//$six_day = time();
	$six_day = date("d/m/Y",$six_day);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Index</title>
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
	<div class="top-page">
		<div class="container">
			<div class="book-ticket">
				<h3 class="title-dat-ve">Đặt vé máy bay</h3>
				<div class="fields">
					<input type="radio" name="RoundTrip" value="true" id="ve-khu-hoi" checked />
					<label for="ve-khu-hoi"><span></span>Vé khứ hồi</label>
					<input type="radio" name="RoundTrip" value="false" id="ve-mot-chieu" />
					<label for="ve-mot-chieu"><span></span>Vé một chiều</label>
				</div>
				<form class="form" action="result.php" method="post">
					<div class="row row-no-padding">
						<div class="col-md-4 col-sm-12 chon-dia-diem">
							<p>Điểm đi</p>
							<input type="text" class="chuyen-bay chieu-di" id="chieu-di" value="Hà Nội" name="TFromPlace" />
							<input id="hide-chieu-di" type="hidden" name="FromPlace" value="HAN"/>
						</div>
						<div class="col-md-4 col-sm-12">
							<p>Điểm đến</p>
							<input type="text" class="chuyen-bay chieu-ve" id="chieu-ve" value="Hồ Chí Minh" name="TToPlace" />
							<input id="hide-chieu-ve" type="hidden" name="ToPlace" value="SGN"/>
						</div>
						<div class="col-md-4 col-sm-12 date">
							<div class="row row-no-padding">
								<div class="col-md-6 col-sm-12">
									<p>Ngày đi</p>
									<input type="text" class="chuyen-bay" id="ngay-di" value="<?=$three_day?>" name="DepartDate" />
								</div>
								<div class="col-md-6 col-sm-12">
									<p>Ngày về</p>
									<input type="text" class="chuyen-bay" id="ngay-ve" value="<?=$six_day?>" name="ReturnDate" />
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="row row-no-padding">
						<div class="col-md-2 col-sm-12">
							<p>Người lớn (>12)</p>
							<input type="text" class="nguoi-lon" id="nguoi-lon" value="1" name="adult" />
						</div>
						<div class="col-md-2 col-sm-12">
							<p>Trẻ em (2>12)</p>
							<input type="text" class="tre-em" id="tre-em" value="0" name="child" />
						</div>
						<div class="col-md-2 col-sm-12">
							<p>Sơ sinh(0>2)</p>
							<input type="text" class="so-sinh" id="so-sinh" value="0" name="infant" />
						</div>
						<div class="col-md-6 col-sm-12 tim-kiem">
							<p><input type="submit" value="Tìm kiếm chuyến bay" /></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</form>
			</div>
			<div class="advs top-adv">
				<img src="images/adv-1.jpg" alt="" />
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</header>
<section class="content-area container">
	<div class="cac-tieu-chi">
		<div class="row">
			<div class="col-md-4 col-sm-12 tieu-chi">
				<div class="inner-content" style="background: #F25163 url('images/bg-panel-1.jpg') no-repeat bottom left 25px;">
					<h2 class="title">Chất lượng dịch vụ hàng đầu</h2>
					<p class="excerpt">Hỗ trợ tận tình - chu đáo 24/7<br />Dịch vụ tin cậy - giá trị đích thực<br />Luôn có khuyến mãi và quà tặng</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 tieu-chi">
				<div class="inner-content" style="background: #67C6DC url('images/bg-panel-2.jpg') no-repeat bottom left 25px;">
					<h2 class="title">VÉ MÁY BAY GIÁ RẺ NHẤT</h2>
					<p class="excerpt">Tourcoach luôn cung cấp vé máy bay giá rẻ nhất của các hãng như VietJet, Jetstar và Vietnam Airlines...</p>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 tieu-chi">
				<div class="inner-content" style="background: #FDCA4B url('images/bg-panel-3.jpg') no-repeat bottom left 25px;">
					<h2 class="title">Thanh toán dễ dàng tiện lợi</h2>
					<p class="excerpt">Bạn có thể thanh toán trực tuyến ngay sau khi đặt vé hoặc thanh toán tại văn phòng của Tourcoach</p>
				</div>
			</div>
		</div>
	</div>
	<div class="group-mb">
		<div class="row">
			<div class="col-md-7 col-sm-12 col-xs-12 ve-hot">
				<div class="tab-group">
					<ul>
						<li rel="ve-noi-dia" class="active"><a href="#">Vé nội địa</a></li>
						<li rel="ve-quoc-te"><a href="#">Vé quốc tế</a></li>
					</ul>
					<div class="ve-hot-icon"></div>
				</div>
				<div class="clearfix"></div>
				<div class="group-content">
					<table class="list-ve ve-noi-dia">
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">TP. Hồ Chí Minh</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">TP. Hồ Chí Minh</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">TP. Hồ Chí Minh</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">TP. Hồ Chí Minh</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">TP. Hồ Chí Minh</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">TP. Hồ Chí Minh</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">TP. Hồ Chí Minh</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
					</table>
					<table class="list-ve ve-quoc-te">
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">Nhật Bản</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">Nhật Bản</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">Nhật Bản</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">Nhật Bản</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">Nhật Bản</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">Nhật Bản</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
						<tr>
							<td><img src="images/vietair.png" alt="" /></td>
							<td>VN365</td>
							<td>12.06.2015</td>
							<td><span class="chieu-di">Hà Nội</span><span class="chieu-ve">Nhật Bản</span> </td>
							<td>1.657.000 VNĐ</td>
							<td><a href="#"><span>chi tiết »</span></a></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-5 col-sm-12 col-xs-12 support box">
				<h2 class="title">Hỗ trợ đặt vé trực tuyến</h2>
				<div class="support-panel call">
					<h3>Gọi điện thoại cho Tourcoach</h3>
					<div class="hotline-support">
						<p>Hotline hỗ trợ 24/7<span>043-2222-143</span></p>
					</div>
				</div>
				<div class="support-panel chat">
					<h3>Chát với đội ngũ chăm sóc của Tourcoach<span>Tư vấn hỗ trợ khách hàng về dịch vụ của Tourcoach</span></h3>
					<div class="list-supports row">
						<div class="col-md-3 col-sm-12 col-xs-12">
							<span>Vé máy bay</span>
						</div>
						<div class="col-md-9 col-sm-12 col-xs-12">
							<ul class="skype-list">
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="list-supports row">
						<div class="col-md-3 col-sm-12 col-xs-12">
							<span>Dịch vụ khác</span>
						</div>
						<div class="col-md-9 col-sm-12 col-xs-12">
							<ul class="skype-list">
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
								<li><a href="#">Mr Thế<span>0974 352 092</span></a></li>
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="support-panel connect-social">
					<h3>Hoặc kết nối với Tourcoach qua mạng xã hội</h3>
					<ul class="social-list">
						<li class="facebook"><a href="#"></a></li>
						<li class="twitter"><a href="#"></a></li>
						<li class="googleplus"><a href="#"></a></li>
						<li class="youtube"><a href="#"></a></li>
						<li class="linkedin"><a href="#"></a></li>
						<li class="kakaostory"><a href="#"></a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="services-tourcouch box">
		<h2 class="title">Dịch vụ của Tourcoach</h2>
		<div class="servies-us row">
			<div class="col-md-3 col-sm-4 col-xs-12 img-thumb">
				<img src="images/img-post.jpg" alt="" />
			</div>
			<div class="col-md-9 col-sm-8 col-xs-12 service-content">
				<h3>Giới thiệu về Tourcoach</h3>
				<p>TOURCOACH là công ty hoạt động trong lĩnh vực thương mại điện tử – chuyên cung cấp dịch vụ vé máy bay trực tuyến của các hãng hàng không nội địa và quốc tế. TOURCOACH có hệ thống Đặt Vé Máy Bay Trực Tuyến tại website www.TOURCOACH.NET với các chức năng: Tìm kiếm hành trình bay, So sánh giá vé của các hãng hàng không, Dịch vụ du lịch, Đặt vé trên website và Thanh toán trực tuyến. <a href="#">xem chi tiết »</a></p>
				<h4>Tại sao bạn nên chọn Tourcoach?</h4>
				<ul class="cam-ket row">
					<li class="col-md-4 col-sm-6 col-xs-6"><a href="#"><i class="fa fa-usd"></i>Đảm bảo giá tốt nhất</a></li>
					<li class="col-md-4 col-sm-6 col-xs-6"><a href="#"><i class="fa fa-check"></i>Luôn có khuyến mãi và quà tặng</a></li>
					<li class="col-md-4 col-sm-6 col-xs-6"><a href="#"><i class="fa fa-hand-o-right"></i>Thanh toán dễ dàng, đa dạng</a></li>
					<li class="col-md-4 col-sm-6 col-xs-6"><a href="#"><i class="fa fa-search"></i>Tìm kiếm linh hoạt, dễ dàng</a></li>
					<li class="col-md-4 col-sm-6 col-xs-6"><a href="#"><i class="fa fa-hand-o-right"></i>Dịch vụ tin cậy - giá trị đích thực</a></li>
					<li class="col-md-4 col-sm-6 col-xs-6"><a href="#"><i class="fa fa-user"></i>Hỗ trợ tận tình - chu đáo 24/7</a></li>
				</ul>
			</div>
		</div>
		<div class="service-slider">
			<div class="row wow">
				<div class="owl-carousel owl-theme service-owl-carousel">
					<div class="inner-item">
						<img class="post-thumb" src="images/img-post2.jpg" alt="" />
						<div class="inner-service">
							<img class="post-icon" src="images/icon-service1.png" alt="" />
							<h3>Combo booking</h3>
							<p>Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu.</p>
							<div class="ho-tro-online">
								<p class="call">Mrs Tuyến<span>094 998 0762</span></p>
								<p class="chat"><span>combo-booking@tourcoach.net</span></p>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="inner-item">
						<img class="post-thumb" src="images/img-post3.jpg" alt="" />
						<div class="inner-service">
							<img class="post-icon" src="images/icon-service2.png" alt="" />
							<h3>Đặt phòng khách sạn</h3>
							<p>Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu.</p>
							<div class="ho-tro-online">
								<p class="call">Mrs Tuyến<span>094 998 0762</span></p>
								<p class="chat"><span>combo-booking@tourcoach.net</span></p>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="inner-item">
						<img class="post-thumb" src="images/img-post4.jpg" alt="" />
						<div class="inner-service">
							<img class="post-icon" src="images/icon-service3.png" alt="" />
							<h3>Du thuyền</h3>
							<p>Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu.</p>
							<div class="ho-tro-online">
								<p class="call">Mrs Tuyến<span>094 998 0762</span></p>
								<p class="chat"><span>combo-booking@tourcoach.net</span></p>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="inner-item">
						<img class="post-thumb" src="images/img-post2.jpg" alt="" />
						<div class="inner-service">
							<img class="post-icon" src="images/icon-service1.png" alt="" />
							<h3>Combo booking</h3>
							<p>Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu.</p>
							<div class="ho-tro-online">
								<p class="call">Mrs Tuyến<span>094 998 0762</span></p>
								<p class="chat"><span>combo-booking@tourcoach.net</span></p>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="inner-item">
						<img class="post-thumb" src="images/img-post3.jpg" alt="" />
						<div class="inner-service">
							<img class="post-icon" src="images/icon-service2.png" alt="" />
							<h3>Đặt phòng khách sạn</h3>
							<p>Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu.</p>
							<div class="ho-tro-online">
								<p class="call">Mrs Tuyến<span>094 998 0762</span></p>
								<p class="chat"><span>combo-booking@tourcoach.net</span></p>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="inner-item">
						<img class="post-thumb" src="images/img-post4.jpg" alt="" />
						<div class="inner-service">
							<img class="post-icon" src="images/icon-service3.png" alt="" />
							<h3>Du thuyền</h3>
							<p>Nunc orci mi, venenatis quis ultrices vitae, congue non nibh. Nulla bibendum, justo eget ultrices vestibulum, erat tortor venenatis risus, sit amet cursus dui augue a arcu.</p>
							<div class="ho-tro-online">
								<p class="call">Mrs Tuyến<span>094 998 0762</span></p>
								<p class="chat"><span>combo-booking@tourcoach.net</span></p>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="khuyen-mai box">
		<h2 class="title">Tin khuyến mãi</h2>
		<div class="row">
			<div class="owl-carousel owl-theme khuyen-mai-slider" id="khuyen-mai-slider">
				<div class="item">
					<img class="img-thumb" src="images/img-post5.jpg" alt="" />
					<div class="inner-post">
						<h3>VietJetAir bán vé 0 đồng vào 12h trưa (4-6, bán 5 chặng)</h3>
						<p>Chúng tôi sẽ có 30 ngày săn vé máy bay giá rẻ 0 đồng của VietJetAir nhé. Mỗi ngày sẽ có 1 chặng bay được khuyến mãi giá 0 đồng , và chỉ bán trong buổi trưa...</p>
						<a href="#">Xem chi tiết</a>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="item">
					<img class="img-thumb" src="images/img-post6.jpg" alt="" />
					<div class="inner-post">
						<h3>Đồng vào 12h trưa (4-6, bán 5 chặng)</h3>
						<p>Chúng tôi sẽ có 30 ngày săn vé máy bay giá rẻ 0 đồng của VietJetAir nhé, giá rẻ 0 đồng của VietJetAir nhé. Mỗi ngày sẽ của VietJetAir nhé, giá rẻ 0 đồng của VietJetAir nhé. Mỗi ngày sẽ có 1 chặng bay được khuyến mãi giá 0 đồng , và chỉ bán trong buổi trưa...</p>
						<a href="#">Xem chi tiết</a>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="item">
					<img class="img-thumb" src="images/img-post5.jpg" alt="" />
					<div class="inner-post">
						<h3>VietJetAir bán vé 0 đồng vào 12h trưa (4-6, bán 5 chặng)</h3>
						<p>Chúng tôi sẽ có 30 ngày săn vé máy bay giá rẻ 0 đồng của VietJetAir nhé. Mỗi ngày sẽ có 1 chặng bay được khuyến mãi giá 0 đồng , và chỉ bán trong buổi trưa...</p>
						<a href="#">Xem chi tiết</a>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="item">
					<img class="img-thumb" src="images/img-post6.jpg" alt="" />
					<div class="inner-post">
						<h3>Đồng vào 12h trưa (4-6, bán 5 chặng)</h3>
						<p>Chúng tôi sẽ có 30 ngày săn vé máy bay giá rẻ 0 đồng của VietJetAir nhé, giá rẻ 0 đồng của VietJetAir nhé. Mỗi ngày sẽ của VietJetAir nhé, giá rẻ 0 đồng của VietJetAir nhé. Mỗi ngày sẽ có 1 chặng bay được khuyến mãi giá 0 đồng , và chỉ bán trong buổi trưa...</p>
						<a href="#">Xem chi tiết</a>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="thanh-toan box">
		<h2 class="title">Các hình thức thanh toán</h2>
		<ul class="list-thanh-toan">
			<li class="item">
				<img src="images/icon-thanhtoan1.png" alt="" />
				<div class="inner">
					<h3>Thanh toán bằng tiền mặt tại văn phòng Tourcoach</h3>
					<p>Sau khi đăng ký thành công, quý khách vui lòng qua văn phòng công ty để thanh toán và nhận vé.</p>
				</div>
				<div class="clearfix"></div>
			</li>
			<li class="item">
				<img src="images/icon-thanhtoan2.png" alt="" />
				<div class="inner">
					<h3>Thanh toán bằng tiền mặt tại văn phòng Tourcoach</h3>
					<p>Sau khi đăng ký thành công, quý khách vui lòng qua văn phòng công ty để thanh toán và nhận vé.</p>
				</div>
				<div class="clearfix"></div>
			</li>
			<li class="item">
				<img src="images/icon-thanhtoan3.png" alt="" />
				<div class="inner">
					<h3>Thanh toán bằng tiền mặt tại văn phòng Tourcoach</h3>
					<p>Sau khi đăng ký thành công, quý khách vui lòng qua văn phòng công ty để thanh toán và nhận vé.</p>
				</div>
				<div class="clearfix"></div>
			</li>
			<li class="item">
				<img src="images/icon-thanhtoan4.png" alt="" />
				<div class="inner">
					<h3>Thanh toán bằng tiền mặt tại văn phòng Tourcoach</h3>
					<p>Sau khi đăng ký thành công, quý khách vui lòng qua văn phòng công ty để thanh toán và nhận vé.</p>
				</div>
				<div class="clearfix"></div>
			</li>
			<li class="clear"></li>
		</ul>
	</div>
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

<div class="dialog listCity ui-dialog-content ui-widget-content" id="list-chieu-di">
	<h3 class="select-title">Lựa chọn thành phố hoặc sân bay xuất phát <a class="dialog-close" href="#">X</a></h3>
	<div class="domestic-col">
		<ul>
			<li class="title">Miền Bắc </li>
			<li><a href="#" airportcode="HAN">Hà Nội</a></li>
			<li><a href="#" airportcode="HPH">Hải Phòng</a></li>
			<li><a href="#" airportcode="DIN">Điện Biên</a></li>
		</ul>
		<ul>
			<li class="title">Miền Trung </li>
			<li><a href="#" airportcode="THD">Thanh Hóa</a></li>
			<li><a href="#" airportcode="VII">Vinh</a></li>
			<li><a href="#" airportcode="HUI">Huế</a></li>
			<li><a href="#" airportcode="VDH">Đồng Hới</a></li>
			<li><a href="#" airportcode="DAD">Đà Nẵng</a></li>
			<li><a href="#" airportcode="TMK">Tam Kỳ</a></li>
			<li><a href="#" airportcode="PXU">Pleiku</a></li>
			<li><a href="#" airportcode="TBB">Tuy Hòa</a></li>
		</ul>
	</div>
	<div class="domestic-col">
		<ul>
			<li class="title">Miền Nam </li>
			<li><a href="#" airportcode="SGN">Hồ Chí Minh</a></li>
			<li><a href="#" airportcode="CXR">Nha Trang</a></li>
			<li><a href="#" airportcode="DLI">Đà Lạt</a></li>
			<li><a href="#" airportcode="PQC">Phú Quốc</a></li>
			<li><a href="#" airportcode="UIH">Qui Nhơn</a></li>
			<li><a href="#" airportcode="VCA">Cần Thơ</a></li>
			<li><a href="#" airportcode="VCS">Côn Đảo</a></li>
			<li><a href="#" airportcode="BMV">Ban Mê Thuột</a></li>
			<li><a href="#" airportcode="VKG">Rạch Giá</a></li>
			<li><a href="#" airportcode="CAH">Cà Mau</a></li>
		</ul>
	</div>
	<div class="internation-city">
		<h3 class="title">Đặt vé quốc tế</h3>
		<div class="select quoc-gia">
			<p>Chọn quốc gia</p>
			<label>
				<select>
					<option value="ong">Ông</option>
					<option value="ba">Bà</option>
				</select>
			</label>
		</div>
		<div class="select thanh-pho">
			<p>Chọn thành phố hoặc sân bay</p>
			<label>
				<select>
					<option value="ong">Ông</option>
					<option value="ba">Bà</option>
				</select>
			</label>
		</div>
		<div>
			<a href="#" class="submit" id="submit-departure">Chọn</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="dialog listCity ui-dialog-content ui-widget-content" id="list-chieu-ve">
	<h3 class="select-title">Lựa chọn thành phố hoặc sân bay đến<a class="dialog-close" href="#">X</a></h3>
	<div class="domestic-col">
		<ul>
			<li class="title">Miền Bắc </li>
			<li><a href="#" airportcode="HAN">Hà Nội</a></li>
			<li><a href="#" airportcode="HPH">Hải Phòng</a></li>
			<li><a href="#" airportcode="DIN">Điện Biên</a></li>
		</ul>
		<ul>
			<li class="title">Miền Trung </li>
			<li><a href="#" airportcode="THD">Thanh Hóa</a></li>
			<li><a href="#" airportcode="VII">Vinh</a></li>
			<li><a href="#" airportcode="HUI">Huế</a></li>
			<li><a href="#" airportcode="VDH">Đồng Hới</a></li>
			<li><a href="#" airportcode="DAD">Đà Nẵng</a></li>
			<li><a href="#" airportcode="TMK">Tam Kỳ</a></li>
			<li><a href="#" airportcode="PXU">Pleiku</a></li>
			<li><a href="#" airportcode="TBB">Tuy Hòa</a></li>
		</ul>
	</div>
	<div class="domestic-col">
		<ul>
			<li class="title">Miền Nam </li>
			<li><a href="#" airportcode="SGN">Hồ Chí Minh</a></li>
			<li><a href="#" airportcode="CXR">Nha Trang</a></li>
			<li><a href="#" airportcode="DLI">Đà Lạt</a></li>
			<li><a href="#" airportcode="PQC">Phú Quốc</a></li>
			<li><a href="#" airportcode="UIH">Qui Nhơn</a></li>
			<li><a href="#" airportcode="VCA">Cần Thơ</a></li>
			<li><a href="#" airportcode="VCS">Côn Đảo</a></li>
			<li><a href="#" airportcode="BMV">Ban Mê Thuột</a></li>
			<li><a href="#" airportcode="VKG">Rạch Giá</a></li>
			<li><a href="#" airportcode="CAH">Cà Mau</a></li>
		</ul>
	</div>
	<div class="internation-city">
		<h3 class="title">Đặt vé quốc tế</h3>
		<div class="select quoc-gia">
			<p>Chọn quốc gia</p>
			<label>
				<select>
					<option value="ong">Ông</option>
					<option value="ba">Bà</option>
				</select>
			</label>
		</div>
		<div class="select thanh-pho">
			<p>Chọn thành phố hoặc sân bay</p>
			<label>
				<select>
					<option value="ong">Ông</option>
					<option value="ba">Bà</option>
				</select>
			</label>
		</div>
		<div>
			<a href="#" class="submit" id="submit-departure">Chọn</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
</body>
</html>