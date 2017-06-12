<?php
require_once DIR.'/model/venoidia.php';
require_once DIR.'/model/sqlconnection.php';
//
function venoidia_Get($command)
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
                $new_obj=new venoidia($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'venoidia');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new venoidia($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function venoidia_getById($Id)
{
    return venoidia_Get('select * from venoidia where Id='.$Id);
}
//
function venoidia_getByAll()
{
    return venoidia_Get('select * from venoidia');
}
//
function venoidia_getByTop($top,$where,$order)
{
    return venoidia_Get("select * from venoidia ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function venoidia_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return venoidia_Get("SELECT * FROM  venoidia ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function venoidia_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return venoidia_Get("SELECT venoidia.Id, loaive.Name as DanhMucId, venoidia.Name, venoidia.Name_en, venoidia.MaChuyenBay, venoidia.DiemDi, venoidia.DiemDi_en, venoidia.DiemDen, venoidia.DiemDen_en, venoidia.NgayDi, venoidia.Gia, venoidia.Gia_en, venoidia.Img, venoidia.Img_hang, venoidia.NoiDung, venoidia.NoiDung_en, venoidia.Title, venoidia.Title_en, venoidia.Keyword, venoidia.Description, venoidia.Created FROM  venoidia, loaive where loaive.Id=venoidia.DanhMucId  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function venoidia_insert($obj)
{
    return exe_query("insert into venoidia (DanhMucId,Name,Name_en,MaChuyenBay,DiemDi,DiemDi_en,DiemDen,DiemDen_en,NgayDi,Gia,Gia_en,Img,Img_hang,NoiDung,NoiDung_en,Title,Title_en,Keyword,Description,Created) values ('$obj->DanhMucId','$obj->Name','$obj->Name_en','$obj->MaChuyenBay','$obj->DiemDi','$obj->DiemDi_en','$obj->DiemDen','$obj->DiemDen_en','$obj->NgayDi','$obj->Gia','$obj->Gia_en','$obj->Img','$obj->Img_hang','$obj->NoiDung','$obj->NoiDung_en','$obj->Title','$obj->Title_en','$obj->Keyword','$obj->Description','$obj->Created')",'venoidia');
}
//
function venoidia_update($obj)
{
    return exe_query("update venoidia set DanhMucId='$obj->DanhMucId',Name='$obj->Name',Name_en='$obj->Name_en',MaChuyenBay='$obj->MaChuyenBay',DiemDi='$obj->DiemDi',DiemDi_en='$obj->DiemDi_en',DiemDen='$obj->DiemDen',DiemDen_en='$obj->DiemDen_en',NgayDi='$obj->NgayDi',Gia='$obj->Gia',Gia_en='$obj->Gia_en',Img='$obj->Img',Img_hang='$obj->Img_hang',NoiDung='$obj->NoiDung',NoiDung_en='$obj->NoiDung_en',Title='$obj->Title',Title_en='$obj->Title_en',Keyword='$obj->Keyword',Description='$obj->Description',Created='$obj->Created' where Id=$obj->Id",'venoidia');
}
//
function venoidia_delete($obj)
{
    return exe_query('delete from venoidia where Id='.$obj->Id,'venoidia');
}
//
function venoidia_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from venoidia '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
