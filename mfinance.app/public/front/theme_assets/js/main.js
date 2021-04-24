/*
Template Name: Tejarat - Multipurpose Business & Corporate HTML Template
Template URI: https://themeforest.net/user/aazztech/portfolio
Author: Aazztech
Author URI: https://themeforest.net/user/aazztech
Version: 1.0.2
*/

(function ($) {
    "use strict";

    //Menu Sticky
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 60) {
            $('.menu--sticky').addClass('sticky--on');
        } else if ($(window).scrollTop() >= 0) {
            $('.menu--sticky').removeClass('sticky--on');
        }
    });



    var windowWidth = $(window).width();
    /* setting background images */
    $('.bg_image_holder').each(function () {
        var $this = $(this);
        var imgLink = $this.children().attr('src');
        $this.css({
            "background-image": "url(" + imgLink + ")",
            "opacity": "1"
        }).children().attr('alt', imgLink);
    });


    /* responsive mobile menu */
    function mobileMenu(dropDownTrigger, dropDown) {
        $('.navbar ' + dropDown).slideUp();
        $(dropDownTrigger).removeAttr('data-toggle');

        $('.navbar ' + dropDownTrigger).on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('active').siblings(dropDown)
                .slideToggle().parent().siblings('.dropdown')
                .children(dropDown).slideUp().siblings(dropDownTrigger).removeClass('active');
        })
    }


    if (windowWidth < 992) {
        // mobileMenu('.dropdown-toggle', '');
        mobileMenu('.nav-item.dropdown .nav-link', '.mega-menu,.dropdown-menu');
    }

    /*
     * Replace all SVG images with inline SVG
     */
    $('img.svg').each(function () {
        var $img = $(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        $.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });

    // carousel one
    $('.carousel-one').owlCarousel({
        items: 3,
        margin: 30,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // carousel one
    $('.carousel-two').owlCarousel({
        items: 3,
        margin: 30,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // carousel three
    $('.carousel-three').owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-circle",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // carousel four
    $('.carousel-four').owlCarousel({
        items: 1,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // portfolio carousel
    $('.portfolio-carousel').owlCarousel({
        items: 4,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            550: {
                items: 2
            },
            768: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    // image carousel one
    $('.image-carousel-one').owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-circle",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // image carousel two
    $('.image-carousel-two').owlCarousel({
        items: 1,
        nav: false,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // testimonial carousel one
    $('.testimonial-carousel-one').owlCarousel({
        items: 1,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // testimonial carousel two
    $('.testimonial-carousel-two').owlCarousel({
        items: 2,
        margin: 30,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle dot-light",
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });

    // testimonial carousel three
    $('.testimonial-carousel-three').owlCarousel({
        items: 3,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-circle",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            992: {
                items: 3
            }
        }
    });

    // testimonial carousel four
    $('.testimonial-carousel-four').owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-circle nav-circle--light",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // testimonial carousel five
    $('.testimonial-carousel-five').owlCarousel({
        items: 2,
        nav: false,
        loop: false,
        /*navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-square nav-square-dark",*/
        dots: false,
        autoplay: false,
        responsive: {
            0: {
                items: 1
            },
            992: {
                items: 2
            }
        }
    });

    // testimonial carousel six
    $('.testimonial-carousel-six').owlCarousel({
        items: 1,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle dot-secondary",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // team carousel one
    $('.team-carousel-one').owlCarousel({
        items: 3,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-square nav-square-dark",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // team carousel two
    $('.team-carousel-two').owlCarousel({
        items: 4,
        margin: 30,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            992: {
                items: 4
            }
        }
    });

    // team carousel three
    $('.team-carousel-three').owlCarousel({
        items: 1,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-circle nav-circle--light",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            992: {
                items: 1
            }
        }
    });

    // logo carousel one
    $('.logo-carousel-one').owlCarousel({
        items: 5,
        autoplay: true,
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 5
            }
        }
    });

    // logo carousel two
    $('.logo-carousel-two').owlCarousel({
        items: 2,
        margin: 30,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });

    // logo carousel three
    $('.logo-carousel-three').owlCarousel({
        items: 5,
        margin: 30,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-square nav-square-dark",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            992: {
                items: 5
            }
        }
    });

    // logo carousel one
    $('.logo-carousel-four').owlCarousel({
        items: 5,
        autoplay: true,
        loop: true,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 5
            }
        }
    });

    // logo carousel dark
    $('.logo-carousel-dark').owlCarousel({
        items: 4,
        nav: false,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    // blog carousel one
    $('.blog-carousel-one').owlCarousel({
        items: 3,
        margin: 30,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // blog carousel two
    $('.blog-carousel-two').owlCarousel({
        items: 3,
        autoplay: true,
        margin: 30,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

    // Twitter Feed Carousel
    $('.twitter-feeds-carousel').owlCarousel({
        items: 1,
        autoplay: true,
        loop: true,
        nav: true,
        navText: ['<i class="la la-angle-left"></i>', '<i class="la la-angle-right"></i>'],
        navContainerClass: "nav-circle nav-circle--lighten",
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.twitter-feeds-carousel2').owlCarousel({
        items: 1,
        autoplay: true,
        loop: true,
        nav: false,
        dots: true,
        dotsClass: "owl-dots dot-circle",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    //image view carousel
    $('.image-view-carousel').owlCarousel({
        items: 1,
        center: true,
        loop: false,
        nav: false,
        dots: false,
        URLhashListener: true,
        startPosition: '#image1'
    });

    //address carousel
    $('.addresses_carousel').owlCarousel({
        items: 4,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });

    //address carousel
    $('.intro_area9-carousel').owlCarousel({
        items: 1,
        dots: true,
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // tooltip trigger
    $('[data-toggle="tooltip"]').tooltip();

    /* product count increment, decrement */
    var $prodCount = $('#numberInput');
    $('.pcount').on("click", function () {
        var curCount = parseInt($prodCount.val());
        if ($(this).data('operation') === 'plus') {
            !isNaN(curCount) ? $prodCount.val(curCount + 1) : $prodCount.val(1);
        } else {
            curCount > 0 ? $prodCount.val(curCount - 1) : '';
        }
    });

    //select2 trigger
    $(document).ready(function () {
        $(".select2_default").select2({
            placeholder: "Multiple Select",
            width: "100%",
            containerCssClass: "form-control"
        });

        function selecWithIcon(selected) {
            if (!selected.id) {
                return selected.text;
            }
            var $elem = $(
                "<span><span class='la la-" + selected.element.value + "'></span>" + selected.text + "</span>"
            );
            return $elem;
        }


        $(".select2_tagged").select2({
            multiple: true,
            placeholder: "Select options",
            containerCssClass: "form-control"
        });

        $(".selection_with_icon").select2({
            templateResult: selecWithIcon,
            containerCssClass: "form-control",
            dropdownCssClass: "custom_select_with_icon"

        });
    });

    //initialize counterUp js
    $('.count_up').counterUp();

    /* bar rating plugin installation */
    $('.give_rating').barrating({
        theme: 'fontawesome-stars'
    });

    //initialize video bg
    $("#bgndVideo").YTPlayer();

    //Range slider light
    $("#slider-range1").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
        slide: function (event, ui) {
            $("#amount1").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#amount1").val("$" + $("#slider-range1").slider("values", 0) +
        " - $" + $("#slider-range1").slider("values", 1));

    //range slider dark
    $("#slider-range2").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
        slide: function (event, ui) {
            $("#amount2").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#amount2").val("$" + $("#slider-range2").slider("values", 0) +
        " - $" + $("#slider-range2").slider("values", 1));


    //Trumbowyg Editor
    $('#text-editor').trumbowyg();

    /* COUNTDOWN INIT */
    $('.countdown').countdown('2019/11/25', function (event) {
        var $this = $(this).html(event.strftime('' +
            '<li><span>%D</span> <span>Days</span></li>  ' +
            '<li><span>%H</span> <span>Hours</span></li>  ' +
            '<li><span>%M</span> <span>Minutes</span></li>  ' +
            '<li><span>%S</span> <span>Seconds</span></li> '));
    });

    $('.search_trigger').on('click', function () {
        $(this).toggleClass('la-search la-close');
        $(this).parent('.search_module').children('.search_area').toggleClass('active');
    });


    //Video Popup
    $('.video-iframe').magnificPopup({
        type: 'iframe',
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
                '<div class="mfp-close"></div>' +
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                '</div>',
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: function (url) {
                        var m = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                        if (!m || !m[1]) return null;
                        return m[1];
                    },
                    src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: function (url) {
                        var m = url.match(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
                        if (!m || !m[5]) return null;
                        return m[5];
                    },
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                }
            },
            srcAction: 'iframe_src'
        }
    });




    //initialize filterizr
    $('.filter-sort ul li').on("click", function () {
        $('.filter-sort ul li').removeClass('active');
        $(this).addClass('active');
    });
    $('.filter-sort2 ul li').on("click", function () {
        $('.filter-sort2 ul li').removeClass('active');
        $(this).addClass('active');
    });

    /* go top */
    var scrollTop = $('.go_top');


    $(window).on('scroll', function () {
        var distanceFromTop = $(document).scrollTop();
        if (distanceFromTop > 117) {
            scrollTop.fadeIn(400);
        } else {
            scrollTop.fadeOut(400);
        }
    });
    scrollTop.on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    $(".custom-upload").change(function () {
        $(".file-name").text(this.files[0].name);
    });

    //TOGGLING NESTED ul
    $(".drop-down .selected a").click(function () {
        $(".drop-down .options ul").toggle();
    });

    //SELECT OPTIONS AND HIDE OPTION AFTER SELECTION
    $(".drop-down .options ul li a").click(function () {
        var text = $(this).html();
        $(".drop-down .selected a span").html(text);
        $(".drop-down .options ul").hide();
    });


    //HIDE OPTIONS IF CLICKED ANYWHERE ELSE ON PAGE
    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("drop-down"))
            $(".drop-down .options ul").hide();
    });
})(jQuery);