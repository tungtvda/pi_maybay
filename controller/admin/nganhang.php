<?php
require_once '../../config.php';
require_once DIR.'/model/nganhangService.php';
require_once DIR.'/view/admin/nganhang.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new nganhang();
            $new_obj->Id=$_GET["Id"];
            nganhang_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/nganhang.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=nganhang_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/nganhang.php');
        }
        else
        {
            $data['tab1_class']='default-tab current';
        }
    }
    else
    {
        $data['tab1_class']='default-tab current';
    }
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_nganhang=nganhang_getByAll();
            foreach($List_nganhang as $nganhang)
            {
                if(isset($_GET["check_".$nganhang->Id])) nganhang_delete($nganhang);
            }
            header('Location: '.SITE_NAME.'/controller/admin/nganhang.php');
        }
    }
    if(isset($_POST["NganHang"])&&isset($_POST["NganHang_en"])&&isset($_POST["Img"])&&isset($_POST["TenTaiKhoan"])&&isset($_POST["TenTaiKhoan_en"])&&isset($_POST["SoTaiKhoan"])&&isset($_POST["ChiNhanh"])&&isset($_POST["ChiNhanh_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['NganHang']))
       $array['NganHang']='0';
       if(!isset($array['NganHang_en']))
       $array['NganHang_en']='0';
       if(!isset($array['Img']))
       $array['Img']='0';
       if(!isset($array['TenTaiKhoan']))
       $array['TenTaiKhoan']='0';
       if(!isset($array['TenTaiKhoan_en']))
       $array['TenTaiKhoan_en']='0';
       if(!isset($array['SoTaiKhoan']))
       $array['SoTaiKhoan']='0';
       if(!isset($array['ChiNhanh']))
       $array['ChiNhanh']='0';
       if(!isset($array['ChiNhanh_en']))
       $array['ChiNhanh_en']='0';
      $new_obj=new nganhang($array);
        if($insert)
        {
            nganhang_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/nganhang.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            nganhang_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/nganhang.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=nganhang_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=nganhang_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_nganhang($data);
}
else
{
     header('location: '.SITE_NAME);
}
