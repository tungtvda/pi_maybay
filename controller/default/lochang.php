<?php


if(!defined('DIR')) require_once '../../config.php';
require_once(DIR."/model/airportsService.php");

if (isset($_GET['giatri']))
{
    $giatri = $_GET['giatri'];
    $str1="";

    if($datnuoc!="")
    {
        if(isset($_SESSION['timve']))
        {
            $doituong=$_SESSION['timve'];


            foreach($doituong->value as $loc)
            {
                $str1 .= '<option value="974"> -- Không có dữ liệu -- </option>';
            }
        }
    }
    else
    {
        $str1 .= '<option value="974"> -- Không có dữ liệu -- </option>';

    }





}