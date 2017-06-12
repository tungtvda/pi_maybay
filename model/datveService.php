<?php
require_once DIR.'/model/datve.php';
require_once DIR.'/model/sqlconnection.php';
//
function datve_Get($command)
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
                $new_obj=new datve($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'datve');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new datve($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function datve_getById($Id)
{
    return datve_Get('select * from datve where Id='.$Id);
}
//
function datve_getByMaVe($MaVe)
{
    return datve_Get('select * from datve where MaDatVe='.$MaVe);
}
//
function datve_getByAll()
{
    return datve_Get('select * from datve');
}
//
function datve_getByTop($top,$where,$order)
{
    return datve_Get("select * from datve ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function datve_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return datve_Get("SELECT * FROM  datve ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function datve_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return datve_Get("SELECT datve.Id, trangthai.Name as TrangThaiThanhToan, datve.MaDatVe, datve.HangBay, datve.LoaiVe, datve.ChieuDi, datve.ChieuVe, datve.NgayDi, datve.NgayVe, datve.SoNguoiLon, datve.SoTreEm, datve.TreSoSinh, datve.ThanhTien, datve.NguoiDaiDien, datve.Phone, datve.Email, datve.Address, datve.YeuCau, datve.MaSoThue, datve.TenCongTy, datve.DiaChiCongTy, datve.DiaChiNhanHoaDon, datve.HTTT, datve.NgayDat FROM  datve, trangthai where trangthai.Id=datve.TrangThaiThanhToan  ".(($where!='')?(' and '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function datve_insert($obj)
{
    return exe_query("insert into datve (TrangThaiThanhToan,MaDatVe,HangBay,LoaiVe,ChieuDi,ChieuVe,NgayDi,NgayVe,SoNguoiLon,SoTreEm,TreSoSinh,ThanhTien,NguoiDaiDien,Phone,Email,Address,YeuCau,MaSoThue,TenCongTy,DiaChiCongTy,DiaChiNhanHoaDon,HTTT,NgayDat) values ('$obj->TrangThaiThanhToan','$obj->MaDatVe','$obj->HangBay','$obj->LoaiVe','$obj->ChieuDi','$obj->ChieuVe','$obj->NgayDi','$obj->NgayVe','$obj->SoNguoiLon','$obj->SoTreEm','$obj->TreSoSinh','$obj->ThanhTien','$obj->NguoiDaiDien','$obj->Phone','$obj->Email','$obj->Address','$obj->YeuCau','$obj->MaSoThue','$obj->TenCongTy','$obj->DiaChiCongTy','$obj->DiaChiNhanHoaDon','$obj->HTTT','$obj->NgayDat')",'datve');
}
//
function datve_update($obj)
{
    return exe_query("update datve set TrangThaiThanhToan='$obj->TrangThaiThanhToan',MaDatVe='$obj->MaDatVe',HangBay='$obj->HangBay',LoaiVe='$obj->LoaiVe',ChieuDi='$obj->ChieuDi',ChieuVe='$obj->ChieuVe',NgayDi='$obj->NgayDi',NgayVe='$obj->NgayVe',SoNguoiLon='$obj->SoNguoiLon',SoTreEm='$obj->SoTreEm',TreSoSinh='$obj->TreSoSinh',ThanhTien='$obj->ThanhTien',NguoiDaiDien='$obj->NguoiDaiDien',Phone='$obj->Phone',Email='$obj->Email',Address='$obj->Address',YeuCau='$obj->YeuCau',MaSoThue='$obj->MaSoThue',TenCongTy='$obj->TenCongTy',DiaChiCongTy='$obj->DiaChiCongTy',DiaChiNhanHoaDon='$obj->DiaChiNhanHoaDon',HTTT='$obj->HTTT',NgayDat='$obj->NgayDat' where Id=$obj->Id",'datve');
}
//
function datve_delete($obj)
{
    return exe_query('delete from datve where Id='.$obj->Id,'datve');
}
//
function datve_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from datve '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
