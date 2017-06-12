<?php
require_once '../../config.php';
require_once DIR.'/model/dieukhoan_chinhsachService.php';
require_once DIR.'/view/admin/dieukhoan_chinhsach.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new dieukhoan_chinhsach();
            $new_obj->Id=$_GET["Id"];
            dieukhoan_chinhsach_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dieukhoan_chinhsach.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=dieukhoan_chinhsach_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/dieukhoan_chinhsach.php');
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
            $List_dieukhoan_chinhsach=dieukhoan_chinhsach_getByAll();
            foreach($List_dieukhoan_chinhsach as $dieukhoan_chinhsach)
            {
                if(isset($_GET["check_".$dieukhoan_chinhsach->Id])) dieukhoan_chinhsach_delete($dieukhoan_chinhsach);
            }
            header('Location: '.SITE_NAME.'/controller/admin/dieukhoan_chinhsach.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["DieuKhoan"])&&isset($_POST["DieuKhoan_en"])&&isset($_POST["ChinhSach"])&&isset($_POST["ChinhSach_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['DieuKhoan']))
       $array['DieuKhoan']='0';
       if(!isset($array['DieuKhoan_en']))
       $array['DieuKhoan_en']='0';
       if(!isset($array['ChinhSach']))
       $array['ChinhSach']='0';
       if(!isset($array['ChinhSach_en']))
       $array['ChinhSach_en']='0';
      $new_obj=new dieukhoan_chinhsach($array);
        if($insert)
        {
            dieukhoan_chinhsach_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dieukhoan_chinhsach.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            dieukhoan_chinhsach_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/dieukhoan_chinhsach.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=dieukhoan_chinhsach_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=dieukhoan_chinhsach_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_dieukhoan_chinhsach($data);
}
else
{
     header('location: '.SITE_NAME);
}
