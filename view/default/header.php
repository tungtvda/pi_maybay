<?php
/**
 * Created by PhpStorm.
 * User: ductho
 * Date: 8/15/14
 * Time: 3:43 PM
 */
require_once DIR.'/view/default/public.php';
function view_header($data=array())
{
    $asign=array();
    $asign['Title']=$data['Title'];
    $asign['Description']=strip_tags($data['Description']);
    $asign['Keyword']=strip_tags($data['Keyword']);
    $asign['icon']=$data['config'][0]->Icon;

    print_template($asign,'header');
}
