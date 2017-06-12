<?php
require_once '../../config.php';
require_once DIR.'/model/airportsService.php';
require_once DIR.'/view/admin/airports.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new airports();
            $new_obj->Id=$_GET["Id"];
            airports_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/airports.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=airports_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/airports.php');
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
            $List_airports=airports_getByAll();
            foreach($List_airports as $airports)
            {
                if(isset($_GET["check_".$airports->Id])) airports_delete($airports);
            }
            header('Location: '.SITE_NAME.'/controller/admin/airports.php');
        }
    }
    if(isset($_POST["code"])&&isset($_POST["name"])&&isset($_POST["cityCode"])&&isset($_POST["cityName"])&&isset($_POST["countryName"])&&isset($_POST["countryCode"])&&isset($_POST["timezone"])&&isset($_POST["lat"])&&isset($_POST["lon"])&&isset($_POST["numAirports"])&&isset($_POST["city"]))
    {
       $array=$_POST;
       if(!isset($array['code']))
       $array['code']='0';
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['cityCode']))
       $array['cityCode']='0';
       if(!isset($array['cityName']))
       $array['cityName']='0';
       if(!isset($array['countryName']))
       $array['countryName']='0';
       if(!isset($array['countryCode']))
       $array['countryCode']='0';
       if(!isset($array['timezone']))
       $array['timezone']='0';
       if(!isset($array['lat']))
       $array['lat']='0';
       if(!isset($array['lon']))
       $array['lon']='0';
       if(!isset($array['numAirports']))
       $array['numAirports']='0';
       if(!isset($array['city']))
       $array['city']='0';
      $new_obj=new airports($array);
        if($insert)
        {
            airports_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/airports.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            airports_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/airports.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=airports_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=airports_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_airports($data);
}
else
{
     header('location: '.SITE_NAME);
}
