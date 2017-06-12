<?php
require_once '../../config.php';
require_once DIR.'/model/thanhtoanService.php';
require_once DIR.'/view/admin/thanhtoan.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new thanhtoan();
            $new_obj->Id=$_GET["Id"];
            thanhtoan_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=thanhtoan_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/thanhtoan.php');
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
            $List_thanhtoan=thanhtoan_getByAll();
            foreach($List_thanhtoan as $thanhtoan)
            {
                if(isset($_GET["check_".$thanhtoan->Id])) thanhtoan_delete($thanhtoan);
            }
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan.php');
        }
    }
    if(isset($_POST["Name"])&&isset($_POST["Name_en"])&&isset($_POST["Img"])&&isset($_POST["Link"]))
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
       if(!isset($array['Link']))
       $array['Link']='0';
      $new_obj=new thanhtoan($array);
        if($insert)
        {
            thanhtoan_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            thanhtoan_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/thanhtoan.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=thanhtoan_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=thanhtoan_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_thanhtoan($data);
}
else
{
     header('location: '.SITE_NAME);
}
