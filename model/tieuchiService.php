<?php
require_once DIR.'/model/tieuchi.php';
require_once DIR.'/model/sqlconnection.php';
//
function tieuchi_Get($command)
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
                $new_obj=new tieuchi($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'tieuchi');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new tieuchi($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function tieuchi_getById($Id)
{
    return tieuchi_Get('select * from tieuchi where Id='.$Id);
}
//
function tieuchi_getByAll()
{
    return tieuchi_Get('select * from tieuchi');
}
//
function tieuchi_getByTop($top,$where,$order)
{
    return tieuchi_Get("select * from tieuchi ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function tieuchi_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return tieuchi_Get("SELECT * FROM  tieuchi ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tieuchi_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return tieuchi_Get("SELECT tieuchi.Id, tieuchi.Name, tieuchi.Name_en, tieuchi.Img, tieuchi.MoTaNgan, tieuchi.MoTaNgan_en FROM  tieuchi ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tieuchi_insert($obj)
{
    return exe_query("insert into tieuchi (Name,Name_en,Img,MoTaNgan,MoTaNgan_en) values ('$obj->Name','$obj->Name_en','$obj->Img','$obj->MoTaNgan','$obj->MoTaNgan_en')",'tieuchi');
}
//
function tieuchi_update($obj)
{
    return exe_query("update tieuchi set Name='$obj->Name',Name_en='$obj->Name_en',Img='$obj->Img',MoTaNgan='$obj->MoTaNgan',MoTaNgan_en='$obj->MoTaNgan_en' where Id=$obj->Id",'tieuchi');
}
//
function tieuchi_delete($obj)
{
    return exe_query('delete from tieuchi where Id='.$obj->Id,'tieuchi');
}
//
function tieuchi_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from tieuchi '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
