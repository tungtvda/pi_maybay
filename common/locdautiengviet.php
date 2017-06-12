<?php

/**
 * @author vdbkpro
 * @copyright 2013
 */

function LocDau($str)
{
    if(!$str) return false;
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẽ|Ẻ|Ẹ|Ê|Ề|Ế|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Õ|Ỏ|Ọ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ơ|Ờ|Ớ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ũ|Ủ|Ụ|U|Ư|Ừ|Ứ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        '-'=>' ',
    );

    foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
    $str=str_replace(',',"",$str);
    $str=str_replace('.','',$str);
    $str=str_replace(':','',$str);
    $str=str_replace(';','',$str);
    $str=str_replace("'",'',$str);
    $str=str_replace('"','',$str);
    $str=str_replace('/','',$str);
    $str=str_replace('!','',$str);
    $str=str_replace('@','',$str);
    $str=str_replace('$','',$str);
    $str=str_replace('%','',$str);
    $str=str_replace('^','',$str);
    $str=str_replace('&','',$str);
    $str=str_replace('*','',$str);
    $str=str_replace('(','',$str);
    $str=str_replace(')','',$str);
    $str=str_replace('=','',$str);
    $str=str_replace('\\','',$str);
    $str=str_replace('[','',$str);
    $str=str_replace(']','',$str);
    $str=str_replace('?','',$str);
    $str=str_replace('>','',$str);
    $str=str_replace('<','',$str);
    $str=str_replace('{','',$str);
    $str=str_replace('}','',$str);
    $str=str_replace('–','-',$str);
    $str=str_replace('---','-',$str);
    $str=str_replace('-–','-',$str);
    $str=str_replace('“','',$str);
    $str=str_replace('”','',$str);

    $str=strtolower($str);
    return $str;
}
function LocDauImg($str)
{
    if(!$str) return false;
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẽ|Ẻ|Ẹ|Ê|Ề|Ế|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Õ|Ỏ|Ọ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ơ|Ờ|Ớ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ũ|Ủ|Ụ|U|Ư|Ừ|Ứ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        '-'=>' ',
    );
    foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
    $str=str_replace(',',"",$str);
    $str=str_replace(':','',$str);
    $str=str_replace(';','',$str);
    $str=str_replace("'",'',$str);
    $str=str_replace('"','',$str);
    $str=str_replace('!','',$str);
    $str=str_replace('@','',$str);
    $str=str_replace('$','',$str);
    $str=str_replace('%','',$str);
    $str=str_replace('^','',$str);
    $str=str_replace('&','',$str);
    $str=str_replace('*','',$str);
    $str=str_replace('(','',$str);
    $str=str_replace(')','',$str);
    $str=str_replace('=','',$str);
    $str=str_replace('\\','',$str);
    $str=str_replace('[','',$str);
    $str=str_replace(']','',$str);
    $str=str_replace('?','',$str);
    $str=str_replace('>','',$str);
    $str=str_replace('<','',$str);
    $str=str_replace('{','',$str);
    $str=str_replace('}','',$str);
    $str=str_replace('–','-',$str);
    $str=str_replace('---','-',$str);
    $str=str_replace('-–','-',$str);

    $str=strtolower($str);
    return $str;
}
?>
