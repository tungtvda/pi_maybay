<div class=" top-page top-page-detail_tt">
    <div class="container">
        <div class="row col-md-12 col-sm-12 col-xs-12 duongdan_tt">
            {tieude}
        </div>
        <div class="book-ticket col-md-12 col-sm-12 col-xs-12" style="width: 100%;  background:  #F5F5F5; border-radius: 5px">

            <div class="fields" style="border-bottom: 1px dashed  #9A9A9A;border-top: none; padding-top: 10px; padding-bottom: 10px; margin-bottom: 10px; padding-left: 0px; padding-right:0px">
                <input type="radio" name="RoundTrip" value="true" id="ve-khu-hoi" checked />
                <label for="ve-khu-hoi"><span></span>{vekhuhoi_td}</label>
                <input type="radio" name="RoundTrip" value="false" id="ve-mot-chieu" />
                <label for="ve-mot-chieu"><span></span>{vemotchieu_td}</label>
            </div>
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
    <div class="main-content">
        <div style="margin-top: 20px" class="lien-he box">
            <h2 class="title">{Name_dm}</h2>
            <div class="top-contact row">
                <div class="item col-md-4 col-sm-12 col-xs-12">
                    <div class="icon-contact">
                        <img src="{SITE-NAME}/view/default/theme/images/icon-contact-add.jpg" alt="" />
                    </div>
                    <p>{vp_td}<span>{Address_gt}</span></p>
                    <div class="clearfix"></div>
                </div>
                <div class="item col-md-4 col-sm-12 col-xs-12">
                    <div class="icon-contact">
                        <img src="{SITE-NAME}/view/default/theme/images/icon-contact-phone.jpg" alt="" />
                    </div>
                    <p>{hl_td}<span>{Hotline}</span></p>
                    <div class="clearfix"></div>
                </div>
                <div class="item col-md-4 col-sm-12 col-xs-12">
                    <div class="icon-contact">
                        <img src="{SITE-NAME}/view/default/theme/images/icon-contact-email.jpg" alt="" />
                    </div>
                    <p>Email<span>{Email}</span></p>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="contact-form form">
                <form action="" method="post">
                    <h3>{name_tt8}</h3>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="quy-danh">
                                <p>{quydanh_tt}</p>
                                <label>
                                    <select name="QuyDanh">
                                        {qd_tt}
                                    </select>
                                </label>
                            </div>
                            <div class="full-name">
                                <p>{hoten_tt} <span>(*)</span></p>
                                <input type="text" value="" name="Name_lh" placeholder="Nguyễn Văn A" />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="email">
                                <p>Email <span>(*)</span></p>
                                <input type="email" value=""  class="dienthoai_us" name="Email_lh" placeholder="nguyenvana@gmail.com" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="phone">
                                <p>{dt_tt} <span>(*)</span></p>
                                <input type="number" value=""  class="dienthoai_us" name="Phone_lh" placeholder="0975 356 389" />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="address">
                                <p>{dc_tt} <span>(*)</span></p>
                                <input type="text" value="" name="Address_lh" placeholder="B44 Nguyễn Thị Định, Trung Hòa - Nhân Chính, Hà Nội" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="address">
                                <p>{ndyc_td}</p>
                                <textarea class="noi-dung" name="NoiDung_lh" placeholder="Nội dung..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12 options">
                            <div class="call-or-mail">
                                <span>Please:</span>
                                <input type="radio" name="call-mail" id="sendmail" value="sendmail" title="Send me more details via email" />
                                <label for="sendmail"><span></span>{gem_td}</label>
                                <input type="radio" name="call-mail" id="call" value="call" title="Call me if possible" />
                                <label for="call"><span></span>{call_td}</label>
                            </div>
                            <div class="sign-up">
                                <input type="checkbox" id="sign-up" name="sign-up" />
                                <label for="sign-up"><span></span>{name_tt12}</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 send">

                            <button type="submit" class="guiyeucau" name="guiyeucau">{dk_tt}</button>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

