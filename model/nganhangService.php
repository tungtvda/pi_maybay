<?php
require_once DIR.'/model/nganhang.php';
require_once DIR.'/model/sqlconnection.php';
//
function nganhang_Get($command)
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
                $new_obj=new nganhang($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'nganhang');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new nganhang($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function nganhang_getById($Id)
{
    return nganhang_Get('select * from nganhang where Id='.$Id);
}
//
function nganhang_getByAll()
{
    return nganhang_Get('select * from nganhang');
}
//
function nganhang_getByTop($top,$where,$order)
{
    return nganhang_Get("select * from nganhang ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function nganhang_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return nganhang_Get("SELECT * FROM  nganhang ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function nganhang_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return nganhang_Get("SELECT nganhang.Id, nganhang.NganHang, nganhang.NganHang_en, nganhang.Img, nganhang.TenTaiKhoan, nganhang.TenTaiKhoan_en, nganhang.SoTaiKhoan, nganhang.ChiNhanh, nganhang.ChiNhanh_en FROM  nganhang ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function nganhang_insert($obj)
{
    return exe_query("insert into nganhang (NganHang,NganHang_en,Img,TenTaiKhoan,TenTaiKhoan_en,SoTaiKhoan,ChiNhanh,ChiNhanh_en) values ('$obj->NganHang','$obj->NganHang_en','$obj->Img','$obj->TenTaiKhoan','$obj->TenTaiKhoan_en','$obj->SoTaiKhoan','$obj->ChiNhanh','$obj->ChiNhanh_en')",'nganhang');
}
//
function nganhang_update($obj)
{
    return exe_query("update nganhang set NganHang='$obj->NganHang',NganHang_en='$obj->NganHang_en',Img='$obj->Img',TenTaiKhoan='$obj->TenTaiKhoan',TenTaiKhoan_en='$obj->TenTaiKhoan_en',SoTaiKhoan='$obj->SoTaiKhoan',ChiNhanh='$obj->ChiNhanh',ChiNhanh_en='$obj->ChiNhanh_en' where Id=$obj->Id",'nganhang');
}
//
function nganhang_delete($obj)
{
    return exe_query('delete from nganhang where Id='.$obj->Id,'nganhang');
}
//
function nganhang_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from nganhang '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
