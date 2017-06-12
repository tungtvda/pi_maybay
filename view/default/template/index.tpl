<div class="top-page home-page">
    <div class="container">
		<div class="row row-no-padding">
			<div class="book-ticket col-lg-8 col-md-12 col-sm-12">
				<h3 class="title-dat-ve">{datvemaybay_td}</h3>
                <form class="form" action="{SITE-NAME}/tim-kiem-chuyen-bay/" method="post">
                    <div class="fields row">
                        <div class="col-md-12 col-sm-12">
                            <input type="radio" name="RoundTrip" value="true" id="ve-khu-hoi" {RoundTripTrue} />
                            <label for="ve-khu-hoi"><span></span>{vekhuhoi_td}</label>
                            <input type="radio" name="RoundTrip" value="false" id="ve-mot-chieu" {RoundTripFalse} />
                            <label for="ve-mot-chieu"><span></span>{vemotchieu_td}</label>
                        </div>
                    </div>
                    <div class="row row-padding-10">
                        <div class="col-md-4 col-sm-12 chon-dia-diem">
                            <p>{diemdi_td}</p>
                            <input type="text" class="chuyen-bay chieu-di" id="chieu-di" value="{TFromPlace}" name="TFromPlace" />
                            <input id="hide-chieu-di" type="hidden" name="FromPlace" value="{FromPlace}"/>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <p>{diemden_td}</p>
                            <input type="text" class="chuyen-bay chieu-ve" id="chieu-ve" value="{TToPlace}" name="TToPlace" />
                            <input id="hide-chieu-ve" type="hidden" name="ToPlace" value="{ToPlace}"/>
                        </div>
                        <div class="col-md-4 col-sm-12 date">
                            <div class="row row-padding-10">
                                <div class="col-md-6 col-sm-12">
                                    <p>{ngaydi_td}</p>
                                    <input type="text" class="chuyen-bay" id="ngay-di" value="{DepartDate}" name="DepartDate" />
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p>{ngayve_td}</p>
                                    <input type="text" class="chuyen-bay" id="ngay-ve" value="{ReturnDate}" name="ReturnDate" />
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row row-padding-10">
                        <div class="col-md-4 col-sm-12">
                            <p>Class</p>
                            <div class="quy-danh">
                                <label>
                                    <select class="inputselect_box"  name="">
                                        <option value="Economy">Economy</option>
                                        <option value="Economy">Economy</option>
                                    </select>
                                </label>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <p>{nguoilon_td} (>12)</p>
                            <div>
                                <a class="sub" href="#">-</a>
                                <select class="nguoi-lon" id="nguoi-lon" name="adult">
                                    {Adult}
                                </select>
                                <a class="sum" href="#">+</a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <p>{treem_td} (2>12)</p>
                            <div>
                                <a class="sub" href="#">-</a>
                                <select class="tre-em" id="tre-em" value="0" name="child">
									{Child}
                                </select>
                                <a class="sum" href="#">+</a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <p>{sosinh_td}(0>2)</p>
                            <div>
                                <a class="sub" href="#">-</a>
                                <select class="so-sinh" id="so-sinh" value="0" name="infant">
									{Infant}
                                </select>
                                <a class="sum" href="#">+</a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row row-padding-10">
                        <div class="col-md-6 col-sm-12 tim-kiem">
                            <p><input type="submit" value="{timchuyenbay_td}" name="bntTimKiem" /></p>
                        </div>
                        <div class="col-md-6 col-sm-12 logo-coarch">
                            <a href="#"><img src="{SITE-NAME}/view/default/theme/images/logo-coach.jpg" alt="" /></a>
                        </div>
                    </div>
                </form>
			</div>
			<div class="advs top-adv col-lg-4">
			   <a class="visible-lg-block" href="{link_qc}"><img src="{img_qc}" alt="{Name_qc}" title="{Name_qc}" /></a>
			</div>
		</div>
    </div>
</div>
</header>
<section class="content-area container">
<div class="cac-tieu-chi">
    <div class="row row-padding-15">
      {tieuchi}
    </div>
</div>
<div class="group-mb">
    <div class="row">
        <div class="col-md-7 col-sm-12 col-xs-12 ve-hot">
            <div class="tab-group">
                <ul>
                    <li rel="ve-noi-dia" class="active"><a href="#">{venoidia_td}</a></li>
                    <li rel="ve-quoc-te"><a href="#">{vequocte_td}</a></li>
                </ul>
                <div class="ve-hot-icon"></div>
            </div>
            <div class="clearfix"></div>
            <div class="group-content">
                <table class="list-ve ve-noi-dia">
                    {venoidia_index}
                </table>
                <table class="list-ve ve-quoc-te">
                   {vequocte_index}
                </table>
            </div>
        </div>
        <div class="col-md-5 col-sm-12 col-xs-12 support box">
            <h2 class="title">{hotro_ol}</h2>
            <div class="support-panel call">
                <h3>{call_ol}</h3>
                <div class="hotline-support">
                    <p>{ol_ol}<span>{Hotlien_datve}</span></p>
                </div>
            </div>
            <div class="support-panel chat">
                <h3>{chat_ol}<span>{tuvan_ol}</span></h3>
                {danhmuchotro}
            </div>
            <div class="support-panel connect-social">
                <h3>{mang_ol}</h3>
                <ul class="social-list">
                    <li class="facebook"><a href="http://www.facebook.com/{Face}"></a></li>
                    <li class="twitter"><a href="http://www.twitter.com/{Twitter}"></a></li>
                    <li class="googleplus"><a href="https://plus.google.com/{Google}"></a></li>
                    <li class="youtube"><a href="https://www.youtube.com/{Youtube}"></a></li>
                    <li class="linkedin"><a href="http://feeds.feedburner.com/{Feed}"></a></li>
                    <li class="kakaostory"><a href="#"></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="services-tourcouch box">
    <h2 class="title">{dv_td}</h2>
    <div class="servies-us row">
        <div class="col-md-3 col-sm-4 col-xs-12 img-thumb">
            <img src="{img_gt}" alt="{gioithieu_td}" title="{gioithieu_td}" />
        </div>
        <div class="col-md-9 col-sm-8 col-xs-12 service-content">
            <h3>{gioithieu_td}</h3>
            <p>{gioithieu}<a href="{SITE-NAME}/gioi-thieu.html">{chitiet_td} »</a></p>
            <h4>{taisao_td}?</h4>
            <ul class="cam-ket row">
                <li class="col-md-4 col-sm-6 col-xs-6"><a href="{SITE-NAME}/gioi-thieu.html"><i class="fa fa-usd"></i>{gia_td}</a></li>
                <li class="col-md-4 col-sm-6 col-xs-6"><a href="{SITE-NAME}/gioi-thieu.html"><i class="fa fa-check"></i>{km_td}</a></li>
                <li class="col-md-4 col-sm-6 col-xs-6"><a href="{SITE-NAME}/gioi-thieu.html"><i class="fa fa-hand-o-right"></i>{thanhtoan_td}</a></li>
                <li class="col-md-4 col-sm-6 col-xs-6"><a href="{SITE-NAME}/gioi-thieu.html"><i class="fa fa-search"></i>{tk_td}</a></li>
                <li class="col-md-4 col-sm-6 col-xs-6"><a href="{SITE-NAME}/gioi-thieu.html"><i class="fa fa-hand-o-right"></i>{dichvu_td}</a></li>
                <li class="col-md-4 col-sm-6 col-xs-6"><a href="{SITE-NAME}/gioi-thieu.html"><i class="fa fa-user"></i>{tantinh_td}</a></li>
            </ul>
        </div>
    </div>
    <div class="service-slider">
        <div class="row wow">
            <div class="owl-carousel owl-theme service-owl-carousel">
                {dichvu}
            </div>
        </div>
    </div>
</div>
<div class="khuyen-mai box">
    <h2 class="title">{tinkm_td}</h2>
    <div class="row">
        <div class="owl-carousel owl-theme khuyen-mai-slider" id="khuyen-mai-slider">
           {tinkhuyenmai}
        </div>
    </div>
</div>
<div class="thanh-toan box">
    <h2 class="title">{httt_td}</h2>
    <ul class="list-thanh-toan">
       {hinhthucthanhtoan}
    </ul>
</div>
