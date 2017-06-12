<?php
require_once '../../config.php';
require_once DIR.'/model/gioithieuService.php';
require_once DIR.'/view/admin/gioithieu.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new gioithieu();
            $new_obj->Id=$_GET["Id"];
            gioithieu_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/gioithieu.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=gioithieu_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/gioithieu.php');
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
            $List_gioithieu=gioithieu_getByAll();
            foreach($List_gioithieu as $gioithieu)
            {
                if(isset($_GET["check_".$gioithieu->Id])) gioithieu_delete($gioithieu);
            }
            header('Location: '.SITE_NAME.'/controller/admin/gioithieu.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["Img"])&&isset($_POST["GioiThieu"])&&isset($_POST["GioiThieu_en"])&&isset($_POST["UuViet"])&&isset($_POST["UuViet_en"])&&isset($_POST["CacDichVu"])&&isset($_POST["CacDicVu_en"])&&isset($_POST["CamKet"])&&isset($_POST["CamKet_en"])&&isset($_POST["LienHe"])&&isset($_POST["LienHe_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Img']))
       $array['Img']='0';
       if(!isset($array['GioiThieu']))
       $array['GioiThieu']='0';
       if(!isset($array['GioiThieu_en']))
       $array['GioiThieu_en']='0';
       if(!isset($array['UuViet']))
       $array['UuViet']='0';
       if(!isset($array['UuViet_en']))
       $array['UuViet_en']='0';
       if(!isset($array['CacDichVu']))
       $array['CacDichVu']='0';
       if(!isset($array['CacDicVu_en']))
       $array['CacDicVu_en']='0';
       if(!isset($array['CamKet']))
       $array['CamKet']='0';
       if(!isset($array['CamKet_en']))
       $array['CamKet_en']='0';
       if(!isset($array['LienHe']))
       $array['LienHe']='0';
       if(!isset($array['LienHe_en']))
       $array['LienHe_en']='0';
      $new_obj=new gioithieu($array);
        if($insert)
        {
            gioithieu_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/gioithieu.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            gioithieu_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/gioithieu.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=gioithieu_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=gioithieu_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_gioithieu($data);
}
else
{
     header('location: '.SITE_NAME);
}
