<?php
require_once '../../config.php';
require_once DIR.'/model/mangxahoiService.php';
require_once DIR.'/view/admin/mangxahoi.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new mangxahoi();
            $new_obj->Id=$_GET["Id"];
            mangxahoi_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/mangxahoi.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=mangxahoi_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/mangxahoi.php');
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
            $List_mangxahoi=mangxahoi_getByAll();
            foreach($List_mangxahoi as $mangxahoi)
            {
                if(isset($_GET["check_".$mangxahoi->Id])) mangxahoi_delete($mangxahoi);
            }
            header('Location: '.SITE_NAME.'/controller/admin/mangxahoi.php');
        }
    }
    if(isset($_POST["Face"])&&isset($_POST["Feed"])&&isset($_POST["Twitter"])&&isset($_POST["Google"])&&isset($_POST["Youtube"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Face']))
       $array['Face']='0';
       if(!isset($array['Feed']))
       $array['Feed']='0';
       if(!isset($array['Twitter']))
       $array['Twitter']='0';
       if(!isset($array['Google']))
       $array['Google']='0';
       if(!isset($array['Youtube']))
       $array['Youtube']='0';
      $new_obj=new mangxahoi($array);
        if($insert)
        {
            mangxahoi_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/mangxahoi.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            mangxahoi_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/mangxahoi.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=mangxahoi_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=mangxahoi_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_mangxahoi($data);
}
else
{
     header('location: '.SITE_NAME);
}
