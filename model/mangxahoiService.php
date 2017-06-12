<?php
require_once DIR.'/model/mangxahoi.php';
require_once DIR.'/model/sqlconnection.php';
//
function mangxahoi_Get($command)
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
                $new_obj=new mangxahoi($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'mangxahoi');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new mangxahoi($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function mangxahoi_getById($Id)
{
    return mangxahoi_Get('select * from mangxahoi where Id='.$Id);
}
//
function mangxahoi_getByAll()
{
    return mangxahoi_Get('select * from mangxahoi');
}
//
function mangxahoi_getByTop($top,$where,$order)
{
    return mangxahoi_Get("select * from mangxahoi ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function mangxahoi_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return mangxahoi_Get("SELECT * FROM  mangxahoi ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function mangxahoi_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return mangxahoi_Get("SELECT mangxahoi.Id, mangxahoi.Face, mangxahoi.Feed, mangxahoi.Twitter, mangxahoi.Google, mangxahoi.Youtube FROM  mangxahoi ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function mangxahoi_insert($obj)
{
    return exe_query("insert into mangxahoi (Face,Feed,Twitter,Google,Youtube) values ('$obj->Face','$obj->Feed','$obj->Twitter','$obj->Google','$obj->Youtube')",'mangxahoi');
}
//
function mangxahoi_update($obj)
{
    return exe_query("update mangxahoi set Face='$obj->Face',Feed='$obj->Feed',Twitter='$obj->Twitter',Google='$obj->Google',Youtube='$obj->Youtube' where Id=$obj->Id",'mangxahoi');
}
//
function mangxahoi_delete($obj)
{
    return exe_query('delete from mangxahoi where Id='.$obj->Id,'mangxahoi');
}
//
function mangxahoi_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from mangxahoi '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
