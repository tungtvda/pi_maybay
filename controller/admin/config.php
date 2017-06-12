<?php
require_once '../../config.php';
require_once DIR.'/model/configService.php';
require_once DIR.'/view/admin/config.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new config();
            $new_obj->Id=$_GET["Id"];
            config_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/config.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=config_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/config.php');
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
            $List_config=config_getByAll();
            foreach($List_config as $config)
            {
                if(isset($_GET["check_".$config->Id])) config_delete($config);
            }
            header('Location: '.SITE_NAME.'/controller/admin/config.php');
        }
    }
    if(isset($_POST["Title"])&&isset($_POST["Title_en"])&&isset($_POST["Keyword"])&&isset($_POST["Description"])&&isset($_POST["Logo"])&&isset($_POST["Logo_footer"])&&isset($_POST["Icon"])&&isset($_POST["Name"])&&isset($_POST["Name_en"])&&isset($_POST["Address"])&&isset($_POST["Address_en"])&&isset($_POST["Phone"])&&isset($_POST["Hotline"])&&isset($_POST["Hotlien_datve"])&&isset($_POST["Email"])&&isset($_POST["Website"])&&isset($_POST["Skype"])&&isset($_POST["Yahoo"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Title']))
       $array['Title']='0';
       if(!isset($array['Title_en']))
       $array['Title_en']='0';
       if(!isset($array['Keyword']))
       $array['Keyword']='0';
       if(!isset($array['Description']))
       $array['Description']='0';
       if(!isset($array['Logo']))
       $array['Logo']='0';
       if(!isset($array['Logo_footer']))
       $array['Logo_footer']='0';
       if(!isset($array['Icon']))
       $array['Icon']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Name_en']))
       $array['Name_en']='0';
       if(!isset($array['Address']))
       $array['Address']='0';
       if(!isset($array['Address_en']))
       $array['Address_en']='0';
       if(!isset($array['Phone']))
       $array['Phone']='0';
       if(!isset($array['Hotline']))
       $array['Hotline']='0';
       if(!isset($array['Hotlien_datve']))
       $array['Hotlien_datve']='0';
       if(!isset($array['Email']))
       $array['Email']='0';
       if(!isset($array['Website']))
       $array['Website']='0';
       if(!isset($array['Skype']))
       $array['Skype']='0';
       if(!isset($array['Yahoo']))
       $array['Yahoo']='0';
      $new_obj=new config($array);
        if($insert)
        {
            config_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/config.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            config_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/config.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=config_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=config_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_config($data);
}
else
{
     header('location: '.SITE_NAME);
}
