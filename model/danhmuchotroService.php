<?php
require_once DIR.'/model/danhmuchotro.php';
require_once DIR.'/model/sqlconnection.php';
//
function danhmuchotro_Get($command)
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
                $new_obj=new danhmuchotro($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'danhmuchotro');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new danhmuchotro($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function danhmuchotro_getById($Id)
{
    return danhmuchotro_Get('select * from danhmuchotro where Id='.$Id);
}
//
function danhmuchotro_getByAll()
{
    return danhmuchotro_Get('select * from danhmuchotro');
}
//
function danhmuchotro_getByTop($top,$where,$order)
{
    return danhmuchotro_Get("select * from danhmuchotro ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function danhmuchotro_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuchotro_Get("SELECT * FROM  danhmuchotro ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuchotro_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return danhmuchotro_Get("SELECT danhmuchotro.Id, danhmuchotro.Name, danhmuchotro.Name_en FROM  danhmuchotro ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function danhmuchotro_insert($obj)
{
    return exe_query("insert into danhmuchotro (Name,Name_en) values ('$obj->Name','$obj->Name_en')",'danhmuchotro');
}
//
function danhmuchotro_update($obj)
{
    return exe_query("update danhmuchotro set Name='$obj->Name',Name_en='$obj->Name_en' where Id=$obj->Id",'danhmuchotro');
}
//
function danhmuchotro_delete($obj)
{
    return exe_query('delete from danhmuchotro where Id='.$obj->Id,'danhmuchotro');
}
//
function danhmuchotro_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from danhmuchotro '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
