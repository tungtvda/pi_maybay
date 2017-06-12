<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_dangkythanhcong($data = array())
{
    $asign = array();
    $asign['Name_dm']= $data['Name_dm'];
    $asign['Name']= $data['Name'];
    $asign['tieude']= $data['tieude'];
    $asign['NoiDung']= $data['NoiDung'];
    $asign['cungloai']= $data['cungloai'];

    $asign['Email_bdk']= $data['Email_bdk'];
    $asign['pass_bdk']= $data['pass_bdk'];
    if($_SESSION['kiemtra']==1)
    {
        $asign['name_tt8'] = $data['name_tt8'][0]->Name;
        $asign['quydanh_tt'] = "Email đăng nhập của bạn là";


        $asign['hoten_tt'] = "Mật khẩu đăng nhập là";

    }
    else

    {

        $asign['name_tt8'] = $data['name_tt8'][0]->Name_en;
        $asign['quydanh_tt'] = "Your login email is";
        $asign['hoten_tt'] = "Login password is";

    }






    print_template($asign, 'dangkythanhcong');
}