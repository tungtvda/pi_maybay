<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 11/20/14
 * Time: 11:00 AM
 */
if(isset($_SESSION['lang']))
{
    if($_SESSION['lang']==1)
    {
        $_SESSION['kiemtra']=1;
    }
    else
    {
        $_SESSION['kiemtra']=2;
    }
}
else
{
    $_SESSION['kiemtra']=1;
}
$array_files=scandir(DIR.'/model');
foreach ($array_files as $filename) {
    $path = DIR.'/model/' . $filename;
    if (is_file($path)) {
        require_once $path;
    }
}
//
$array_files=scandir(DIR.'/view/default');
foreach ($array_files as $filename) {
    $path = DIR.'/view/default/' . $filename;
    if (is_file($path)) {
        require_once $path;
    }
}
function show_header($title,$description,$keyword,$data1=array())
{
    $data=array();
    $data['Title']=$title;
    $data['Description']=$description;
    $data['Keyword']=$keyword;
    $data['config']=$data1['config'];

    view_header($data);
}
function show_header2($title,$description,$keyword,$data1=array())
{
    $data=array();
    $data['Title']=$title;
    $data['Description']=$description;
    $data['Keyword']=$keyword;
    $data['config']=$data1['config'];
    $_SESSION['lienhe']=$data['config'][0]->Phone;
    view_header2($data);
}

function  show_slide($data1=array())
{
    $data=array();
    $data['slide']=$data1['slide'];
    view_slide($data);
}

function  show_left($data1=array(),$active='trangchu')
{
    $data=array();
    $data['active']=$active;
    $data['name_tt5']=tieude_getByTop(1,'Id=5','');
    if($data['active']=="gioithieu")
        {
            $data['danhmuc_left']=danhmucgioithieu_getByTop('','','ViTri asc');
        }
    if($data['active']=="tintuc")
    {

        $data['danhmuc_left']=danhmuctintuc_getByTop('','','ViTri asc');
    }
    if($data['active']=="tuyendung")
    {
        $data['danhmuc_left']=danhmuctuyendung_getByTop('','','ViTri asc');
    }
    if($data['active']=="blog")
    {
        $data['danhmuc_left']=danhmucblog_getByTop('','','ViTri asc');
    }
    if($data['active']=="phongthuy")
    {
        $data['danhmuc_left']=danhmucphongthuy_getByTop('','','ViTri asc');
    }
    if($data['active']=="duan")
    {
        $data['danhmuc_left']=danhmucduan_getByTop('','','ViTri asc');
    }
    if($data['active']=="vayvon")
    {
        $data['danhmuc_left']=danhmucvayvon_getByTop('','','ViTri asc');
    }
    if(isset($data1['danhmuc_id']))
    {
        $data['danhmucId']=$data1['danhmuc_id'];

    }
    $data['tinhthanh']=province_getByTop('','provinceid	!=0','provinceid asc');
    $data['huongnha']=huongnha_getByTop('','','Id asc');

    $data['giada']=gia_getByTop('','','ViTri asc');
    $data['dientichda']=dientich_getByTop('','','ViTri asc');
    $data['phongda']=sophongngu_getByTop('','','ViTri asc');

    view_left($data);
}
function  show_left2($data1=array())
{
    $data=array();
    $data['danhmuc1']=$data1['danhmuc1'];
    $data['doitac']=$data1['doitac'];
    $data['sanpham_left']=$data1['sanpham_left'];
    $data['tag']=$data1['tag'];
    view_left2($data);
}
function  show_right($data1=array())
{
    $data=array();

    $data['hotro_right']=hotro_getByTop('','','Id desc');

    view_right($data);
}
function  show_right2($data1=array())
{
    $data=array();

    $data['hotro_right']=hotro_getByTop('','','Id desc');

    view_right2($data);
}
function show_menu($data1=array(),$active='trangchu')
{
    $data=array();
    $data['active']=$active;
    $data['config']=$data1['config'];
    $data['menu1']=menu_getById(1);
    $data['menu2']=menu_getById(2);
    $data['menu3']=menu_getById(3);
    $data['menu4']=menu_getById(4);
    $data['menu5']=menu_getById(5);
    $data['menu6']=menu_getById(6);
    $data['menu7']=menu_getById(7);
    $data['name_tt1']=tieude_getById(1);
    $data['name_tt10']=tieude_getById(10);
    $data['bg_dangnhap']=bg_dangnhap_getById(1);

    view_menu($data);
}
function show_body($data1=array())
{
    $data=array();


    view_body($data);
}
function show_body2($data1=array())
{
    $data=array();


    view_body2($data);
}
function show_body3($data1=array())
{
    $data=array();


    view_body3($data);
}
function show_footer($data1=array(),$active='trangchu')
{
    $data=array();
    $data['mangxahoi_ft']=mangxahoi_getById(1);
    $data['config']=$data1['config'];
    $data['doitac']=doitac_getByTop('','','Id desc');
    $data['quocgia']=countries_getByTop('','','id desc');

    $data['venoidia']=venoidia_getByTop(7,'DanhMucId=1','Id desc');
    $data['thanhtoan']=thanhtoan_getByTop('','','Id desc');
    $data['menu1']=menu_getByTop(1,'Id=1','');
    $data['menu2']=menu_getByTop(1,'Id=2','');
    $data['menu3']=menu_getByTop(1,'Id=3','');
    $data['menu4']=menu_getByTop(1,'Id=4','');
    $data['menu5']=menu_getByTop(1,'Id=5','');
    $data['menu6']=menu_getByTop(1,'Id=6','');
    $data['menu7']=menu_getByTop(1,'Id=7','');
    $data['name_tt2']=tieude_getById(2);
    $data['name_tt3']=tieude_getById(3);
    $data['name_tt4']=tieude_getById(4);
    $data['name_tt5']=tieude_getById(5);
    $data['active']=$active;
    if (isset($_POST['dangkyemail'])) {

        $email=addslashes(strip_tags($_POST['Email_dk']));


        if($email=="")
        {
            if($_SESSION['kiemtra']==1)
            {
                echo "<script>alert('Quý khách vui nhập email')</script>";
            }
            else
            {
                echo "<script>alert('Guests are welcome enter email')</script>";
            }

        }
        else
        {

            $new = new dangky();


            $new->Email=$email;

            $new->Created=date(DATETIME_FORMAT);
            dangky_insert($new);
            if($_SESSION['kiemtra']==1)
            {
                echo "<script>alert('Quý khách đã đăng ký thành công')</script>";
            }
            else
            {
                echo "<script>alert('You have successfully registered')</script>";
            }



        }

    }
    view_footer($data);
}
function show_footer2($data1=array())
{
    $data=array();
    $data['mangxahoi']=$data1['mangxahoi'];
    $data['config']=$data1['config'];
    $data['chinhsach']=$data1['chinhsach'];

    view_footer2($data);
}


