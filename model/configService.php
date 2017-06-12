<?php
require_once DIR.'/model/config.php';
require_once DIR.'/model/sqlconnection.php';
//
function config_Get($command)
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
                $new_obj=new config($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'config');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new config($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function config_getById($Id)
{
    return config_Get('select * from config where Id='.$Id);
}
//
function config_getByAll()
{
    return config_Get('select * from config');
}
//
function config_getByTop($top,$where,$order)
{
    return config_Get("select * from config ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function config_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return config_Get("SELECT * FROM  config ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function config_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return config_Get("SELECT config.Id, config.Title, config.Title_en, config.Keyword, config.Description, config.Logo, config.Logo_footer, config.Icon, config.Name, config.Name_en, config.Address, config.Address_en, config.Phone, config.Hotline, config.Hotlien_datve, config.Email, config.Website, config.Skype, config.Yahoo FROM  config ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function config_insert($obj)
{
    return exe_query("insert into config (Title,Title_en,Keyword,Description,Logo,Logo_footer,Icon,Name,Name_en,Address,Address_en,Phone,Hotline,Hotlien_datve,Email,Website,Skype,Yahoo) values ('$obj->Title','$obj->Title_en','$obj->Keyword','$obj->Description','$obj->Logo','$obj->Logo_footer','$obj->Icon','$obj->Name','$obj->Name_en','$obj->Address','$obj->Address_en','$obj->Phone','$obj->Hotline','$obj->Hotlien_datve','$obj->Email','$obj->Website','$obj->Skype','$obj->Yahoo')",'config');
}
//
function config_update($obj)
{
    return exe_query("update config set Title='$obj->Title',Title_en='$obj->Title_en',Keyword='$obj->Keyword',Description='$obj->Description',Logo='$obj->Logo',Logo_footer='$obj->Logo_footer',Icon='$obj->Icon',Name='$obj->Name',Name_en='$obj->Name_en',Address='$obj->Address',Address_en='$obj->Address_en',Phone='$obj->Phone',Hotline='$obj->Hotline',Hotlien_datve='$obj->Hotlien_datve',Email='$obj->Email',Website='$obj->Website',Skype='$obj->Skype',Yahoo='$obj->Yahoo' where Id=$obj->Id",'config');
}
//
function config_delete($obj)
{
    return exe_query('delete from config where Id='.$obj->Id,'config');
}
//
function config_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from config '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
