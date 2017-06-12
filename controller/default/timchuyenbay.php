<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:40 PM
 */
if(!defined('SITE_NAME'))
{
    require_once '../../config.php';
}

require_once DIR.'/controller/default/public.php';
require_once DIR.'/common/redict.php';
$data['config']=config_getByTop(1,'','');
if(isset($_SESSION['ran']))
{
    $ran2=$_SESSION['ran'];
    session_unset($_SESSION['s'.$ran2]);
}

if(isset($_POST['bntTimKiem'])){

    $FromPlace = '';
    $TFromPlace = '';
    $ToPlace = '';
    $TToPlace = '';
    $DepartDate = '';
    $ReturnDate = '';
    $Adult = '';
    $Child = '';
    $Infant = '';

    $FromNamePlace = '';
    $FromCountryName = '';
    $FromCountryCode = '';
    $ToNamePlace = '';
    $ToCountryName = '';
    $ToCountryCode = '';

    $dk="cityCode='".$_POST['FromPlace']."'";
    $data['FromPlaceArray'] = airports_getByTop2('',$dk,'');
    foreach($data['FromPlaceArray'] as $sanBay) {
        $FromNamePlace = $sanBay->name;
        $FromCountryName = $sanBay->countryName;
        $FromCountryCode = $sanBay->countryCode;
    }

    $dk="cityCode='".$_POST['ToPlace']."'";
    $data['ToPlaceArray'] = airports_getByTop2('',$dk,'');
    foreach($data['ToPlaceArray'] as $sanBay) {
        $ToNamePlace = $sanBay->name;
        $ToCountryName = $sanBay->countryName;
        $ToCountryCode = $sanBay->countryCode;
    }
    if(isset( $_POST['RoundTrip']) && $_POST['RoundTrip'] == 'true') {
        $RoundTrip = "true";
        $FromPlace = $_POST['FromPlace'];
        $TFromPlace = $_POST['TFromPlace'];
        $ToPlace = $_POST['ToPlace'];
        $TToPlace = $_POST['TToPlace'];
        $DepartDate = date("Y-m-d", strtotime(str_replace("/", "-", $_POST['DepartDate'])));
        $ReturnDate = ($_POST['ReturnDate'] && $_POST['ReturnDate'] != "") ? date("Y-m-d", strtotime(str_replace("/", "-", $_POST['ReturnDate']))) : "";
        $Adult = $_POST['adult'];
        $Child = $_POST['child'];
        $Infant = $_POST['infant'];
    }
    else {
        $RoundTrip = "false";
        $FromPlace = $_POST['FromPlace'];
        $TFromPlace = $_POST['TFromPlace'];
        $ToPlace = $_POST['ToPlace'];
        $TToPlace = $_POST['TToPlace'];
        $DepartDate = date("Y-m-d", strtotime(str_replace("/","-", $_POST['DepartDate'])));
        $ReturnDate = '';
        $Adult = $_POST['adult'];
        $Child = $_POST['child'];
        $Infant = $_POST['infant'];
    }

    $dataarray = array(
        "RoundTrip" => $RoundTrip,
        "FromPlace" => $FromPlace,
        "ToPlace" => $ToPlace,
        "TFromPlace" => $TFromPlace,
        "TToPlace" => $TToPlace,

        "FromNamePlace" => $FromNamePlace,
        "FromCountryName" => $FromCountryName,
        "FromCountryCode" => $FromCountryCode,
        "ToNamePlace" => $ToNamePlace,
        "ToCountryName" => $ToCountryName,
        "ToCountryCode" => $ToCountryCode,

        "DepartDate" => $DepartDate.'T00:00:00',
        "ReturnDate" => $ReturnDate.'T00:00:00',
        "CurrencyType" => "VND",
        "Adult" => $Adult,
        "Child" => $Child,
        "Infant" => $Infant,
        "Sources" => "VietJetAir,JetStar,Abacus,VietnamAirlines"
    );
    //var_dump($dataarray);
    $ran=rand(1000000000,9999999999);
    $_SESSION['ran']=$ran;
    $_SESSION['s'.$ran] = $dataarray;
    if($FromCountryCode == $ToCountryCode) {
        $link=SITE_NAME.'/ket-qua-tim-kiem-noi-dia/'.$ran;
    }
    else {
        $link=SITE_NAME.'/ket-qua-tim-kiem-quoc-te/'.$ran;
    }
//    print_r($_SESSION['s'.$ran]);
    //$link='search.php?Source=VietJetAir';
    echo "<script>window.location.href='$link'</script>";
}
else
{
    redict(SITE_NAME);
}


