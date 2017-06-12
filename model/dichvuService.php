<?php
require_once DIR.'/model/dichvu.php';
require_once DIR.'/model/sqlconnection.php';
//
function dichvu_Get($command)
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
                $new_obj=new dichvu($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'dichvu');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new dichvu($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function dichvu_getById($Id)
{
    return dichvu_Get('select * from dichvu where Id='.$Id);
}
//
function dichvu_getByAll()
{
    return dichvu_Get('select * from dichvu');
}
//
function dichvu_getByTop($top,$where,$order)
{
    return dichvu_Get("select * from dichvu ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function dichvu_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return dichvu_Get("SELECT * FROM  dichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dichvu_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return dichvu_Get("SELECT dichvu.Id, dichvu.ViTri, dichvu.Name, dichvu.Name_en, dichvu.Img, dichvu.MoTaNgan, dichvu.MoTaNgan_en, dichvu.NoiDung, dichvu.NoiDung_en, dichvu.Icon, dichvu.Icon_gioithieu, dichvu.Avatar, dichvu.Name_ht, dichvu.MoTaNgan_ht, dichvu.MoTaNgan_ht_en, dichvu.Phone, dichvu.Email, dichvu.Yahoo, dichvu.Skype, dichvu.Title, dichvu.Title_en, dichvu.Keyword, dichvu.Description FROM  dichvu ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function dichvu_insert($obj)
{
    return exe_query("insert into dichvu (ViTri,Name,Name_en,Img,MoTaNgan,MoTaNgan_en,NoiDung,NoiDung_en,Icon,Icon_gioithieu,Avatar,Name_ht,MoTaNgan_ht,MoTaNgan_ht_en,Phone,Email,Yahoo,Skype,Title,Title_en,Keyword,Description) values ('$obj->ViTri','$obj->Name','$obj->Name_en','$obj->Img','$obj->MoTaNgan','$obj->MoTaNgan_en','$obj->NoiDung','$obj->NoiDung_en','$obj->Icon','$obj->Icon_gioithieu','$obj->Avatar','$obj->Name_ht','$obj->MoTaNgan_ht','$obj->MoTaNgan_ht_en','$obj->Phone','$obj->Email','$obj->Yahoo','$obj->Skype','$obj->Title','$obj->Title_en','$obj->Keyword','$obj->Description')",'dichvu');
}
//
function dichvu_update($obj)
{
    return exe_query("update dichvu set ViTri='$obj->ViTri',Name='$obj->Name',Name_en='$obj->Name_en',Img='$obj->Img',MoTaNgan='$obj->MoTaNgan',MoTaNgan_en='$obj->MoTaNgan_en',NoiDung='$obj->NoiDung',NoiDung_en='$obj->NoiDung_en',Icon='$obj->Icon',Icon_gioithieu='$obj->Icon_gioithieu',Avatar='$obj->Avatar',Name_ht='$obj->Name_ht',MoTaNgan_ht='$obj->MoTaNgan_ht',MoTaNgan_ht_en='$obj->MoTaNgan_ht_en',Phone='$obj->Phone',Email='$obj->Email',Yahoo='$obj->Yahoo',Skype='$obj->Skype',Title='$obj->Title',Title_en='$obj->Title_en',Keyword='$obj->Keyword',Description='$obj->Description' where Id=$obj->Id",'dichvu');
}
//
function dichvu_delete($obj)
{
    return exe_query('delete from dichvu where Id='.$obj->Id,'dichvu');
}
//
function dichvu_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from dichvu '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
