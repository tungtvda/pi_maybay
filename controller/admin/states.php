<?php
require_once '../../config.php';
require_once DIR.'/model/statesService.php';
require_once DIR.'/view/admin/states.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new states();
            $new_obj->id=$_GET["id"];
            states_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/states.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=states_getById($_GET["id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/states.php');
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
            $List_states=states_getByAll();
            foreach($List_states as $states)
            {
                if(isset($_GET["check_".$states->id])) states_delete($states);
            }
            header('Location: '.SITE_NAME.'/controller/admin/states.php');
        }
    }
    if(isset($_POST["name"])&&isset($_POST["country_id"]))
    {
       $array=$_POST;
       if(!isset($array['id']))
       $array['id']='0';
       if(!isset($array['name']))
       $array['name']='0';
       if(!isset($array['country_id']))
       $array['country_id']='0';
      $new_obj=new states($array);
        if($insert)
        {
            states_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/states.php');
        }
        else
        {
            $new_obj->id=$_GET["id"];
            states_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/states.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=states_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=states_getByPagingReplace($data['page'],20,'id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_states($data);
}
else
{
     header('location: '.SITE_NAME);
}
