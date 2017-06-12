<?php
require_once DIR.'/model/countries.php';
require_once DIR.'/model/sqlconnection.php';
//
function countries_Get($command)
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
                $new_obj=new countries($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'countries');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new countries($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function countries_getById($id)
{
    return countries_Get('select * from countries where id='.$id);
}
//
function countries_getByAll()
{
    return countries_Get('select * from countries');
}
//
function countries_getByTop($top,$where,$order)
{
    return countries_Get("select * from countries ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function countries_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return countries_Get("SELECT * FROM  countries ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function countries_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return countries_Get("SELECT countries.id, countries.sortname, countries.name FROM  countries ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function countries_insert($obj)
{
    return exe_query("insert into countries (sortname,name) values ('$obj->sortname','$obj->name')",'countries');
}
//
function countries_update($obj)
{
    return exe_query("update countries set sortname='$obj->sortname',name='$obj->name' where id=$obj->id",'countries');
}
//
function countries_delete($obj)
{
    return exe_query('delete from countries where id='.$obj->id,'countries');
}
//
function countries_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from countries '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
