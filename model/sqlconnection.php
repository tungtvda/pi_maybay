<?php
function ConnectSql()
{
    $connection= mysqli_connect(SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if($connection)
    {
        $connection->set_charset("utf8");
        return $connection;        
    }
    return false;
}
function ConnectSqlextend()
{
    $connection= mysqli_connect(SERVER_EXTEND,DB_USERNAME_EXTEND,DB_PASSWORD_EXTEND,DB_NAME_EXTEND);
    if($connection)
    {
        $connection->set_charset("utf8");
        return $connection;
    }
    return false;
}
function ConnectCache()
{
    if(class_exists('Memcache'))
    {
        $cache=new Memcache();
        $cache->connect('127.0.0.1',11211);
    }
    else
    {
        $cache=new Memcached();
        $cache->addServer('127.0.0.1',11211);
    }

    return $cache;
}
function backup($command,$table)
{
    $source=fopen(DIR.'/backup/'.$table.'.sql','a+');
    fwrite($source,$command."\n");
    fclose($source);
}
function exe_query($command,$table)
{
    deleteCacheGroup($table);
    backup($command.";",$table);
    mysqli_query(ConnectSql(),$command);
}
function GetCurrentTime()
{
    return date(DATETIME_FORMAT);
}
function saveCacheGroup($mycache,$key,$table)
{
    if(CACHE)
    {
        $cache_group=$mycache->get('group_cache_'.$table);
        if($cache_group)
        {
            array_push($cache_group,$key);
        }
        else
        {
            $cache_group=array();
            array_push($cache_group,$key);
        }
        $mycache->set('group_cache_'.$table,$cache_group);
    }
}
function deleteCacheGroup($table)
{
    if(CACHE)
    {
        $mycache=ConnectCache();
        $cachegroup=$mycache->get('group_cache_'.$table);
        if($cachegroup)
        {
            foreach($cachegroup as $cacheitem)
            {
                $mycache->delete($cacheitem);
            }
            $mycache->delete('group_cache_'.$table);
        }
    }
}