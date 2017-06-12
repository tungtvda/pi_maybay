<?php
require_once DIR.'/model/thanhtoan_chuyenkhoan.php';
require_once DIR.'/model/sqlconnection.php';
//
function thanhtoan_chuyenkhoan_Get($command)
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
                $new_obj=new thanhtoan_chuyenkhoan($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'thanhtoan_chuyenkhoan');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new thanhtoan_chuyenkhoan($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function thanhtoan_chuyenkhoan_getById($Id)
{
    return thanhtoan_chuyenkhoan_Get('select * from thanhtoan_chuyenkhoan where Id='.$Id);
}
//
function thanhtoan_chuyenkhoan_getByAll()
{
    return thanhtoan_chuyenkhoan_Get('select * from thanhtoan_chuyenkhoan');
}
//
function thanhtoan_chuyenkhoan_getByTop($top,$where,$order)
{
    return thanhtoan_chuyenkhoan_Get("select * from thanhtoan_chuyenkhoan ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function thanhtoan_chuyenkhoan_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return thanhtoan_chuyenkhoan_Get("SELECT * FROM  thanhtoan_chuyenkhoan ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thanhtoan_chuyenkhoan_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return thanhtoan_chuyenkhoan_Get("SELECT thanhtoan_chuyenkhoan.Id, thanhtoan_chuyenkhoan.Name, thanhtoan_chuyenkhoan.HuongDanThanhToan, thanhtoan_chuyenkhoan.HuongDanThanhToan_en, thanhtoan_chuyenkhoan.ThongTinChuyenKhoan, thanhtoan_chuyenkhoan.ThongTinChuyenKhoan_en FROM  thanhtoan_chuyenkhoan ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thanhtoan_chuyenkhoan_insert($obj)
{
    return exe_query("insert into thanhtoan_chuyenkhoan (Name,HuongDanThanhToan,HuongDanThanhToan_en,ThongTinChuyenKhoan,ThongTinChuyenKhoan_en) values ('$obj->Name','$obj->HuongDanThanhToan','$obj->HuongDanThanhToan_en','$obj->ThongTinChuyenKhoan','$obj->ThongTinChuyenKhoan_en')",'thanhtoan_chuyenkhoan');
}
//
function thanhtoan_chuyenkhoan_update($obj)
{
    return exe_query("update thanhtoan_chuyenkhoan set Name='$obj->Name',HuongDanThanhToan='$obj->HuongDanThanhToan',HuongDanThanhToan_en='$obj->HuongDanThanhToan_en',ThongTinChuyenKhoan='$obj->ThongTinChuyenKhoan',ThongTinChuyenKhoan_en='$obj->ThongTinChuyenKhoan_en' where Id=$obj->Id",'thanhtoan_chuyenkhoan');
}
//
function thanhtoan_chuyenkhoan_delete($obj)
{
    return exe_query('delete from thanhtoan_chuyenkhoan where Id='.$obj->Id,'thanhtoan_chuyenkhoan');
}
//
function thanhtoan_chuyenkhoan_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from thanhtoan_chuyenkhoan '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
