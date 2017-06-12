<?php
require_once DIR.'/model/datdichvu.php';
require_once DIR.'/model/sqlconnection.php';
//
function datdichvu_Get($command)
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
                $new_obj=new datdichvu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'datdichvu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new datdichvu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function datdichvu_getById($Id)
{
    return datdichvu_Get('select * from datdichvu where Id='.$Id);
}
//
function datdichvu_getByAll()
{
    return datdichvu_Get('select * from datdichvu');
}
//
function datdichvu_getByTop($top,$where,$order)
{
    return datdichvu_Get("select * from datdichvu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function datdichvu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return datdichvu_Get("SELECT * FROM  datdichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function datdichvu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return datdichvu_Get("SELECT datdichvu.Id, datdichvu.LoaiDichVu, datdichvu.TrangThai, datdichvu.Name, datdichvu.Email, datdichvu.Phone, datdichvu.Address, datdichvu.NoiDung, datdichvu.Created FROM  datdichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function datdichvu_insert($obj)
{
    return exe_query("insert into datdichvu (LoaiDichVu,TrangThai,Name,Email,Phone,Address,NoiDung,Created) values ('$obj->LoaiDichVu','$obj->TrangThai','$obj->Name','$obj->Email','$obj->Phone','$obj->Address','$obj->NoiDung','$obj->Created')",'datdichvu');
}
//
function datdichvu_update($obj)
{
    return exe_query("update datdichvu set LoaiDichVu='$obj->LoaiDichVu',TrangThai='$obj->TrangThai',Name='$obj->Name',Email='$obj->Email',Phone='$obj->Phone',Address='$obj->Address',NoiDung='$obj->NoiDung',Created='$obj->Created' where Id=$obj->Id",'datdichvu');
}
//
function datdichvu_delete($obj)
{
    return exe_query('delete from datdichvu where Id='.$obj->Id,'datdichvu');
}
//
function datdichvu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from datdichvu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
