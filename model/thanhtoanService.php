<?php
require_once DIR.'/model/thanhtoan.php';
require_once DIR.'/model/sqlconnection.php';
//
function thanhtoan_Get($command)
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
                $new_obj=new thanhtoan($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'thanhtoan');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new thanhtoan($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function thanhtoan_getById($Id)
{
    return thanhtoan_Get('select * from thanhtoan where Id='.$Id);
}
//
function thanhtoan_getByAll()
{
    return thanhtoan_Get('select * from thanhtoan');
}
//
function thanhtoan_getByTop($top,$where,$order)
{
    return thanhtoan_Get("select * from thanhtoan ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function thanhtoan_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return thanhtoan_Get("SELECT * FROM  thanhtoan ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thanhtoan_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return thanhtoan_Get("SELECT thanhtoan.Id, thanhtoan.Name, thanhtoan.Name_en, thanhtoan.Img, thanhtoan.Link FROM  thanhtoan ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function thanhtoan_insert($obj)
{
    return exe_query("insert into thanhtoan (Name,Name_en,Img,Link) values ('$obj->Name','$obj->Name_en','$obj->Img','$obj->Link')",'thanhtoan');
}
//
function thanhtoan_update($obj)
{
    return exe_query("update thanhtoan set Name='$obj->Name',Name_en='$obj->Name_en',Img='$obj->Img',Link='$obj->Link' where Id=$obj->Id",'thanhtoan');
}
//
function thanhtoan_delete($obj)
{
    return exe_query('delete from thanhtoan where Id='.$obj->Id,'thanhtoan');
}
//
function thanhtoan_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from thanhtoan '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
