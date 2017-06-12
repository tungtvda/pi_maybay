<?php
require_once '../../config.php';
require_once DIR.'/model/countriesService.php';
require_once DIR.'/view/admin/countries.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new countries();
            $new_obj->id=$_GET["id"];
            countries_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/countries.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=countries_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/countries.php');
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
            $List_countries=countries_getByAll();
            foreach($List_countries as $countries)
            {
                if(isset($_GET["check_".$countries->id])) countries_delete($countries);
            }
            header('Location: '.SITE_NAME.'/controller/admin/countries.php');
        }
    }
    if(isset($_POST["sortname"])&&isset($_POST["name"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['sortname']))
       $array['sortname']='0';
       if(!isset($array['name']))
       $array['name']='0';
      $new_obj=new countries($array);
        if($insert)
        {
            countries_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/countries.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            countries_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/countries.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=countries_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=countries_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_countries($data);
}
else
{
     header('location: '.SITE_NAME);
}
