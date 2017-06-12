<?php
require_once DIR.'/model/states.php';
require_once DIR.'/model/sqlconnection.php';
//
function states_Get($command)
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
                $new_obj=new states($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'states');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new states($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function states_getById($id)
{
    return states_Get('select * from states where id='.$id);
}
//
function states_getByAll()
{
    return states_Get('select * from states');
}
//
function states_getByTop($top,$where,$order)
{
    return states_Get("select * from states ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function states_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return states_Get("SELECT * FROM  states ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function states_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return states_Get("SELECT states.id, states.name, states.country_id FROM  states ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function states_insert($obj)
{
    return exe_query("insert into states (name,country_id) values ('$obj->name','$obj->country_id')",'states');
}
//
function states_update($obj)
{
    return exe_query("update states set name='$obj->name',country_id='$obj->country_id' where id=$obj->id",'states');
}
//
function states_delete($obj)
{
    return exe_query('delete from states where id='.$obj->id,'states');
}
//
function states_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(id) as count from states '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
