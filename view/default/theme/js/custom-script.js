function autocomplet_di() {
    var min_length = 1; // min caracters to display the autocomplete
    var keyword = $('#sanbay_di').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: '/controller/default/ajax.php',
            type: 'POST',
            data: {keyword:keyword},
            success:function(data){
                $('.hien_tinh_di').show();
                $('.hien_tinh_di').html(data);

                jQuery(document).ready( function($) {
                    $('.hien_tinh_di li').click(function () {
                        $('#chieu-di').val($(this).children().html());
                        $('#hide-chieu-di').val($(this).attr('class'));
                        $('#hide-noi-dia').val('false');
                        $('.hien_tinh_di').hide();
                        $('#sanbay_di').val('');
                        $('#list-chieu-di').hide();
                        $index = 'chieu-ve';
                        var of = $('#' + $index);
                        var offset = of.offset();
                        $('#list-' + $index).css('left', offset.left).css('top', offset.top + 52).show();
                        $('#list-chieu-ve').show();
                    });
                });
            }
        });
    } else {
        $('.hien_tinh_di').hide();
    }
}
function autocomplet_ve() {
    var min_length = 1; // min caracters to display the autocomplete
    var keyword = $('#sanbay_ve').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: '/controller/default/ajax.php',
            type: 'POST',
            data: {keyword:keyword},
            success:function(data){
                $('.hien_tinh_ve').show();
                $('.hien_tinh_ve').html(data);

                jQuery(document).ready( function($) {
                    $('.hien_tinh_ve li').click(function () {
                        $('#chieu-ve').val($(this).children().html());
                        $('#hide-chieu-ve').val($(this).attr('class'));
                        $('#hide-noi-dia').val('false');
                        $('#sanbay_ve').val('');
                        $('.hien_tinh_ve').hide();
                        $('#list-chieu-ve').hide();
                    });
                });
            }
        });
    } else {
        $('.hien_tinh_di').hide();
    }
}


// set_item : this function will be executed when we select an item
function set_item(item) {
    // change input value
    $('#sanbay_di').val(item);
    // hide proposition list
    $('.hien_tinh').hide();
}

$(function() {
    $.datepicker.regional["vi-VN"] =
    {
        closeText: "Đóng",
        prevText: "Trước",
        nextText: "Sau",
        currentText: "Hôm nay",
        monthNames: ["Tháng 1 -", "Tháng 2 -", "Tháng 3 -", "Tháng 4 -", "Tháng 5 -", "Tháng 6 -", "Tháng 7 -", "Tháng 8 -", "Tháng 9 -", "Tháng 10 -", "Tháng 11 -", "Tháng 12 -"],
        monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một", "Mười hai"],
        dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
        dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
        dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
        weekHeader: "Tuần",
        dateFormat: "dd/mm/yy",
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ""
    };

    $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
    $( "#ngay-di" ).datepicker({
        defaultDate: "+1w",
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy',
        minDate: 0,
        onClose: function( selectedDate ) {
            $( "#ngay-ve" ).datepicker( "option", "minDate", selectedDate );
            $( "#ngay-ve" ).datepicker({
                defaultDate: "+1w",
                numberOfMonths: 2,
                dateFormat: 'dd/mm/yy',
                onClose: function( selectedDate ) {
                    $( "#ngay-di" ).datepicker( "option", "maxDate", selectedDate );
                }
            });
        }
    });
    $( "#ngay-ve" ).datepicker({
        defaultDate: "+1w",
        numberOfMonths: 2,
        dateFormat: 'dd/mm/yy'
        //onClose: function( selectedDate ) {
        //	$( "#ngay-di" ).datepicker( "option", "maxDate", selectedDate );
        //}
    });
});

jQuery(function($) {
    menu();
});

function menu() {
    $('.toogle-menu').click(function() {
        $('.main-menu ul').slideToggle('slow');
        return false;
    });
}

$(window).resize(function() {
    var w_window = $(window).width();
    if(w_window <= 989) {
        $('.main-menu ul').hide();
    }
    else {
        $('.main-menu ul').show();
    }
});

jQuery(document).ready( function($) {

    $(".fancybox").fancybox({
        openEffect	: 'none',
        closeEffect	: 'none'
    });

    //$('#ngay-ve').addClass('disabled-text').attr('disabled','disabled');
    if($(".fields #ve-mot-chieu, .checkbox_right_tt #ve-mot-chieu").is(":checked")) {
        $('#ngay-ve').addClass('disabled-text').attr('disabled','disabled');
    }
    else {
        $('#ngay-ve').removeClass('disabled-text').removeAttr('disabled');
    }
    $( ".fields input, .checkbox_right_tt input" ).on( "click", function() {
        if($(this).val() == "false") {
            $('#ngay-ve').addClass('disabled-text').attr('disabled','disabled');
        }
        else {
            $('#ngay-ve').removeClass('disabled-text').removeAttr('disabled');
        }
    });

    $('select').change(function() {
        if ($(this).children('option:first-child').is(':selected')) {
            $(this).addClass('placeholder');
        } else {
            $(this).removeClass('placeholder');
        }
    });

    $("#xuathoadon").change(function () {
        if ($(this).is(':checked')) {
            $('.hienhoadon').slideDown();
            $('.hienhoadon input').removeAttr("disabled");
        }
        else {
            $('.hienhoadon').slideUp();
            $('.hienhoadon input').attr("disabled", "disabled");
        }

    })

    $(".doi-tac-slider").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 400,
        pagination: false,
        items : 8,
        rewindNav: false,
        itemsDesktop : [1199,8],
        itemsDesktopSmall : [979,6],
        itemsTablet: [768,4],
        itemsTabletSmall: false,
        itemsMobile : [479,2],
        singleItem : false,
        itemsScaleUp : false,
        stopOnHover:true,
        autoPlay:false
    });
    $(".khuyen-mai-slider").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 400,
        pagination: false,
        items : 2,
        rewindNav: false,
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [979,2],
        itemsTablet: [768,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        singleItem : false,
        itemsScaleUp : false,
        stopOnHover:true,
        autoPlay:false
    });
    $(".service-owl-carousel").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 400,
        pagination: false,
        items : 3,
        rewindNav: false,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        itemsTablet: [768,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        singleItem : false,
        itemsScaleUp : false,
        stopOnHover:true,
        autoPlay:false
    });

    $('.sub').click(function(e){
        e.preventDefault();
        if ($(this).next().hasClass('nguoi-lon') && $(this).next().val() > 1) {
            $(this).next().val($(this).next().val()*1 - 1);
        } else if($(this).next().hasClass('tre-em') && $(this).next().val() > 0) {
            $(this).next().val($(this).next().val()*1 - 1);
        } else if($(this).next().hasClass('so-sinh') && $(this).next().val() > 0) {
            $(this).next().val($(this).next().val()*1 - 1);
        }
        else {
            return;
        }
    });

    $('.sum').click(function(e){
        e.preventDefault();
        $(this).prev().val($(this).prev().val()*1 + 1);
    });

    $('.tab-group ul li').click(function(e){
        e.preventDefault();
        console.log($(this).index());
        //alert($(this).attr('rel'));
        $('.tab-group ul li').removeClass('active');
        $(this).addClass('active');
        $('.group-content table').hide();
        $('.group-content .' + $(this).attr('rel')).fadeIn(300);
    });

    $('.faq .faq-list li .content').hide();
    $('.faq .faq-list li').first().addClass('active').find('.content').show();
    $('.faq .faq-list li .faq-title').click(function(e){
        e.preventDefault();
        if($(this).parent().hasClass('active')) {
            $('.faq .faq-list li').removeClass('active');
            $(this).next().slideUp('300');
        }
        else {
            $('.faq .faq-list li').removeClass('active');
            $(this).parent().addClass('active');

            $('.faq .faq-list li .content').hide();
            $(this).next().slideDown('300');
        }
    });

    $('.dialog').hide();
    $('.chuyen-bay').click(function(){
        $('.dialog').hide();
        $index = $(this).attr('id');
        var of = $('#' + $index);
        var offset = of.offset();
        $('#list-' + $index).css('left', offset.left).css('top', offset.top + 52).show();
        //$('#list-chieu-di ul a').each(function(){
        //	$(this).removeAttr('style');
        //	if($(this).attr('class') == $('#hide-chieu-ve').val()) {
        //		$(this).css('font-weight', 'bold');
        //	}
        //});
        $('#list-chieu-ve ul a').each(function(){
            $(this).removeAttr('style');
            if($(this).attr('class') == $('#hide-chieu-di').val()) {
                $(this).css('font-weight', 'bold');
            }
        });
        $('#list-chieu-di ul a').click(function(e){
            e.preventDefault();
            //if($(this).attr('class') == $('#hide-chieu-ve').val()) {
            //	return;
            //}
            //else {
            $('#chieu-di').val($(this).text());
            $('#hide-chieu-di').val($(this).attr('airportcode'));
            $(this).parents('#list-chieu-di').hide();

            $index = 'chieu-ve';
            var of = $('#' + $index);
            var offset = of.offset();
            $('#list-' + $index).css('left', offset.left).css('top', offset.top + 52).show();
            $('#list-chieu-ve').show(function(){
                $('#list-chieu-ve ul a').each(function(){
                    $(this).removeAttr('style');
                    if($(this).attr('class') == $('#hide-chieu-di').val()) {
                        $(this).css('font-weight', 'bold');
                    }
                });
            });
            //}
        });
        $('#list-chieu-ve ul a').click(function(e){
            e.preventDefault();
            if($(this).attr('class') == $('#hide-chieu-di').val()) {
                return;
            }
            else {
                $('#chieu-ve').val($(this).text());
                $('#hide-chieu-ve').val($(this).attr('airportcode'));
                $(this).parents('#list-chieu-ve').hide();
            }
        });
    });

    $('.dialog .dialog-close').click(function(e){
        e.preventDefault();
        $(this).parent().parent().hide();
    });

    $('#list-chieu-di #submit-departure').click(function(e){
        e.preventDefault();
        if($("#thanhpho_di option:selected" ).val()) {
            $('#chieu-di').val($("#thanhpho_di option:selected" ).text());
            $('#hide-chieu-di').val($("#thanhpho_di option:selected" ).val());
            $('#hide-noi-dia').val('false');
            $(this).parents('#list-chieu-di').hide();
            $index = 'chieu-ve';
            var of = $('#' + $index);
            var offset = of.offset();
            $('#list-' + $index).css('left', offset.left).css('top', offset.top + 52).show();
            $('#list-chieu-ve').show();

            $('#list-chieu-ve ul a').each(function(){
                $(this).removeAttr('style');
                if($(this).attr('class') == $('#hide-chieu-di').val()) {
                    $(this).css('font-weight', 'bold');
                }
            });
        }
        else {
            return;
        }
    });

    $('#list-chieu-ve #submit-landingture').click(function(e){
        e.preventDefault();
        if($("#thanhpho_den option:selected" ).val()) {
            $('#chieu-ve').val($("#thanhpho_den option:selected" ).text());
            $('#hide-chieu-ve').val($("#thanhpho_den option:selected" ).val());
            $('#hide-noi-dia').val('false');
            $(this).parents('#list-chieu-ve').hide();
        }
        else {
            return;
        }
    });

    //$("body").on('click',function(e) {
    //	if ( $(e.target).attr('class') == 'dialog') {
    //		return;
    //	} else {
    //		$('.dialog').hide();
    //	}
    //});

    $(window).scroll(function () {
        if ($(this).scrollTop() > 2) {
            $('#masthead.sticky-header .navigation').addClass('affix');
            $('#masthead.sticky-header .navigation').removeClass('affix-top');
        } else {
            $('#masthead.sticky-header .navigation').removeClass('affix');
            $('#masthead.sticky-header .navigation').addClass('affix-top');
        }
    });

    if ($(".height_sticky_auto").length) {
        $('.navigation').affix({
            offset: {
                top: $('#masthead').offset().top
            }
        });
    }
});


//Get list air
function search_noidia($url,$datapost,$sources,$type,$sortby,$ele){
    $expands = 'TicketPriceDetails,PriceSummaries,Details,TicketOptions';
    return $.ajax({
        type: "POST",
        url: $url + ".php?source="+$sources+"&type="+$type+"&sapxep="+$sortby,
        data: $datapost
    }).done(function(html){
        if (html.search("Fatal error") > -1){
            $('#'+$ele).html('<h1>Lỗi quá thời gian kết nối '+$sources+' tại server http://api.atvietnam.vn</h1>');
        }
        else {
            if (html == '')
                $('#'+$ele).html("Không tìm thấy kết quả nào của" + $sources);
            else {
                $('#'+$ele).html(html);
                $('.send').css('display','block');

                $(".list-result>table>tbody>tr:first-child").addClass("selected");
                $(".list-result>table>tbody>tr:first-child>.check-ve>input").prop("checked", true);

                $('.flight-info-detail').hide();

                //Send fixed
                var window_height = $(window).height();
                var send_top = $(".send input").offset().top;
                if (send_top > window_height) {
                    $(".send input").addClass("send-fixed");
                    $(window).scroll(function() {
                        var scroll_top = $(this).scrollTop();
                        if ( scroll_top + window_height < send_top ) {
                            $(".send input").addClass("send-fixed");
                        }
                        else {
                            $(".send input").removeClass("send-fixed");
                        }
                    });
                }

                jQuery(document).ready(function($){
                    var of = $('.bottom-offset');
                    var offset = of.offset();
                    //alert(offset.top);
                    $w_height = $(window).height();
                    $('.bottom-fixed').removeClass('false');

                    $('.bottom-fixed').scroll(function() {
                        var of2 = $(this);
                        var offset2 = of2.offset();
                        //if(offset.top == offset2.top) {
                        //	$('.bottom-fixed').addClass('bottom-fixed');
                        //}
                        //else {
                        //	$('.bottom-fixed').removeClass('bottom-fixed');
                        //}
                        //alert($(window).scrollTop() + $w_height);

                        if(offset2.top >= offset.top) {
                            $('.bottom-fixed').addClass('false');
                        }
                        else {
                            $('.bottom-fixed').removeClass('false');
                        }
                    });
                });
            }
        }
        $('.ajax-loader').hide();

        //$('.result-depart .i-result').click(function(){
        //    $landing = "";
        //    $('.result-landing .i-result input').each(function(index){
        //        if($(this).attr('checked') == 'checked') {
        //            $landing = $(this).val();
        //        }
        //    });
        //    $depart = $(this).children().find('input').val();
        //    $deferered = Array();
        //    $deferered.push(get_flight($datapost, $depart, $landing, "chi-tiet-ve"));
        //    $start = Date.now();
        //});
        //
        //$('.result-landing .i-result').click(function(){
        //    $depart = "";
        //    $('.result-depart .i-result input').each(function(index){
        //        if($(this).attr('checked') == 'checked') {
        //            $depart = $(this).val();
        //        }
        //    });
        //    $landing = $(this).children().find('input').val();
        //    $deferered = Array();
        //    $deferered.push(get_flight($datapost, $depart, $landing, "chi-tiet-ve"));
        //    $start = Date.now();
        //});

        $(document).on('click', '.result-depart .list-ve .i-result', function (event) {
            var $target = $(event.target);
            if(!$target.parents().is("a") && !$target.is("a")){
                $('.result-depart .list-ve .i-result').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('.check-ve-radio').prop('checked', true);
            }
        });

        $(document).on('click', '.result-depart .list-ve .i-result .check-ve-radio', function (evt) {
            evt.stopPropagation();
            evt.preventDefault();
        });

        $(document).on('click', '.result-landing .list-ve .i-result', function (event) {
            var $target = $(event.target);
            if(!$target.parents().is("a") && !$target.is("a")){
                $('.result-landing .list-ve .i-result').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('.check-ve-radio').prop('checked', true);
            }
        });

        $(document).on('click', '.result-landing .list-ve .i-result .check-ve-radio', function (evt) {
            evt.stopPropagation();
            evt.preventDefault();
        });

        $('#'+$ele+' .i-result a').click(function(e){
            e.preventDefault();
            //alert($(this).parents('.i-result').html());
            if($(this).parents('.i-result').hasClass('viewed')) {
                $(this).parents('.i-result').removeClass('viewed');
                $(this).parents('.i-result').next().hide();
            }
            else {
                $('.list-ve .i-result').removeClass('viewed');
                $(this).parents('.i-result').addClass('viewed');

                $('.flight-info-detail').hide();
                $(this).parents('.i-result').next().show();
            }
        });
    });
}

function search_quocte($url,$datapost,$sources,$type,$sortby,$ele){
    $expands = 'TicketPriceDetails,PriceSummaries,Details,TicketOptions';
    return $.ajax({
        type: "POST",
        url: $url + ".php?source="+$sources+"&type="+$type+"&sapxep="+$sortby,
        data: $datapost
    }).done(function(html){
        if (html.search("Fatal error") > -1){
            $('#'+$ele).html('<h1>Lỗi quá thời gian kết nối '+$sources+' tại server http://api.atvietnam.vn</h1>');
        }
        else {
            if (html == '')
                $('#'+$ele).html("Không tìm thấy kết quả nào của" + $sources);
            else {
                $('#'+$ele).html(html);
                $('.send').css('display','block');

                $(".list-result>table>tbody>tr:first-child").addClass("selected");
                $(".list-result>table>tbody>tr:first-child>.check-ve>input").prop("checked", true);

                $('.flight-info-detail').hide();

                //Send fixed
                var window_height = $(window).height();
                var send_top = $(".send input").offset().top;
                if (send_top > window_height) {
                    $(".send input").addClass("send-fixed");
                    $(window).scroll(function() {
                        var scroll_top = $(this).scrollTop();
                        if ( scroll_top + window_height < send_top ) {
                            $(".send input").addClass("send-fixed");
                        }
                        else {
                            $(".send input").removeClass("send-fixed");
                        }
                    });
                }

                jQuery(document).ready(function($){
                    var of = $('.bottom-offset');
                    var offset = of.offset();
                    //alert(offset.top);
                    $w_height = $(window).height();
                    $('.bottom-fixed').removeClass('false');

                    $('.bottom-fixed').scroll(function() {
                        var of2 = $(this);
                        var offset2 = of2.offset();
                        //if(offset.top == offset2.top) {
                        //	$('.bottom-fixed').addClass('bottom-fixed');
                        //}
                        //else {
                        //	$('.bottom-fixed').removeClass('bottom-fixed');
                        //}
                        //alert($(window).scrollTop() + $w_height);

                        if(offset2.top >= offset.top) {
                            $('.bottom-fixed').addClass('false');
                        }
                        else {
                            $('.bottom-fixed').removeClass('false');
                        }
                    });
                });
            }
        }
        $('.ajax-loader').hide();

        //$('.result-depart .i-result').click(function(){
        //    $landing = "";
        //    $('.result-landing .i-result input').each(function(index){
        //        if($(this).attr('checked') == 'checked') {
        //            $landing = $(this).val();
        //        }
        //    });
        //    $depart = $(this).children().find('input').val();
        //    $deferered = Array();
        //    $deferered.push(get_flight($datapost, $depart, $landing, "chi-tiet-ve"));
        //    $start = Date.now();
        //});
        //
        //$('.result-landing .i-result').click(function(){
        //    $depart = "";
        //    $('.result-depart .i-result input').each(function(index){
        //        if($(this).attr('checked') == 'checked') {
        //            $depart = $(this).val();
        //        }
        //    });
        //    $landing = $(this).children().find('input').val();
        //    $deferered = Array();
        //    $deferered.push(get_flight($datapost, $depart, $landing, "chi-tiet-ve"));
        //    $start = Date.now();
        //});

        $(document).on('click', '.result-depart .list-ve .i-result', function (event) {
            var $target = $(event.target);
            if(!$target.parents().is("a") && !$target.is("a")){
                $('.result-depart .list-ve .i-result').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('.check-ve-radio').prop('checked', true);
            }
        });

        $(document).on('click', '.result-depart .list-ve .i-result .check-ve-radio', function (evt) {
            evt.stopPropagation();
            evt.preventDefault();
        });

        $(document).on('click', '.result-landing .list-ve .i-result', function (event) {
            var $target = $(event.target);
            if(!$target.parents().is("a") && !$target.is("a")){
                $('.result-landing .list-ve .i-result').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('.check-ve-radio').prop('checked', true);
            }
        });

        $(document).on('click', '.result-landing .list-ve .i-result .check-ve-radio', function (evt) {
            evt.stopPropagation();
            evt.preventDefault();
        });

        $('#'+$ele+' .i-result a').click(function(e){
            e.preventDefault();
            //alert($(this).parents('.i-result').html());
            if($(this).parents('.i-result').hasClass('viewed')) {
                $(this).parents('.i-result').removeClass('viewed');
                $(this).parents('.i-result').next().hide();
            }
            else {
                $('.list-ve .i-result').removeClass('viewed');
                $(this).parents('.i-result').addClass('viewed');

                $('.flight-info-detail').hide();
                $(this).parents('.i-result').next().show();
            }
        });
    });
}

function get_flight($datapost,$outbound,$inbound,$ele) {
    return $.ajax({
        type: "POST",
        url: "/controller/default/chitietve_aj.php?outbound="+$outbound+"&inbound="+$inbound,
        data: $datapost
    }).done(function(html) {
        if (html.search("Fatal error") > -1) {
            $('#'+$ele).html('<h1>L?i quá th?i gian k?t n?i '+$sources+' t?i server http://api.atvietnam.vn</h1>');
        }
        else {
            if (html == '')
                $('#'+$ele).html("Không tìm th?y k?t qu? nào c?a" + $sources);
            else {
                $('#'+$ele).html(html);
            }
        }
    });
}

$(document).ready(function() {
    $('ul.tab_datve>li>a').on('shown.bs.tab', function (e) {
        var current_a = e.target;
        var current_a_link = $(current_a).attr('href');
        var current_id = current_a_link.replace('#', '');
        $(".tab-content>div input").attr("disabled", "disabled");
        $("#" + current_id + " input").removeAttr("disabled");
    })
});