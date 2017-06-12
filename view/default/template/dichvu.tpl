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
    <div class="services-tourcouch box">
        <h2 class="title">{dv_td}</h2>
        <div class=" motadichvu_tt col-md-12 col-sm-12 col-xs-12">
            <p>{name_tt6}</p>
        </div>
        <div class=" danhsachdv_tt col-xs-12 col-md-12 col-sm-12">
            {dichvu}

        </div>
    </div>

