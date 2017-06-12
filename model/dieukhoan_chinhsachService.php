<?php
require_once DIR.'/model/dieukhoan_chinhsach.php';
require_once DIR.'/model/sqlconnection.php';
//
function dieukhoan_chinhsach_Get($command)
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
                $new_obj=new dieukhoan_chinhsach($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'dieukhoan_chinhsach');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new dieukhoan_chinhsach($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function dieukhoan_chinhsach_getById($Id)
{
    return dieukhoan_chinhsach_Get('select * from dieukhoan_chinhsach where Id='.$Id);
}
//
function dieukhoan_chinhsach_getByAll()
{
    return dieukhoan_chinhsach_Get('select * from dieukhoan_chinhsach');
}
//
function dieukhoan_chinhsach_getByTop($top,$where,$order)
{
    return dieukhoan_chinhsach_Get("select * from dieukhoan_chinhsach ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function dieukhoan_chinhsach_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return dieukhoan_chinhsach_Get("SELECT * FROM  dieukhoan_chinhsach ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dieukhoan_chinhsach_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return dieukhoan_chinhsach_Get("SELECT dieukhoan_chinhsach.Id, dieukhoan_chinhsach.Name, dieukhoan_chinhsach.DieuKhoan, dieukhoan_chinhsach.DieuKhoan_en, dieukhoan_chinhsach.ChinhSach, dieukhoan_chinhsach.ChinhSach_en FROM  dieukhoan_chinhsach ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dieukhoan_chinhsach_insert($obj)
{
    return exe_query("insert into dieukhoan_chinhsach (Name,DieuKhoan,DieuKhoan_en,ChinhSach,ChinhSach_en) values ('$obj->Name','$obj->DieuKhoan','$obj->DieuKhoan_en','$obj->ChinhSach','$obj->ChinhSach_en')",'dieukhoan_chinhsach');
}
//
function dieukhoan_chinhsach_update($obj)
{
    return exe_query("update dieukhoan_chinhsach set Name='$obj->Name',DieuKhoan='$obj->DieuKhoan',DieuKhoan_en='$obj->DieuKhoan_en',ChinhSach='$obj->ChinhSach',ChinhSach_en='$obj->ChinhSach_en' where Id=$obj->Id",'dieukhoan_chinhsach');
}
//
function dieukhoan_chinhsach_delete($obj)
{
    return exe_query('delete from dieukhoan_chinhsach where Id='.$obj->Id,'dieukhoan_chinhsach');
}
//
function dieukhoan_chinhsach_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from dieukhoan_chinhsach '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
