<?php
require_once '../../config.php';
require_once DIR.'/model/admin_apiService.php';
require_once DIR.'/view/admin/admin_api.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new admin_api();
            $new_obj->Id=$_GET["Id"];
            admin_api_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/admin_api.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=admin_api_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/admin_api.php');
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
            $List_admin_api=admin_api_getByAll();
            foreach($List_admin_api as $admin_api)
            {
                if(isset($_GET["check_".$admin_api->Id])) admin_api_delete($admin_api);
            }
            header('Location: '.SITE_NAME.'/controller/admin/admin_api.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["Password"])&&isset($_POST["Api"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Password']))
       $array['Password']='0';
       if(!isset($array['Api']))
       $array['Api']='0';
      $new_obj=new admin_api($array);
        if($insert)
        {
            admin_api_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/admin_api.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            admin_api_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/admin_api.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=admin_api_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=admin_api_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_admin_api($data);
}
else
{
     header('location: '.SITE_NAME);
}
