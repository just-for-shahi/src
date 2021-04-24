(function ($) {
    'use strict';
    var tpj,
        revapi15,
        revapi17,
        revapi27,
        revapi24,
        revapi30,
        revapi31,
        revapi32,
        revapi33,
        revapi34,
        revapi26,
        revapi7,
        revapi8,
        revapi9,
        revapi18;
    (function () {
        if (!/loaded|interactive|complete/.test(document.readyState)) document.addEventListener("DOMContentLoaded", onLoad); else onLoad();

        function onLoad() {
            if (tpj === undefined) {
                tpj = jQuery;
                if ("off" == "on") tpj.noConflict();
            }

            /* SLIDER1 */
            if (tpj("#rev_slider_15_2").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_15_2");
            } else {
                revapi15 = tpj("#rev_slider_15_2").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 7500,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "off",
                        bullets: {
                            enable: true,
                            hide_onmobile: false,
                            style: "erinyen",
                            hide_onleave: false,
                            direction: "horizontal",
                            h_align: "center",
                            v_align: "bottom",
                            h_offset: 0,
                            v_offset: 40,
                            space: 5,
                            tmp: ''
                        }
                    },
                    visibilityLevels: [1200, 1199, 992, 768, 576],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 400,
                        speedbg: 0,
                        speedls: 0,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }

            /* SLIDER2 */
            if (tpj("#rev_slider_17_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_17_1");
            } else {
                revapi17 = tpj("#rev_slider_17_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "off",
                        bullets: {
                            enable: false
                        }
                    },
                    visibilityLevels: [1200, 1199, 992, 768],
                    responsiveLevels: [1200, 1199, 992, 768],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 400,
                        speedbg: 0,
                        speedls: 0,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }

            /* SLIDER3 */
            if (tpj("#rev_slider_24_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_24_1");
            } else {
                revapi24 = tpj("#rev_slider_24_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "on",
                        arrows: {
                            style:"zeus",
                            enable:true,
                            hide_onmobile:false,
                            hide_onleave:false,
                            tmp:'<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
                            left: {
                                h_align:"left",
                                v_align:"center",
                                h_offset:20,
                                v_offset:0
                            },
                            right: {
                                h_align:"right",
                                v_align:"center",
                                h_offset:20,
                                v_offset:0
                            }
                        }
                    },
                    visibilityLevels: [1240, 1024, 778, 480],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            } /* END OF revapi call */

            /* SLIDER4 */
            if (tpj("#rev_slider_26_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_26_1");
            } else {
                revapi26 = tpj("#rev_slider_26_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        onHoverStop: "off",
                    },
                    visibilityLevels: [1240, 1024, 778, 480],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "on",
                    stopAfterLoops: 0,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }

            if (tpj("#rev_slider_27_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_27_1");
            } else {
                revapi27 = tpj("#rev_slider_27_1").show().revolution({
                    sliderType: "hero",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {},
                    visibilityLevels: [1240, 1024, 778, 480],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner0",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        disableFocusListener: false,
                    }
                });
            }

            if (tpj("#rev_slider_30_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_30_1");
            } else {
                revapi30 = tpj("#rev_slider_30_1").show().revolution({
                    sliderType: "hero",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {},
                    visibilityLevels: [1240, 1024, 778, 480],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner0",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        disableFocusListener: false,
                    }
                });
            }


            if (tpj("#rev_slider_31_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_31_1");
            } else {
                revapi31 = tpj("#rev_slider_31_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation:"off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation:"off",
                        mouseScrollReverse:"default",
                        onHoverStop:"on",
                        thumbnails: {
                            style:"hades",
                            enable:true,
                            width:60,
                            height:60,
                            min_width:100,
                            wrapper_padding:5,
                            wrapper_color:"transparent",
                            tmp:'<span class="tp-thumb-img-wrap">  <span class="tp-thumb-image"></span></span>',
                            visibleAmount:5,
                            hide_onmobile:false,
                            hide_onleave:false,
                            direction:"horizontal",
                            span:false,
                            position:"inner",
                            space:5,
                            h_align:"center",
                            v_align:"bottom",
                            h_offset:0,
                            v_offset:40
                        }
                    },
                    visibilityLevels: [1240, 1024, 778, 480],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }

            if (tpj("#rev_slider_32_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_32_1");
            } else {
                revapi32 = tpj("#rev_slider_32_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        onHoverStop: "off",
                    },
                    visibilityLevels: [1200, 1199, 992, 768, 576],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 400,
                        speedbg: 0,
                        speedls: 0,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }


            if (tpj("#rev_slider_33_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_33_1");
            } else {
                revapi33 = tpj("#rev_slider_33_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        onHoverStop: "off",
                    },
                    visibilityLevels: [1240, 1024, 778, 480],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }

            if (tpj("#rev_slider_34_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_34_1");
            } else {
                revapi34 = tpj("#rev_slider_34_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "off",
                        arrows: {
                            style: "hephaistos",
                            enable: true,
                            hide_onmobile: false,
                            hide_onleave: false,
                            tmp: '',
                            left: {
                                h_align: "left",
                                v_align: "center",
                                h_offset: 20,
                                v_offset: 0
                            },
                            right: {
                                h_align: "right",
                                v_align: "center",
                                h_offset: 20,
                                v_offset: 0
                            }
                        }
                    },
                    visibilityLevels: [1240, 1024, 778, 480],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }

            if (tpj("#rev_slider_35_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_35_1");
            } else {
                revapi32 = tpj("#rev_slider_35_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        onHoverStop: "off",
                    },
                    visibilityLevels: [1200, 1199, 992, 768, 576],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1110, 960, 720, 540],
                    gridheight:[850, 650, 600, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 700,
                        speedbg: 0,
                        speedls: 0,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }

            if (tpj("#rev_slider_36_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_36_1");
            } else {
                revapi32 = tpj("#rev_slider_36_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        onHoverStop: "off",
                    },
                    visibilityLevels: [1200, 1199, 992, 768, 576],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1110, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 700,
                        speedbg: 0,
                        speedls: 0,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
            if(tpj("#rev_slider_7_1").revolution == undefined){
                revslider_showDoubleJqueryError("#rev_slider_7_1");
            }else {
                revapi7 = tpj("#rev_slider_7_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 9000,
                    navigation: {
                        onHoverStop: "off",
                    },
                    visibilityLevels: [1200, 1199, 992, 768, 576],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1110, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 700,
                        speedbg: 0,
                        speedls: 0,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
            if(tpj("#rev_slider_8_1").revolution == undefined){
                revslider_showDoubleJqueryError("#rev_slider_8_1");
            }else{
                revapi8 = tpj("#rev_slider_8_1").show().revolution({
                    sliderLayout:"fullwidth",
                    dottedOverlay:"none",
                    delay:9000,
                    navigation: {
                    },
                    responsiveLevels:[1240,1024,778,480],
                    visibilityLevels:[1240,1024,778,480],
                    gridwidth:[1920,1024,778,480],
                    gridheight:[787,500,400,350],
                    lazyType:"none",
                    shadow:0,
                    spinner:"spinner0",
                    autoHeight:"off",
                    disableProgressBar:"on",
                    hideThumbsOnMobile:"off",
                    hideSliderAtLimit:0,
                    hideCaptionAtLimit:0,
                    hideAllCaptionAtLilmit:0,
                    debugMode:false,
                    fallbacks: {
                        simplifyAll:"off",
                        disableFocusListener:false,
                    }
                });
            }
            if(tpj("#rev_slider_9_1").revolution == undefined){
                revslider_showDoubleJqueryError("#rev_slider_9_1");
            }else{
                revapi9 = tpj("#rev_slider_9_1").show().revolution({
                    sliderLayout:"auto",
                    dottedOverlay:"none",
                    delay:9000,
                    navigation: {
                        onHoverStop:"off",
                    },
                    responsiveLevels:[1240,1024,778,480],
                    visibilityLevels:[1240,1024,778,480],
                    gridwidth:[1920,1024,778,480],
                    gridheight:[700,1000,1000,800],
                    lazyType:"none",
                    shadow:0,
                    spinner:"spinner0",
                    stopLoop:"off",
                    stopAfterLoops:-1,
                    stopAtSlide:-1,
                    shuffle:"off",
                    autoHeight:"off",
                    disableProgressBar:"on",
                    hideThumbsOnMobile:"off",
                    hideSliderAtLimit:0,
                    hideCaptionAtLimit:0,
                    hideAllCaptionAtLilmit:0,
                    debugMode:false,
                    fallbacks: {
                        simplifyAll:"off",
                        nextSlideOnWindowFocus:"off",
                        disableFocusListener:false,
                    }
                });
            }

            if (tpj("#rev_slider_15_1").revolution == undefined) {
                revslider_showDoubleJqueryError("#rev_slider_15_1");
            } else {
                revapi18 = tpj("#rev_slider_15_1").show().revolution({
                    sliderType: "standard",
                    sliderLayout: "fullwidth",
                    dottedOverlay: "none",
                    delay: 7500,
                    navigation: {
                        keyboardNavigation: "off",
                        keyboard_direction: "horizontal",
                        mouseScrollNavigation: "off",
                        mouseScrollReverse: "default",
                        onHoverStop: "off",
                        bullets: {
                            enable: true,
                            hide_onmobile: false,
                            style: "erinyen",
                            hide_onleave: false,
                            direction: "horizontal",
                            h_align: "center",
                            v_align: "bottom",
                            h_offset: 0,
                            v_offset: 40,
                            space: 5,
                            tmp: ''
                        }
                    },
                    visibilityLevels: [1200, 1199, 992, 768, 576],
                    responsiveLevels: [1200, 1199, 992, 768, 576],
                    gridwidth:[1140, 960, 720, 540],
                    gridheight:[700, 650, 600, 400],
                    lazyType: "none",
                    parallax: {
                        type: "mouse",
                        origo: "enterpoint",
                        speed: 400,
                        speedbg: 0,
                        speedls: 0,
                        levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                        disable_onmobile: "on"
                    },
                    shadow: 0,
                    spinner: "spinner0",
                    stopLoop: "off",
                    stopAfterLoops: -1,
                    stopAtSlide: -1,
                    shuffle: "off",
                    autoHeight: "off",
                    disableProgressBar: "on",
                    hideThumbsOnMobile: "off",
                    hideSliderAtLimit: 0,
                    hideCaptionAtLimit: 0,
                    hideAllCaptionAtLilmit: 0,
                    debugMode: false,
                    fallbacks: {
                        simplifyAll: "off",
                        nextSlideOnWindowFocus: "off",
                        disableFocusListener: false,
                    }
                });
            }
        }
        /* END OF ON LOAD FUNCTION */
    }());
    /* END OF WRAPPING FUNCTION */
})(jQuery);