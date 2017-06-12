<?php
require_once '../../config.php';
require_once DIR.'/model/danhmuchotroService.php';
require_once DIR.'/view/admin/danhmuchotro.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new danhmuchotro();
            $new_obj->Id=$_GET["Id"];
            danhmuchotro_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/danhmuchotro.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=danhmuchotro_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/danhmuchotro.php');
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
            $List_danhmuchotro=danhmuchotro_getByAll();
            foreach($List_danhmuchotro as $danhmuchotro)
            {
                if(isset($_GET["check_".$danhmuchotro->Id])) danhmuchotro_delete($danhmuchotro);
            }
            header('Location: '.SITE_NAME.'/controller/admin/danhmuchotro.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["Name_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Name_en']))
       $array['Name_en']='0';
      $new_obj=new danhmuchotro($array);
        if($insert)
        {
            danhmuchotro_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/danhmuchotro.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            danhmuchotro_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/danhmuchotro.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=danhmuchotro_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=danhmuchotro_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_danhmuchotro($data);
}
else
{
     header('location: '.SITE_NAME);
}
