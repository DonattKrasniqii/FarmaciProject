(function ($) {
    "use strict";

    /*-----------------
        Menu Stick
    -----------------*/
    var header = $('.sticky-bar');
    var win = $(window);
    win.on('scroll', function() {
        var scroll = win.scrollTop();
        if (scroll < 200) {
            header.removeClass('stick');
        } else {
            header.addClass('stick');
        }
    });

    /*------ ScrollUp -------- */
    $.scrollUp({
        scrollText: '<i class="fal fa-long-arrow-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    /*------ Wow Active ----*/
    new WOW().init();

    /*------ Hero slider active 1 ----*/
    $('.hero-slider-active-1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="slider-icon-1-prev"><i class="far fa-chevron-left"></i></span>',
        nextArrow: '<span class="slider-icon-1-next"><i class="far fa-chevron-right"></i></span>',
    });

    /*------ Hero slider active 2 ----*/
    $('.hero-slider-active-2').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: false,
    });

    /*------ Timer active ----*/
    $('#timer-1-active').syotimer({
        year: 2021,
        month: 8,
        day: 31,
        hour: 23,
        minute: 59,
        layout: 'hms',
        periodic: false,
        periodUnit: 'm'
    });

    /*------ Product slider active 1 ----*/
    $('.product-slider-active-1').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="pro-icon-1-prev"><i class="far fa-angle-left"></i></span>',
        nextArrow: '<span class="pro-icon-1-next"><i class="far fa-angle-right"></i></span>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    /*------ Testimonial active 1 ----*/
    $('.testimonial-active-1').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="pro-icon-1-prev"><i class="far fa-angle-left"></i></span>',
        nextArrow: '<span class="pro-icon-1-next"><i class="far fa-angle-right"></i></span>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    /*------ Testimonial active 3 ----*/
    $('.testimonial-active-3').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    /*------ Categories slider 1 ----*/
    $('.categories-slider-1').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    /*------ SVG img active ----*/
    SVGInject(document.querySelectorAll('img.injectable'), {});


    /*----------------------------
        Category toggle function
    ------------------------------*/
    var searchToggle = $('.categori-button-active');
    searchToggle.on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('open')){
           $(this).removeClass('open');
           $(this).siblings('.categori-dropdown-active-large').removeClass('open');
        }else{
           $(this).addClass('open');
           $(this).siblings('.categori-dropdown-active-large').addClass('open');
        }
    })

    /*-------------------------
        Testimonial active 2
    --------------------------*/
    var $status = $('.pagingInfo');
    var $slickElement = $('.testimonial-active-2');

    $slickElement.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
        //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
        var i = (currentSlide ? currentSlide : 0) + 1;
        $status.text('0' + i + ' ------ ' + '0' +  slick.slideCount);
    });

    $slickElement.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="testimonial-icon-2-prev"><i class="far fa-angle-left"></i></span>',
        nextArrow: '<span class="testimonial-icon-2-next"><i class="far fa-angle-right"></i></span>',
    });

    /*---------------------
        Price range
    --------------------- */
    var sliderrange = $('#slider-range');
    var amountprice = $('#amount');
    $(function() {
        sliderrange.slider({
            range: true,
            min: 16,
            max: 400,
            values: [0, 300],
            slide: function(event, ui) {
                amountprice.val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        amountprice.val("$" + sliderrange.slider("values", 0) +
            " - $" + sliderrange.slider("values", 1));
    });


    /*-------------------------------
        Sort by active
    -----------------------------------*/
    if ($('.sort-by-product-area').length) {
        var $body = $('body'),
            $cartWrap = $('.sort-by-product-area'),
            $cartContent = $cartWrap.find('.sort-by-dropdown');
        $cartWrap.on('click', '.sort-by-product-wrap', function(e) {
            e.preventDefault();
            var $this = $(this);
            if (!$this.parent().hasClass('show')) {
                $this.siblings('.sort-by-dropdown').addClass('show').parent().addClass('show');
            } else {
                $this.siblings('.sort-by-dropdown').removeClass('show').parent().removeClass('show');
            }
        });
        /*Close When Click Outside*/
        $body.on('click', function(e) {
            var $target = e.target;
            if (!$($target).is('.sort-by-product-area') && !$($target).parents().is('.sort-by-product-area') && $cartWrap.hasClass('show')) {
                $cartWrap.removeClass('show');
                $cartContent.removeClass('show');
            }
        });
    }

    /*-----------------------
        Shop filter active
    ------------------------- */
    $('.shop-filter-active').on('click', function(e) {
        e.preventDefault();
        $('.product-filter-wrapper').slideToggle();
    })
    var shopFiltericon = $('.shop-filter-active');
    shopFiltericon.on('click', function() {
        $('.shop-filter-active').toggleClass('active');
    })

    /*-------------------------------------
        Product details big image slider
    ---------------------------------------*/
    $('.pro-dec-big-img-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: '.product-dec-slider-small , .product-dec-slider-small-2',
    });

    /*---------------------------------------
        Product details small image slider
    -----------------------------------------*/
    $('.product-dec-slider-small').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.pro-dec-big-img-slider',
        dots: false,
        focusOnSelect: true,
        fade: false,
        arrows: false,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

    /*-----------------------
        Magnific Popup
    ------------------------*/
    $('.img-popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

     /*----------------------------
    	Cart Plus Minus Button
    ------------------------------ */
    $(".product-quality").append('<div class="dec qtybutton">-</i></div><div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function () {
        var $button = $(this),
        oldValue = $button.parent().find("input").val(),
        maxValue = $('.cart-plus-minus-box').data('limit'),
        newVal;
        if ($button.text() == "+") {
            if (maxValue >= parseFloat(oldValue) + 1) {
                newVal = parseFloat(oldValue) + 1;
            } else {
                newVal = 6
            }
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    /*---------------------
        Select active
    --------------------- */
    $('.select-active').select2();

    /*--- Checkout toggle function ----*/
    $('.checkout-click1').on('click', function(e) {
        e.preventDefault();
        $('.checkout-login-info').slideToggle(900);
    });

    /*--- Checkout toggle function ----*/
    $('.checkout-click3').on('click', function(e) {
        e.preventDefault();
        $('.checkout-login-info3').slideToggle(1000);
    });

    /*-------------------------
        Create an account toggle
    --------------------------*/
    $('.checkout-toggle2').on('click', function() {
        $('.open-toggle2').slideToggle(1000);
    });

    $('.checkout-toggle').on('click', function() {
        $('.open-toggle').slideToggle(1000);
    });


    /*-------------------------------------
        Checkout one click toggle function
    ---------------------------------------*/
    var checked = $( '.sin-payment input:checked' )
    if(checked){
        $(checked).siblings( '.payment-box' ).slideDown(900);
    };
	 $( '.sin-payment input' ).on('change', function() {
        $( '.payment-box' ).slideUp(900);
        $(this).siblings( '.payment-box' ).slideToggle(900);
    });

    /*-------------------------------------
        Checkout paymentMethod function
    ---------------------------------------*/
    paymentMethodChanged();
	function paymentMethodChanged() {
		var $order_review = $( '.payment-method' );

		$order_review.on( 'click', 'input[name="payment_method"]', function() {
			var selectedClass = 'payment-selected';
			var parent = $( this ).parents( '.sin-payment' ).first();
			parent.addClass( selectedClass ).siblings().removeClass( selectedClass );
		} );
	}

    /*------------------------
        Clipboar Active
    -------------------------*/
    $('.cbtn').on('click', function() {
        var $this = $(this);
        var clipboard = new ClipboardJS('.cbtn');
        clipboard.on('success', function(e) {
          $this.text('Copied!');
          setTimeout(function() {
            $this.text('Copy');
          }, 2000);
        });
    });

    /*----------------------------------------
        SVG Inject With Vivus(After Inject)
    ------------------------------------------*/
    SVGInject(document.querySelectorAll("img.svgInject"), {
        makeIdsUnique: true,
        afterInject: function (img, svg) {
            new Vivus(svg, {
                duration: 80
            });
        }
    });

    /* Vivus On Hover */
    $('[data-vivus-hover]').hover(function () {
        var svg = $(this).find('svg')[0];
        new Vivus(svg, {
            duration: 50
        });
    })

    /*---- CounterUp ----*/

    $('.count').counterUp({
        delay: 10,
        time: 1500
    });


    // Isotope active
    $('.grid').imagesLoaded(function() {
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            layoutMode: 'masonry',
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.grid-item',
            }
        });
    });

    /*====== SidebarSearch ======*/
    function sidebarSearch() {
        var searchTrigger = $('.search-active'),
            endTriggersearch = $('.search-close'),
            container = $('.main-search-active');

        searchTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('search-visible');
        });

        endTriggersearch.on('click', function() {
            container.removeClass('search-visible');
        });

    };
    sidebarSearch();

     /*====== Sidebar menu Active ======*/
    function mobileHeaderActive() {
        var navbarTrigger = $('.burger-icon'),
            endTrigger = $('.mobile-menu-close'),
            container = $('.mobile-header-active'),
            wrapper4 = $('body');

        wrapper4.prepend('<div class="body-overlay-1"></div>');

        navbarTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('sidebar-visible');
            wrapper4.addClass('mobile-menu-active');
        });

        endTrigger.on('click', function() {
            container.removeClass('sidebar-visible');
            wrapper4.removeClass('mobile-menu-active');
        });

        $('.body-overlay-1').on('click', function() {
            container.removeClass('sidebar-visible');
            wrapper4.removeClass('mobile-menu-active');
        });
    };
    mobileHeaderActive();

    $('#mobileSearchIcon').click(function (){
        $('.burger-icon').click();
    });
   /*---------------------
        Mobile menu active
    ------------------------ */
    var $offCanvasNav = $('.mobile-menu'),
        $offCanvasNavSubMenu = $offCanvasNav.find('.dropdown');

    /*Add Toggle Button With Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="far fa-angle-down"></i></span>');

    /*Close Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.slideUp();

    /*Category Sub Menu Toggle*/
    $offCanvasNav.on('click', 'li a, li .menu-expand', function(e) {
        var $this = $(this);
        if ( ($this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/)) && ($this.attr('href') === '#' || $this.hasClass('menu-expand')) ) {
            e.preventDefault();
            if ($this.siblings('ul:visible').length){
                $this.parent('li').removeClass('active');
                $this.siblings('ul').slideUp();
            } else {
                $this.parent('li').addClass('active');
                $this.closest('li').siblings('li').removeClass('active').find('li').removeClass('active');
                $this.closest('li').siblings('li').find('ul:visible').slideUp();
                $this.siblings('ul').slideDown();
            }
        }
    });

    /*--- language currency active ----*/
    $('.mobile-language-active').on('click', function(e) {
        e.preventDefault();
        $('.lang-dropdown-active').slideToggle(900);
    });

    /*--- Categori-button-active-2 ----*/
    $('.categori-button-active-2').on('click', function(e) {
        e.preventDefault();
        $('.categori-dropdown-active-small').slideToggle(900);
    });

    /*--- Mobile demo active ----*/
    var demo = $('.tm-demo-options-wrapper');
    $('.view-demo-btn-active').on('click', function (e) {
        e.preventDefault();
        demo.toggleClass('demo-open');
    });



})(jQuery);

