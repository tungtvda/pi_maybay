<?php
require_once '../../config.php';
require_once DIR.'/model/dichvuService.php';
require_once DIR.'/view/admin/dichvu.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new dichvu();
            $new_obj->Id=$_GET["Id"];
            dichvu_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dichvu.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=dichvu_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/dichvu.php');
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
            $List_dichvu=dichvu_getByAll();
            foreach($List_dichvu as $dichvu)
            {
                if(isset($_GET["check_".$dichvu->Id])) dichvu_delete($dichvu);
            }
            header('Location: '.SITE_NAME.'/controller/admin/dichvu.php');
        }
    }
    if(isset($_POST["ViTri"])&&isset($_POST["Name"])&&isset($_POST["Name_en"])&&isset($_POST["Img"])&&isset($_POST["MoTaNgan"])&&isset($_POST["MoTaNgan_en"])&&isset($_POST["NoiDung"])&&isset($_POST["NoiDung_en"])&&isset($_POST["Icon"])&&isset($_POST["Icon_gioithieu"])&&isset($_POST["Avatar"])&&isset($_POST["Name_ht"])&&isset($_POST["MoTaNgan_ht"])&&isset($_POST["MoTaNgan_ht_en"])&&isset($_POST["Phone"])&&isset($_POST["Email"])&&isset($_POST["Yahoo"])&&isset($_POST["Skype"])&&isset($_POST["Title"])&&isset($_POST["Title_en"])&&isset($_POST["Keyword"])&&isset($_POST["Description"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['ViTri']))
       $array['ViTri']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Name_en']))
       $array['Name_en']='0';
       if(!isset($array['Img']))
       $array['Img']='0';
       if(!isset($array['MoTaNgan']))
       $array['MoTaNgan']='0';
       if(!isset($array['MoTaNgan_en']))
       $array['MoTaNgan_en']='0';
       if(!isset($array['NoiDung']))
       $array['NoiDung']='0';
       if(!isset($array['NoiDung_en']))
       $array['NoiDung_en']='0';
       if(!isset($array['Icon']))
       $array['Icon']='0';
       if(!isset($array['Icon_gioithieu']))
       $array['Icon_gioithieu']='0';
       if(!isset($array['Avatar']))
       $array['Avatar']='0';
       if(!isset($array['Name_ht']))
       $array['Name_ht']='0';
       if(!isset($array['MoTaNgan_ht']))
       $array['MoTaNgan_ht']='0';
       if(!isset($array['MoTaNgan_ht_en']))
       $array['MoTaNgan_ht_en']='0';
       if(!isset($array['Phone']))
       $array['Phone']='0';
       if(!isset($array['Email']))
       $array['Email']='0';
       if(!isset($array['Yahoo']))
       $array['Yahoo']='0';
       if(!isset($array['Skype']))
       $array['Skype']='0';
       if(!isset($array['Title']))
       $array['Title']='0';
       if(!isset($array['Title_en']))
       $array['Title_en']='0';
       if(!isset($array['Keyword']))
       $array['Keyword']='0';
       if(!isset($array['Description']))
       $array['Description']='0';
      $new_obj=new dichvu($array);
        if($insert)
        {
            dichvu_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dichvu.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            dichvu_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/dichvu.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=dichvu_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=dichvu_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_dichvu($data);
}
else
{
     header('location: '.SITE_NAME);
}
