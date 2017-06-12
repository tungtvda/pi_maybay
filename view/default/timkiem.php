<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
require_once DIR . '/common/paging.php';
function show_timkiem($data = array())
{
    $asign = array();
    $asign['tieude']="";
    if($_SESSION['kiemtra']==1)
    {
        $asign['dv_td']='Kết quả tìm kiếm cho từ khóa " '. $data['name'].' "';
        $asign['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Trang chủ</a> <i class="fa fa-angle-right"></i> <span>Tìm kiếm</span>';
        $asign['name_tt6'] = $data['name_tt6'][0]->Name;
    }
    else
    {
        $asign['dv_td']='Search Results for keyword " '. $data['name'].' "';
        $asign['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> <span>Search</span>';
        $asign['name_tt6'] = $data['name_tt6'][0]->Name_en;
    }

    $asign['danhsach'] = "";
    if (count($data['danhsach']) > 0) {
        $asign['danhsach'] = print_item('khuyenmai', $data['danhsach']);
    }
    else
    {

        if($_SESSION['kiemtra']==1)
        {
            $asign['danhsach'] = "Không có kết quả tìm kiếm";
        }
        else
        {
            $asign['danhsach'] = "No search results";
        }


    }
    $asign['PAGING'] ="";

    print_template($asign, 'tinkhuyenmai');
}