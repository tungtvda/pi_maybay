<?php
require_once DIR . '/common/paging.php';
require_once DIR . '/common/cls_fast_template.php';
function view_index($data)
{
    $ft = new FastTemplate(DIR . '/view/admin/templates');
    $ft->assign('USER-NAME', isset($data['username']) ? $data['username'] : '');
    $ft->define('header', 'header.tpl');
    $ft->define('body', 'body.tpl');
    $ft->define('footer', 'footer.tpl');

    $ft->assign('TAB1-CLASS', "");
    $ft->assign('TAB2-CLASS', "current");


    $ft->assign('NOTIFICATION-CONTENT', isset($data['notififation_content']) ? $data['notififation_content'] : '');
    $ft->assign('TABLE-HEADER', '');
    $ft->assign('PAGING', '');
    $ft->assign('TABLE-BODY', '');
    $ft->assign('TABLE-NAME', ' Dashboard');
    $ft->assign('CONTENT-BOX-LEFT', isset($data['content_box_left']) ? $data['content_box_left'] : '');
    $ft->assign('CONTENT-BOX-RIGHT', isset($data['content_box_right']) ? $data['content_box_right'] : ' ');
    $ft->assign('NOTIFICATION', isset($data['notification']) ? $data['notification'] : ' ');
    $ft->assign('SITE-NAME', isset($data['sitename']) ? $data['sitename'] : SITE_NAME);
    $ft->assign('an', 'hidden');
    $ft->assign('kichhoat', 'active');
    $ft->assign('FORM', showFrom('', ''));
    //
    print $ft->parse_and_return('header');
    print $ft->parse_and_return('body');
    print $ft->parse_and_return('footer');
}

function showFrom($form, $ListKey = array())
{
    $str_from = '';
    $str_from .= '<div class="row-fluid">';
    $str_from .= '<div class="span12">';
    $str_from .= '<ul class="widgeticons row-fluid">';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/datve.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/datve.png" alt="" class=""><span>Danh sách đặt vé</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/admin.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/admin.png" alt="" class=""><span>Tài khoản quản trị</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/user.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/user.png" alt="" class=""><span>Thành viên</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/config.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/cauhinh.png" alt="" class=""><span>Cấu hình hệ thống</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/lienhe.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/lienhe.png" alt="" class=""><span>Liên hệ</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/datdichvu.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/datdichvu.png" alt="" class=""><span>Danh sách đặt dịch vụ</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/dangky.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/dangky.png" alt="" class=""><span>Đăng ký email</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/dichvu.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/dichvu.png" alt="" class=""><span>Dịch vụ</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/hotro.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/hotro.png" alt="" class=""><span>Hỗ trợ trực tuyến</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/tintuckhuyenmai.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/khuyenmai.png" alt="" class=""><span>Tin khuyến mãi</span></a></li>';


    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/cauhoi.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/blog.png" alt="" class=""><span>Câu hỏi</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/dieukhoan_chinhsach.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/dieukhoan.png" alt="" class=""><span>Điều khoản - chính sách</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/doitac.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/doitac.png" alt="" class=""><span>Đối tác</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/gioithieu.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/gioithieu.png" alt="" class=""><span>Giới thiệu</span></a></li>';


    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/hinhthucthanhtoan.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/thanhtoan.png" alt="" class=""><span>Hình thức thanh toán</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/mangxahoi.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/mangxahoi.png" alt="" class=""><span>Mạng xã hội</span></a></li>';


    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/menu.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/menu.png" alt="" class=""><span>Cấu hình menu</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/thanhtoan.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/thanhtoan.png" alt="" class=""><span>Thanh toán trực tuyến</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/thanhtoan_chuyenkhoan.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/thanhtoan.png" alt="" class=""><span>Chuyển khoản</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/tieuchi.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/tieuchi.png" alt="" class=""><span>Tiêu chí</span></a></li>';


    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/tieude.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/tieude.png" alt="" class=""><span>Tiêu đề</span></a></li>';


    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/venoidia.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/venoidia.png" alt="" class=""><span>Vé nội địa</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/bg_dangnhap.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/album.png" alt="" class=""><span>Hình nền đăng nhập</span></a></li>';
    $str_from .= '<li class="one_fifth"><a href="'.SITE_NAME.'/controller/admin/quangcao.php"><img src="'.SITE_NAME.'/view/admin/Themes/images/imgadmin/quangcao.png" alt="" class=""><span>Quảng cáo</span></a></li>';


    $str_from .= '</ul></div></div>';
    return $str_from;
}
