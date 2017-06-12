<?php
require_once DIR.'/view/default/public.php';
function view_footer($data=array())
{
    $asign=array();

    $asign['trangchu_mn'] = ($data['active'] == 'trangchu') ? 'active' : '';

    $asign['gioithieu_mn'] = ($data['active'] == 'gioithieu') ? 'active' : '';
    $asign['venoidia_mn'] = ($data['active'] == 'venoidia') ? 'active' : '';
    $asign['vequocte_mn'] = ($data['active'] == 'vequocte') ? 'active' : '';
    $asign['dichvu_mn'] = ($data['active'] == 'dichvu') ? 'active' : '';
    $asign['tinkhuyenmai_mn'] = ($data['active'] == 'tinkhuyenmai') ? 'active' : '';

    $asign['logo']=$data['config'][0]->Logo_footer;
    $asign['Hotline']=$data['config'][0]->Hotline;
    $asign['Email']=$data['config'][0]->Email;

    $asign['doitac'] = "";
    if(count($data['doitac'])>0)
    {
        $asign['doitac'] = print_item('doitac', $data['doitac']);
    }

    $asign['venoidia'] = "";
    if(count($data['venoidia'])>0)
    {
        $asign['venoidia'] = print_item('venoidia', $data['venoidia']);
    }

    $asign['thanhtoan'] = "";
    if(count($data['thanhtoan'])>0)
    {
        $asign['thanhtoan'] = print_item('thanhtoan_ft', $data['thanhtoan']);
    }
    if ($_SESSION['kiemtra'] == 1) {

        $asign['ten_menu0'] = "Trang chủ";
        $asign['ten_menu1'] = $data['menu1'][0]->Name;
        $asign['ten_menu2'] = $data['menu2'][0]->Name;
        $asign['ten_menu3'] = $data['menu3'][0]->Name;
        $asign['ten_menu4'] = $data['menu4'][0]->Name;
        $asign['ten_menu5'] = $data['menu5'][0]->Name;
        $asign['ten_menu6'] = $data['menu6'][0]->Name;
        $asign['vect_td']="Về chúng tôi";
        $asign['dc'] ="Địa chỉ";
        $asign['Address']=$data['config'][0]->Address;
        $asign['ten'] = $data['config'][0]->Name;
        $asign['thongtin_td'] ="Thông tin";
        $asign['dv_td']="Dịch vụ";
        $asign['dieukhoan_td']="Điều khoản & điều kiện";
        $asign['cs_td']="Chính sách riêng tư";
        $asign['hd_td']="Hướng dẫn thanh toán";
        $asign['ck_td']="Thông tin chuyển khoản";
        $asign['ch_td']="Câu hỏi thường gặp";
        $asign['vend_td']="Vé nội địa";
        $asign['dkn_td']="Đăng ký nhận bản tin";
        $asign['dth_td']="Đối tác hàng không";
        $asign['ketnnoi_td']="KẾT NỐI VỚI TOURCOACH";
        $asign['antoan_td']="Thanh toán an toàn tại TOURCOACH";

        $asign['dangkybt_td']="Đăng ký";

        $asign['name_tt2'] = $data['name_tt2'][0]->Name;
        $asign['name_tt3'] = $data['name_tt3'][0]->Name;
        $asign['name_tt4'] = $data['name_tt4'][0]->Name;
        $asign['name_tt5'] = $data['name_tt5'][0]->Name;
    }
    else
    {
        $asign['ten_menu0'] = "Home";
        $asign['ten_menu1'] = $data['menu1'][0]->Name_en;
        $asign['ten_menu2'] = $data['menu2'][0]->Name_en;
        $asign['ten_menu3'] = $data['menu3'][0]->Name_en;
        $asign['ten_menu4'] = $data['menu4'][0]->Name_en;
        $asign['ten_menu5'] = $data['menu5'][0]->Name_en;
        $asign['ten_menu6'] = $data['menu6'][0]->Name_en;
        $asign['vect_td']="About us";
        $asign['dc'] ="Address";
        $asign['Address']=$data['config'][0]->Address_en;
        $asign['ten'] = $data['config'][0]->Name_en;
        $asign['thongtin_td'] ="Information";
        $asign['dv_td']="Service";
        $asign['dieukhoan_td']="Terms & Conditions";
        $asign['cs_td']="Privacy policy";
        $asign['hd_td']="Payment instructions";
        $asign['ck_td']="Information transfer";
        $asign['ch_td']="FAQ";
        $asign['vend_td']="Domestic ticket";
        $asign['dkn_td']="Sign up for our newsletter";
        $asign['dth_td']="Airline partners";
        $asign['ketnnoi_td']="CONNECTING TO TOURCOACH";
        $asign['antoan_td']="Secure payment at TOURCOACH";
        $asign['dangkybt_td']="Register";

        $asign['name_tt2'] = $data['name_tt2'][0]->Name_en;
        $asign['name_tt3'] = $data['name_tt3'][0]->Name_en;
        $asign['name_tt4'] = $data['name_tt4'][0]->Name_en;
        $asign['name_tt5'] = $data['name_tt5'][0]->Name_en;
    }
    $asign['Face']=$data['mangxahoi_ft'][0]->Face;
    $asign['Feed']=$data['mangxahoi_ft'][0]->Feed;
    $asign['Twitter']=$data['mangxahoi_ft'][0]->Twitter;
    $asign['Google']=$data['mangxahoi_ft'][0]->Google;
    $asign['Youtube']=$data['mangxahoi_ft'][0]->Youtube;



    $asign['quocgia']="";
    if(count( $data['quocgia'])>0)
    {
        foreach ( $data['quocgia'] as $qg) {
            $asign['quocgia'] .='<option value="'.$qg->sortname.'">'.$qg->name.'</option>';
        }
    }

    print_template($asign,'footer');
}
