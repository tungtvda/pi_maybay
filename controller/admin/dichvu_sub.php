<?php
require_once '../../config.php';
require_once DIR.'/model/dichvu_subService.php';
require_once DIR.'/model/dichvuService.php';
require_once DIR.'/model/saoService.php';
require_once DIR.'/view/admin/dichvu_sub.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new dichvu_sub();
            $new_obj->Id=$_GET["Id"];
            dichvu_sub_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dichvu_sub.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=dichvu_sub_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/dichvu_sub.php');
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
    $data['listfkey']['DanhMucId']=dichvu_getByAll();
    $data['listfkey']['HangSao']=sao_getByAll();
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_dichvu_sub=dichvu_sub_getByAll();
            foreach($List_dichvu_sub as $dichvu_sub)
            {
                if(isset($_GET["check_".$dichvu_sub->Id])) dichvu_sub_delete($dichvu_sub);
            }
            header('Location: '.SITE_NAME.'/controller/admin/dichvu_sub.php');
        }
    }
    if(isset($_POST["DanhMucId"])&&isset($_POST["Name"])&&isset($_POST["Name_en"])&&isset($_POST["Img"])&&isset($_POST["HangSao"])&&isset($_POST["Address"])&&isset($_POST["Address_en"])&&isset($_POST["GiaCu"])&&isset($_POST["GiaCu_en"])&&isset($_POST["GiaMoi"])&&isset($_POST["GiaMoi_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['DanhMucId']))
       $array['DanhMucId']='0';
       if(!isset($array['BanChay']))
       $array['BanChay']='0';
       if(!isset($array['NoiBat']))
       $array['NoiBat']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Name_en']))
       $array['Name_en']='0';
       if(!isset($array['Img']))
       $array['Img']='0';
       if(!isset($array['HangSao']))
       $array['HangSao']='0';
       if(!isset($array['Address']))
       $array['Address']='0';
       if(!isset($array['Address_en']))
       $array['Address_en']='0';
       if(!isset($array['GiaCu']))
       $array['GiaCu']='0';
       if(!isset($array['GiaCu_en']))
       $array['GiaCu_en']='0';
       if(!isset($array['GiaMoi']))
       $array['GiaMoi']='0';
       if(!isset($array['GiaMoi_en']))
       $array['GiaMoi_en']='0';
      $new_obj=new dichvu_sub($array);
        if($insert)
        {
            dichvu_sub_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/dichvu_sub.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            dichvu_sub_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/dichvu_sub.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=dichvu_sub_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=dichvu_sub_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_dichvu_sub($data);
}
else
{
     header('location: '.SITE_NAME);
}
