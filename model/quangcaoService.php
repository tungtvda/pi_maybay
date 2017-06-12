<?php
require_once DIR.'/model/quangcao.php';
require_once DIR.'/model/sqlconnection.php';
//
function quangcao_Get($command)
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
                $new_obj=new quangcao($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'quangcao');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new quangcao($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function quangcao_getById($Id)
{
    return quangcao_Get('select * from quangcao where Id='.$Id);
}
//
function quangcao_getByAll()
{
    return quangcao_Get('select * from quangcao');
}
//
function quangcao_getByTop($top,$where,$order)
{
    return quangcao_Get("select * from quangcao ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function quangcao_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return quangcao_Get("SELECT * FROM  quangcao ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function quangcao_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return quangcao_Get("SELECT quangcao.Id, quangcao.Name, quangcao.Name_en, quangcao.Img, quangcao.Link FROM  quangcao ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function quangcao_insert($obj)
{
    return exe_query("insert into quangcao (Name,Name_en,Img,Link) values ('$obj->Name','$obj->Name_en','$obj->Img','$obj->Link')",'quangcao');
}
//
function quangcao_update($obj)
{
    return exe_query("update quangcao set Name='$obj->Name',Name_en='$obj->Name_en',Img='$obj->Img',Link='$obj->Link' where Id=$obj->Id",'quangcao');
}
//
function quangcao_delete($obj)
{
    return exe_query('delete from quangcao where Id='.$obj->Id,'quangcao');
}
//
function quangcao_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from quangcao '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
