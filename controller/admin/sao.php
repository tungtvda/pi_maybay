<?php
require_once '../../config.php';
require_once DIR.'/model/saoService.php';
require_once DIR.'/view/admin/sao.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new sao();
            $new_obj->Id=$_GET["Id"];
            sao_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/sao.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=sao_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/sao.php');
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
            $List_sao=sao_getByAll();
            foreach($List_sao as $sao)
            {
                if(isset($_GET["check_".$sao->Id])) sao_delete($sao);
            }
            header('Location: '.SITE_NAME.'/controller/admin/sao.php');
        }
    }
    if(isset($_POST["Name"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
      $new_obj=new sao($array);
        if($insert)
        {
            sao_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/sao.php');
        }
        else
        {
            $new_obj->Id=$_GET["Id"];
            sao_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/sao.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=sao_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=sao_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_sao($data);
}
else
{
     header('location: '.SITE_NAME);
}
