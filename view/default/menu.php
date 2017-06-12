<?php
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/locdautiengviet.php';
function view_menu($data = array())
{
    $asign = array();
    $asign['trangchu_mn'] = ($data['active'] == 'trangchu') ? 'active' : '';

    $asign['gioithieu_mn'] = ($data['active'] == 'gioithieu') ? 'active' : '';
    $asign['venoidia_mn'] = ($data['active'] == 'venoidia') ? 'active' : '';
    $asign['vequocte_mn'] = ($data['active'] == 'vequocte') ? 'active' : '';
    $asign['dichvu_mn'] = ($data['active'] == 'dichvu') ? 'active' : '';
    $asign['tinkhuyenmai_mn'] = ($data['active'] == 'tinkhuyenmai') ? 'active' : '';

    $asign['logo'] = $data['config'][0]->Logo;
    $asign['Hotlien_datve'] = $data['config'][0]->Hotlien_datve;
    if($_SESSION['kiemtra']==1)
    {
        $asign['bg_dangnhap'] = $data['bg_dangnhap'][0]->Img;
        $asign['ten_menu0'] = "Trang chủ";
        $asign['ten_menu1'] = $data['menu1'][0]->Name;
        $asign['ten_menu2'] = $data['menu2'][0]->Name;
        $asign['ten_menu3'] = $data['menu3'][0]->Name;
        $asign['ten_menu4'] = $data['menu4'][0]->Name;
        $asign['ten_menu5'] = $data['menu5'][0]->Name;
        $asign['ten_menu6'] = $data['menu6'][0]->Name;
        $asign['ten_menu7'] = $data['menu7'][0]->Name;
        $asign['ten'] = $data['config'][0]->Name;
        $asign['name_tt1'] = $data['name_tt1'][0]->Name;
        $asign['name_tt10'] = $data['name_tt10'][0]->Name;
        $asign['vechungtoi'] ='Về chúng tôi';
        $asign['hotli'] ='HOTLINE ĐẶT VÉ';
        $asign['tk_td'] ='Tìm kiếm';

        $asign['dangnhap_td'] ='Đăng nhập';

        $asign['hoac_td'] ='Hoặc đăng nhập bằng tài khoản';
        $asign['dangky-td'] =' <a href="'.SITE_NAME.'.dang-ky-thanh-vien.html" style="color: #70d572">Đăng ký</a> là thành viên của Tourcoach';
    }
    else
    {
        $asign['bg_dangnhap'] = $data['bg_dangnhap'][0]->Img_en;

        $asign['ten_menu0'] = "Home";
        $asign['ten_menu1'] = $data['menu1'][0]->Name_en;
        $asign['ten_menu2'] = $data['menu2'][0]->Name_en;
        $asign['ten_menu3'] = $data['menu3'][0]->Name_en;
        $asign['ten_menu4'] = $data['menu4'][0]->Name_en;
        $asign['ten_menu5'] = $data['menu5'][0]->Name_en;
        $asign['ten_menu6'] = $data['menu6'][0]->Name_en;
        $asign['ten_menu7'] = $data['menu7'][0]->Name_en;
        $asign['ten'] = $data['config'][0]->Name_en;
        $asign['name_tt1'] = $data['name_tt1'][0]->Name_en;
        $asign['name_tt10'] = $data['name_tt10'][0]->Name_en;
        $asign['hoac_td'] ='Hoặc đăng nhập bằng tài khoản';
        $asign['vechungtoi'] ='About us';
        $asign['hotli'] ='BOOKING HOTLINE';
        $asign['tk_td'] ='Search';
        $asign['dangnhap_td'] ='Login';
        $asign['dangky-td'] =' <a href="'.SITE_NAME.'.dang-ky-thanh-vien.html" style="color: #70d572">Register</a> as a member of Tourcoach';
    }
    $asign['link_kt']="";
    if(isset($_SESSION['user_id']))
    {
        if($_SESSION['kiemtra']==1)
        {
            $asign['link_kt'] ='<li><a href="javascript:void()" id="try-1"><i class="fa fa-sign-in"></i> '.(isset($_SESSION['user_name'])?$_SESSION['user_name']:'').'</a></li>
                        <li><a href="'.SITE_NAME.'/dang-xuat.html"><i class="fa fa-pencil-square-o"></i> Đăng xuất</a></li>';
        }
        else
        {
            $asign['link_kt'] ='<li><a href="javascript:void()" id="try-1"><i class="fa fa-sign-in"></i> '.$_SESSION['user_name'].'</a></li>
                        <li><a href="'.SITE_NAME.'/dang-xuat.html"><i class="fa fa-pencil-square-o"></i> Logout</a></li>';
        }
    }
    else
    {
        if($_SESSION['kiemtra']==1)
        {
            $asign['link_kt'] ='<li><a href="javascript:void()" id="try-1"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                        <li><a href="'.SITE_NAME.'/dang-ky.html"><i class="fa fa-pencil-square-o"></i> Đăng ký</a></li>';
        }
        else
        {
            $asign['link_kt'] ='<li><a href="javascript:void()" id="try-1"><i class="fa fa-sign-in"></i> Login</a></li>
                        <li><a href="'.SITE_NAME.'/dang-ky.html"><i class="fa fa-pencil-square-o"></i> Sigup</a></li>';
        }
    }

    print_template($asign, 'menu');
}