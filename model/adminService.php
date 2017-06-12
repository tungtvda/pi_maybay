<?php
require_once DIR.'/model/admin.php';
require_once DIR.'/model/sqlconnection.php';
//
function admin_Get($command)
{
            $array_result=array();
    $key=md5($command);
    if(CACHE)
    {
        $mycache=ConnectCache();
        $cachecommand=$mycache->get($key);
        if($cachecommand)
        {
            $array_result=$cachecommand;
        }
        else
        {
          $result=mysqli_query(ConnectSql(),$command);
            if($result!=false)while($row=mysqli_fetch_array($result))
            {
                $new_obj=new admin($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'admin');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new admin($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function admin_getById($Id)
{
    return admin_Get('select * from admin where Id='.$Id);
}
//
function admin_getByAll()
{
    return admin_Get('select * from admin');
}
//
function admin_getByTop($top,$where,$order)
{
    return admin_Get("select * from admin ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function admin_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return admin_Get("SELECT * FROM  admin ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function admin_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return admin_Get("SELECT admin.Id, admin.TenDangNhap, admin.Full_name, admin.MatKhau FROM  admin ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function admin_insert($obj)
{
    return exe_query("insert into admin (TenDangNhap,Full_name,MatKhau) values ('$obj->TenDangNhap','$obj->Full_name','$obj->MatKhau')",'admin');
}
//
function admin_update($obj)
{
    return exe_query("update admin set TenDangNhap='$obj->TenDangNhap',Full_name='$obj->Full_name',MatKhau='$obj->MatKhau' where Id=$obj->Id",'admin');
}
//
function admin_delete($obj)
{
    return exe_query('delete from admin where Id='.$obj->Id,'admin');
}
//
function admin_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from admin '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
