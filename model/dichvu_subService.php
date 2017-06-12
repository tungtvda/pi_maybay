<?php
require_once DIR.'/model/dichvu_sub.php';
require_once DIR.'/model/sqlconnection.php';
//
function dichvu_sub_Get($command)
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
                $new_obj=new dichvu_sub($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'dichvu_sub');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new dichvu_sub($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function dichvu_sub_getById($Id)
{
    return dichvu_sub_Get('select * from dichvu_sub where Id='.$Id);
}
//
function dichvu_sub_getByAll()
{
    return dichvu_sub_Get('select * from dichvu_sub');
}
//
function dichvu_sub_getByTop($top,$where,$order)
{
    return dichvu_sub_Get("select * from dichvu_sub ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function dichvu_sub_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return dichvu_sub_Get("SELECT * FROM  dichvu_sub ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dichvu_sub_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return dichvu_sub_Get("SELECT dichvu_sub.Id, dichvu.Name as DanhMucId, dichvu_sub.BanChay, dichvu_sub.NoiBat, dichvu_sub.Name, dichvu_sub.Name_en, dichvu_sub.Img, sao.Name as HangSao, dichvu_sub.Address, dichvu_sub.Address_en, dichvu_sub.GiaCu, dichvu_sub.GiaCu_en, dichvu_sub.GiaMoi, dichvu_sub.GiaMoi_en FROM  dichvu_sub, dichvu, sao where dichvu.Id=dichvu_sub.DanhMucId and sao.Id=dichvu_sub.HangSao  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dichvu_sub_insert($obj)
{
    return exe_query("insert into dichvu_sub (DanhMucId,BanChay,NoiBat,Name,Name_en,Img,HangSao,Address,Address_en,GiaCu,GiaCu_en,GiaMoi,GiaMoi_en) values ('$obj->DanhMucId','$obj->BanChay','$obj->NoiBat','$obj->Name','$obj->Name_en','$obj->Img','$obj->HangSao','$obj->Address','$obj->Address_en','$obj->GiaCu','$obj->GiaCu_en','$obj->GiaMoi','$obj->GiaMoi_en')",'dichvu_sub');
}
//
function dichvu_sub_update($obj)
{
    return exe_query("update dichvu_sub set DanhMucId='$obj->DanhMucId',BanChay='$obj->BanChay',NoiBat='$obj->NoiBat',Name='$obj->Name',Name_en='$obj->Name_en',Img='$obj->Img',HangSao='$obj->HangSao',Address='$obj->Address',Address_en='$obj->Address_en',GiaCu='$obj->GiaCu',GiaCu_en='$obj->GiaCu_en',GiaMoi='$obj->GiaMoi',GiaMoi_en='$obj->GiaMoi_en' where Id=$obj->Id",'dichvu_sub');
}
//
function dichvu_sub_delete($obj)
{
    return exe_query('delete from dichvu_sub where Id='.$obj->Id,'dichvu_sub');
}
//
function dichvu_sub_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from dichvu_sub '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
