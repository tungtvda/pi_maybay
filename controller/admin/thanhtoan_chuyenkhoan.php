<?php
require_once '../../config.php';
require_once DIR.'/model/thanhtoan_chuyenkhoanService.php';
require_once DIR.'/view/admin/thanhtoan_chuyenkhoan.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new thanhtoan_chuyenkhoan();
            $new_obj->Id=$_GET["Id"];
            thanhtoan_chuyenkhoan_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan_chuyenkhoan.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=thanhtoan_chuyenkhoan_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/thanhtoan_chuyenkhoan.php');
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
            $List_thanhtoan_chuyenkhoan=thanhtoan_chuyenkhoan_getByAll();
            foreach($List_thanhtoan_chuyenkhoan as $thanhtoan_chuyenkhoan)
            {
                if(isset($_GET["check_".$thanhtoan_chuyenkhoan->Id])) thanhtoan_chuyenkhoan_delete($thanhtoan_chuyenkhoan);
            }
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan_chuyenkhoan.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["HuongDanThanhToan"])&&isset($_POST["HuongDanThanhToan_en"])&&isset($_POST["ThongTinChuyenKhoan"])&&isset($_POST["ThongTinChuyenKhoan_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['HuongDanThanhToan']))
       $array['HuongDanThanhToan']='0';
       if(!isset($array['HuongDanThanhToan_en']))
       $array['HuongDanThanhToan_en']='0';
       if(!isset($array['ThongTinChuyenKhoan']))
       $array['ThongTinChuyenKhoan']='0';
       if(!isset($array['ThongTinChuyenKhoan_en']))
       $array['ThongTinChuyenKhoan_en']='0';
      $new_obj=new thanhtoan_chuyenkhoan($array);
        if($insert)
        {
            thanhtoan_chuyenkhoan_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan_chuyenkhoan.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            thanhtoan_chuyenkhoan_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan_chuyenkhoan.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=thanhtoan_chuyenkhoan_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=thanhtoan_chuyenkhoan_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_thanhtoan_chuyenkhoan($data);
}
else
{
     header('location: '.SITE_NAME);
}
