<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_index($data = array())
{
    $asign = array();
    $asign['Hotlien_datve'] = $data['config'][0]->Hotlien_datve;
    $asign['img_gt'] = $data['gioithieu'][0]->Img;
    $asign['img_qc'] = $data['quangcao'][0]->Img;
    $asign['link_qc'] = $data['quangcao'][0]->Link;
    if($_SESSION['kiemtra']==1)
    {
        $asign['venoidia_td']="Vé nội địa";
        $asign['vequocte_td']="Vé quốc tế";
        $asign['datvemaybay_td']="ĐẶT VÉ MÁY BAY";
        $asign['vekhuhoi_td']="Vé khứ hồi";
        $asign['vemotchieu_td']="Vé một chiều";
        $asign['diemdi_td']="Điểm đi";
        $asign['diemden_td']="Điểm đến";
        $asign['ngaydi_td']="Ngày đi";
        $asign['ngayve_td']="Ngày về";
        $asign['nguoilon_td']="Người lớn";
        $asign['treem_td']="Trẻ em";
        $asign['sosinh_td']="Sơ sinh";
        $asign['timchuyenbay_td']="Tìm chuyến bay";


        $asign['Name_qc'] = $data['quangcao'][0]->Name;
        $asign['gioithieu'] =strip_tags($data['gioithieu'][0]->GioiThieu);
        $asign['hotro_ol']="HỖ TRỢ ĐẶT VÉ TRỰC TUYẾN";
        $asign['call_ol']="Gọi điện thoại cho Tourcoach";
        $asign['ol_ol']="Hotline hỗ trợ 24/7";
        $asign['chat_ol']="Chát với đội ngũ chăm sóc của Tourcoach";
        $asign['tuvan_ol']="Tư vấn hỗ trợ khách hàng về dịch vụ của Tourcoach";
        $asign['mang_ol']="Hoặc kết nối với Tourcoach qua mạng xã hội";
        $asign['dv_td']="DỊCH VỤ CỦA TOURCOACH";
        $asign['gioithieu_td']="Giới thiệu về Tourcoach";
        $asign['chitiet_td']="xem chi tiết";

        $asign['taisao_td']="Tại sao bạn nên chọn Tourcoach";
        $asign['gia_td']="Đảm bảo giá tốt nhất";
        $asign['km_td']="Luôn có khuyến mãi và quà tặng";
        $asign['thanhtoan_td']="Thanh toán dễ dàng, đa dạng";
        $asign['tk_td']="Tìm kiếm linh hoạt, dễ dàng";
        $asign['dichvu_td']="Dịch vụ tin cậy - giá trị đích thực";
        $asign['tantinh_td']="Hỗ trợ tận tình - chu đáo 24/7";

        $asign['tinkm_td']="Tin khuyến mãi";
        $asign['httt_td']="Các hình thức thanh toán";
    }
    else
    {
        $asign['vequocte_td']="International ticket";
        $asign['venoidia_td']="Domestic ticket";
        $asign['datvemaybay_td']="TICKET BOOKING";
        $asign['vekhuhoi_td']="Return Ticket";
        $asign['vemotchieu_td']="One-way ticket";
        $asign['diemdi_td']="Points go";
        $asign['diemden_td']="Destination";
        $asign['ngaydi_td']="Date out";
        $asign['ngayve_td']="Date of";
        $asign['nguoilon_td']="Adults";
        $asign['treem_td']="Children";
        $asign['sosinh_td']="Newborn";
        $asign['timchuyenbay_td']="Find flight";



        $asign['Name_qc'] = $data['quangcao'][0]->Name_en;
        $asign['gioithieu'] =strip_tags($data['gioithieu'][0]->GioiThieu_en);
        $asign['hotro_ol']="SUPPORT ONLINE BOOKING";
        $asign['call_ol']="Call Tourcoach";
        $asign['ol_ol']="Hotline Support 24/7";
        $asign['chat_ol']="Chat with care team of Tourcoach";
        $asign['tuvan_ol']="Advice about customer support services Tourcoach";
        $asign['mang_ol']="Or connect via social networking Tourcoach";
        $asign['dv_td']="TOURCOACH SERVICES";
        $asign['gioithieu_td']="About Tourcoach";
        $asign['chitiet_td']="view detail";
        $asign['taisao_td']="Why you should choose Tourcoach";
        $asign['gia_td']="Best Price Guarantee";
        $asign['km_td']="Always have promotions and giveaways";
        $asign['thanhtoan_td']="Payment is easy, diversity";
        $asign['tk_td']="Search flexible, easy";
        $asign['dichvu_td']="Reliable service - the true value";
        $asign['tantinh_td']="Local Support - attentive 24/7";

        $asign['tinkm_td']="Promotion";
        $asign['httt_td']="Forms of payment";
    }

    $asign['venoidia_index'] = "";
    if (count($data['venoidia_index']) > 0) {
        $asign['venoidia_index'] = print_item('venoidia-index', $data['venoidia_index']);
    }

    $asign['vequocte_index'] = "";
    if (count($data['vequocte_index']) > 0) {
        $asign['vequocte_index'] = print_item('venoidia-index', $data['vequocte_index']);
    }


    $asign['dichvu'] = "";
    if (count($data['dichvu']) > 0) {
        $asign['dichvu'] = print_item('dichvu_home', $data['dichvu']);
    }


    $asign['tieuchi'] = "";
    if (count($data['tieuchi']) > 0) {
        $asign['tieuchi'] = print_item('tieuchi', $data['tieuchi']);
    }
    $asign['dichvu'] = "";
    if (count($data['dichvu']) > 0) {
        $asign['dichvu'] = print_item('dichvu_home', $data['dichvu']);
    }
    $asign['tinkhuyenmai'] = "";
    if (count($data['tinkhuyenmai']) > 0) {
        $asign['tinkhuyenmai'] = print_item('tinkhuyenmai_home', $data['tinkhuyenmai']);
    }
    $asign['hinhthucthanhtoan'] = "";
    if (count($data['hinhthucthanhtoan']) > 0) {
        $asign['hinhthucthanhtoan'] = print_item('hinhthucthanhtoan', $data['hinhthucthanhtoan']);
    }


    $asign['danhmuchotro'] = "";
    if (count($data['danhmuchotro']) > 0) {
        foreach ($data['danhmuchotro'] as $dmht) {
            $iddm_hotro ="DanhMucId=".$dmht->Id;
            $data['hotro'] = hotro_getByTop('', $iddm_hotro, 'Id desc');
            if (count($data['hotro']) > 0) {
                $asign['danhmuchotro'] .= '<div class="list-supports row">';
                $asign['danhmuchotro'] .= '<div class="col-md-3 col-sm-12 col-xs-12">';
                if($_SESSION['kiemtra']==1)
                {
                    $asign['danhmuchotro'] .= '<span>'.$dmht->Name.'</span>';
                }
                else
                {
                    $asign['danhmuchotro'] .= '<span>'.$dmht->Name_en.'</span>';
                }

                $asign['danhmuchotro'] .= '</div>';
                $asign['danhmuchotro'] .= '<div class="col-md-9 col-sm-12 col-xs-12">';
                $asign['danhmuchotro'] .= '<ul class="skype-list">';
                foreach($data['hotro'] as $ht)
                {
                    $asign['danhmuchotro'] .= '<li><a href="Skype:'.$ht->Skype.'?chat">Mr Thế<span>'.$ht->Phone.'</span></a></li>';
                }


                $asign['danhmuchotro'] .= ' </ul><div class="clearfix"></div></div></div>';
            }
        }
    }
    $asign['Face']=$data['mangxahoi'][0]->Face;
    $asign['Feed']=$data['mangxahoi'][0]->Feed;
    $asign['Twitter']=$data['mangxahoi'][0]->Twitter;
    $asign['Google']=$data['mangxahoi'][0]->Google;
    $asign['Youtube']=$data['mangxahoi'][0]->Youtube;

    //Default values
    $DepartDate = time() + 3*24*60*60;
    $DepartDate = date("d/m/Y",$DepartDate);
    $ReturnDate = time() + 4*24*60*60;
    $ReturnDate = date("d/m/Y",$ReturnDate);

    $asign['RoundTripTrue'] = 'checked';
    $asign['RoundTripFalse'] = '';
    $asign['FromPlace'] = 'HAN';
    $asign['ToPlace'] = 'SGN';
    $asign['TFromPlace'] = 'Hà Nội';
    $asign['TToPlace'] = 'Hồ Chí Minh';
    $asign['DepartDate'] = $DepartDate;
    $asign['ReturnDate'] = $ReturnDate;
    $asign['Adult'] = '';
    $asign['Child'] = '';
    $asign['Infant'] = '';
    for($i=1;$i<=15;$i++) {
        if($i == 1)
            $asign['Adult'] .= "<option selected value='".$i."'>".$i."</option>";
        else
            $asign['Adult'] .= "<option value='".$i."'>".$i."</option>";
    }
    for($i=0;$i<=15;$i++) {
        if($i == 0)
            $asign['Child'] .= "<option selected value='".$i."'>".$i."</option>";
        else
            $asign['Child'] .= "<option value='".$i."'>".$i."</option>";
    }
    for($i=0;$i<=15;$i++) {
        if($i == 0)
            $asign['Infant'] .= "<option selected value='".$i."'>".$i."</option>";
        else
            $asign['Infant'] .= "<option value='".$i."'>".$i."</option>";
    }
    $dataarray = null;
    if(isset($_SESSION['ran'])) {
        $dataarray = $_SESSION['s'.$_SESSION['ran']];
        if($dataarray['RoundTrip'] == 'true') {
            $asign['RoundTripTrue'] = 'checked';
            $asign['RoundTripFalse'] = '';
        }
        else {
            $asign['RoundTripTrue'] = '';
            $asign['RoundTripFalse'] = 'checked';
        }
        $asign['RoundTrip'] = $dataarray['RoundTrip'];
        $asign['FromPlace'] = $dataarray['FromPlace'];
        $asign['ToPlace'] = $dataarray['ToPlace'];
        $asign['TFromPlace'] = $dataarray['TFromPlace'];
        $asign['TToPlace'] = $dataarray['TToPlace'];
        $asign['DepartDate'] = date("d/m/Y", strtotime(str_replace("/","-", $dataarray['DepartDate'])));
        $asign['ReturnDate'] = $dataarray['RoundTrip'] == 'true'?date("d/m/Y", strtotime(str_replace("/","-", $dataarray['ReturnDate']))):date("d/m/Y", strtotime(str_replace("/","-", $dataarray['DepartDate'])));
        $asign['Adult'] = $dataarray['Adult'];
        $asign['Child'] = $dataarray['Child'];
        $asign['Infant'] = $dataarray['Infant'];

        for($i=1;$i<=15;$i++) {
            if($i == $dataarray['Adult'])
                $asign['Adult'] .= "<option selected value='".$i."'>".$i."</option>";
            else
                $asign['Adult'] .= "<option value='".$i."'>".$i."</option>";
        }
        for($i=0;$i<=15;$i++) {
            if($i == $dataarray['Child'])
                $asign['Child'] .= "<option selected value='".$i."'>".$i."</option>";
            else
                $asign['Child'] .= "<option value='".$i."'>".$i."</option>";
        }
        for($i=0;$i<=15;$i++) {
            if($i == $dataarray['Infant'])
                $asign['Infant'] .= "<option selected value='".$i."'>".$i."</option>";
            else
                $asign['Infant'] .= "<option value='".$i."'>".$i."</option>";
        }
    }
    //var_dump($dataarray['RoundTrip']);
    print_template($asign, 'index');
}