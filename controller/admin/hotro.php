<?php
require_once '../../config.php';
require_once DIR.'/model/hotroService.php';
require_once DIR.'/model/danhmuchotroService.php';
require_once DIR.'/view/admin/hotro.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new hotro();
            $new_obj->Id=$_GET["Id"];
            hotro_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/hotro.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=hotro_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/hotro.php');
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
    $data['listfkey']['DanhMucId']=danhmuchotro_getByAll();
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_hotro=hotro_getByAll();
            foreach($List_hotro as $hotro)
            {
                if(isset($_GET["check_".$hotro->Id])) hotro_delete($hotro);
            }
            header('Location: '.SITE_NAME.'/controller/admin/hotro.php');
        }
    }
    if(isset($_POST["DanhMucId"])&&isset($_POST["LoaiHoTro"])&&isset($_POST["LoaiHoTro_en"])&&isset($_POST["Name"])&&isset($_POST["Skype"])&&isset($_POST["Phone"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['DanhMucId']))
       $array['DanhMucId']='0';
       if(!isset($array['LoaiHoTro']))
       $array['LoaiHoTro']='0';
       if(!isset($array['LoaiHoTro_en']))
       $array['LoaiHoTro_en']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Skype']))
       $array['Skype']='0';
       if(!isset($array['Phone']))
       $array['Phone']='0';
      $new_obj=new hotro($array);
        if($insert)
        {
            hotro_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/hotro.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            hotro_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/hotro.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=hotro_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=hotro_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_hotro($data);
}
else
{
     header('location: '.SITE_NAME);
}
