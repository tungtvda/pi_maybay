<?php
require_once '../../config.php';
require_once DIR.'/model/vanphongService.php';
require_once DIR.'/view/admin/vanphong.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new vanphong();
            $new_obj->Id=$_GET["Id"];
            vanphong_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/vanphong.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=vanphong_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/vanphong.php');
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
            $List_vanphong=vanphong_getByAll();
            foreach($List_vanphong as $vanphong)
            {
                if(isset($_GET["check_".$vanphong->Id])) vanphong_delete($vanphong);
            }
            header('Location: '.SITE_NAME.'/controller/admin/vanphong.php');
        }
    }
    if(isset($_POST["Address"])&&isset($_POST["Address_en"])&&isset($_POST["Phone"])&&isset($_POST["BanDo"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Address']))
       $array['Address']='0';
       if(!isset($array['Address_en']))
       $array['Address_en']='0';
       if(!isset($array['Phone']))
       $array['Phone']='0';
       if(!isset($array['BanDo']))
       $array['BanDo']='0';
      $new_obj=new vanphong($array);
        if($insert)
        {
            vanphong_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/vanphong.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            vanphong_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/vanphong.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=vanphong_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=vanphong_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_vanphong($data);
}
else
{
     header('location: '.SITE_NAME);
}
