<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_dichvu($data = array())
{
    $asign = array();
    $asign['tieude']="";
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

        $asign['dv_td']="DỊCH VỤ CỦA TOURCOACH";
        $asign['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Trang chủ</a> <i class="fa fa-angle-right"></i> <span>Dịch vụ</span>';
        $asign['name_tt6'] = $data['name_tt6'][0]->Name;
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

        $asign['dv_td']="TOURCOACH SERVICES";
        $asign['tieude'] ='<a href="'.SITE_NAME.'"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> <span>Services</span>';
        $asign['name_tt6'] = $data['name_tt6'][0]->Name_en;
    }

    $asign['dichvu'] = "";
    if (count($data['danhsach']) > 0) {
        $asign['dichvu'] = print_item('dichvu', $data['danhsach']);
    }

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

    print_template($asign, 'dichvu');
}