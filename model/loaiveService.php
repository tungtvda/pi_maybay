<?php
require_once DIR.'/model/loaive.php';
require_once DIR.'/model/sqlconnection.php';
//
function loaive_Get($command)
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
                $new_obj=new loaive($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'loaive');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new loaive($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function loaive_getById($Id)
{
    return loaive_Get('select * from loaive where Id='.$Id);
}
//
function loaive_getByAll()
{
    return loaive_Get('select * from loaive');
}
//
function loaive_getByTop($top,$where,$order)
{
    return loaive_Get("select * from loaive ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function loaive_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return loaive_Get("SELECT * FROM  loaive ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function loaive_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return loaive_Get("SELECT loaive.Id, loaive.Name FROM  loaive ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function loaive_insert($obj)
{
    return exe_query("insert into loaive (Name) values ('$obj->Name')",'loaive');
}
//
function loaive_update($obj)
{
    return exe_query("update loaive set Name='$obj->Name' where Id=$obj->Id",'loaive');
}
//
function loaive_delete($obj)
{
    return exe_query('delete from loaive where Id='.$obj->Id,'loaive');
}
//
function loaive_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from loaive '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
