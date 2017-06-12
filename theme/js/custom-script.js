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
	$('select').change(function() {
		if ($(this).children('option:first-child').is(':selected')) {
			$(this).addClass('placeholder');
		} else {
			$(this).removeClass('placeholder');
		}
	});

	$(".doi-tac-slider").owlCarousel({
		navigation : true, // Show next and prev buttons
		slideSpeed : 400,
		pagination: false,
		items : 9,
		rewindNav: false,
		itemsDesktop : [1199,9],
		itemsDesktopSmall : [979,7],
		itemsTablet: [768,5],
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