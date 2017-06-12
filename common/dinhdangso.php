<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */

function DinhDangSo($int)
{
    $result="";
    $array_char=str_split($int);
    $dem=0;
    for($i=count($array_char)-1;$i>=0;$i--)
    {
        if(($dem++)==3)
        {
            $result.=".".$array_char[$i];
            $dem=1;
        }
        else
        $result.=$array_char[$i];
    }
    $array_char_result=str_split($result);
    $result='';
    for($i=count($array_char_result)-1;$i>=0;$i--)
    {
        $result.=$array_char_result[$i];
    }
    return $result;
}
?>