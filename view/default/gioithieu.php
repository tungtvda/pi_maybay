<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_gioithieu($data = array())
{
    $asign = array();
    $asign['Name_dm']= $data['Name_dm'];
    $asign['Name']= $data['Name'];
    $asign['tieude']= $data['tieude'];
    $asign['NoiDung']= $data['NoiDung'];


    if($_SESSION['kiemtra']==1)
    {
        $asign['gt_td']="GIỚI THIỆU VỀ TOURCOACH";
        $asign['uv_td']="TOURCOACH VÀ NHỮNG ĐIỂM ƯU VIỆT";
        $asign['UuViet']= $data['chitiet'][0]->UuViet;
        $asign['CacDichVu']= $data['chitiet'][0]->CacDichVu;
        $asign['CamKet']= $data['chitiet'][0]->CamKet;

        $asign['LienHe']= $data['chitiet'][0]->LienHe;

        $asign['taisao_td']="Tại sao bạn nên chọn Tourcoach";

        $asign['gia_td']="Đảm bảo giá tốt nhất";
        $asign['km_td']="Luôn có khuyến mãi và quà tặng";
        $asign['thanhtoan_td']="Thanh toán dễ dàng, đa dạng";
        $asign['tk_td']="Tìm kiếm linh hoạt, dễ dàng";
        $asign['dichvu_td']="Dịch vụ tin cậy - giá trị đích thực";
        $asign['tantinh_td']="Hỗ trợ tận tình - chu đáo 24/7";

        $asign['dv_td']="CÁC DỊCH VỤ CỦA CHÚNG TÔI";
        $asign['camket_td']="CAM KẾT KHÁCH HÀNG";

        $asign['Name_ct']= $data['config'][0]->Name;


    }
    else
    {
        $asign['taisao_td']="Why you should choose Tourcoach";
        $asign['gt_td']="ABOUT TOURCOACH";
        $asign['uv_td']="GIVING POINTS AND VIETNAM TOURCOACH";
        $asign['CacDichVu']= $data['chitiet'][0]->CacDicVu_en;
        $asign['CamKet']= $data['chitiet'][0]->CamKet_en;
        $asign['gia_td']="Best Price Guarantee";
        $asign['km_td']="Always have promotions and giveaways";
        $asign['thanhtoan_td']="Payment is easy, diversity";
        $asign['tk_td']="Search flexible, easy";
        $asign['dichvu_td']="Reliable service - the true value";
        $asign['tantinh_td']="Local Support - attentive 24/7";
        $asign['dv_td']="OUR SERVICES";
        $asign['camket_td']="CUSTOMER COMMITMENT";
        $asign['UuViet']= $data['chitiet'][0]->UuViet_en;
        $asign['Name_ct']= $data['config'][0]->Name_en;
        $asign['LienHe']= $data['chitiet'][0]->LienHe_en;
    }




    $asign['danhsach'] = "";
    if (count($data['danhsach']) > 0) {
        $asign['danhsach'] = print_item('dichvu_gt',  $data['danhsach']);
    }






    print_template($asign, 'gioithieu');
}