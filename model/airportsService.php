<?php
require_once DIR.'/model/airports.php';
require_once DIR.'/model/sqlconnection.php';
//
function airports_Get($command)
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
                $new_obj=new airports($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'airports');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new airports($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function airports_getById($Id)
{
    return airports_Get('select * from airports where Id='.$Id);
}
//
function airports_getByAll()
{
    return airports_Get('select * from airports');
}
//
function airports_getByTop($top,$where,$order)
{
    return airports_Get("select airports.cityName, airports.cityCode, airports.countryCode from airports ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
function airports_getByTop2($top,$where,$order)
{
    return airports_Get("select * from airports ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function airports_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return airports_Get("SELECT * FROM  airports ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function airports_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return airports_Get("SELECT airports.code, airports.Id, airports.name, airports.cityCode, airports.cityName, airports.countryName, airports.countryCode, airports.timezone, airports.lat, airports.lon, airports.numAirports, airports.city FROM  airports ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function airports_insert($obj)
{
    return exe_query("insert into airports (code,name,cityCode,cityName,countryName,countryCode,timezone,lat,lon,numAirports,city) values ('$obj->code','$obj->name','$obj->cityCode','$obj->cityName','$obj->countryName','$obj->countryCode','$obj->timezone','$obj->lat','$obj->lon','$obj->numAirports','$obj->city')",'airports');
}
//
function airports_update($obj)
{
    return exe_query("update airports set code='$obj->code',name='$obj->name',cityCode='$obj->cityCode',cityName='$obj->cityName',countryName='$obj->countryName',countryCode='$obj->countryCode',timezone='$obj->timezone',lat='$obj->lat',lon='$obj->lon',numAirports='$obj->numAirports',city='$obj->city' where Id=$obj->Id",'airports');
}
//
function airports_delete($obj)
{
    return exe_query('delete from airports where Id='.$obj->Id,'airports');
}
//
function airports_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from airports '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
