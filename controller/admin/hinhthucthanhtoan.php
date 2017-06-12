<?php
require_once '../../config.php';
require_once DIR.'/model/hinhthucthanhtoanService.php';
require_once DIR.'/view/admin/hinhthucthanhtoan.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new hinhthucthanhtoan();
            $new_obj->Id=$_GET["Id"];
            hinhthucthanhtoan_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/hinhthucthanhtoan.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=hinhthucthanhtoan_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/hinhthucthanhtoan.php');
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
            $List_hinhthucthanhtoan=hinhthucthanhtoan_getByAll();
            foreach($List_hinhthucthanhtoan as $hinhthucthanhtoan)
            {
                if(isset($_GET["check_".$hinhthucthanhtoan->Id])) hinhthucthanhtoan_delete($hinhthucthanhtoan);
            }
            header('Location: '.SITE_NAME.'/controller/admin/hinhthucthanhtoan.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["Name_en"])&&isset($_POST["Img"])&&isset($_POST["MoTaNgan"])&&isset($_POST["MoTaNgan_en"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
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
      $new_obj=new hinhthucthanhtoan($array);
        if($insert)
        {
            hinhthucthanhtoan_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/hinhthucthanhtoan.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            hinhthucthanhtoan_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/hinhthucthanhtoan.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=hinhthucthanhtoan_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=hinhthucthanhtoan_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_hinhthucthanhtoan($data);
}
else
{
     header('location: '.SITE_NAME);
}
