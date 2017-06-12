<div class="item_dichvu_sub_tt col-md-3-1  ">
    <div class="post_dichvu_sub_tt">
        <span>-{phantram}%</span>
        <img  src="{Img}" alt="{Name}" title="{Name}">

    </div>
    <div class="start_tt">
        {sao}
    </div>
    <div class="post_dichvu_sub_tt_bt ">
        <div class="top_dichvu_sub_tt">
            <h3>{Name}</h3>
            <i class="fa fa-map-marker"></i><span class="map_dichvu">{Address}</span>
            <table>
                <tr>
                    <td style="padding-right: 10px">{giatu}: </td>
                    <td><span class="giacu">{GiaCu}</span> </td>
                </tr>
                <tr>
                    <td style="padding-right: 10px"></td>
                    <td><span class="giamoi">{GiaMoi}</span> </td>
                </tr>
            </table>

        </div>
        <div class="bottom_dichvu_sub_tt">
            <a href="#datphong_ft" id="{idnoibat}{Id}">{xemtiep} »</a>

        </div>


    </div>

</div>
<input hidden="" id="name{idnoibat}{Id}" value="{Name}">

<script>
    $(document).ready(function () {
        $("#{idnoibat}{Id}").click(function () {
            var giatri=$('#name{idnoibat}{Id}').val();

                    document.getElementById("Name_kt").value = giatri;
        })
    });

</script>