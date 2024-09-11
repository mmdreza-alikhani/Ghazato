(function($) { "use strict";

    /*========== PAGE LOADING ==========*/
    $(window).on("load", function(){
        $('.images-preloader').fadeOut();
    })
    $("body").removeClass("preload");

    /*========== cLICK TO TOP ==========*/
    var offset = 450;
    var duration = 1000;
    var upToTop = $(".click-to-top");
    upToTop.hide();
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > offset) {
            upToTop.fadeIn(1000);
        } else {
            upToTop.fadeOut(1000);
        }
    });
    upToTop.on('click', function(event) {
        $('html, body').animate({ scrollTop: 0 }, 1000);
    });

    /*========== SLIDER REVOLUTION ==========*/
    try {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var navbarHeight = $('.navbar-desktop').outerHeight();
        var menu_asideWidth = $('.navbar-desktop.aside').width();
        var cate_boxHeight = $('.cate-box').height();
        var slider_2_width = windowWidth - menu_asideWidth;
        var slider_2_height = windowHeight - cate_boxHeight - 30;
        var slideshow_7_height = windowHeight - navbarHeight;

        $('#rev_slider_1').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 700],

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: false,
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },

            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
        $('#rev_slider_2').show().revolution({
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[slider_2_width, slider_2_width, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[slider_2_height, slider_2_height, 600, 500, 620],

            /* basic navigation arrows and bullets */
            navigation: {
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            }
        });
        $('#rev_slider_3').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1400, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 620],

            visibilityLevels:[1920, 1400, 1200, 992, 768],

            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: false,
                bullets: {
                    enable: true,
                    hide_onleave: false,
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 50,
                    space: 7,
                },
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },

            visibilityLevels:[1920, 1400, 1200, 992, 768]
        });
        $('#rev_slider_4').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 620],

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: false,
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },

            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
        $('#rev_slider_5').show().revolution({
            delay: 5000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 700],

            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,

            /* basic navigation arrows and bullets */
            navigation: {
                bullets: {
                    enable: true,
                    hide_onleave: false,
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 50,
                    space: 7,
                },
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },

            visibilityLevels:[1920, 1500, 1200, 768]
        });
        $('#rev_slider_6').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight , windowHeight, 600, 500, 680],

            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: true,
                bullets: {
                    enable: true,
                    hide_onleave: false,
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 50,
                    space: 7,
                },
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },
            visibilityLevels:[1920, 1500, 1200, 768]
        });
        $('#rev_slider_7').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[1170, 930, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[slideshow_7_height , slideshow_7_height, 600, 500, 800],

            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: true,
                bullets: {
                    enable: true,
                    hide_onleave: false,
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 40,
                    space: 7,
                },
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },
            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
        $('#rev_slider_8').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 620],

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: true,
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },
            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
        $('#rev_slider_11').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 700],

            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: true,
                bullets: {
                    enable: true,
                    hide_onleave: false,
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 50,
                    space: 7,
                },
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },
            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
        $('#rev_slider_12').show().revolution({
            delay: 7000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 700],

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: true,
                bullets: {
                    enable: true,
                    hide_onleave: false,
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 50,
                    space: 7,
                },
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },
            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
        $('#rev_slider_13').show().revolution({
            delay: 5000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 700],

            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: true,
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },
            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
        $('#rev_slider_14').show().revolution({
            delay: 5000,
            responsiveLevels: [1920, 1500, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridwidth:[windowWidth, windowWidth, 1200, 992, 768],
            /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
            gridheight:[windowHeight, windowHeight, 600, 500, 700],

            stopLoop: "on",
            stopAfterLoops: 0,
            stopAtSlide: 1,

            /* basic navigation arrows and bullets */
            navigation: {
                onHoverStop: true,
                bullets: {
                    enable: true,
                    hide_onleave: false,
                    h_align: 'center',
                    v_align: 'bottom',
                    h_offset: 0,
                    v_offset: 40,
                    space: 7,
                },
                touch: {
                    touchenabled: 'on',
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal'
                }
            },
            visibilityLevels:[1920, 1500, 1200, 992, 768]
        });
    } catch(err) {}

    /*========== TIME PICKER ==========*/
    try {
        $('.time-picker').timepicker({
            'minTime': '10:00am',
            'maxTime': '11:00pm',
            'timeFormat': 'h : i a'
        });
    } catch(err) {}

    /*========== NAVBAR ==========*/
    try {
        var navbarOffset = $(".navbar-desktop").offset().top;
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > navbarOffset) {
                $(".navbar-desktop").not('.aside').addClass('fixed');
            } else {
                $(".navbar-desktop").not('.aside').removeClass("fixed");
            }
        });
        $(".navbar-desktop").not('.aside').find('li.has-children').on({
            mouseenter: function(){
                $(this).children().last().children().stop().slideDown();
            },
            mouseleave: function(){
                $(this).children().last().children().stop().slideUp();
            }
        });
    } catch(err) {}

    /*========== MENU COLLAPSE ==========*/
    $('#menu-accordion li a').on('click', function () {
        $('#menu-accordion li').removeClass('current');
        $(this).parent().addClass('current');
    })
    $('#menu-accordion .show').parent().addClass('current');

    /*========== TAGCLOUD ==========*/
    try {
        var tagCloudBlog = $('.blog-standard .post .tagcloud');
        tagCloudBlog.prepend("<span class='lnr lnr-tag'></span>");
    } catch(err) {}

    /*========== COUNT DOWN ==========*/
    try {
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                var $this = $(this).html(event.strftime('' +
                    '<div class="time-box"><span class="time-number">%m</span> <span class="time-unit">months</span> </div>' +
                    '<div class="time-box"><span class="time-number">%D</span> <span class="time-unit">days</span> </div>' +
                    '<div class="time-box"><span class="time-number">%H</span> <span class="time-unit">hours</span> </div>' +
                    '<div class="time-box"><span class="time-number">%M</span> <span class="time-unit">mins</span> </div>' +
                    '<div class="time-box"><span class="time-number">%S</span> <span class="time-unit">secs</span></div>'
                ));
            });
        });
    } catch(err) {}


    /*========== SIDENAV MOBILE ==========*/
    var $nav = $('#main-nav');
    var $toggle = $('.navbar-mobile__toggler');
    var defaultData = {
        maxWidth: false,
        customToggle: $toggle,
        navTitle: 'Menu'
    };
    // we'll store our temp stuff here
    var $clone = null;
    var data = {};
    // calling like this only for demo purposes
    var initNav = function(conf) {
        if ($clone) {
            // clear previous instance
            $clone.remove();
        }
        // remove old toggle click event
        $toggle.off('click');
        // make new copy
        $clone = $nav.clone();
        // remember data
        $.extend(data, conf)
        // call the plugin
        $clone.hcMobileNav($.extend({}, defaultData, data));
    }
    // run first demo
    initNav({});

    /*========== OWL CAROUSEL ==========*/
    // Feature
    $('#feature-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        loop: true,
        responsive:{
            0:{
                items:1,
                dots: true,
                margin: 0
            },
            768:{
                items:2,
                margin: 0,
                dots: false
            },
            1200:{
                items:3,
                margin: 30,
                dots: false,
            }
        }
    });
    $('#feature-prev').on('click',function(){
        $('#feature-carousel').trigger('prev.owl.carousel');
    })
    $('#feature-next').on('click', function(){
        $('#feature-carousel').trigger('next.owl.carousel');
    })
    // Image on menu sidebar
    $('#image-carousel').owlCarousel({
        items:1,
        margin: 2
    });
    // Food slider
    $('#food-carousel').owlCarousel({
        dotsEach: 3,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        loop: true,
        responsive:{
            0:{
                items:1,
                dots: true,
                margin: 10
            },
            768:{
                items:2,
                margin: 30
            },
            992:{
                items:3,
                margin: 30
            },
            1200:{
                items:3,
                margin: 30,
            }
        }
    });
    // Testimonials
    $('#testimonials-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        loop: true,
        dotsEach: 3,
        responsive:{
            0:{
                items:1,
                dotsEach: 3
            },
            768:{
                items: 2,
                margin: 30
            },
            992:{
                items: 3,
                margin: 30
            }
        }
    });
    $('#testimonials-2-carousel').owlCarousel({
        loop:true,
        responsive:{
            items:1,
            0:{
                items:1
            },
            768:{
                items:1,
                dots: false,
            },
            1200:{
                items:1,
                dots: false,
            }
        }
    });
    $('#testimonials-2-carousel-prev').on('click', function(){
        $('#testimonials-2-carousel').trigger('prev.owl.carousel');
    })
    $('#testimonials-2-carousel-next').on('click', function(){
        $('#testimonials-2-carousel').trigger('next.owl.carousel');
    })
    // Special slider
    $('#special-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        dotsEach: 4,
        responsive:{
            0:{
                items:1
            },
            768:{
                items: 3,
                margin: 20
            },
            1200:{
                items: 4,
                margin: 30
            },
            1500:{
                items: 4
            }
        }
    });
    $('#special-carousel-fixed').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        dotsEach: 4,
        responsive:{
            0:{
                items:1
            },
            768:{
                items: 2
            },
            992:{
                items: 3
            },
            1200:{
                items: 4
            },
            1500:{
                items: 5
            }
        }
    });
    $('#special-carousel-center').owlCarousel({
        loop: true,
        dotsEach: 3,
        center: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        responsive:{
            0:{
                items:1
            },
            768:{
                items: 2,
                margin: 20
            },
            1500:{
                items: 2,
                margin: 40,
                autoWidth: true
            }
        }
    });
    $('#special-carousel-box').owlCarousel({
        loop: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        dots: false,
        mouseDrag: false,
        touchDrag: false,
        items: 1
    });
    $('#special-slider-four').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        dotsEach: 2,
        margin: 30,
        responsive:{
            0:{
                items:1
            },
            768:{
                items: 2
            },
            1200:{
                items: 4
            }
        }
    });
    // Two sync carousel
    var carouselCenter = $('#special-carousel-center');
    var carouselBox = $('#special-carousel-box')
    carouselCenter.on('change.owl.carousel', function(event) {
        if (event.namespace && event.property.name === 'position') {
            var target = event.relatedTarget.relative(event.property.value, true);
            carouselBox.owlCarousel('to', target, 300, true);
        }
    })
    // Cupcake slider
    $('#cupcake-slider').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplaySpeed: 2000,
        dotsEach: 4,
        responsive:{
            0:{
                items:1
            },
            768:{
                items: 3,
                margin: 30
            },
            992:{
                items: 4,
                margin: 30
            },
            1200:{
                items: 5,
                margin: 30
            },
            1500:{
                items: 6,
                margin: 30
            }
        }
    });

    if ( windowWidth >= 992 ) {
        $('#cupcake-slider').on('translated.owl.carousel', function(event) {
            var firstOwlItem = $('#cupcake-slider .owl-stage .owl-item.active').first();
            var lastOwlItem = $('#cupcake-slider .owl-stage .owl-item.active').last();
            $(this).find('.owl-item').removeClass('opacity');
            firstOwlItem.first().addClass('opacity');
            lastOwlItem.addClass('opacity');
        })
    }
    // Our chef slider
    $('#our-chef-carousel').owlCarousel({
        dotsEach: 3,
        responsive:{
            0:{
                items:1
            },
            768:{
                items: 2,
                margin: 30
            },
            992:{
                items: 3,
                margin: 30
            }
        }
    });
    // Grid image
    $('#grid-image').owlCarousel({
        loop:true,
        responsive : {
            0 : {
                items: 1
            },
            768 : {
                items: 2
            },
            992 : {
                items: 3
            },
            1200 : {
                items: 4
            }
        }
    })
    $('#grid-image').on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            $('#grid-image').trigger('next.owl');
        } else {
            $('#grid-image').trigger('prev.owl');
        }
        e.preventDefault();
    });
    var shop_single_carousel = $('#shop-single-image');
    shop_single_carousel.owlCarousel({
        loop:true,
        items: 1,
        dots: false,
        thumbs: true,
        thumbsPrerendered: true
    })

    /*========== SELECT INPUT ==========*/
    $('html').on('click', function(){
        $('.select .dropdown').hide();
    })
    $('.select').on('click', function(){
        event.stopPropagation();
    })
    $('.select .form-control').on('click', function(){
        $(this).parent().next().toggle();
    })
    $('.select .dropdown li').on('click', function(){
        $(this).parent().toggle();
        var text = $(this).data('value');
        $(this).parent().prev().find('div').text(text);
    })

    /*========== LIGHT GALLERY ==========*/
    try {
        $('.lightgallery').lightGallery({
            'showAfterLoad': false
        });
    } catch(err) {}

    /*========== MENU SIDEBAR ==========*/
    $('.menu-sidebar-icon').on('click', function(){
        $('.menu-sidebar').addClass('show');
    })
    $('#close-icon').on('click',function(){
        $('.menu-sidebar').removeClass('show');
    })
    $('html').on('click', function() {
        $('.menu-sidebar').removeClass('show');
    });
    $('.menu-sidebar').on('click', function(event){
        event.stopPropagation();
    });
    $('.menu-sidebar-icon').on('click', function(event){
        event.stopPropagation();
    });

    /*========== FULLPAGE ==========*/
    try {
        if ( $(window).width() >= 768 ) {
            $('#fullpage').fullpage({
                navigation: true,
                onLeave: function(index, nextIndex, direction) {

                    var progressbarCircle = $('.js-progress-circle');

                    if(index == 1 && direction == "down") {

                        progressbarCircle.each(function(){
                            var that = $(this);
                            var percentage = that.data("value");
                            var color = that.data("color");
                            var circle_wrap = that.find('.js-circle');
                            var progress = percentage / 100;

                            var empty_fill = that.data("empty-color");

                            that.find('.js-dot').css('background',color);

                            var circle = circle_wrap.circleProgress({
                                size: 139,
                                thickness: 5,
                                animation: {
                                    duration: 1600
                                },
                                fill: color,
                                emptyFill: empty_fill,
                                reverse: false
                            });

                            circle = circle_wrap.circleProgress({
                                value: progress
                            });
                            circle.on('circle-animation-progress', function (e, p, v) {
                                var $this = $(this),
                                    instance = $this.data('circle-progress'),
                                    size = instance.size,
                                    thickness = instance.getThickness(),
                                    radius = size / 2 - thickness / 2,
                                    angle = 2 * v * Math.PI + instance.startAngle,
                                    x = radius * Math.cos(angle),
                                    y = radius * Math.sin(angle);
                                $this.find('.dot').css({
                                    left: x + size / 2,
                                    top: y + size / 2
                                });
                            });
                        });
                    }
                }
            });
            $('.prev-slide').on('click', function(){
                $.fn.fullpage.moveSlideLeft();
            });
            $('.next-slide').on('click', function(){
                $.fn.fullpage.moveSlideRight();
            });
        }
    } catch(err) {}

    /*========== TABS ==========*/
    try {
        $("#tabs").tabs({
            hide: { effect: "fadeOut", duration: 300 },
            show: { effect: "fadeIn", duration: 300 }
        });
        $("#feature-tabs").tabs({
            hide: { effect: "fadeOut", duration: 300 },
            show: { effect: "fadeIn", duration: 300 }
        });
        $("#shop-single-tab").tabs({
            hide: { effect: "fadeOut", duration: 300 },
            show: { effect: "fadeIn", duration: 300 }
        });
    } catch(err) {}

    /*========== CIRCLE JS ==========*/
    try {
        var progressbarCircle = $('.js-progress-circle');
        progressbarCircle.each(function () {
            var that = $(this);
            var executed = false;

            var percentage = that.data("value");
            var color = that.data("color");
            var circle_wrap = that.find('.js-circle');
            var progress = percentage / 100;

            var empty_fill = that.data("empty-color");

            that.find('.js-dot').css('background',color);

            var circle = circle_wrap.circleProgress({
                size: 139,
                thickness: 5,
                animation: {
                    duration: 1600
                },
                fill: color,
                emptyFill: empty_fill,
                reverse: false
            });
            $(window).on('load', function () {
                that.waypoint(function () {
                    if (!executed) {
                        executed = true;
                        circle = circle_wrap.circleProgress({
                            value: progress
                        });
                        circle.on('circle-animation-progress', function (e, p, v) {
                            var $this = $(this),
                                instance = $this.data('circle-progress'),
                                size = instance.size,
                                thickness = instance.getThickness(),
                                radius = size / 2 - thickness / 2,
                                angle = 2 * v * Math.PI + instance.startAngle,
                                x = radius * Math.cos(angle),
                                y = radius * Math.sin(angle);
                            $this.find('.dot').css({
                                left: x + size / 2,
                                top: y + size / 2
                            });
                        });
                    }
                }, { offset: 'bottom-in-view' });
            })
        })
    } catch (error) {}

    /*========== MODAL VIDEO ==========*/
    try {
        $(".js-video-button").on('click', function(e){
            e.preventDefault();
        })
        $(".js-video-button").modalVideo();
    } catch(err) {}

    /*========== ZOOM ==========*/
    try {
        $("#zoom-image").elevateZoom({
            gallery:'shop-single-thumb',
            cursor: "crosshair",
            galleryActiveClass: 'active',
            zoomType: "inner",
        });
    } catch(err) {}

    /*========== INCRESE VALUE ==========*/
    $(".number-button").on("click", function(e) {
        e.preventDefault();
        var $button = $(this);
        var input_quantity = $button.parent().prev();
        var oldValue = input_quantity.val();

        if ($button.hasClass('plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        input_quantity.val(newVal);
    });

    /*========== FLIPSTER ==========*/
    try {
        $('.my-flipster').flipster({
            style: 'flat',
            spacing: -0.25,
            loop: true,
            start: 'center',
            scrollwheel: false,
            nav: true
        });
    } catch(err) {}

    /*========== SET FULL HEIGHT ==========*/
    try {
        var headerHeight = $('header').outerHeight();
        var exceptHeight = windowHeight - headerHeight;
        $('#grid-image').height(exceptHeight);
        $('.coming-soon').height(exceptHeight);
        $('.error').height(exceptHeight);
    } catch(err) {}

    /*========== noUISLIDER ==========*/
    try {
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start: [0, 190],
            connect: true,
            range: {
                'min': 0,
                'max': 100
            },
            format: {
                from: function(value) {
                    return parseInt(value,10);
                },
                to: function(value) {
                    return parseInt(value,10);
                }
            }
        });
        var nodes = [
            document.getElementById('lower-value'), // 0
            document.getElementById('upper-value')  // 1
        ];
        slider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
            nodes[handle].innerHTML = values[handle];
        });

        // Display the slider value and how far the handle moved
        // from the left edge of the slider.
        nonLinearSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
            nodes[handle].innerHTML = values[handle] + ', ' + positions[handle].toFixed(2) + '%';
        });
    } catch(err) {}

    /*========== SECTION BACKGROUND ==========*/
    try {
        $('.set-bg').each(function(){
            var imageUrl = $(this).data('bg');
            $(this).css("background-image", "url(' + imageUrl + ')");
        })
    } catch(err){}
    /*========== CONFIG CONTACT ==========*/
    try {
        var contactFormWrapper = $('.js-contact-form');
        contactFormWrapper.each(function () {
            var that = $(this);
            that.on('submit', function (e) {
                var url = "includes/contact-form.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $(this).serialize(),
                    success: function (data)
                    {
                        var result = JSON.parse(data);
                        var message = result.message;
                        var type = result.type;
                        if (type === "success") {
                            swal ( "Success" ,  message ,  "success" );
                            that.reset();
                        } else if (type === "danger") {
                            swal ( "Oops" ,  message ,  "error" );
                        }
                    },
                    statusCode: {
                        404: function() {
                            swal ( "Oops" ,  "File Not Found!" ,  "error" );
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown ) {
                        swal ( "Oops" ,  errorThrown  ,  "error" );
                    }
                });
                return false;
            });
        });
    } catch(err) {}

})(jQuery);

/*========== WOW JS ==========*/
try {
    wow = new WOW(
        {
            animateClass: 'animated'
        }
    );
    wow.init();
} catch(err) {}


