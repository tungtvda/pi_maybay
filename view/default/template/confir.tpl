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
<div class="left_sidebar col-md-9-1 col-sm-9 col-xs-12;" style="padding-left: 0px; margin-top: 25px;">
    <div class="main-content clearfix">
        <div class="tieude_datve_tt">
            <div class="tieude_datve_tt_icon4"></div>
            <span class="thongtin_tt_icon">{Name_dm}</span>
        </div>
        <div class="noidung_tt_datve">
            <h3>Yêu cầu đặt vé của quý khách đã được xử lý trên hệ thống của chúng tôi.</h3>
            {noi_dung}
        </div>
    </div>
</div>
<div style="padding-right: 0px" class="right_sidebar col-md-3-right col-sm-3 col-xs-12">
    <div class="chi-tiet-ve-dat">
        <div class="tieude_tt"><h3>THÔNG TIN ĐẶT VÉ</h3></div>
        {chi_tiet_don_hang}
    </div>
    <div class="fb-page" data-href="https://www.facebook.com/facebook" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
</div>

