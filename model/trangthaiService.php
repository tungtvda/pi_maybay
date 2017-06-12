<?php
require_once DIR.'/model/trangthai.php';
require_once DIR.'/model/sqlconnection.php';
//
function trangthai_Get($command)
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
                $new_obj=new trangthai($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'trangthai');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new trangthai($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function trangthai_getById($Id)
{
    return trangthai_Get('select * from trangthai where Id='.$Id);
}
//
function trangthai_getByAll()
{
    return trangthai_Get('select * from trangthai');
}
//
function trangthai_getByTop($top,$where,$order)
{
    return trangthai_Get("select * from trangthai ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function trangthai_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return trangthai_Get("SELECT * FROM  trangthai ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function trangthai_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return trangthai_Get("SELECT trangthai.Id, trangthai.Name FROM  trangthai ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function trangthai_insert($obj)
{
    return exe_query("insert into trangthai (Name) values ('$obj->Name')",'trangthai');
}
//
function trangthai_update($obj)
{
    return exe_query("update trangthai set Name='$obj->Name' where Id=$obj->Id",'trangthai');
}
//
function trangthai_delete($obj)
{
    return exe_query('delete from trangthai where Id='.$obj->Id,'trangthai');
}
//
function trangthai_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from trangthai '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
