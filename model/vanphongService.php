<?php
require_once DIR.'/model/vanphong.php';
require_once DIR.'/model/sqlconnection.php';
//
function vanphong_Get($command)
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
                $new_obj=new vanphong($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'vanphong');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new vanphong($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function vanphong_getById($Id)
{
    return vanphong_Get('select * from vanphong where Id='.$Id);
}
//
function vanphong_getByAll()
{
    return vanphong_Get('select * from vanphong');
}
//
function vanphong_getByTop($top,$where,$order)
{
    return vanphong_Get("select * from vanphong ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function vanphong_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return vanphong_Get("SELECT * FROM  vanphong ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function vanphong_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return vanphong_Get("SELECT vanphong.Id, vanphong.Address, vanphong.Address_en, vanphong.Phone, vanphong.BanDo FROM  vanphong ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function vanphong_insert($obj)
{
    return exe_query("insert into vanphong (Address,Address_en,Phone,BanDo) values ('$obj->Address','$obj->Address_en','$obj->Phone','$obj->BanDo')",'vanphong');
}
//
function vanphong_update($obj)
{
    return exe_query("update vanphong set Address='$obj->Address',Address_en='$obj->Address_en',Phone='$obj->Phone',BanDo='$obj->BanDo' where Id=$obj->Id",'vanphong');
}
//
function vanphong_delete($obj)
{
    return exe_query('delete from vanphong where Id='.$obj->Id,'vanphong');
}
//
function vanphong_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from vanphong '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
