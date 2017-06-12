<?php
require_once DIR.'/model/admin_api.php';
require_once DIR.'/model/sqlconnection.php';
//
function admin_api_Get($command)
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
                $new_obj=new admin_api($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'admin_api');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new admin_api($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function admin_api_getById($Id)
{
    return admin_api_Get('select * from admin_api where Id='.$Id);
}
//
function admin_api_getByAll()
{
    return admin_api_Get('select * from admin_api');
}
//
function admin_api_getByTop($top,$where,$order)
{
    return admin_api_Get("select * from admin_api ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function admin_api_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return admin_api_Get("SELECT * FROM  admin_api ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function admin_api_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return admin_api_Get("SELECT admin_api.Id, admin_api.Name, admin_api.Password, admin_api.Api FROM  admin_api ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function admin_api_insert($obj)
{
    return exe_query("insert into admin_api (Name,Password,Api) values ('$obj->Name','$obj->Password','$obj->Api')",'admin_api');
}
//
function admin_api_update($obj)
{
    return exe_query("update admin_api set Name='$obj->Name',Password='$obj->Password',Api='$obj->Api' where Id=$obj->Id",'admin_api');
}
//
function admin_api_delete($obj)
{
    return exe_query('delete from admin_api where Id='.$obj->Id,'admin_api');
}
//
function admin_api_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from admin_api '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
