<?php
require_once '../../config.php';
require_once DIR.'/model/venoidiaService.php';
require_once DIR.'/model/loaiveService.php';
require_once DIR.'/view/admin/venoidia.php';
require_once DIR.'/common/messenger.php';
$data=array();
$insert=true;
if(isset($_SESSION["Admin"]))
{
    if(isset($_GET["action"])&&isset($_GET["Id"]))
    {
        if($_GET["action"]=="delete")
        {
            $new_obj= new venoidia();
            $new_obj->Id=$_GET["Id"];
            venoidia_delete($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/venoidia.php');
        }
        else if($_GET["action"]=="edit")
        {
            $new_obj=venoidia_getById($_GET["Id"]);
            if($new_obj!=false)
            {
                $data['form']=$new_obj[0];
                $data['tab2_class']='default-tab current';
                $data['tab1_class']=' ';
                $insert=false;
            }
            else header('Location: '.SITE_NAME.'/controller/admin/venoidia.php');
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
    $data['listfkey']['DanhMucId']=loaive_getByAll();
    if(isset($_GET["action_all"]))
    {
        if($_GET["action_all"]=="ThemMoi")
        {
            $data['tab2_class']='default-tab current';
            $data['tab1_class']=' ';
        }
        else
        {
            $List_venoidia=venoidia_getByAll();
            foreach($List_venoidia as $venoidia)
            {
                if(isset($_GET["check_".$venoidia->Id])) venoidia_delete($venoidia);
            }
            header('Location: '.SITE_NAME.'/controller/admin/venoidia.php');
        }
    }
    if(isset($_POST["DanhMucId"])&&isset($_POST["Name"])&&isset($_POST["Name_en"])&&isset($_POST["MaChuyenBay"])&&isset($_POST["DiemDi"])&&isset($_POST["DiemDi_en"])&&isset($_POST["DiemDen"])&&isset($_POST["DiemDen_en"])&&isset($_POST["NgayDi"])&&isset($_POST["Gia"])&&isset($_POST["Gia_en"])&&isset($_POST["Img"])&&isset($_POST["Img_hang"])&&isset($_POST["NoiDung"])&&isset($_POST["NoiDung_en"])&&isset($_POST["Title"])&&isset($_POST["Title_en"])&&isset($_POST["Keyword"])&&isset($_POST["Description"])&&isset($_POST["Created"]))
    {
       $array=$_POST;
       if(!isset($array['Id']))
       $array['Id']='0';
       if(!isset($array['DanhMucId']))
       $array['DanhMucId']='0';
       if(!isset($array['Name']))
       $array['Name']='0';
       if(!isset($array['Name_en']))
       $array['Name_en']='0';
       if(!isset($array['MaChuyenBay']))
       $array['MaChuyenBay']='0';
       if(!isset($array['DiemDi']))
       $array['DiemDi']='0';
       if(!isset($array['DiemDi_en']))
       $array['DiemDi_en']='0';
       if(!isset($array['DiemDen']))
       $array['DiemDen']='0';
       if(!isset($array['DiemDen_en']))
       $array['DiemDen_en']='0';
       if(!isset($array['NgayDi']))
       $array['NgayDi']='0';
       if(!isset($array['Gia']))
       $array['Gia']='0';
       if(!isset($array['Gia_en']))
       $array['Gia_en']='0';
       if(!isset($array['Img']))
       $array['Img']='0';
       if(!isset($array['Img_hang']))
       $array['Img_hang']='0';
       if(!isset($array['NoiDung']))
       $array['NoiDung']='0';
       if(!isset($array['NoiDung_en']))
       $array['NoiDung_en']='0';
       if(!isset($array['Title']))
       $array['Title']='0';
       if(!isset($array['Title_en']))
       $array['Title_en']='0';
       if(!isset($array['Keyword']))
       $array['Keyword']='0';
       if(!isset($array['Description']))
       $array['Description']='0';
       if(!isset($array['Created']))
       $array['Created']='0';
      $new_obj=new venoidia($array);
        if($insert)
        {
            $new_obj->Created=date(DATETIME_FORMAT);
            venoidia_insert($new_obj);
            header('Location: '.SITE_NAME.'/controller/admin/venoidia.php');
        }
        else
        {
            $new_obj->Created=date(DATETIME_FORMAT);
            $new_obj->Id=$_GET["Id"];
            venoidia_update($new_obj);
            $insert=false;
            header('Location: '.SITE_NAME.'/controller/admin/venoidia.php');
        }
    }
    $data['username']=isset($_SESSION["UserName"])?$_SESSION["UserName"]:'quản trị viên';
    $data['count_paging']=venoidia_count('');
    $data['page']=isset($_GET['page'])?$_GET['page']:'1';
    $data['table_body']=venoidia_getByPagingReplace($data['page'],20,'Id DESC','');
    // gọi phương thức trong tầng view để hiển thị
    view_venoidia($data);
}
else
{
     header('location: '.SITE_NAME);
}
