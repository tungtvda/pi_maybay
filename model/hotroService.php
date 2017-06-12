<?php
require_once DIR.'/model/hotro.php';
require_once DIR.'/model/sqlconnection.php';
//
function hotro_Get($command)
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
                $new_obj=new hotro($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'hotro');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new hotro($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function hotro_getById($Id)
{
    return hotro_Get('select * from hotro where Id='.$Id);
}
//
function hotro_getByAll()
{
    return hotro_Get('select * from hotro');
}
//
function hotro_getByTop($top,$where,$order)
{
    return hotro_Get("select * from hotro ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function hotro_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return hotro_Get("SELECT * FROM  hotro ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function hotro_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return hotro_Get("SELECT hotro.Id, danhmuchotro.Name as DanhMucId, hotro.LoaiHoTro, hotro.LoaiHoTro_en, hotro.Name, hotro.Skype, hotro.Phone FROM  hotro, danhmuchotro where danhmuchotro.Id=hotro.DanhMucId  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function hotro_insert($obj)
{
    return exe_query("insert into hotro (DanhMucId,LoaiHoTro,LoaiHoTro_en,Name,Skype,Phone) values ('$obj->DanhMucId','$obj->LoaiHoTro','$obj->LoaiHoTro_en','$obj->Name','$obj->Skype','$obj->Phone')",'hotro');
}
//
function hotro_update($obj)
{
    return exe_query("update hotro set DanhMucId='$obj->DanhMucId',LoaiHoTro='$obj->LoaiHoTro',LoaiHoTro_en='$obj->LoaiHoTro_en',Name='$obj->Name',Skype='$obj->Skype',Phone='$obj->Phone' where Id=$obj->Id",'hotro');
}
//
function hotro_delete($obj)
{
    return exe_query('delete from hotro where Id='.$obj->Id,'hotro');
}
//
function hotro_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from hotro '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
