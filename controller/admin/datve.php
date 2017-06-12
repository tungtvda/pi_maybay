<?php
require_once '../../config.php';
require_once DIR.'/model/datveService.php';
require_once DIR.'/model/trangthaiService.php';
require_once DIR.'/view/admin/datve.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new datve();
            $new_obj->Id=$_GET["Id"];
            datve_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/datve.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=datve_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/datve.php');
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
    $data['listfkey']['TrangThaiThanhToan']=trangthai_getByAll();
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_datve=datve_getByAll();
            foreach($List_datve as $datve)
            {
                if(isset($_GET["check_".$datve->Id])) datve_delete($datve);
            }
            header('Location: '.SITE_NAME.'/controller/admin/datve.php');
        }
    }
    if(isset($_POST["TrangThaiThanhToan"])&&isset($_POST["MaDatVe"])&&isset($_POST["HangBay"])&&isset($_POST["LoaiVe"])&&isset($_POST["ChieuDi"])&&isset($_POST["ChieuVe"])&&isset($_POST["NgayDi"])&&isset($_POST["NgayVe"])&&isset($_POST["SoNguoiLon"])&&isset($_POST["SoTreEm"])&&isset($_POST["TreSoSinh"])&&isset($_POST["ThanhTien"])&&isset($_POST["NguoiDaiDien"])&&isset($_POST["Phone"])&&isset($_POST["Email"])&&isset($_POST["Address"])&&isset($_POST["YeuCau"])&&isset($_POST["MaSoThue"])&&isset($_POST["TenCongTy"])&&isset($_POST["DiaChiCongTy"])&&isset($_POST["DiaChiNhanHoaDon"])&&isset($_POST["HTTT"])&&isset($_POST["NgayDat"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['TrangThaiThanhToan']))
       $array['TrangThaiThanhToan']='0';
       if(!isset($array['MaDatVe']))
       $array['MaDatVe']='0';
       if(!isset($array['HangBay']))
       $array['HangBay']='0';
       if(!isset($array['LoaiVe']))
       $array['LoaiVe']='0';
       if(!isset($array['ChieuDi']))
       $array['ChieuDi']='0';
       if(!isset($array['ChieuVe']))
       $array['ChieuVe']='0';
       if(!isset($array['NgayDi']))
       $array['NgayDi']='0';
       if(!isset($array['NgayVe']))
       $array['NgayVe']='0';
       if(!isset($array['SoNguoiLon']))
       $array['SoNguoiLon']='0';
       if(!isset($array['SoTreEm']))
       $array['SoTreEm']='0';
       if(!isset($array['TreSoSinh']))
       $array['TreSoSinh']='0';
       if(!isset($array['ThanhTien']))
       $array['ThanhTien']='0';
       if(!isset($array['NguoiDaiDien']))
       $array['NguoiDaiDien']='0';
       if(!isset($array['Phone']))
       $array['Phone']='0';
       if(!isset($array['Email']))
       $array['Email']='0';
       if(!isset($array['Address']))
       $array['Address']='0';
       if(!isset($array['YeuCau']))
       $array['YeuCau']='0';
       if(!isset($array['MaSoThue']))
       $array['MaSoThue']='0';
       if(!isset($array['TenCongTy']))
       $array['TenCongTy']='0';
       if(!isset($array['DiaChiCongTy']))
       $array['DiaChiCongTy']='0';
       if(!isset($array['DiaChiNhanHoaDon']))
       $array['DiaChiNhanHoaDon']='0';
       if(!isset($array['HTTT']))
       $array['HTTT']='0';
       if(!isset($array['NgayDat']))
       $array['NgayDat']='0';
      $new_obj=new datve($array);
        if($insert)
        {
            datve_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/datve.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            datve_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/datve.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=datve_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=datve_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_datve($data);
}
else
{
     header('location: '.SITE_NAME);
}
