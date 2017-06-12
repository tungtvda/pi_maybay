<?php
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}

if(isset($_GET['giatri']))
{
     $_SESSION['lang']=$_GET['giatri'];

        echo "<script>location.reload(true)</script>";
}
?>