<?php
    function Checkstring($string)
    {
if(strrpos($string,"javascript")===false && strrpos($string,"script")===false && strrpos($string,"</")===false && strrpos($string,"/>")===false &&  strrpos($string,"'")===false && strrpos($string,'"')===false && strrpos($string,"\\")===false && strrpos($string,"<")===false )
        {
           return true;
        }
       else return false;
    }
?>
