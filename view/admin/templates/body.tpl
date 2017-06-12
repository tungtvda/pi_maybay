<script type="text/javascript">
    function openKcEditor(output) {
        var L_AnhMinhHoa = document.getElementsByName(output);
        var AnhMinhHoa = L_AnhMinhHoa[0];
        window.KCFinder = {
            callBack: function (url) {
                window.KCFinder = null;
                AnhMinhHoa.value = url;
            }
        };
        window.open('{SITE-NAME}/view/admin/Themes/kcfinder/browse.php?type=images&dir=images/public',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
        );
    }
    ;

    $(document).ready(function () {

        $("#li_tab1").click(function () {
            $('#tab1').addClass('current');
            $('#tab2').removeClass('current');
            $('#li_tab1').addClass('current');
            $('#li_tab2').removeClass('current');

        })
        $("#li_tab2").click(function () {
            $('#tab1').removeClass('current');
            $('#tab2').addClass('current');
            $('#li_tab1').removeClass('current');
            $('#li_tab2').addClass('current');

        })
    });

</script>
<div class="contentinner">



    <div id="dyntable_wrapper" class="dataTables_wrapper  " role="grid">
        <div id="dyntable_length" class="dataTables_length">
            <h1>{TABLE-NAME}</h1>
        </div>
        <div {an} class="dataTables_filter" id="dyntable_filter">
            <ul class="nav nav-tabs nav-justified">
                <li id="li_tab1" class="{TAB1-CLASS}"><a id="table_ac" href="javascript:void()">Table</a></li>
                <li id="li_tab2" class="{TAB2-CLASS}"><a id="form_ac" href="javascript:void()">Form</a></li>
            </ul>
        </div>
        <div id="tab1" class="{TAB1-CLASS}" style="display: none">


            <form action="" method="GET">
                <table class="table table-bordered dataTable" id="dyntable" aria-describedby="dyntable_info">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%">
                        <col class="con1">
                        <col class="con0">
                        <col class="con1">
                        <col class="con0">
                        <col class="con1">
                    </colgroup>
                    <thead>
                    <tr role="row">
                        <th><input class="checkall" type="checkbox"></th>
                        {TABLE-HEADER}
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="20">
                            <div class="bulk-actions align-left">

                                <select name="action_all">
                                    <option value="ThemMoi">Thêm mới</option>
                                    <option value="Xoa">Xóa</option>
                                    {ACTION}
                                </select>
                                <input class="btn btn-primary" type="submit" value="Apply"/>
                            </div>


                            <div class="clear"></div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    {TABLE-BODY}
                    </tbody>
                </table>
            </form>
            <div class="dataTables_info" id="dyntable_info">Showing 1 to 20</div>
            <div class="dataTables_paginate paging_full_numbers" id="dyntable_paginate">
                {PAGING}
            </div>
        </div>


        <div id="tab2" style="display: none" class="{TAB2-CLASS}">
            <div class="stepContainer" style="height: 215px;">
                <div id="wiz1step1" class="formwiz">
                    <form action="" method="post" enctype="multipart/form-data">

                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                            {FORM}

                            <p {an}>
                                <input class="button" type="submit" value="Submit"/>
                            </p>

                        </fieldset>

                        <div class="clear"></div><!-- End .clear -->

                    </form>


                </div>

            </div>

        </div>


    </div>


</div>








