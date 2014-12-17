jQuery(document).ready(function ($) {

	// Nivo Slider //////////////////////////////////////////////////////////////////////////////////////////////
	$('#nivoslider').nivoSlider({
        effect: 'fold', // Specify sets like: 'fold,fade,sliceDown'
        slices: 15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed: 500, // Slide transition speed
        pauseTime: 3000 // How long each slide will show
    });

	$('.galleryslider').nivoSlider({
        effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
		manualAdvance: true
    });

	// Twitter ///////////////////////////////////////////////////////////////////////////////////////////////////
	$(".tweet").tweet({
		username: "voodoopixel",
		count: 1
	});

	// Primary nav ///////////////////////////////////////////////////////////////////////////////////////////////
	$('#menu').superfish({});
	$('#menu').mobileMenu({
		defaultText: 'Navigate to...',
		className: 'mobileMenu',
		subMenuDash: '&ndash;'
	});

	// Fancybox //////////////////////////////////////////////////////////////////////////////////////////////
	$('.fancybox').fancybox();

	// Filterable portfolio //////////////////////////////////////////////////////////////////////////////////////////////
	var $portfolioClone = $(".portfolio").clone();
	$(".filter a").click(function(e){
		$(".filter li").removeClass("current");
		var $filterClass = $(this).parent().attr("class");
		if ( $filterClass == "all" ) {
			var $filteredPortfolio = $portfolioClone.find(".columns, .column");
		} else {
			var $filteredPortfolio = $portfolioClone.find(".column[data-type~=" + $filterClass + "],.columns[data-type~=" + $filterClass + "]");
		}
		$(".portfolio").quicksand( $filteredPortfolio, {
			duration: 800,
			easing: 'easeInOutQuart'
		});
		$(this).parent().addClass("current");
		e.preventDefault();
	});

	// Tabs //////////////////////////////////////////////////////////////////////////////////////////////
	$('.tab-container').easytabs();

	// Toggles //////////////////////////////////////////////////////////////////////////////////////////////
	$(".togglebox").hide();
	$("h4").click(function(){
	$(this).toggleClass("active").next(".togglebox").slideToggle("slow");
		return true;
	});


	// Touch Carousel //////////////////////////////////////////////////////////////////////////////////////////////
	$(".carousel").touchCarousel({
		itemsPerMove: 1
    });



});
