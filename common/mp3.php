<?php

function get_length_mp3($filename)
{
    $result=shell_exec('ffmpeg -i '.$filename.' 2>&1 | grep -o \'Duration: [0-9:.]*\'');
    $duration = str_replace('Duration: ', '', $result); // 00:05:03.25

//get the duration in seconds
    $realtime=explode('.',$duration);
    $timeArr = explode(':',$realtime[0]);
    $t  =(($timeArr[0]!='00')?$timeArr[0].':':'').(($timeArr[1]!='00')?$timeArr[1].':':'').$timeArr[2];
    return $t;
}
//
function put_ftp($filename)
{
    $file=explode('/',$filename);
    $file=$file[count($file)-1];
    $conn_id = ftp_connect(FTP_SERVER);
    if($conn_id===false)
    {
        return false;
    }
    if(!ftp_login($conn_id, FTP_USERNAME, FTP_PASS))
        return false;

// upload a file
    if (ftp_put($conn_id, $file, $filename, FTP_BINARY))
    {
        ftp_close($conn_id);
        return $file;
    }
    else
    {
        ftp_close($conn_id);
        return false;
    }
}
//