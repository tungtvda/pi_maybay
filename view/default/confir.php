<?php
/**
 * Created by PhpStorm.
 * User: tungtv
 * Date: 11/10/14
 * Time: 2:44 PM
 */
require_once DIR . '/view/default/public.php';
require_once DIR . '/common/cls_fast_template.php';
function show_confir($data = array())
{
    $asign = array();
    $asign['Name_dm']= $data['Name_dm'];
    $asign['tieude'] = "";
    if ($_SESSION['kiemtra'] == 1) {
        $asign['sohk_td']="Số hành khách";
        $asign['ngayxuatphat_td']="Ngày xuất phát";
        $asign['loaive_td']="Loại vé";
        $asign['hanhtrinh_td']="Hành trình chuyến đi";
        $asign['venoidia_td']="Vé nội địa";
        $asign['vequocte_td']="Vé quốc tế";
        $asign['datvemaybay_td']="ĐẶT VÉ MÁY BAY";
        $asign['vekhuhoi_td']="Vé khứ hồi";
        $asign['vemotchieu_td']="Vé một chiều";
        $asign['diemdi_td']="Điểm đi";
        $asign['diemden_td']="Điểm đến";
        $asign['ngaydi_td']="Ngày đi";
        $asign['ngayve_td']="Ngày về";
        $asign['nguoilon_td']="người lớn";
        $asign['treem_td']="trẻ em";
        $asign['sosinh_td']="sơ sinh";
        $asign['timchuyenbay_td']="Tìm chuyến bay";
        $asign['tieude'] = '<a href="' . SITE_NAME . '"><i class="fa fa-home"></i> Trang chủ</a> <i class="fa fa-angle-right"></i> <span>Thanh toán</span>';
    } else {
        $asign['sohk_td']="Number of passengers";
        $asign['ngayxuatphat_td']="On the starting";
        $asign['loaive_td']="Ticket type";
        $asign['hanhtrinh_td']="Trip Itinerary";
        $asign['vequocte_td']="International ticket";
        $asign['venoidia_td']="Domestic ticket";
        $asign['datvemaybay_td']="TICKET BOOKING";
        $asign['vekhuhoi_td']="Return Ticket";
        $asign['vemotchieu_td']="One-way ticket";
        $asign['diemdi_td']="Points go";
        $asign['diemden_td']="Destination";
        $asign['ngaydi_td']="Date out";
        $asign['ngayve_td']="Date of";
        $asign['nguoilon_td']="adults";
        $asign['treem_td']="children";
        $asign['sosinh_td']="newborn";
        $asign['timchuyenbay_td']="Find flight";
        $asign['tieude'] = '<a href="' . SITE_NAME . '"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-right"></i> <span>pay</span>';
    }
    $asign['nganhang'] = "";
    if (count($data['nganhang']) > 0) {
        $asign['nganhang'] = print_item('nganhang', $data['nganhang']);
    }

    $asign['vanphong'] = "";
    if (count($data['vanphong']) > 0) {
        $asign['vanphong'] = print_item('vanphong', $data['vanphong']);
    }

    $asign['noi_dung'] = '';

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

    $orderid = '';
    if(isset($_GET['orderid'])) {
        $orderid = $_GET['orderid'];
    }
    $data_datve = $_SESSION['d'.$orderid];
    //var_dump($data_datve);

    if($_GET['method'] == 1) {
        $asign['noi_dung'] .= '
        <div class="don-hang-info">
                <p><label>Mã đơn hàng: </label>'.$orderid.'</p>
                <p><label>Hình thức thanh toán: </label>Thanh toán tại nhà</p>
                <p><label>Tình trạng: </label>Chờ thanh toán</p>
            </div>
            <div class="more-info">
                <h4><span>HƯỚNG DẪN THANH TOÁN</span></h4>
                <p>Quý khách đã lựa chọn hình thức <label class="phuong-thuc">Thanh toán tại nhà</label>. TOURCOACH sẽ đến tận nơi theo địa chỉ Quý khách đã đăng ký để giao vé và thu tiền trong giờ hành chính (08h-17h30) từ thứ 2 đến thứ 7.<br />
                    Với hình thức này, Quý khách sẽ mất thêm phí giao vé là 30,000 đồng<br />
                    Quý khách lưu ý: Hình thức thanh toán này chỉ áp dụng cho khách hàng tại khu vực nội thành Hà Nội . TOURCOACH giao vé và thanh toán tại nhà quý khách trong vòng bán kính 10km so với địa chỉ văn phòng công ty chúng tôi.</p>
                <span><label>Tên người nhân:</label>'.$_POST['hoten-tainha'].'</span>
                <span><label>Địa chỉ nhận</label>'.$_POST['diachi-tainha'].'</span>
                <span><label>Thành phố:</label>'.$_POST['thanhpho-tainha'].'</span>
                <span><label>Điện thoại liên hệ:</label>'.$_POST['sdt-tainha'].'</span>
            </div>
            <div class="more-info">
                <h4><span>Quý khách lưu ý</span></h4>
                <ul>
                    <li>Thông tin đơn hàng của quý khách sẽ được gửi tới địa chỉ email <span>'.(isset($_POST['email_lienhe'])?$_POST['email_lienhe']:"").'</span>.</li>
                    <li>Trong thời gian sớm nhất (trong vòng 12h tới) nhân viên TOURCOACH sẽ liên hệ với Quý khách theo số điện thoại <span class="color-red">'.(isset($_POST['sdt-tainha'])?$_POST['sdt-tainha']:"").'</span> để thông báo kết quả đặt vé và hướng dẫn Quý khách cách thức thanh toán.</li>
                    <li>Không thực hiện Chuyển Khoản hoặc Thanh toán qua Cổng THANH TOÁN TRỰC TUYẾN khi nhân viên Tourcoach chưa liên hệ với Quý khách.</li>
                </ul>
            </div>';
    }
    if($_GET['method'] == 2) {
        $asign['noi_dung'] .= '
        <div class="don-hang-info">
            <p><label>Mã đơn hàng: </label>'.$orderid.'</p>
            <p><label>Hình thức thanh toán: </label>Thanh toán tại văn phòng TOURCOACH</p>
            <p><label>Tình trạng: </label>Chờ thanh toán</p>
        </div>
        <div class="more-info">
            <h4><span>HƯỚNG DẪN THANH TOÁN</span></h4>
            <p>Quý khách đã lựa chọn hình thức <label class="phuong-thuc">Thanh toán tại văn phòng TOURCOACH</label> của chúng tôi. Quý khách vui lòng qua văn phòng TOURCOACH để trực tiếp thanh toán và nhận vé theo địa chỉ sau:</p>
            <div class="dia-chi-van-phong">
                <p class="chuyenbay_datve_tt3">CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TÊ COACH</p>
                <div class="diachit_datve_tt">
                    <p><span class="chuyenbay_datve_tt2">Địa chỉ:</span> B44 Nguyễn Thị Định, Trung Hòa - Nhân Chính, Hà Nội</p>
                    <p><span class="chuyenbay_datve_tt2">Hotlien</span> 043 22 143 / 0986 886 668</p>
                    <p><a><i class="fa fa-map-marker"></i> Xem bản đồ</a></p>
                </div>
                <div class="diachit_datve_tt">
                    <p><span class="chuyenbay_datve_tt2">Địa chỉ:</span> B44 Nguyễn Thị Định, Trung Hòa - Nhân Chính, Hà Nội</p>
                    <p><span class="chuyenbay_datve_tt2">Hotlien</span> 043 22 143 / 0986 886 668</p>
                    <p><a><i class="fa fa-map-marker"></i> Xem bản đồ</a></p>
                </div>
            </div>
        </div>
        <div class="more-info">
            <h4><span>Quý khách lưu ý</span></h4>
            <ul>
                <li>Thông tin đơn hàng của quý khách sẽ được gửi tới địa chỉ email <span>'.(isset($_POST['email_lienhe'])?$_POST['email_lienhe']:"").'</span>.</li>
                <li>Trong thời gian sớm nhất (trong vòng 12h tới) nhân viên TOURCOACH sẽ liên hệ với Quý khách theo số điện thoại <span class="color-red">'.(isset($_POST['sdt_lienhe'])?$_POST['sdt_lienhe']:"").'</span> để thông báo kết quả đặt vé và hướng dẫn Quý khách cách thức thanh toán.</li>
                <li>Không thực hiện Chuyển Khoản hoặc Thanh toán qua Cổng THANH TOÁN TRỰC TUYẾN khi nhân viên Tourcoach chưa liên hệ với Quý khách.</li>
            </ul>
        </div>';
    }
    if($_GET['method'] == 3) {
        $asign['noi_dung'] .= '
        <div class="don-hang-info">
                <p><label>Mã đơn hàng: </label>'.$orderid.'</p>
                <p><label>Hình thức thanh toán: </label>Thanh toán qua chuyển khoản</p>
                <p><label>Tình trạng: </label>Chờ thanh toán</p>
            </div>
            <div class="more-info">
                <h4><span>HƯỚNG DẪN THANH TOÁN</span></h4>
                <p>Quý khách đã lựa chọn hình thức <label class="phuong-thuc">Thanh toán Chuyển khoản ngân hàng</label><span class=""></span></p>
                <p >Vui lòng chọn tài khoản ngân hàng mà Quý khách có thể chuyển khoản một cách tiện lợi nhất</p>
                <p  class="chuyenbay_datve_tt2">Lưu ý khi chuyển khoản:</p>
                <p >Khi chuyển khoản, quý khách vui lòng nhập nội dung chuyển khoản là:</p>
                <p  class="chuyenbay_datve_tt2">"MDH 530172, Nguyen Van A, Noi dung thanh toan"</p>
                <p >VD:</p>
                <p >"MDH 530172, Nguyen Van A, TT vé máy bay"</p>
                <p >"MDH 530172, Nguyen Van A, TT thêm hành khách ký gửi"</p>
                <p >"MDH 530172, Nguyen Van A, TT phí đổi tên, dịch vụ khác"</p>
                <p >Để việc thanh toán được chính xác. Xin cảm ơn quý khách!</p>
                <div class="col-md-12 danhsach_ngan_hang_tt" style="padding-left: 0px; padding-right: 0px">
                    <div class="col-md-3 " style="padding-left: 0px">
                        <img src="{SITE-NAME}/view/default/theme/images/logo-vietcombank.png" class="img-responsive">
                    </div>
                    <div class="col-md-9 " >
                        <p class="chuyenbay_datve_tt2">Ngân hàng cổ phần ngoại thương Việt Nam</p>
                        <p ><span class="nganhang_tentk_tt">Tên tài khoản: </span> CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH</p>
                        <p ><span class="nganhang_tentk_tt">Số tài khoản: </span> 23423423423423</p>
                        <p ><span class="nganhang_tentk_tt">Chi nhánh: </span> Hà Nội</p>
                    </div>
                </div>
                <div class="col-md-12 danhsach_ngan_hang_tt" style="padding-left: 0px; padding-right: 0px">
                    <div class="col-md-3 " style="padding-left: 0px">
                        <img src="{SITE-NAME}/view/default/theme/images/logo-vietcombank.png" class="img-responsive">
                    </div>
                    <div class="col-md-9 " >
                        <p class="chuyenbay_datve_tt2">Ngân hàng cổ phần ngoại thương Việt Nam</p>
                        <p ><span class="nganhang_tentk_tt">Tên tài khoản: </span> CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH</p>
                        <p ><span class="nganhang_tentk_tt">Số tài khoản: </span> 23423423423423</p>
                        <p ><span class="nganhang_tentk_tt">Chi nhánh: </span> Hà Nội</p>
                    </div>
                </div>
                <div class="col-md-12 danhsach_ngan_hang_tt" style="padding-left: 0px; padding-right: 0px">
                    <div class="col-md-3 " style="padding-left: 0px">
                        <img src="{SITE-NAME}/view/default/theme/images/logo-vietcombank.png" class="img-responsive">
                    </div>
                    <div class="col-md-9 " >
                        <p class="chuyenbay_datve_tt2">Ngân hàng cổ phần ngoại thương Việt Nam</p>
                        <p ><span class="nganhang_tentk_tt">Tên tài khoản: </span> CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH</p>
                        <p ><span class="nganhang_tentk_tt">Số tài khoản: </span> 23423423423423</p>
                        <p ><span class="nganhang_tentk_tt">Chi nhánh: </span> Hà Nội</p>
                    </div>
                </div>
                <div class="col-md-12 danhsach_ngan_hang_tt" style="padding-left: 0px; padding-right: 0px">
                    <div class="col-md-3 " style="padding-left: 0px">
                        <img src="{SITE-NAME}/view/default/theme/images/logo-vietcombank.png" class="img-responsive">
                    </div>
                    <div class="col-md-9 " >
                        <p class="chuyenbay_datve_tt2">Ngân hàng cổ phần ngoại thương Việt Nam</p>
                        <p ><span class="nganhang_tentk_tt">Tên tài khoản: </span> CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH</p>
                        <p ><span class="nganhang_tentk_tt">Số tài khoản: </span> 23423423423423</p>
                        <p ><span class="nganhang_tentk_tt">Chi nhánh: </span> Hà Nội</p>
                    </div>
                </div>
                <div class="col-md-12 danhsach_ngan_hang_tt" style="padding-left: 0px; padding-right: 0px">
                    <div class="col-md-3 " style="padding-left: 0px">
                        <img src="{SITE-NAME}/view/default/theme/images/logo-vietcombank.png" class="img-responsive">
                    </div>
                    <div class="col-md-9 " >
                        <p class="chuyenbay_datve_tt2">Ngân hàng cổ phần ngoại thương Việt Nam</p>
                        <p ><span class="nganhang_tentk_tt">Tên tài khoản: </span> CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TẾ COACH</p>
                        <p ><span class="nganhang_tentk_tt">Số tài khoản: </span> 23423423423423</p>
                        <p ><span class="nganhang_tentk_tt">Chi nhánh: </span> Hà Nội</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="more-info">
                <h4><span>Quý khách lưu ý</span></h4>
                <ul>
                    <li>Thông tin đơn hàng của quý khách sẽ được gửi tới địa chỉ email <span>'.(isset($_POST['email_lienhe'])?$_POST['email_lienhe']:"").'</span>.</li>
                    <li>Trong thời gian sớm nhất (trong vòng 12h tới) nhân viên TOURCOACH sẽ liên hệ với Quý khách theo số điện thoại <span class="color-red">'.(isset($_POST['sdt_lienhe'])?$_POST['sdt_lienhe']:"").'</span> để thông báo kết quả đặt vé và hướng dẫn Quý khách cách thức thanh toán.</li>
                    <li>Không thực hiện Chuyển Khoản hoặc Thanh toán qua Cổng THANH TOÁN TRỰC TUYẾN khi nhân viên Tourcoach chưa liên hệ với Quý khách.</li>
                </ul>
            </div>';
    }

    $asign["chi_tiet_don_hang"] = '';
    if($data_datve) {
        $asign["chi_tiet_don_hang"] .= '
        <div style="padding-top: 0px" class="sap_xep_tt noidung_tk_tt gia_td_tt">
            <ul>
                <li>
                    <a>Hãng hàng không</a><br />
                    <img src="'.$data_datve->Id.'" alt="" />
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Mã đơn hàng</a><span style="float: right">'.$data_datve->Id.'</span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Trạng thái</a><span style="float: right">Chờ xác nhận</span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Khách hàng</a><span style="float: right"></span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Tổng giá</a><span style="float: right">'.($data_datve->TicketPrice + $data_datve->ReturnTicketType).'</span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Điểm đi</a><span style="float: right">'.$data_datve->FromPlace.'</span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Điểm đến</a><span style="float: right">'.$data_datve->ToPlace.'</span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Loại vé</a><span style="float: right">'.($data_datve->RoundTrip==true?"Khứ hồi":"Một chiều").'</span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Số hành khách</a><span style="float: right">'.($data_datve->Adult + $data_datve->Child + $data_datve->Infant).'</span>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a>Hành lý thêm</a><span style="float: right">0kg</span>
                    <div class="clearfix"></div>
                </li>
            </ul>
        </div>';
    }
    else {
        $asign["chi_tiet_don_hang"] .= '<p style="text-align: center; font-weight: bold; margin: 10px 0;">Không tồn tại đơn hàng.</p>';
    }
    print_template($asign, 'confir');
}