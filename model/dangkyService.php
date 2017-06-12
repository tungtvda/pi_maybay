<?php
require_once DIR.'/model/dangky.php';
require_once DIR.'/model/sqlconnection.php';
//
function dangky_Get($command)
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
                $new_obj=new dangky($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'dangky');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new dangky($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function dangky_getById($Id)
{
    return dangky_Get('select * from dangky where Id='.$Id);
}
//
function dangky_getByAll()
{
    return dangky_Get('select * from dangky');
}
//
function dangky_getByTop($top,$where,$order)
{
    return dangky_Get("select * from dangky ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function dangky_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return dangky_Get("SELECT * FROM  dangky ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dangky_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return dangky_Get("SELECT dangky.Id, dangky.Email, dangky.Created FROM  dangky ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dangky_insert($obj)
{
    return exe_query("insert into dangky (Email,Created) values ('$obj->Email','$obj->Created')",'dangky');
}
//
function dangky_update($obj)
{
    return exe_query("update dangky set Email='$obj->Email',Created='$obj->Created' where Id=$obj->Id",'dangky');
}
//
function dangky_delete($obj)
{
    return exe_query('delete from dangky where Id='.$obj->Id,'dangky');
}
//
function dangky_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from dangky '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
