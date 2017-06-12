<?php
require_once DIR.'/model/bg_dangnhap.php';
require_once DIR.'/model/sqlconnection.php';
//
function bg_dangnhap_Get($command)
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
                $new_obj=new bg_dangnhap($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'bg_dangnhap');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new bg_dangnhap($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function bg_dangnhap_getById($Id)
{
    return bg_dangnhap_Get('select * from bg_dangnhap where Id='.$Id);
}
//
function bg_dangnhap_getByAll()
{
    return bg_dangnhap_Get('select * from bg_dangnhap');
}
//
function bg_dangnhap_getByTop($top,$where,$order)
{
    return bg_dangnhap_Get("select * from bg_dangnhap ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function bg_dangnhap_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return bg_dangnhap_Get("SELECT * FROM  bg_dangnhap ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function bg_dangnhap_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return bg_dangnhap_Get("SELECT bg_dangnhap.Id, bg_dangnhap.Img, bg_dangnhap.Img_en FROM  bg_dangnhap ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function bg_dangnhap_insert($obj)
{
    return exe_query("insert into bg_dangnhap (Img,Img_en) values ('$obj->Img','$obj->Img_en')",'bg_dangnhap');
}
//
function bg_dangnhap_update($obj)
{
    return exe_query("update bg_dangnhap set Img='$obj->Img',Img_en='$obj->Img_en' where Id=$obj->Id",'bg_dangnhap');
}
//
function bg_dangnhap_delete($obj)
{
    return exe_query('delete from bg_dangnhap where Id='.$obj->Id,'bg_dangnhap');
}
//
function bg_dangnhap_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from bg_dangnhap '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
