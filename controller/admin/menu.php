<?php
require_once '../../config.php';
require_once DIR.'/model/menuService.php';
require_once DIR.'/view/admin/menu.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new menu();
            $new_obj->Id=$_GET["Id"];
            menu_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/menu.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=menu_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/menu.php');
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
            $List_menu=menu_getByAll();
            foreach($List_menu as $menu)
            {
                if(isset($_GET["check_".$menu->Id])) menu_delete($menu);
            }
            header('Location: '.SITE_NAME.'/controller/admin/menu.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["Name_en"])&&isset($_POST["Title"])&&isset($_POST["Title_en"])&&isset($_POST["Keyword"])&&isset($_POST["Description"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Name_en']))
       $array['Name_en']='0';
       if(!isset($array['Title']))
       $array['Title']='0';
       if(!isset($array['Title_en']))
       $array['Title_en']='0';
       if(!isset($array['Keyword']))
       $array['Keyword']='0';
       if(!isset($array['Description']))
       $array['Description']='0';
      $new_obj=new menu($array);
        if($insert)
        {
            menu_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/menu.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            menu_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/menu.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=menu_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=menu_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_menu($data);
}
else
{
     header('location: '.SITE_NAME);
}
