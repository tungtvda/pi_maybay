<!DOCTYPE html>

<!-- Mirrored from demo.themepixels.com/webpage/katniss/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2015 09:21:11 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hệ thống quản trị website</title>
    <link rel="stylesheet" href="{SITE-NAME}/view/admin/Themes/css/style.default.css" type="text/css"/>
    <link rel="stylesheet" href="{SITE-NAME}/view/admin/Themes/css/prettify.css" type="text/css"/>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/prettify.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery-migrate-1.1.1.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery-ui-1.9.2.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.flot.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.flot.resize.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/modernizr.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/detectizr.min.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/js/custom.js"></script>
    <!--[if lte IE 8]>
    <script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript">
        var sitename='{SITE-NAME}';
    </script>
    <script type="text/javascript" src="{SITE-NAME}/view/admin/Themes/ckeditor/ckeditor.js"></script>
</head>

<body>

<div class="mainwrapper">

    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">

        <div class="logopanel" style="text-align: center!important;">
           <a href="http://vifonic.com/"><img style="height: 36px" src="{SITE-NAME}/view/admin/Themes/images/logo.png" title="Hệ thống quản trị của Vifonic.com" alt="Hệ thống quản trị của Vifonic.com"></a>
        </div>
        <!--logopanel-->

        <div class="datewidget"><iframe scrolling="no" frameborder="no" style="overflow:hidden;border:0;margin:0;padding:0;width:235px;height:45px;"src="http://clocklink.com/html5embed.php?clock=lat&timezone=ICT&color=gray&size=235&Title=&Message=&Target=&From=2015,1,1,0,0,0&Color=gray"></iframe></div>

        <div class="searchwidget">
            <form action="" method="post">
                <div class="input-append">
                    <input type="text" class="span2 search-query" placeholder="Tìm kiếm...">
                    <button type="submit" class="btn"><span class="icon-search"></span></button>
                </div>
            </form>
        </div>
        <!--searchwidget-->


        <!--plainwidget-->

        <div class="leftmenu">
            <ul class="nav nav-tabs nav-stacked">
                <li class="nav-header">Main Navigation</li>
                <li class="{kichhoat}"><a href="{SITE-NAME}/admin"><span class="icon-align-justify"></span> Dashboard</a></li>
                <li class="{kichhoat_datdichvu}"><a href="{SITE-NAME}/controller/admin/datve.php"><span class="icon-plane"></span> Danh sách đặt vé</a></li>
                <li class="{kichhoat_admin}" ><a href="{SITE-NAME}/controller/admin/admin.php"><span class="icon-user"></span> Tài khoản quản trị</a></li>
                <li class="{kichhoat_user}" ><a href="{SITE-NAME}/controller/admin/user.php"><span class="icon-user"></span> Thành viên</a></li>
                <li class="{kichhoat_config}"><a href="{SITE-NAME}/controller/admin/config.php"><span class=" icon-wrench"></span> Cấu hình hệ thống</a></li>
                <li class="{kichhoat_lienhe}"><a href="{SITE-NAME}/controller/admin/lienhe.php"><span class="icon-envelope"></span> Liên hệ</a></li>
                <li class="{kichhoat_datdichvu}"><a href="{SITE-NAME}/controller/admin/datdichvu.php"><span class="icon-plane"></span> Danh sách đặt dịch vụ</a></li>
                <li class="{kichhoat_dangky}"><a href="{SITE-NAME}/controller/admin/dangky.php"><span class="icon-pencil"></span> Đăng ký email</a></li>
                <li class="dropdown {kichhoat_dichvu}" ><a href="#"><span class=" icon-plane"></span> Dịch vụ</a>
                    <ul>
                        <li><a href="{SITE-NAME}/controller/admin/dichvu.php">Dịch vụ</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/dichvu_sub.php">Chi tiết </a></li>
                    </ul>
                </li>
                <li class="dropdown {kichhoat_hotro}"><a href="#"><span class="icon-question-sign"></span> Hỗ trợ trực tuyến</a>
                    <ul>
                        <li><a href="{SITE-NAME}/controller/admin/danhmuchotro.php">Danh mục</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/hotro.php">Danh sách </a></li>
                    </ul>
                </li>
                <li class="{kichhoat_tintuc}"><a href="{SITE-NAME}/controller/admin/tinkhuyenmai.php"><span class="icon-gift"></span> Tin khuyến mãi</a></li>
                <li class="{kichhoat_cauhoi}"><a href="{SITE-NAME}/controller/admin/cauhoi.php"><span class="icon-question-sign"></span> Câu hỏi</a></li>
                <li class="{kichhoat_dieukhoan}"><a href="{SITE-NAME}/controller/admin/dieukhoan_chinhsach.php"><span class="icon-edit"></span> Điều khoản - chính sách</a></li>
                <li class="{kichhoat_doitac}"><a href="{SITE-NAME}/controller/admin/doitac.php"><span class=" icon-thumbs-up"></span> Đối tác</a></li>
                <li class="{kichhoat_gioithieu}"><a href="{SITE-NAME}/controller/admin/gioithieu.php"><span class=" icon-signal"></span> Giới thiệu</a></li>
                <li class="{kichhoat_hinhthuc}"><a href="{SITE-NAME}/controller/admin/hinhthucthanhtoan.php"><span class=" icon-edit"></span> Hình thức thanh toán</a></li>
                <li class="{kichhoat_mangxahoi}"><a href="{SITE-NAME}/controller/admin/mangxahoi.php"><span class=" iconfa-facebook"></span> Mạng xã hội</a></li>
                <li class="{kichhoat_menu}"><a href="{SITE-NAME}/controller/admin/menu.php"><span class="icon-th-list"></span> Cấu hình menu</a></li>
                <li class="{kichhoat_thanhtoantt}"><a href="{SITE-NAME}/controller/admin/thanhtoan.php"><span class=" icon-edit"></span> Thanh toán trực tuyến</a></li>
                <li class="{kichhoat_thanhtoanchuyenkhoan}"><a href="{SITE-NAME}/controller/admin/thanhtoan_chuyenkhoan.php"><span class=" icon-edit"></span> Thanh toán chuyển khoản</a></li>
                <li class="{kichhoat_tieuchi}"><a href="{SITE-NAME}/controller/admin/tieuchi.php"><span class="icon-check"></span> Tiêu chí</a></li>
                <li class="{kichhoat_tieude}"><a href="{SITE-NAME}/controller/admin/tieude.php"><span class="icon-font"></span> Tiêu đề</a></li>
                <li class="{kichhoat_venoidia}"><a href="{SITE-NAME}/controller/admin/venoidia.php"><span class="icon-plane"></span> Vé nội địa</a></li>
                <li class="{kichhoat_bg_dangnhap}"><a href="{SITE-NAME}/controller/admin/bg_dangnhap.php"><span class="icon-picture"></span> Hình nền đăng nhập</a></li>
                <li class="{kichhoat_bg_dangnhap}"><a href="{SITE-NAME}/controller/admin/quangcao.php"><span class="icon-bullhorn"></span> Quảng cáo</a></li>
                <li class="{kichhoat_bg_dangnhap}"><a href="{SITE-NAME}/controller/admin/nganhang.php"><span class="icon-usd"></span>Ngân hàng</a></li>
                <li class="{kichhoat_bg_dangnhap}"><a href="{SITE-NAME}/controller/admin/vanphong.php"><span class="icon-map-marker"></span>Văn phòng</a></li>
            </ul>
        </div>
        <!--leftmenu-->

    </div>
    <!--mainleft-->
    <!-- END OF LEFT PANEL -->

    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel">
        <div class="headerpanel">
            <a href="#" class="showmenu"></a>

            <div class="headerright">


                <div class="dropdown userinfo">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#"
                       href="#">Xin chào, {USER-NAME} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{SITE-NAME}"><span class=" icon-globe"></span>Tới website</a></li>
                        <li><a href="{SITE-NAME}/controller/admin/signout.php"><span class="icon-share"></span> Đăng xuất</a></li>

                    </ul>
                </div>
                <!--dropdown-->

            </div>
            <!--headerright-->

        </div>
        <!--headerpanel-->
        <div class="breadcrumbwidget">

            <ul class="breadcrumb">
                <li><a href="{SITE-NAME}/admin">Home</a> <span class="divider">/</span></li>

            </ul>
        </div>
        <!--breadcrumbwidget-->
        <div class="pagetitle">
            <h1>Hệ thống quản trị {SITE-NAME}</h1>
        </div>
        <!--pagetitle-->

        <div class="maincontent">