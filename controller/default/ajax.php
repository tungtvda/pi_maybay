<?php


if(!defined('DIR')) require_once '../../config.php';
require_once(DIR."/model/airportsService.php");
require_once(DIR."/model/countriesService.php");

//if (isset($_GET['Id']))
//{
//
//    if($datnuoc!="")
//    {
//        $idkt="countryCode='".$datnuoc."'";
//        $data['tinhthanh']=airports_getByTop('',$idkt,'id desc');
//        $str1 = '<option value=""> -- Chọn tình thành -- </option>';
//        if(count($data['tinhthanh'])>0)
//        {
//            foreach ($data['tinhthanh'] as $val) {
//                    $str1 .= "<option value='".$val->code."'>".$val->name."</option>";
//            }
//        }
//        else
//        {
//            $str1 = '<option value="974"> -- Không có dữ liệu -- </option>';
//        }
//        echo $str1;
//    }
//    else
//    {
//        $str1 = '<option value="974"> -- Không có dữ liệu -- </option>';
//    }
//}

//get all tỉnh
//tên, IDQG
// IDQG --> TenQG

//HaNoi_VietNam
//Seul_Korea
//abc_
$datnuoc = $_POST['keyword'];
$chuoi_dl="";
//$idkt="cityName like '%".$datnuoc."%' or cityCode like '%".$datnuoc."%' or countryName like '%".$datnuoc."%'";
//$idkt="cityCode like '%".$datnuoc."%' or cityName like '%".$datnuoc."%' or countryName like '%".$datnuoc."%' or name like '%".$datnuoc."%'";
$idkt="cityCode = '".strtoupper($datnuoc)."'";
$data['tinhthanh']=airports_getByTop('100',$idkt,"cityName");
if(count($data['tinhthanh'])>0)
{
	foreach($data['tinhthanh'] as $tt )
	{
		$idquocgia="sortname = '".$tt->countryCode."'";
		$data['quocgia']=countries_getByTop('',$idquocgia,'');
		if(count($data['quocgia'])>0)
		{
			foreach($data['quocgia'] as $qg )
			{
				$chuoi_dl .="<li class='".$tt->cityCode."'><span>".$tt->cityName." (".$tt->cityCode.")</span>".$qg->name."</li>";
			}
		}
	}

}
//$idkt="cityCode like '%".$datnuoc."%' or cityName like '%".$datnuoc."%' or countryName like '%".$datnuoc."%' or name like '%".$datnuoc."%'";
$idkt="cityCode not like '".strtoupper($datnuoc)."%' and name like '".ucfirst($datnuoc)."%'";
$data['tinhthanh']=airports_getByTop('100',$idkt,"cityName");
if(count($data['tinhthanh'])>0)
{
    foreach($data['tinhthanh'] as $tt )
    {
        $idquocgia="sortname = '".$tt->countryCode."'";
        $data['quocgia']=countries_getByTop('',$idquocgia,'');
        if(count($data['quocgia'])>0)
        {
            foreach($data['quocgia'] as $qg )
            {
                $chuoi_dl .="<li class='".$tt->cityCode."'><span>".$tt->cityName." (".$tt->cityCode.")</span>".$qg->name."</li>";
            }
        }
    }
}

$idkt="cityCode not like '".strtoupper($datnuoc)."%' and name not like '".ucfirst($datnuoc)."%' and cityName like '".ucfirst($datnuoc)."%'";
$data['tinhthanh']=airports_getByTop('100',$idkt,"cityName");
if(count($data['tinhthanh'])>0)
{
    foreach($data['tinhthanh'] as $tt )
    {
        $idquocgia="sortname = '".$tt->countryCode."'";
        $data['quocgia']=countries_getByTop('',$idquocgia,'');
        if(count($data['quocgia'])>0)
        {
            foreach($data['quocgia'] as $qg )
            {
                $chuoi_dl .="<li class='".$tt->cityCode."'><span>".$tt->cityName." (".$tt->cityCode.")</span>".$qg->name."</li>";
            }
        }
    }
}

//$idkt="cityCode like '%".$datnuoc."%' or cityName like '%".$datnuoc."%' or countryName like '%".$datnuoc."%' or name like '%".$datnuoc."%'";
$idkt="countryName like '".strtoupper($datnuoc)."%'";
$data['tinhthanh']=airports_getByTop('100',$idkt,"cityName");
if(count($data['tinhthanh'])>0)
{
    foreach($data['tinhthanh'] as $tt )
    {
        $idquocgia="sortname = '".$tt->countryCode."'";
        $data['quocgia']=countries_getByTop('',$idquocgia,'');
        if(count($data['quocgia'])>0)
        {
            foreach($data['quocgia'] as $qg )
            {
                $chuoi_dl .="<li class='".$tt->cityCode."'><span>".$tt->cityName." (".$tt->cityCode.")</span>".$qg->name."</li>";
            }
        }
    }
}

echo $chuoi_dl;