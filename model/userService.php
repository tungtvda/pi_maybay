<?php
require_once DIR.'/model/user.php';
require_once DIR.'/model/sqlconnection.php';
//
function user_Get($command)
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
                $new_obj=new user($row);
                $new_obj->decode();
                array_push($array_result,$new_obj);
            }
            $mycache->set($key,$array_result);
            saveCacheGroup($mycache,$key,'user');
        }
    }
    else
    {
       $result=mysqli_query(ConnectSql(),$command);
       if($result!=false)while($row=mysqli_fetch_array($result))
        {
            $new_obj=new user($row);
            $new_obj->decode();
            array_push($array_result,$new_obj);
        }
    }
    return $array_result;
}
//
function user_getById($Id)
{
    return user_Get('select * from user where Id='.$Id);
}
//
function user_getByAll()
{
    return user_Get('select * from user');
}
//
function user_getByTop($top,$where,$order)
{
    return user_Get("select * from user ".(($where!='')?(' where '.$where):'').(($order!='')?" Order By ".$order:'').(($top!='')?' limit '.$top:''));
}
//
function user_getByPaging($CurrentPage, $PageSize,$Order,$where)
{
   return user_Get("SELECT * FROM  user ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_getByPagingReplace($CurrentPage, $PageSize,$Order,$where)
{
   return user_Get("SELECT user.Id, user.Name, user.QuyDanh, user.MatKhau, user.Phone, user.Email, user.Address, user.TrangThai, user.Created FROM  user ".(($where!='')?(' where '.$where):'')." Order By ".$Order." Limit ".(($CurrentPage-1)*$PageSize)." , ".$PageSize);
}
//
function user_insert($obj)
{
    return exe_query("insert into user (Name,QuyDanh,MatKhau,Phone,Email,Address,TrangThai,Created) values ('$obj->Name','$obj->QuyDanh','$obj->MatKhau','$obj->Phone','$obj->Email','$obj->Address','$obj->TrangThai','$obj->Created')",'user');
}
//
function user_update($obj)
{
    return exe_query("update user set Name='$obj->Name',QuyDanh='$obj->QuyDanh',MatKhau='$obj->MatKhau',Phone='$obj->Phone',Email='$obj->Email',Address='$obj->Address',TrangThai='$obj->TrangThai',Created='$obj->Created' where Id=$obj->Id",'user');
}
//
function user_delete($obj)
{
    return exe_query('delete from user where Id='.$obj->Id,'user');
}
//
function user_count($where)
{
    $result=mysqli_query(ConnectSql(),'select COUNT(Id) as count from user '.(($where!='')?'where '.$where:''));
    if($result!=false)
    {
         $row=mysqli_fetch_array($result);
         return $row['count'];
    }
   else return false;
}
