<?php
require_once '../../config.php';
require_once DIR.'/model/adminService.php';
require_once DIR.'/view/admin/admin.php';
require_once DIR.'/common/messenger.php';
require_once(DIR."/common/hash_pass.php");
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new admin();
            $new_obj->Id=$_GET["Id"];
            admin_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/admin.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=admin_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/admin.php');
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
            $List_admin=admin_getByAll();
            foreach($List_admin as $admin)
            {
                if(isset($_GET["check_".$admin->Id])) admin_delete($admin);
            }
            header('Location: '.SITE_NAME.'/controller/admin/admin.php');
        }
    }
    if(isset($_POST["TenDangNhap"])&&isset($_POST["Full_name"])&&isset($_POST["MatKhau"]))
    {
        $array=$_POST;
        if(!isset($array['Id']))
            $array['Id']='0';
        if(!isset($array['TenDangNhap']))
            $array['TenDangNhap']='0';
        if(!isset($array['Full_name']))
            $array['Full_name']='0';
        if(!isset($array['MatKhau']))
            $array['MatKhau']='0';
        $new_obj=new admin($array);
        if($insert)
        {
            $new_obj->MatKhau=hash_pass($_POST["MatKhau"]);
            admin_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/admin.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            $data['kiemtra']=admin_getById($_GET["Id"]);
            if($data['kiemtra'][0]->MatKhau==$_POST["MatKhau"])
            {
                $new_obj->MatKhau=$data['kiemtra'][0]->MatKhau;
            }
            else
            {
                $new_obj->MatKhau=hash_pass($_POST["MatKhau"]);
            }

            admin_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/admin.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=admin_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=admin_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_admin($data);
}
else
{
    header('location: '.SITE_NAME);
}
