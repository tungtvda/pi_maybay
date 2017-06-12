<?php
require_once DIR.'/model/doitac.php';
require_once DIR.'/model/sqlconnection.php';
//
function doitac_Get($command)
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
                $new_obj=new doitac($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'doitac');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new doitac($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function doitac_getById($Id)
{
    return doitac_Get('select * from doitac where Id='.$Id);
}
//
function doitac_getByAll()
{
    return doitac_Get('select * from doitac');
}
//
function doitac_getByTop($top,$where,$order)
{
    return doitac_Get("select * from doitac ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function doitac_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return doitac_Get("SELECT * FROM  doitac ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function doitac_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return doitac_Get("SELECT doitac.Id, doitac.Name, doitac.Name_en, doitac.Img, doitac.Link FROM  doitac ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function doitac_insert($obj)
{
    return exe_query("insert into doitac (Name,Name_en,Img,Link) values ('$obj->Name','$obj->Name_en','$obj->Img','$obj->Link')",'doitac');
}
//
function doitac_update($obj)
{
    return exe_query("update doitac set Name='$obj->Name',Name_en='$obj->Name_en',Img='$obj->Img',Link='$obj->Link' where Id=$obj->Id",'doitac');
}
//
function doitac_delete($obj)
{
    return exe_query('delete from doitac where Id='.$obj->Id,'doitac');
}
//
function doitac_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from doitac '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
