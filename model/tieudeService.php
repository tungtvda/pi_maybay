<?php
require_once DIR.'/model/tieude.php';
require_once DIR.'/model/sqlconnection.php';
//
function tieude_Get($command)
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
                $new_obj=new tieude($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'tieude');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new tieude($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function tieude_getById($Id)
{
    return tieude_Get('select * from tieude where Id='.$Id);
}
//
function tieude_getByAll()
{
    return tieude_Get('select * from tieude');
}
//
function tieude_getByTop($top,$where,$order)
{
    return tieude_Get("select * from tieude ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function tieude_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return tieude_Get("SELECT * FROM  tieude ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tieude_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return tieude_Get("SELECT tieude.Id, tieude.Name, tieude.Name_en FROM  tieude ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function tieude_insert($obj)
{
    return exe_query("insert into tieude (Name,Name_en) values ('$obj->Name','$obj->Name_en')",'tieude');
}
//
function tieude_update($obj)
{
    return exe_query("update tieude set Name='$obj->Name',Name_en='$obj->Name_en' where Id=$obj->Id",'tieude');
}
//
function tieude_delete($obj)
{
    return exe_query('delete from tieude where Id='.$obj->Id,'tieude');
}
//
function tieude_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from tieude '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
