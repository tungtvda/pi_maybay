<?php
require_once DIR.'/model/menu.php';
require_once DIR.'/model/sqlconnection.php';
//
function menu_Get($command)
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
                $new_obj=new menu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'menu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new menu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function menu_getById($Id)
{
    return menu_Get('select * from menu where Id='.$Id);
}
//
function menu_getByAll()
{
    return menu_Get('select * from menu');
}
//
function menu_getByTop($top,$where,$order)
{
    return menu_Get("select * from menu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function menu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return menu_Get("SELECT * FROM  menu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function menu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return menu_Get("SELECT menu.Id, menu.Name, menu.Name_en, menu.Title, menu.Title_en, menu.Keyword, menu.Description FROM  menu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function menu_insert($obj)
{
    return exe_query("insert into menu (Name,Name_en,Title,Title_en,Keyword,Description) values ('$obj->Name','$obj->Name_en','$obj->Title','$obj->Title_en','$obj->Keyword','$obj->Description')",'menu');
}
//
function menu_update($obj)
{
    return exe_query("update menu set Name='$obj->Name',Name_en='$obj->Name_en',Title='$obj->Title',Title_en='$obj->Title_en',Keyword='$obj->Keyword',Description='$obj->Description' where Id=$obj->Id",'menu');
}
//
function menu_delete($obj)
{
    return exe_query('delete from menu where Id='.$obj->Id,'menu');
}
//
function menu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from menu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
