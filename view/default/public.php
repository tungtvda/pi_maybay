<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nguyenvietdinh
 * Date: 2/6/14
 * Time: 3:51 PM
 * To change this template use File | Settings | File Templates.
 */
require_once DIR.'/common/cls_fast_template.php';
require_once DIR.'/common/locdautiengviet.php';
function print_template($data=array(),$tem)
{
    $ft=new FastTemplate(DIR.'/view/default/template');
    $ft->define($tem,$tem.'.tpl');
    $ft->assign('SITE-NAME',SITE_NAME);
    if(count($data)>0)
    {
        $keys=array_keys($data);
        foreach($keys as $item)
        {
            $ft->assign($item,$data[$item]);
        }
    }
    print $ft->parse_and_return($tem);
}

function print_item($file,$ListItem,$LocDau=false,$LocDauAssign=false,$numberformat=false)
{
    if(count($ListItem)>0)
    {
        $array_var=get_object_vars($ListItem[0]);
        $var_name_array=array_keys($array_var);
        $result='';
        $ft=new FastTemplate(DIR.'/view/default/template/item');
        $ft->define('item',$file.'.tpl');
        $ft->assign('SITE-NAME',SITE_NAME);
        $dem=0;
        foreach($ListItem as $item)
        {

            foreach($var_name_array as $var)
            {
                if($LocDau!=false)
                {
                    if($LocDau==$var)
                    {
                        $ft->assign($LocDauAssign,LocDau($item->$var));
                    }
                }

                if($numberformat!=false)
                {
                    if($numberformat==$var)
                    {
                        $ft->assign($var,number_format($item->$var,0,'.','.'));
                    }
                    else
                    {
                        $ft->assign($var,$item->$var);
                    }
                }
                else
                {
                    $ft->assign($var,$item->$var);
                }
            }





            if(get_class($item)=='tinkhuyenmai')
            {
                $ft->assign('Created',date_format(date_create($item->Created), 'd-m-Y : H:i:s'));
                if($_SESSION['kiemtra']==1)
                {
                    $ft->assign('xemtiep',"Xem chi tiết");
                    $ft->assign('Name',$item->Name);
                    if (strlen($item->NoiDung) > 300) {
                        $ten1=strip_tags($item->NoiDung);

                        $ten = substr($ten1, 0, 300);
                        $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                        $ft->assign('NoiDung',$name);
                    } else {
                        $ft->assign('NoiDung',strip_tags($item->NoiDung));
                    }
                    if (strlen($item->NoiDung) > 100) {
                        $ten2=strip_tags($item->NoiDung);

                        $ten3 = substr($ten2, 0, 100);
                        $name1 = substr($ten3, 0, strrpos($ten3, ' ')) . "...";
                        $ft->assign('NoiDung_ngan',$name1);
                    } else {
                        $ft->assign('NoiDung_ngan',strip_tags($item->NoiDung));
                    }
                }
                else
                {
                    $ft->assign('xemtiep',"Detail");
                    $ft->assign('Name',$item->Name_en);
                    if (strlen($item->NoiDung_en) > 350) {
                        $ten1=strip_tags($item->NoiDung_en);

                        $ten = substr($ten1, 0, 350);
                        $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                        $ft->assign('NoiDung',$name);
                    } else {
                        $ft->assign('NoiDung',strip_tags($item->NoiDung_en));
                    }
                    if (strlen($item->NoiDung_en) > 100) {
                        $ten2=strip_tags($item->NoiDung_en);

                        $ten3 = substr($ten2, 0, 100);
                        $name1 = substr($ten3, 0, strrpos($ten3, ' ')) . "...";
                        $ft->assign('NoiDung_ngan',$name1);
                    } else {
                        $ft->assign('NoiDung_ngan',strip_tags($item->NoiDung_en));
                    }
                }
                $ft->assign('Link',link_tinkhuyenmai($item));



            }

            if(get_class($item)=='tieuchi')
            {
                if($dem==0)
                {
                    $ft->assign('mau','background: #F25163');
                }
                else
                {
                    if($dem==1)
                    {
                        $ft->assign('mau','background: #67C6DC');
                    }
                    else
                    {
                        $ft->assign('mau',' background: #FDCA4B');

                    }
                }
                if($_SESSION['kiemtra']==1)
                {

                    $ft->assign('Name',$item->Name);
                    $ft->assign('MoTaNgan',$item->MoTaNgan);

                }
                else
                {

                    $ft->assign('Name',$item->Name_en);
                    $ft->assign('MoTaNgan',$item->MoTaNgan_en);
                }

            }

            if(get_class($item)=='hinhthucthanhtoan')
            {

                if($_SESSION['kiemtra']==1)
                {

                    $ft->assign('Name',$item->Name);
                    $ft->assign('MoTaNgan',$item->MoTaNgan);

                }
                else
                {

                    $ft->assign('Name',$item->Name_en);
                    $ft->assign('MoTaNgan',$item->MoTaNgan_en);
                }

            }

            if(get_class($item)=='doitac')
            {

                if($_SESSION['kiemtra']==1)
                {

                    $ft->assign('Name',$item->Name);


                }
                else
                {

                    $ft->assign('Name',$item->Name_en);

                }

            }


            if(get_class($item)=='dichvu')
            {
                if($_SESSION['kiemtra']==1)
                { $ft->assign('xemtiep',"Chi tiết");
                    $ft->assign('Name',$item->Name);
                    $ft->assign('MoTaNgan',$item->MoTaNgan);
                    $ft->assign('NoiDung',$item->NoiDung);
                }
                else
                { $ft->assign('xemtiep',"Detail");
                    $ft->assign('Name',$item->Name_en);
                    $ft->assign('MoTaNgan',$item->MoTaNgan_en);
                    $ft->assign('NoiDung',$item->NoiDung_en);
                }
                $ft->assign('Link',link_dichvu($item));
            }

            if(get_class($item)=='dichvu_sub')
            {
                $ft->assign('idchay','chay');
                $ft->assign('idnoibat','noibat');

                if ($item->HangSao == 5) {

                    $linksao = ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $ft->assign('sao',$linksao);
                }
                if ($item->HangSao == 4) {
                    $linksao = ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $ft->assign('sao',$linksao);
                }
                if ($item->HangSao == 3) {
                    $linksao = ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $ft->assign('sao',$linksao);
                }
                if ($item->HangSao == 2) {
                    $linksao = ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $ft->assign('sao',$linksao);
                }
                if ($item->HangSao == 1) {
                    $linksao = ' <img src="' . SITE_NAME . '/view/default/theme/images/star-on.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $linksao .= '<img src="' . SITE_NAME . '/view/default/theme/images/star_off.png">';
                    $ft->assign('sao',$linksao);
                }

                if($_SESSION['kiemtra']==1)
                { $ft->assign('xemtiep',"Liên hệ đặt phòng");
                    $ft->assign('giatu',"Giá từ");
                    $ft->assign('Name',$item->Name);
                    $ft->assign('Address',$item->Address);


                    if($item->GiaMoi!="")
                    {
                        $ft->assign('GiaMoi',number_format($item->GiaMoi, 0, ",", ".")." vnđ");
                    }
                    else
                    {
                        $ft->assign('GiaMoi',"Liên hệ");
                    }
                    if($item->GiaCu!="")
                    {
                        $ft->assign('GiaCu',number_format($item->GiaCu, 0, ",", ".")." vnđ");

                    }
                    else
                    {
                        $ft->assign('GiaCu',"");
                    }
                    if($item->GiaMoi!=""&&$item->GiaCu!="")
                    {
                        $phamtram=$item->GiaCu-$item->GiaMoi;
                        $giacat=($phamtram/$item->GiaCu)*100;
                        $tyle2=round($giacat, 1);
                        $ft->assign('phantram',$tyle2);
                    }
                    else{
                        $ft->assign('phantram',0);
                    }
                }
                else
                { $ft->assign('xemtiep',"Contact booking");
                    $ft->assign('giatu',"Price from");
                    $ft->assign('Name',$item->Name_en);
                    $ft->assign('Address',$item->Address_en);

                    if($item->GiaMoi_en!="")
                    {
                        $ft->assign('GiaMoi',number_format($item->GiaMoi_en, 0, ",", ".")." $");
                    }
                    else
                    {
                        $ft->assign('GiaMoi',"Contact");
                    }
                    if($item->GiaCu_en!="")
                    {
                        $ft->assign('GiaCu',number_format($item->GiaCu_en, 0, ",", ".")." $");

                    }
                    else
                    {
                        $ft->assign('GiaCu',"");
                    }
                    if($item->GiaMoi_en!=""&&$item->GiaCu_en!="")
                    {
                        $phamtram=$item->GiaCu_en-$item->GiaMoi_en;
                        $giacat=($phamtram/$item->GiaCu_en)*100;
                        $tyle2=round($giacat, 1);
                        $ft->assign('phantram',$tyle2);
                    }
                    else{
                        $ft->assign('phantram',0);
                    }
                }
                $ft->assign('Link',link_dichvu($item));
            }

            if(get_class($item)=='venoidia')
            {
                if($_SESSION['kiemtra']==1)
                { $ft->assign('xemtiep',"Chi tiết");
                    $ft->assign('Name',$item->Name);
                    $ft->assign('DiemDi',$item->DiemDi);
                    $ft->assign('DiemDen',$item->DiemDen);
                    $ft->assign('Gia',$item->Gia);

                }
                else
                { $ft->assign('xemtiep',"Detail");
                    $ft->assign('Name',$item->Name_en);
                    $ft->assign('DiemDi',$item->DiemDi_en);
                    $ft->assign('DiemDen',$item->DiemDen_en);
                    $ft->assign('Gia',$item->Gia_en);

                }
                if($item->DanhMucId==1)
                {
                    $ft->assign('Link',link_venoidia($item));
                }
                else
                {
                    $ft->assign('Link',link_vequocte($item));
                }
                $ft->assign('NgayDi',date_format(date_create($item->NgayDi), 'd-m-Y'));

            }

            if(get_class($item)=='cauhoi')
            {
                if($_SESSION['kiemtra']==1)
                {
                    $ft->assign('Name',$item->Name);
                    $ft->assign('NoiDung',$item->NoiDung);
                }
                else
                {
                    $ft->assign('Name',$item->Name_en);
                    $ft->assign('NoiDung',$item->NoiDung_en);
                }
                $demtang=$dem+1;
                $ft->assign('dem',$demtang);


            }

            if(get_class($item)=='hotro')
            {
                if($_SESSION['kiemtra']==1)
                {
                    $ft->assign('LoaiHoTro',$item->LoaiHoTro);

                }
                else
                {
                    $ft->assign('LoaiHoTro',$item->LoaiHoTro_en);

                }



            }

            if(get_class($item)=='thanhtoan')
            {

                if($_SESSION['kiemtra']==1)
                {
                    $ft->assign('Name',$item->Name);
                }
                else
                {
                    $ft->assign('Name',$item->Name_en);
                }
            }

            if(get_class($item)=='tuyendung')
            {
                if($_SESSION['kiemtra']==1)
                { $ft->assign('xemtiep',"Xem tiếp");
                    $ft->assign('Name',$item->Name);
                    if (strlen($item->NoiDung) > 250) {
                        $ten1=strip_tags($item->NoiDung);

                        $ten = substr($ten1, 0, 250);
                        $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                        $ft->assign('NoiDung',$name);
                    } else {
                        $ft->assign('NoiDung',strip_tags($item->NoiDung));
                    }
                    if (strlen($item->NoiDung) > 100) {
                        $ten2=strip_tags($item->NoiDung);

                        $ten3 = substr($ten2, 0, 100);
                        $name1 = substr($ten3, 0, strrpos($ten3, ' ')) . "...";
                        $ft->assign('NoiDung_ngan',$name1);
                    } else {
                        $ft->assign('NoiDung_ngan',strip_tags($item->NoiDung));
                    }
                }
                else
                { $ft->assign('xemtiep',"Read more");
                    $ft->assign('Name',$item->Name_en);
                    if (strlen($item->NoiDung_en) > 250) {
                        $ten1=strip_tags($item->NoiDung_en);

                        $ten = substr($ten1, 0, 250);
                        $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                        $ft->assign('NoiDung',$name);
                    } else {
                        $ft->assign('NoiDung',strip_tags($item->NoiDung_en));
                    }
                    if (strlen($item->NoiDung_en) > 100) {
                        $ten2=strip_tags($item->NoiDung_en);

                        $ten3 = substr($ten2, 0, 100);
                        $name1 = substr($ten3, 0, strrpos($ten3, ' ')) . "...";
                        $ft->assign('NoiDung_ngan',$name1);
                    } else {
                        $ft->assign('NoiDung_ngan',strip_tags($item->NoiDung_en));
                    }
                }
                $ft->assign('Link',link_tuyendung($item));


            }




            if(get_class($item)=='gioithieu')
            {
                if($_SESSION['kiemtra']==1)
                { $ft->assign('xemtiep',"Xem tiếp");
                    $ft->assign('Name',$item->Name);
                    if (strlen($item->NoiDung) > 250) {
                        $ten1=strip_tags($item->NoiDung);

                        $ten = substr($ten1, 0, 250);
                        $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                        $ft->assign('NoiDung',$name);
                    } else {
                        $ft->assign('NoiDung',strip_tags($item->NoiDung));
                    }
                    if (strlen($item->NoiDung) > 100) {
                        $ten2=strip_tags($item->NoiDung);

                        $ten3 = substr($ten2, 0, 100);
                        $name1 = substr($ten3, 0, strrpos($ten3, ' ')) . "...";
                        $ft->assign('NoiDung_ngan',$name1);
                    } else {
                        $ft->assign('NoiDung_ngan',strip_tags($item->NoiDung));
                    }
                }
                else
                { $ft->assign('xemtiep',"Read more");
                    $ft->assign('Name',$item->Name_en);
                    if (strlen($item->NoiDung_en) > 250) {
                        $ten1=strip_tags($item->NoiDung_en);

                        $ten = substr($ten1, 0, 250);
                        $name = substr($ten, 0, strrpos($ten, ' ')) . "...";
                        $ft->assign('NoiDung',$name);
                    } else {
                        $ft->assign('NoiDung',strip_tags($item->NoiDung_en));
                    }
                    if (strlen($item->NoiDung_en) > 100) {
                        $ten2=strip_tags($item->NoiDung_en);

                        $ten3 = substr($ten2, 0, 100);
                        $name1 = substr($ten3, 0, strrpos($ten3, ' ')) . "...";
                        $ft->assign('NoiDung_ngan',$name1);
                    } else {
                        $ft->assign('NoiDung_ngan',strip_tags($item->NoiDung_en));
                    }
                }
                $ft->assign('Link',link_gioithieu($item));



            }
            if(get_class($item)=='gia')
            {
                if($_SESSION['kiemtra']==1)
                {
                    $ft->assign('Name',$item->Name);
                }
                else
                {
                    $ft->assign('Name',$item->Name_en);
                }
            }

            if(get_class($item)=='nganhang')
            {
                if($_SESSION['kiemtra']==1)
                {
                    $ft->assign('ChiNhanh',$item->ChiNhanh);
                    $ft->assign('TenTaiKhoan',$item->TenTaiKhoan);
                    $ft->assign('NganHang',$item->NganHang);
                    $ft->assign('tentk',"Tên tài khoản");
                    $ft->assign('sotk',"Số tài khoản");
                    $ft->assign('chinhanh',"Chi nhánh");
                }
                else
                {
                    $ft->assign('ChiNhanh',$item->ChiNhanh_en);
                    $ft->assign('TenTaiKhoan',$item->TenTaiKhoan_en);
                    $ft->assign('NganHang',$item->NganHang_en);
                    $ft->assign('tentk',"Account name");
                    $ft->assign('sotk',"Số tài khoản");
                    $ft->assign('chinhanh',"Chi nhánh");

                }
            }
            if(get_class($item)=='vanphong')
            {
                if($_SESSION['kiemtra']==1)
                {
                    $ft->assign('Address',$item->Address);
                    $ft->assign('xembd',"Xem bản đồ");
                    $ft->assign('diachi',"Địa chỉ");

                }
                else
                {
                    $ft->assign('Address',$item->Address);
                    $ft->assign('xembd',"View map");
                    $ft->assign('diachi',"Address");

                }
            }

            $dem=$dem+1;

            $result.=$ft->parse_and_return('item');
        }
        return $result;
    }
    else
    {
        return '';
    }

}

if($_SESSION['kiemtra']==1)
{
    function link_danhmucgioithieu($app)
    {
        return SITE_NAME.'/gioi-thieu/'.$app->Id.'/'.LocDau($app->Name).'/';
    }
    function link_venoidia($app)
    {
        return SITE_NAME.'/ve-noi-dia/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_vequocte($app)
    {
        return SITE_NAME.'/ve-quoc-te/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_gioithieu($app)
    {
        return SITE_NAME.'/gioi-thieu/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_danhmuctuyendung($app)
    {
        return SITE_NAME.'/tuyen-dung/'.$app->Id.'/'.LocDau($app->Name).'/';
    }
    function link_tuyendung($app)
    {
        return SITE_NAME.'/tuyen-dung/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_sukien($app)
    {
        return SITE_NAME.'/su-kien/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_tinkhuyenmai($app)
    {
        return SITE_NAME.'/tin-khuyen-mai/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_danhmuctin($app)
    {
        return SITE_NAME.'/tin-tuc/'.$app->Id.'/'.LocDau($app->Name).'/';
    }
    function link_thongtin($app)
    {
        return SITE_NAME.'/thong-tin/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }

    function link_danhmucduan($app)
    {
        return SITE_NAME.'/du-an/'.$app->Id.'/'.LocDau($app->Name).'/';
    }
    function link_dichvu($app)
    {
        return SITE_NAME.'/dich-vu/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }

    function link_danhmucblog($app)
    {
        return SITE_NAME.'/blog/'.$app->Id.'/'.LocDau($app->Name).'/';
    }
    function link_blog($app)
    {
        return SITE_NAME.'/blog/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }

    function link_danhmucphongthuy($app)
    {
        return SITE_NAME.'/phong-thuy/'.$app->Id.'/'.LocDau($app->Name).'/';
    }
    function link_phongthuy($app)
    {
        return SITE_NAME.'/phong-thuy/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_rakhoi($app)
    {
        return SITE_NAME.'/ra-khoi/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_danhmucvayvon($app)
    {
        return SITE_NAME.'/cenmoney/'.$app->Id.'/'.LocDau($app->Name).'/';
    }
    function link_vayvon($app)
    {
        return SITE_NAME.'/cenmoney/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
    function link_baohiem($app)
    {
        return SITE_NAME.'/bao-hiem/'.LocDau($app->Name).'-'.$app->Id.'.html';
    }
}
else

{
    function link_dichvu($app)
    {
        return SITE_NAME.'/dich-vu/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
    function link_venoidia($app)
    {
        return SITE_NAME.'/ve-noi-dia/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
    function link_vequocte($app)
    {
        return SITE_NAME.'/ve-quoc-te/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }

    function link_gioithieu($app)
    {
        return SITE_NAME.'/gioi-thieu/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }

    function link_baohiem($app)
    {
        return SITE_NAME.'/bao-hiem/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
    function link_sukien($app)
    {
        return SITE_NAME.'/su-kien/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
    function link_tinkhuyenmai($app)
    {
        return SITE_NAME.'/tin-khuyen-mai/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
    function link_danhmuctin($app)
    {
        return SITE_NAME.'/tin-tuc/'.$app->Id.'/'.LocDau($app->Name_en).'/';
    }
    function link_thongtin($app)
    {
        return SITE_NAME.'/thong-tin/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }

    function link_danhmucduan($app)
    {
        return SITE_NAME.'/du-an/'.$app->Id.'/'.LocDau($app->Name_en).'/';
    }

    function link_danhmucblog($app)
    {
        return SITE_NAME.'/blog/'.$app->Id.'/'.LocDau($app->Name_en).'/';
    }
    function link_blog($app)
    {
        return SITE_NAME.'/blog/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }

    function link_danhmucphongthuy($app)
    {
        return SITE_NAME.'/phong-thuy/'.$app->Id.'/'.LocDau($app->Name_en).'/';
    }
    function link_phongthuy($app)
    {
        return SITE_NAME.'/phong-thuy/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
    function link_rakhoi($app)
    {
        return SITE_NAME.'/ra-khoi/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
    function link_danhmucvayvon($app)
    {
        return SITE_NAME.'/cenmoney/'.$app->Id.'/'.LocDau($app->Name_en).'/';
    }
    function link_vayvon($app)
    {
        return SITE_NAME.'/cenmoney/'.LocDau($app->Name_en).'-'.$app->Id.'.html';
    }
}




