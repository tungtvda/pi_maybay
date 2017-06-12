<div class="top-page top-page-detail_tt">
    <div class="container">
        <div class=" col-md-12 col-sm-12 col-xs-12 duongdan_tt">
            {tieude}
        </div>
        <div class="book-ticket col-md-12 col-sm-12 col-xs-12">
            <form class="form" action="{SITE-NAME}/tim-kiem-chuyen-bay/" method="post">
                <div class="fields">
                    <input type="radio" name="RoundTrip" value="true" id="ve-khu-hoi" {RoundTripTrue} />
                    <label for="ve-khu-hoi"><span></span>{vekhuhoi_td}</label>
                    <input type="radio" name="RoundTrip" value="false" id="ve-mot-chieu" {RoundTripFalse} />
                    <label for="ve-mot-chieu"><span></span>{vemotchieu_td}</label>
                </div>
                <div class="row row-padding-10">
                    <div class="col-md-2 col-sm-12 chon-dia-diem">
                        <p>{diemdi_td}</p>
                        <input type="text" class="chuyen-bay chieu-di" id="chieu-di" value="{TFromPlace}" name="TFromPlace"/>
                        <input id="hide-chieu-di" type="hidden" name="FromPlace" value="{FromPlace}"/>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <p>{diemden_td}</p>
                        <input type="text" class="chuyen-bay chieu-ve" id="chieu-ve" value="{TToPlace}" name="TToPlace"/>
                        <input id="hide-chieu-ve" type="hidden" name="ToPlace" value="{ToPlace}"/>
                    </div>
                    <div class="col-md-2-2 col-sm-12 date ngay">
                        <div class="row row-padding-10">
                            <div class="col-md-6 col-sm-12">
                                <p>{ngaydi_td}</p>
                                <input type="text" class="chuyen-bay" id="ngay-di" value="{DepartDate}"
                                       name="DepartDate"/>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <p>{ngayve_td}</p>
                                <input type="text" class="chuyen-bay" id="ngay-ve" value="{ReturnDate}" name="ReturnDate"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2-1 col-sm-12 ">
                        <p>{nguoilon_td}</p>
                        <div>
                            <a class="sub" href="#">-</a>
                            <select class="nguoi-lon" id="nguoi-lon" name="adult">
                                {Adult}
                            </select>
                            <a class="sum" href="#">+</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-2-1 col-sm-12">
                        <p>{treem_td}</p>
                        <div>
                            <a class="sub" href="#">-</a>
                            <select class="tre-em" id="tre-em" value="0" name="child">
                                {Child}
                            </select>
                            <a class="sum" href="#">+</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-2-1 col-sm-12">
                        <p>{sosinh_td}</p>
                        <div>
                            <a class="sub" href="#">-</a>
                            <select class="so-sinh" id="so-sinh" value="0" name="infant">
                                {Infant}
                            </select>
                            <a class="sum" href="#">+</a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12 tim-kiem_tt  ">
                        <p><input type="submit" value="{timchuyenbay_td}" name="bntTimKiem" /></p>
                        <input id="hide-noi-dia" type="hidden" name="noi-dia" value="true"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</header>
<section class="content-area container">
<div style="padding-left: 0px;   margin-top: 25px;" class="left_sidebar col-md-9-1 col-sm-9 col-xs-12">

<div class="main-content clearfix">
<div class="tieude_datve_tt">
    <div class="tieude_datve_tt_icon1"></div>
    <span class="thongtin_tt_icon">THÔNG TIN CHUYẾN BAY</span>
</div>
<div class="noidung_tt_datve">
    {noidung_datve}
</div>
{chieu_di}
{chieu_ve}

<div class="tieude_datve_ft">
    <div class="chieu-bay"><span class="mauxanh_tt thongtin_hl" >THÔNG TIN HÀNH LÝ</span></div>
</div>
<div class="noidung_tt_datve">
    <table>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Hành lý sách tay:</td>
            <td class="giatri_datve">Mỗi hành khách được mang tối đa 7kg hành lý sách tay</td>
        </tr>
        <tr>
            <td class="title_datve">Hành lý kýt gửi:</td>
            <td class="giatri_datve">+ Thêm 15kg hành lý (143.000 vnd / người)</td>
        </tr>
        <tr>
            <td class="title_datve"></td>
            <td class="giatri_datve">+ Thêm 20kg hành lý (165.000 vnd / người)</td>
        </tr>
        <tr>
            <td class="title_datve"></td>
            <td class="giatri_datve">+ Thêm 30kg hành lý (270.000 vnd / người)</td>
        </tr>
        <tr>
            <td class="title_datve"></td>
            <td class="giatri_datve">+ Thêm 35kg hành lý (320.000 vnd / người)</td>
        </tr>
        <tr>
            <td class="title_datve"></td>
            <td class="giatri_datve">+ Thêm 40kg hành lý (370.000 vnd / người)</td>
        </tr>

    </table>
</div>
<div class="tieude_datve_ft">
    <div class="chieu-bay"><span class="mauxanh_tt thongtin_hl" >ĐIỀU KIỆN GIÁ VÉ</span></div>
</div>
<div class="noidung_tt_datve" style="margin-bottom: 20px">
    <div class="ma-new-product-title" style="margin-bottom: 30px" ><h2 style="color: #fb9026;">ĐIỀU KIỆN GIÁ VÉ CHIỀU ĐI</h2></div>
    <table>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Thay đổi chuyến bay:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND cộng chênh lệch giá, Trước 24h so với giờ khởi hành</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Thay đổi hành trình:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND cộng chênh lệch giá, Trước 6h so với giờ khởi hành</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Đổi tên hành khách:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND, Trước 24h so với giờ khởi hành</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Bảo lưu vé:</td>
            <td class="giatri_datve">Không được phép</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Hoàn vé:</td>
            <td class="giatri_datve">Không được phép</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Thời hạn thay đổi thông tin chuyến bay:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND cộng chênh lệch giá, Trước 24h so với giờ khởi hành</td>
        </tr>


    </table>
    <div class="ma-new-product-title" style="margin-bottom: 30px" ><h2 style="color: #fb9026;">ĐIỀU KIỆN GIÁ VÉ CHIỀU VỀ</h2></div>
    <table>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Thay đổi chuyến bay:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND cộng chênh lệch giá, Trước 24h so với giờ khởi hành</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Thay đổi hành trình:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND cộng chênh lệch giá, Trước 6h so với giờ khởi hành</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Đổi tên hành khách:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND, Trước 24h so với giờ khởi hành</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Bảo lưu vé:</td>
            <td class="giatri_datve">Không được phép</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Hoàn vé:</td>
            <td class="giatri_datve">Không được phép</td>
        </tr>
        <tr >
            <td class="title_datve" style="padding-bottom: 10px;">Thời hạn thay đổi thông tin chuyến bay:</td>
            <td class="giatri_datve">Được phép - Thu phí:355.000 VND cộng chênh lệch giá, Trước 24h so với giờ khởi hành</td>
        </tr>


    </table>
</div>
    <!--<form class="form" action="{SITE-NAME}/confirmation/" method="post">-->
<form class="form datve-form" action="" method="post">
<div class="tieude_datve_tt">
    <div class="tieude_datve_tt_icon2">

    </div>
    <span class="thongtin_tt_icon">THÔNG TIN HÀNH KHÁCH</span>
</div>
<div class="noidung_tt_datve" style="margin-bottom: 20px">
    <p>Thông tin phải chính xác như trên giấy tờ tùy thân(CMND, Hộ Chiếu, giấy phép lái xe...). Quý khách bị từ chối vận chuyển nếu thông tin không chính xác. Vui lòng nhập thông tin bằng tiếng Việt không dấu.</p>
    <div class="thongtin_date_noidung table-responsive" >
		<table class="table">
			<tr>
				<th>
					<p class="chuyenbay_datve_tt3">Hành khách</p>
				</th>
				<td>
					<p class="chuyenbay_datve_tt3">Qúy danh</p>
				</td>
				<th>
					<label class="chuyenbay_datve_tt3 ">Họ <span class="batcuoc_tt">(*)</span></label>
				</th>
				<th>
					<label class="chuyenbay_datve_tt3 ">Tên lót</span></label>
				</th>
				<th>
					<label class="chuyenbay_datve_tt3 ">Tên <span class="batcuoc_tt">(*)</span></label>
				</th>
				<th>
					<p class="chuyenbay_datve_tt3 ">Ngày <span class="batcuoc_tt">(*)</span></p>
				</th>
				<th>
					<p class="chuyenbay_datve_tt3 ">Tháng <span class="batcuoc_tt">(*)</span></p>
				</th>
				<th>
					<p class="chuyenbay_datve_tt3 ">Năm <span class="batcuoc_tt">(*)</span></p>
				</th>
			</tr>

			{nguoi_lon}
			{tre_em}
			{so_sinh}
		</table>




    </div>
</div>

<div class="tieude_datve_tt">
    <div class="tieude_datve_tt_icon3"></div>
    <span class="thongtin_tt_icon">THÔNG TIN LIÊN HỆ</span>
</div>
<div class="noidung_tt_datve" style="margin-bottom: 20px">
    <p>
        Thông tin này giúp chúng tôi liên lạc với quý khách để thông báo cập nhật lịch bay thay đổi và gửi vé điện tử cho quý khách
    </p>
    <div class="thongtin_date_noidung" >
        <div class="nguoilon_1 ">
				<span class="chuyenbay_datve_tt2">
				   Người đại diện:
				</span>
        </div>
        <div class="nguoilon_thongtin_tt row row-padding-10">
            <div class="col-md-2 col-sm-6 col-xs-12 quy-danh">
                <p class="chuyenbay_datve_tt3">Qúy danh</p>
                <label>
                    <select class="quydanh_1_tt" name="quydanh_lienhe" >
                        <option value="1">Ông</option>
                        <option value="2">Bà</option>
                        <option value="1">Anh</option>
                        <option value="2">Chị</option>
                    </select>
                </label>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right: 15px !important;">
                <p class="chuyenbay_datve_tt3">Họ và tên <span class="batcuoc_tt">(*)</span></p>
                <input type="text" class="input_hoten_tt" name="hoten_lienhe" required />
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 ngay-thang-nam quy-danh frm_ngaysinh">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4 ">
                        <p class="chuyenbay_datve_tt3">Ngày sinh</p>
                        <label>
                            <select class="quydanh_1_tt" name="ngaysinh_lienhe">
                                <option value="">Ngày</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p class="chuyenbay_datve_tt3">&nbsp;</p>
                        <label>
                            <select class="quydanh_1_tt" name="thang_lienhe" >
                                <option value="">Tháng</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p class="chuyenbay_datve_tt3">&nbsp;</p>
                        <label>
                            <select class="quydanh_1_tt" name="nam_lienhe" >
                                <option value="">Năm</option>
                                <option value="1950">1950</option>
                                <option value="1951">1951</option>
                                <option value="1952">1952</option>
                                <option value="1953">1953</option>
                                <option value="1954">1954</option>
                                <option value="1955">1955</option>
                                <option value="1956">1956</option>
                                <option value="1957">1957</option>
                                <option value="1958">1958</option>
                                <option value="1959">1959</option>
                                <option value="1960">1960</option>
                                <option value="1961">1961</option>
                                <option value="1962">1962</option>
                                <option value="1963">1963</option>
                                <option value="1964">1964</option>
                                <option value="1965">1965</option>
                                <option value="1966">1966</option>
                                <option value="1967">1967</option>
                                <option value="1968">1968</option>
                                <option value="1969">1969</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                                <option value="1975">1975</option>
                                <option value="1976">1976</option>
                                <option value="1977">1977</option>
                                <option value="1978">1978</option>
                                <option value="1979">1979</option>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="nguoilon_1 nguoilon_2">
            <span class="chuyenbay_datve_tt2">
                &nbsp;
            </span>
        </div>
        <div class="nguoilon_thongtin_tt row row-padding-10">
            <div class="col-md-4" >
                <p class="chuyenbay_datve_tt3">Số điện thoại di động <span class="batcuoc_tt">(*)</span></p>
                <input type="number" class="input_hoten_tt" name="sdt_lienhe" required  />
            </div>
            <div class="col-md-8" style="padding-left: 0px">
                <p class="chuyenbay_datve_tt3">Email <span class="batcuoc_tt">(*)</span></p>
                <input type="email" class="input_hoten_tt" name="email_lienhe" required >
            </div>
        </div>

        <div class="nguoilon_1 nguoilon_2">
            <span class="chuyenbay_datve_tt2">&nbsp;</span></div>
        <div class="nguoilon_thongtin_tt row row-padding-10">
            <div class="col-md-12" >
                <p class="chuyenbay_datve_tt3">Địa chỉ </p>
                <input type="text" class="input_hoten_tt" name="diachi_lienhe" />
            </div>
        </div>
        <div class="nguoilon_1 nguoilon_2"><span class="chuyenbay_datve_tt2">&nbsp;</span></div>
        <div class="nguoilon_thongtin_tt row row-padding-10">
            <div class="col-md-12" >
                <p class="chuyenbay_datve_tt3">Yêu cầu </p>
                <textarea name="yeucau_lienhe"  class="input_hoten_tt"></textarea>
            </div>
        </div>
        <div class="nguoilon_1 nguoilon_2"><span class="chuyenbay_datve_tt2">&nbsp;</span></div>
        <div class="nguoilon_thongtin_tt row row-padding-10">
            <div class="col-md-12" >
                <input type="checkbox" name="xuathoadon" id="xuathoadon" value="true"> Tôi muốn xuất hóa đơn
            </div>
        </div>
        <div class="hienhoadon">
            <div class="nguoilon_1 nguoilon_2"><span class="chuyenbay_datve_tt2">&nbsp;</span></div>
            <div  class="nguoilon_thongtin_tt">
                <div class="col-md-12 " >
                    <div class="chitiet_hoadon_tt">
                        <p class="chitiet_p_tt" >CHI TIẾT HÓA ĐƠN</p>
                        <p>
                            Qúy khách có nhu cầu lấy hóa đơn giá trị gia tăng phải yêu cầu với phía Tourcoach trong vòng 7 ngày kể từ thời điểm thanh toán đơn hàng.</br>
                            Quý khách vui lòng nhập tiếng Việt có dấu để việc xuất hóa đơn tránh bị sai xót.
                        </p>
                        <div class="nguoilon_thongtin_tt" style="width: 100%">
                            <div class="col-md-4" style="padding-left: 0px" >
                                <p class="chuyenbay_datve_tt3">Mã số thuế<span class="batcuoc_tt">(*)</span></p>
                                <input type="text" class="input_hoten_tt" name="masothue" required disabled="disabled" />
                            </div>

                            <div class="col-md-8" style="padding-left: 0px">
                                <p class="chuyenbay_datve_tt3">Tên công ty <span class="batcuoc_tt">(*)</span></p>
                                <input type="text" class="input_hoten_tt" name="tencongty" required disabled="disabled" />
                            </div>

                        </div>
                        <div class="nguoilon_thongtin_tt" style="width: 100%">
                            <div class="col-md-12" style="padding-left: 0px">
                                <p class="chuyenbay_datve_tt3">Địa chỉ công ty <span class="batcuoc_tt">(*)</span></p>
                                <input type="text" class="input_hoten_tt" name="diachicongty" required disabled="disabled" />
                            </div>
                        </div>
                        <div class="nguoilon_thongtin_tt" style="width: 100%">
                            <div class="col-md-12" style="padding-left: 0px">
                                <p class="chuyenbay_datve_tt3">Địa chỉ nhận hóa đơn</p>
                                <input type="text" class="input_hoten_tt" name="diachinhanhoadon" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tieude_datve_tt">
    <div class="tieude_datve_tt_icon3"></div>
    <span class="thongtin_tt_icon">CHỌN HÌNH THỨC THANH TOÁN</span>
</div>
<div class="noidung_tt_datve" style="margin-bottom: 20px">
    <div class="col-md-12 col-sm-12 col-xs-12 chinhsach_tt">
        Yêu cầu về Điều khoản thanh toán (3 yêu cầu bắt buộc):
        1.	Hiển thị tương phản với màu nền website, ngôn ngữ hiển thị tiếng Việt (với ĐV chạy cổng quốc tế thì cần thêm tiếng Anh). Điều khoản thanh toán phải hiển thị cùng với thông tin khách hàng và đơn hàng trong quá trình thanh toán. Hiển thị dưới dạng Scroll box, không hiển thị dưới dạng Hyperlink, pop up sang 1 trang khác.
        2.	Khách hàng phải đọc, đồng ý với Điều khoản thanh toán thì mới chuyển sang được cổng thanh toán OnePAY.
        3.	Điều khoản thanh toán bắt buộc phải có các nội dung sau:
        •	Chính sách vận chuyển và giao nhận:
        •	Biểu phí liên quan nếu có
        •	Chính sách đổi/ trả hàng
        •	Chính sách hủy dịch vụ
        •	Chính sách no- show (áp dụng với dịch vụ KH phải đến tận nơi để sử dụng như vé xem phim, vé máy bay, vé tầu, dịch vụ khách sạn, dịch vụ du lịch…)
        •	Chính sách bảo hành sản phẩm (nếu có);

        Hình ảnh minh họa yêu cầu hiển thị của Điều khoản thanh toán


        NỘI DUNG ĐIỀU KHOẢN THANH TOÁN (MẪU)
        1.	Chính sách vận chuyển
        Phương thức vận chuyển: Chúng tôi sẽ giao hàng hóa/ sản phẩm cho quý khách qua đường bưu điện theo địa chỉ người nhận hàng mà Quý khách đã đăng ký khi đặt hàng.
        Thời gian giao hàng:
        •	Đối với các đơn hàng tại Hà Nội (áp dụng với các quận Ba Đình, Hoàn Kiếm, Đống Đa, Hai Bà Trưng, Cầu Giấy, Tây Hồ, Hoàng Mai, Thanh Xuân), Quý khách sẽ nhận được sản phẩm trong ngày (đối với các đơn hàng phát sinh trong buổi sáng hoặc buổi chiều) hoặc dưới 24 tiếng (đối với các đơn hàng phát sinh sau 18h).
        •	Các đơn hàng tại TP. Hồ Chí Minh, thời gian giao hàng dưới 24 tiếng.
        •	Các tỉnh thành khác, thời gian giao hàng là từ 18 tiếng đến 72 tiếng.
        (Quý khách vui lòng cộng thêm 24 tiếng nếu thời gian đặt hàng nằm trong khoảng 18h Thứ bảy đến 12h trưa Chủ nhật).
        Nếu quá thời hạn giao hàng đã cam kết mà Quý khách vẫn chưa nhận được sản phẩm đã đặt, Quý khách vui lòng thông báo tới bộ phận Chăm sóc khách hàng của Chúng tôi theo số điện thoại …. hoặc địa chỉ email ……  để được hỗ trợ.
        Phí vận chuyển: Chúng tôi áp dụng chính sách phí vận chuyển như sau:….
        2.	Chính sách đổi/trả hàng:
        Các trường hợp đổi hàng

        • Đối với sản phẩm nước hoa: quý khách sẽ được đổi hàng trong vòng 7 ngày kể từ khi nhận hàng (với khách hàng ở tỉnh gởi về sẽ căn cứ ngày gởi theo dấu bưu điện) trong các trường hợp: CHÚNG TÔI giao nhầm màu, nhầm size, nhầm sản phẩm, hàng hóa bị hư hỏng trong quá trình đi giao. Hàng được đổi phải có giá trị bằng hoặc cao hơn so với hàng khách đã chọn trước đó. Nếu khách hàng chọn sản phẩm có giá trị thấp hơn, CHÚNG TÔI sẽ không hoàn trả lại số tiền chênh lệch.

        • Đối với sản phẩm….(ĐV bổ sung nếu có)

        Các trường hợp không chấp nhận đổi hàng:

        • Quý khách muốn thay đổi mẫu mã, chủng loại nhưng không thông báo trước.
        • Quý khách vận hành không đúng theo chỉ dẫn, gây hỏng hóc sản phẩm.
        • Quý khách đã kiểm tra và ký nhận sản phẩm nhưng sau đó yêu cầu đổi/trả hàng với lý do lỗi ngoại quan (trầy xước, vỡ….

        Điều kiện đổi hàng
        • Điều kiện về thời gian đổi hàng: trong vòng 7 ngày kể từ khi nhận được hàng.
        • Điều kiện về sản phẩm nước hoa: sản phẩm nguyên tem, không bị dơ bẩn, hư hỏng, trầy xước, có mùi. Đầy đủ các phụ kiện hoặc tặng phẩm (nếu có).
        • Điều kiện về hóa đơn, chứng từ: phiếu giao hàng hoặc hóa đơn đỏ (nếu có),...

        Quy trình, cách thức đổi hàng cho khách hàng:

        Bước 1: Xác nhận tình trạng hàng đổi
        Trong vòng 7 ngày, kể từ ngày nhận sản phẩm, nếu sản phẩm thuộc các trường hợp được đổi hàng, khách hàng tiến hành chụp hình hiện trạng của sản phẩm: Thấy rõ mã hàng, tem của CHÚNG TÔI, chỗ sản phẩm hư hỏng, trầy xướt.... Sau đó liên hệ trực tiếp bộ phận Chăm sóc Khánh hàng của CHÚNG TÔI qua hotline để thông báo thông tin và gửi hình ảnh đến CHÚNG TÔI để xác nhận.

        Bước 2: CHÚNG TÔI xác nhận
        CHÚNG TÔI sau khi nhận được thông tin sẽ tiến hành xác nhận tình trạng hàng hóa và xác nhận cho khách hàng là có được đổi hay không.
        Sau khi được xác nhận hàng được chấp nhận đổi trả, vui lòng giữ hàng hóa trong trạng thái nguyên tem, mã hàng của CHÚNG TÔI như ban đầu cùng giấy tờ liên quan:
        + Hóa đơn bán lẻ, Phiếu giao hàng.
        + Điền đầy đủ thông tin vào Phiếu đổi hàng.

        Bước 3: Khách hàng gởi hàng
        Quý khách gửi lại sản phẩm còn nguyên trong bao bì cùng các giấy tờ đã được nêu ở Bước 2 đến cho CHÚNG TÔI theo địa chỉ: ……… từ 8h30-17h30 (thứ 2 đến thứ 6). Nếu trường hợp khách hàng đến trực tiếp cửa hàng, cần gọi điện theo số ……….. để thông báo trước.

        Bước 4: CHÚNG TÔI xác nhận và gởi hàng cho khách hàng
        Sau khi đã nhận, kiểm tra và chấp nhận sản phẩm mà Quý khách muốn đổi, bộ phận chăm sóc khách hàng sẽ liên hệ để đổi hàng và gởi hàng lại cho Quý khách

        LƯU Ý: Nếu hàng hóa gởi về CHÚNG TÔI không đáp ứng điều kiện đổi đã nêu ở trên hoặc không đủ điều kiện để bán lại, khách hàng sẽ chịu trách nhiệm chi trả phần thiệt hại cho CHÚNG TÔI hoặc được cộng thêm vào số tiền mà Quý khách phải chi trả cho sản phẩm được đổi.

        3.	Chính sách hủy đơn hàng
        Chúng tôi chấp nhận cho Quý khách thực hiện hủy đơn hàng trong vòng 24h kể từ thời điểm Quý khách thanh toán thành công.  Quý khách vui lòng liên hệ với Chúng tôi theo số điện thoại….và gửi email về địa chỉ….để được hỗ trợ hủy đơn hàng.
        -  Nếu quý khách hủy đơn hàng trước khi hàng được vận chuyển, thông thường là trong vòng 1 giờ kể từ lúc nhân viên bán hàng liên hệ xác nhận đặt hàng, Chúng tôi sẽ hoàn trả 100% tiền cho những quý khách đã thanh toán.
        -  Nếu quý khách hủy đơn hàng sau khi hàng đã được vận chuyển, Chúng tôi sẽ giải quyết hoàn tiền cho quý khách sau khi đã trừ các chi phí phát sinh của đơn hàng như: phí vận chuyển, phí thanh toán, phí gói quà,…
        Để biết tình trạng hiện tại của đơn hàng, quý khách vui lòng xem trong mục Quản lý đơn hàng trên website…..hoặc liên hệ theo số điện thoại….địa chỉ email…..
        Quá thời gian qui định trên, mọi yêu cầu hủy đơn hàng của Quý khách sẽ không được chấp nhận.
        Mọi thắc mắc về thủ tục đổi hàng, hủy đơn hàng xin vui lòng liên hệ theo thông tin sau:
        (Bổ sung thông tin ĐV…..)



    </div>

    <div class="check-term-and-condition"><input type="checkbox" name="check-term-and-condition" required> Tôi đã đọc và đồng ý điều khoản trên.</div>
    <ul class="nav nav-tabs  tab_datve" role="tablist">
        <li style="padding-left: 0px" role="presentation" class="active">
            <a href="#online-pay-tab" aria-controls="home" role="tab" data-toggle="tab">THANH TOÁN QUA CÁC CỔNG THANH TOÁN ĐIỆN TỬ</a>
        </li>
        <li  role="presentation">
            <a href="#money-pay-tab" aria-controls="profile" role="tab" data-toggle="tab">THANH TOÁN BẰNG TIỀN MẶT TẠI VP TOURCOACH</a>
        </li>
        <li role="presentation">
            <a href="#home-pay-tab" aria-controls="settings" role="tab" data-toggle="tab">THANH TOÁN TẠI NHÀ (+30.000VNĐ)</a>
        </li>
        <li style="padding-right: 0px" role="presentation">
            <a href="#transfer-pay-tab" aria-controls="settings2" role="tab" data-toggle="tab">THANH TOÁN CHUYỂN KHOẢN</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active tab_noidung_tt" id="online-pay-tab">
            <p style="margin-bottom: 20px">Qúy khách có thể thanh toán ngay (trực tuyến) thông qua cổng OnePay, Bảo Kim, Ngân Lượng, 123Pay, SenPay</p>
            <div class="col-md-6" style="padding-left: 0px">
                <p class="chuyenbay_datve_tt3">THẺ GHI NỢ NỘI ĐỊA</p>
                <div class="">
                    <img src="{SITE-NAME}//view/default/theme/images/thanh-toan-noi-dia.jpg" alt="" />
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <input name="onepay-noidia" type="submit" class="nut_xanh_tt" value="Chọn hình thức thanh toán này">
                </div>
            </div>
            <div class="col-md-6" style="border-left: 1px solid #e6e6e6;">
                <p class="chuyenbay_datve_tt3">THẺ THANH TOÁN QUỐC TẾ (VISA, MASTERCARD, JCB)</p>
                <div class="">
                    <img src="{SITE-NAME}//view/default/theme/images/thanh-toan-quoc-te.jpg" alt="" />
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <input name="onepay-quocte" type="submit" class="nut_xanh_tt" value="Chọn hình thức thanh toán này">
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane tab_noidung_tt" id="money-pay-tab">
            <p style="margin-bottom: 20px">Sau khi đặt hàng thành công, Quý khách vui lòng qua văn phòng Tourcoach để thanh toán và nhận vé. Chấp nhận tiền mặt hoặc cả thẻ tại văn phòng.</p>
            <div class="col-md-12" style="padding-left: 0px">
                <p class="chuyenbay_datve_tt3">CÔNG TY TNHH DỊCH VỤ - VẬN TẢI VÀ LỮ HÀNH QUỐC TÊ COACH</p>
                {vanphong}
                <div style="text-align: center">
                    <input name="thanh-toan-vanphong" type="submit" class="nut_xanh_tt" value="Chọn hình thức thanh toán này">
                </div>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane tab_noidung_tt" id="home-pay-tab">
            <p style="margin-bottom: 20px">Với hình thức này, quý khách sẽ mất phí giao vé là 30,000 vnđ. Quý khách vui lòng điền đầy đủ thông tin địa chỉ để nhân viên Tourcoach Giao é và thu tiền</p>
            <div class="col-md-12" style="padding-left: 0px">
                <p class="batcuoc_tt">Lưu ý: Hình thức thanh toán này chỉ áp dụng cho các địa chỉ tại khu vực nội thành Hà Nội</p>
                <div class="thongtin_vanchuyen_tt">
                    <div class="nguoilon_thongtin_tt" style="width: 100%">
                        <div class="col-md-6" style="padding-left: 0px; padding-right: 5px" >
                            <p class="chuyenbay_datve_tt3">Họ và tên<span class="batcuoc_tt">(*)</span></p>
                            <input type="text" class="input_hoten_tt" name="hoten-tainha" required disabled="disabled" />
                        </div>
                        <div class="col-md-6" style="padding-right: 0px; padding-left: 5px">
                            <p class="chuyenbay_datve_tt3">Số điện thoại <span class="batcuoc_tt">(*)</span></p>
                            <input type="text" class="input_hoten_tt" name="sdt-tainha" required disabled="disabled" />
                        </div>
                        <div class="col-md-6" style="padding-left: 0px; margin-top: 10px; padding-right: 5px" >
                            <p class="chuyenbay_datve_tt3">Địa chỉ<span class="batcuoc_tt">(*)</span></p>
                            <input type="text" class="input_hoten_tt" name="diachi-tainha" required disabled="disabled" />
                        </div>
                        <div class="col-md-6" style="padding-right: 0px; margin-top: 10px;padding-left: 5px ">
                            <p class="chuyenbay_datve_tt3">Thành phố <span class="batcuoc_tt">(*)</span></p>
                            <input type="text" class="input_hoten_tt" name="thanhpho-tainha" required disabled="disabled" />
                        </div>
                        <div class="col-md-12" style="text-align: right; padding-top: 20px; padding-right: 0px">
                            <input name="thanh-toan-tainha" type="submit" class="nut_xanh_tt" value="Chọn hình thức thanh toán này" disabled="disabled">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane tab_noidung_tt" id="transfer-pay-tab">
            <p style="margin-bottom: 20px">Quý khách có thể thanh toán cho chúng tôi bằng cách chuyển khoản trực tiếp tại ngân hàng qua thẻ atm hoặc qua interner banhking.</p>
            <p >Vui lòng chọn tài khoản ngân hàng mà Quý khách có thể chuyển khoản một cách tiện lợi nhất</p>
            <p  class="chuyenbay_datve_tt2">Lưu ý khi chuyển khoản:</p>
            <p >Khi chuyển khoản, quý khách vui lòng nhập nội dung chuyển khoản là:</p>
            <p  class="chuyenbay_datve_tt2">"MDH 530172, Nguyen Van A, Noi dung thanh toan"</p>
            <p >VD:</p>
            <p >"MDH 530172, Nguyen Van A, TT vé máy bay"</p>
            <p >"MDH 530172, Nguyen Van A, TT thêm hành khách ký gửi"</p>
            <p >"MDH 530172, Nguyen Van A, TT phí đổi tên, dịch vụ khác"</p>
            <p >Để việc thanh toán được chính xác. Xin cảm ơn quý khách!</p>
           {nganhang}
            <div class="col-md-12" style="text-align: right; padding-top: 20px; padding-right: 0px">
                <input name="thanh-toan-nganhang" type="submit" class="nut_xanh_tt" value="Chọn hình thức thanh toán này">
            </div>
        </div>
    </div>
</div>
</form>
</div>
</div>

<div style="padding-right: 0px" class="right_sidebar col-md-3-right col-sm-3 col-xs-12">
    <div class="chi-tiet-ve-dat">
        <div class="tieude_tt"><h3>CHI TIẾT GIÁ VÉ</h3></div>
        {chi_tiet_ve_di}
        {chi_tiet_ve_ve}
        {tong_ve}
    </div>
    <div class="fb-page" data-href="https://www.facebook.com/facebook" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
</div>

