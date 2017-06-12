<?php
require_once DIR.'/model/cauhoi.php';
require_once DIR.'/model/sqlconnection.php';
//
function cauhoi_Get($command)
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
                $new_obj=new cauhoi($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'cauhoi');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new cauhoi($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function cauhoi_getById($Id)
{
    return cauhoi_Get('select * from cauhoi where Id='.$Id);
}
//
function cauhoi_getByAll()
{
    return cauhoi_Get('select * from cauhoi');
}
//
function cauhoi_getByTop($top,$where,$order)
{
    return cauhoi_Get("select * from cauhoi ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function cauhoi_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return cauhoi_Get("SELECT * FROM  cauhoi ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function cauhoi_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return cauhoi_Get("SELECT cauhoi.Id, cauhoi.Name, cauhoi.Name_en, cauhoi.NoiDung, cauhoi.NoiDung_en FROM  cauhoi ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function cauhoi_insert($obj)
{
    return exe_query("insert into cauhoi (Name,Name_en,NoiDung,NoiDung_en) values ('$obj->Name','$obj->Name_en','$obj->NoiDung','$obj->NoiDung_en')",'cauhoi');
}
//
function cauhoi_update($obj)
{
    return exe_query("update cauhoi set Name='$obj->Name',Name_en='$obj->Name_en',NoiDung='$obj->NoiDung',NoiDung_en='$obj->NoiDung_en' where Id=$obj->Id",'cauhoi');
}
//
function cauhoi_delete($obj)
{
    return exe_query('delete from cauhoi where Id='.$obj->Id,'cauhoi');
}
//
function cauhoi_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from cauhoi '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
