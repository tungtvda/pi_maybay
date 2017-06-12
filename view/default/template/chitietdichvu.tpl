
</header>

<section class="content-area container">
    <div class="breadcrumbs ">
        <div class=" col-md-12 col-sm-12 col-xs-12 duongdan_tt">
            {tieude}
        </div>
    </div>

<div style="padding-left: 0px;" class="left_sidebar col-md-9-1 col-sm-9 col-xs-12">


<div class="services-tourcouch box">
<h2 class="title">{name}</h2>
<div class=" motadichvu_tt col-md-12 col-sm-12 col-xs-12">
    <div class="img_chitietdv_tt">
        <img src="{Img}" class="img-responsive" title="{name}" alt="{name}">
    </div>
    <p>{NoiDung}</p>
</div>
<h4 {an} class="tieude_dichvu_tt"><i class="fa fa-angle-right"></i>{banchay_td}</h4>
<div {an} class=" lendu danhsachdv_tt col-xs-12 col-md-12 col-sm-12">
    {banchay}




</div>
<h4 {an1} class="tieude_dichvu_tt"><i class="fa fa-angle-right"></i> {noibat_td}</h4>
<div {an1} style="border-bottom: 1px dotted #ebebeb" class=" danhsachdv_tt col-xs-12 col-md-12 col-sm-12">
   {noibat}




</div>
<div  class="user_tt danhsachdv_tt col-xs-12 col-md-12 col-sm-12">
    <div style="padding-left: 25px; padding-right: 25px; padding-bottom: 30px" class="col-xs-12 col-md-12 col-sm-12 user_tt_hotro">
        <h4>{datdv_td}</h4>
        <div style="padding-left: 0px; padding-right: 0px" class="col-md-2 col-sm-2 col-xs-2 avatar">
            <img class="img-responsive" src="{Avatar}" style="width: 78%;">
        </div>
        <div  class="col-md-10 col-sm-10 col-xs-10 noidung_user_tt">
            <p>{MoTaNgan_ht}</p>
            <div class="call_user_tt">
                {Name_ht}<span>{Phone}</span>
            </div>
            <div class="chat_user_tt">
                <a style="margin-right: 10px" href="ymsgr:sendim?{Yahoo}"><img src="{SITE-NAME}/view/default/theme/images/yahoo.png"></a>
                <a   href="Skype:{Skype}?chat"><img src="{SITE-NAME}/view/default/theme/images/skype.png"></a>
                <span>{Email}</span>
            </div>
        </div>
    </div>
</div>
<div id="datphong_ft"  class="form_datdichvu col-xs-12 col-md-12 col-sm-12">
    <h4>{guiyc_td} </h4>
    <p>{name_tt7}</p>
    <div class="bang_dichvu">
        <form action="" method="post">
            <table >
                <tr {an}>
                    <td class="tdleft">
                      {tendv_td} <span>(*)</span>
                    </td>
                    <td>
                        <script>
                            $(document).ready(function () {
                                $("#Name_kt").click(function () {
                                    var banner_height = jQuery(".lendu").offset().top;
                                    jQuery("html, body").animate({scrollTop: banner_height}, 500);
                                })
                            });



                        </script>
                        <input type="text" readonly name="Name_kt" id="Name_kt" tabindex="1" value="{Name_kt}" >
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        {ten_td} <span>(*)</span>
                    </td>
                    <td>
                        <input type="text" name="Name_dp"  tabindex="2" value="{Name_dp}"  >
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        Email <span>(*)</span>
                    </td>
                    <td>
                        <input type="email" name="Email_dp"  tabindex="3" value="{Email_dp}" >
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                        {dt_td} <span>(*)</span>
                    </td>
                    <td>
                        <input style="padding: 7px 10px; height: 36px" type="number" name="Phone_dp"  tabindex="4"  value="{Phone_dp}">
                    </td>
                </tr>
                <tr>
                    <td class="tdleft">
                       {dc_td}
                    </td>
                    <td>
                        <input style="padding: 6px 10px;
  height: 39px;" type="text" name="Address_dp"  tabindex="5" value="{Address_dp}" >
                    </td>
                </tr>
                <tr>
                    <td style="  vertical-align: top;" class="tdleft">
                        {yc_td}
                    </td>
                    <td>
                        <textarea name="NoiDung_dp"  tabindex="6">{NoiDung_dp}</textarea>
                    </td>
                </tr>
                <tr>
                    <td style="  " class="tdleft">

                    </td>
                    <td>
                        <button type="submit" class="guiyeucau" name="guiyeucau">{bnt_td}</button>

                    </td>
                </tr>
            </table>
        </form>

    </div>

</div>
</div>
</div>

