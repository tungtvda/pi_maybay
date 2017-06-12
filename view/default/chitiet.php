<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_chitiet($data = array())
{
    $asign = array();
    $asign['Name_dm']= $data['Name_dm'];
    $asign['Name']= $data['Name'];
    $asign['tieude']= $data['tieude'];
    $asign['NoiDung']= $data['NoiDung'];
    $asign['cungloai']= $data['cungloai'];




    if(isset( $data['baivietkhac']))
    {
        $asign['baivietkhac'] = "";
        if (count($data['baivietkhac']) > 0) {
            $asign['baivietkhac'] = print_item('baivietkhac',  $data['baivietkhac']);
            $asign['an']="";
        }
        else
        {
            $asign['an']="hidden";
        }
    }
    else
    {
        $asign['an']="hidden";
    }






    print_template($asign, 'chitiet');
}