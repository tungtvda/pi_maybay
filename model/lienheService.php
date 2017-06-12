<?php
require_once DIR.'/model/lienhe.php';
require_once DIR.'/model/sqlconnection.php';
//
function lienhe_Get($command)
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
                $new_obj=new lienhe($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'lienhe');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new lienhe($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function lienhe_getById($Id)
{
    return lienhe_Get('select * from lienhe where Id='.$Id);
}
//
function lienhe_getByAll()
{
    return lienhe_Get('select * from lienhe');
}
//
function lienhe_getByTop($top,$where,$order)
{
    return lienhe_Get("select * from lienhe ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function lienhe_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return lienhe_Get("SELECT * FROM  lienhe ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function lienhe_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return lienhe_Get("SELECT lienhe.Id, lienhe.QuyDanh, lienhe.Name, lienhe.Address, lienhe.Email, lienhe.Phone, lienhe.NoiDung, lienhe.Created FROM  lienhe ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function lienhe_insert($obj)
{
    return exe_query("insert into lienhe (QuyDanh,Name,Address,Email,Phone,NoiDung,Created) values ('$obj->QuyDanh','$obj->Name','$obj->Address','$obj->Email','$obj->Phone','$obj->NoiDung','$obj->Created')",'lienhe');
}
//
function lienhe_update($obj)
{
    return exe_query("update lienhe set QuyDanh='$obj->QuyDanh',Name='$obj->Name',Address='$obj->Address',Email='$obj->Email',Phone='$obj->Phone',NoiDung='$obj->NoiDung',Created='$obj->Created' where Id=$obj->Id",'lienhe');
}
//
function lienhe_delete($obj)
{
    return exe_query('delete from lienhe where Id='.$obj->Id,'lienhe');
}
//
function lienhe_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from lienhe '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
