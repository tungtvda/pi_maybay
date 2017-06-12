<?php
if(!defined('SITE_NAME'))
{
	require_once '../../config.php';
}
$Outbound = "";
if(isset($_GET['outbound'])) {
    $Outbound = $_GET['outbound'];
}
$Inbound = "";
if(isset($_GET['inbound'])) {
    $Inbound = $_GET['inbound'];
}
$Adult = $_POST['Adult'];
$Child = $_POST['Child'];
$Infant = $_POST['Infant'];
if(isset($_SESSION['dulieu_tk']))
{
    $data=$_SESSION['dulieu_tk'];
}
if(count($data)>0) { ?>

    <?php }
?>