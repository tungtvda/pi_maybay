<?php
require_once '../../config.php';
require_once DIR.'/model/dangkyService.php';
require_once DIR.'/view/admin/dangky.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new dangky();
            $new_obj->Id=$_GET["Id"];
            dangky_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dangky.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=dangky_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/dangky.php');
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
            $List_dangky=dangky_getByAll();
            foreach($List_dangky as $dangky)
            {
                if(isset($_GET["check_".$dangky->Id])) dangky_delete($dangky);
            }
            header('Location: '.SITE_NAME.'/controller/admin/dangky.php');
        }
    }
    if(isset($_POST["Email"])&&isset($_POST["Created"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Email']))
       $array['Email']='0';
       if(!isset($array['Created']))
       $array['Created']='0';
      $new_obj=new dangky($array);
        if($insert)
        {
            dangky_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dangky.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            dangky_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/dangky.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=dangky_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=dangky_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_dangky($data);
}
else
{
     header('location: '.SITE_NAME);
}
