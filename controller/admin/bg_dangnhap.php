<?php
require_once '../../config.php';
require_once DIR.'/model/bg_dangnhapService.php';
require_once DIR.'/view/admin/bg_dangnhap.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new bg_dangnhap();
            $new_obj->Id=$_GET["Id"];
            bg_dangnhap_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/bg_dangnhap.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=bg_dangnhap_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/bg_dangnhap.php');
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
            $List_bg_dangnhap=bg_dangnhap_getByAll();
            foreach($List_bg_dangnhap as $bg_dangnhap)
            {
                if(isset($_GET["check_".$bg_dangnhap->Id])) bg_dangnhap_delete($bg_dangnhap);
            }
            header('Location: '.SITE_NAME.'/controller/admin/bg_dangnhap.php');
        }
    }
    if(isset($_POST["Img"])&&isset($_POST["Img_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Img']))
       $array['Img']='0';
       if(!isset($array['Img_en']))
       $array['Img_en']='0';
      $new_obj=new bg_dangnhap($array);
        if($insert)
        {
            bg_dangnhap_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/bg_dangnhap.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            bg_dangnhap_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/bg_dangnhap.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=bg_dangnhap_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=bg_dangnhap_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_bg_dangnhap($data);
}
else
{
     header('location: '.SITE_NAME);
}
