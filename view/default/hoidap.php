<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_hoidap($data = array())
{
    $asign = array();
    $asign['Name_dm']= $data['Name_dm'];
    $asign['Name']= $data['Name'];
    $asign['tieude']= $data['tieude'];





    $asign['danhsach'] = "";
    if (count($data['danhsach']) > 0) {
        $asign['danhsach'] = print_item('hoidap', $data['danhsach']);
    }

    print_template($asign, 'hoidap');
}