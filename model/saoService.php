<?php
require_once DIR.'/model/sao.php';
require_once DIR.'/model/sqlconnection.php';
//
function sao_Get($command)
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
                $new_obj=new sao($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'sao');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new sao($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function sao_getById($Id)
{
    return sao_Get('select * from sao where Id='.$Id);
}
//
function sao_getByAll()
{
    return sao_Get('select * from sao');
}
//
function sao_getByTop($top,$where,$order)
{
    return sao_Get("select * from sao ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function sao_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return sao_Get("SELECT * FROM  sao ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function sao_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return sao_Get("SELECT sao.Id, sao.Name FROM  sao ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function sao_insert($obj)
{
    return exe_query("insert into sao (Name) values ('$obj->Name')",'sao');
}
//
function sao_update($obj)
{
    return exe_query("update sao set Name='$obj->Name' where Id=$obj->Id",'sao');
}
//
function sao_delete($obj)
{
    return exe_query('delete from sao where Id='.$obj->Id,'sao');
}
//
function sao_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from sao '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
