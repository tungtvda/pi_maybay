<?php
require_once DIR.'/model/hinhthucthanhtoan.php';
require_once DIR.'/model/sqlconnection.php';
//
function hinhthucthanhtoan_Get($command)
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
                $new_obj=new hinhthucthanhtoan($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'hinhthucthanhtoan');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new hinhthucthanhtoan($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function hinhthucthanhtoan_getById($Id)
{
    return hinhthucthanhtoan_Get('select * from hinhthucthanhtoan where Id='.$Id);
}
//
function hinhthucthanhtoan_getByAll()
{
    return hinhthucthanhtoan_Get('select * from hinhthucthanhtoan');
}
//
function hinhthucthanhtoan_getByTop($top,$where,$order)
{
    return hinhthucthanhtoan_Get("select * from hinhthucthanhtoan ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function hinhthucthanhtoan_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return hinhthucthanhtoan_Get("SELECT * FROM  hinhthucthanhtoan ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function hinhthucthanhtoan_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return hinhthucthanhtoan_Get("SELECT hinhthucthanhtoan.Id, hinhthucthanhtoan.Name, hinhthucthanhtoan.Name_en, hinhthucthanhtoan.Img, hinhthucthanhtoan.MoTaNgan, hinhthucthanhtoan.MoTaNgan_en FROM  hinhthucthanhtoan ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function hinhthucthanhtoan_insert($obj)
{
    return exe_query("insert into hinhthucthanhtoan (Name,Name_en,Img,MoTaNgan,MoTaNgan_en) values ('$obj->Name','$obj->Name_en','$obj->Img','$obj->MoTaNgan','$obj->MoTaNgan_en')",'hinhthucthanhtoan');
}
//
function hinhthucthanhtoan_update($obj)
{
    return exe_query("update hinhthucthanhtoan set Name='$obj->Name',Name_en='$obj->Name_en',Img='$obj->Img',MoTaNgan='$obj->MoTaNgan',MoTaNgan_en='$obj->MoTaNgan_en' where Id=$obj->Id",'hinhthucthanhtoan');
}
//
function hinhthucthanhtoan_delete($obj)
{
    return exe_query('delete from hinhthucthanhtoan where Id='.$obj->Id,'hinhthucthanhtoan');
}
//
function hinhthucthanhtoan_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from hinhthucthanhtoan '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
