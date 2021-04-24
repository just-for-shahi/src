! function (l) {
    "use strict";
    var i = "body",
        o = window,
        e = document,
        t = {
            init: function () {
                t.disableEmptyLink(), t.stickyNavbar(), t.isotopeGrid(), t.isotopeFilter(), t.searchToggle(), t.offcanvas(), t.fsOverlay(), t.scrollTo(), t.scrollBackTop(), t.formValidation(), t.tooltips(), t.popovers(), t.creditCard(), t.filterList('[data-filter="#components-list"]', ".list-group-item"), t.filterList('[data-filter="#components-grid"]', ".card-title"), t.productGallery(), t.linkedCarousels(), t.toasts(), t.teamHover(), t.countDown(), t.animateProgress(), t.animateDigits(), t.rangeSlider(), t.parallax(), t.pricingSwitch(), t.googleMap()
            },
            disableEmptyLink: function (t) {
                l('a[href="#"]').on("click", function (t) {
                    t.preventDefault()
                })
            },
            stickyNavbar: function (t, a) {
                if (500, l(t = ".navbar-sticky").length) {
                    var e = l(t).outerHeight();
                    l(o).on("scroll", function () {
                        500 < l(this).scrollTop() ? (l(t).addClass("navbar-stuck"), l(t).hasClass("navbar-floating") || l(i).css("padding-top", e)) : (l(t).removeClass("navbar-stuck"), l(i).css("padding-top", 0))
                    })
                }
            },
            isotopeGrid: function (t, a) {
                if ("0.7s", l(t = ".isotope-grid").length) var e = l(t).imagesLoaded(function () {
                    e.isotope({
                        itemSelector: ".grid-item",
                        transitionDuration: "0.7s",
                        masonry: {
                            columnWidth: ".grid-sizer",
                            gutter: ".gutter-sizer"
                        }
                    })
                })
            },
            isotopeFilter: function (e, i) {
                i = ".nav-tabs", l(e = ".filter-grid").length && l(i).on("click", "a", function (t) {
                    t.preventDefault(), l(i + " a").removeClass("active"), l(this).addClass("active");
                    var a = l(this).attr("data-filter");
                    l(e).isotope({
                        filter: a
                    })
                })
            },
            searchToggle: function (t, a, e) {
                e = ".search-box", l('[data-toggle="search"]').on("click", function () {
                    l(e).addClass("is-open"), setTimeout(function () {
                        l(e + " input").focus()
                    }, 200)
                }), l(".search-close").on("click", function () {
                    l(e).removeClass("is-open")
                })
            },
            offcanvas: function (t, a, e) {
                l('[data-toggle="offcanvas"]').on("click", function (t) {
                    var a = l(this).attr("href");
                    l(a).addClass("in-view"), t.preventDefault()
                }), l(".offcanvas-close").on("click", function () {
                    l(".offcanvas-container").removeClass("in-view")
                })
            },
            fsOverlay: function (t, a, e) {
                l('[data-toggle="fullscreen-overlay"]').on("click", function (t) {
                    var a = l(this).attr("href");
                    l(a).addClass("in-view"), t.preventDefault()
                }), l(".fs-overlay-close").on("click", function () {
                    l(".fs-overlay-wrapper").removeClass("in-view")
                })
            },
            scrollTo: function (t, a) {
                console.log("Hello"), l(e).on("click", ".scroll-to", function (t) {
                    var a = l(this).attr("href");
                    if (console.log(a), "#" === a) return !1;
                    var e = l(a),
                        i = parseInt(1200, 10);
                    if (e.length) {
                        var n = e.data("offset-top") || 75;
                        l("html, body").stop().animate({
                            scrollTop: l(this.hash).offset().top - n
                        }, i, "easeOutExpo")
                    }
                    t.preventDefault()
                })
            },
            scrollBackTop: function (t, a, e) {
                if (600, 1200, l(t = ".scroll-to-top-btn").length) {
                    var i = parseInt(600, 10),
                        n = parseInt(1200, 10);
                    l(o).on("scroll", function () {
                        l(this).scrollTop() > i ? l(t).addClass("visible") : l(t).removeClass("visible")
                    }), l(t).on("click", function () {
                        l("html, body").stop().animate({
                            scrollTop: 0
                        }, n, "easeOutExpo")
                    })
                }
            },
            formValidation: function (t) {
                window.addEventListener("load", function () {
                    var t = document.getElementsByClassName("needs-validation");
                    Array.prototype.filter.call(t, function (a) {
                        a.addEventListener("submit", function (t) {
                            !1 === a.checkValidity() && (t.preventDefault(), t.stopPropagation()), a.classList.add("was-validated")
                        }, !1)
                    })
                }, !1)
            },
            tooltips: function (t) {
                l('[data-toggle="tooltip"]').tooltip()
            },
            popovers: function (t) {
                l('[data-toggle="popover"]').popover()
            },
            creditCard: function (t) {
                l(t = ".interactive-credit-card").length && l(t).card({
                    form: t,
                    container: ".card-wrapper"
                })
            },
            filterList: function (t, i) {
                l(t).each(function () {
                    var t = l(this),
                        a = (t.data("filter"), t.find("input[type=text]")),
                        e = t.find("input[type=radio]");
                    a.keyup(function () {
                        var t = a.val();
                        ".list-group-item" === i ? l(i).each(function () {
                            0 == l(this).text().toLowerCase().indexOf(t.toLowerCase()) ? l(this).show() : l(this).hide()
                        }) : l(i).each(function () {
                            0 == l(this).text().toLowerCase().indexOf(t.toLowerCase()) ? l(this).parents("[data-filter-item]").show() : l(this).parents("[data-filter-item]").hide()
                        })
                    }), e.on("click", function (t) {
                        var a = l(this).val();
                        ".list-group-item" === i ? "all" !== a ? (l(i).hide(), l("[data-filter-item=" + a + "]").show()) : l(i).show() : "all" !== a ? (l(i).parents("[data-filter-item]").hide(), l("[data-filter-item=" + a + "]").show()) : l(i).parents("[data-filter-item]").show()
                    })
                })
            },
            productGallery: function (t) {
                l(t = ".product-carousel").length && l(t).owlCarousel({
                    items: 1,
                    loop: !1,
                    dots: !1,
                    URLhashListener: !0,
                    startPosition: "URLHash",
                    onTranslate: function (t) {
                        var a = t.item.index,
                            e = l(".owl-item").eq(a).find("[data-hash]").attr("data-hash");
                        l(".product-thumbnails li").removeClass("active"), l('[href="#' + e + '"]').parent().addClass("active"), l('[data-hash="' + e + '"]').parent().addClass("active")
                    }
                })
            },
            linkedCarousels: function (t, a) {
                l(t = ".post-cards-carousel").length && l(t).on("change.owl.carousel", function (t) {
                    if (t.namespace && "position" === t.property.name) {
                        var a = t.relatedTarget.relative(t.property.value, !0);
                        l(".post-preview-img-carousel").owlCarousel("to", a, 350, !0)
                    }
                })
            },
            toasts: function (t) {
                l("[data-toast]").on("click", function () {
                    var t = l(this),
                        a = t.data("toast-type"),
                        e = t.data("toast-icon"),
                        i = t.data("toast-position"),
                        n = t.data("toast-title"),
                        o = t.data("toast-message"),
                        s = "";
                    switch (i) {
                        case "topRight":
                            s = {
                                class: "iziToast-" + a || "",
                                title: n || "Title",
                                message: o || "toast message",
                                animateInside: !1,
                                position: "topRight",
                                progressBar: !1,
                                icon: e,
                                timeout: 3200,
                                transitionIn: "fadeInLeft",
                                transitionOut: "fadeOut",
                                transitionInMobile: "fadeIn",
                                transitionOutMobile: "fadeOut"
                            };
                            break;
                        case "bottomRight":
                            s = {
                                class: "iziToast-" + a || "",
                                title: n || "Title",
                                message: o || "toast message",
                                animateInside: !1,
                                position: "bottomRight",
                                progressBar: !1,
                                icon: e,
                                timeout: 3200,
                                transitionIn: "fadeInLeft",
                                transitionOut: "fadeOut",
                                transitionInMobile: "fadeIn",
                                transitionOutMobile: "fadeOut"
                            };
                            break;
                        case "topLeft":
                            s = {
                                class: "iziToast-" + a || "",
                                title: n || "Title",
                                message: o || "toast message",
                                animateInside: !1,
                                position: "topLeft",
                                progressBar: !1,
                                icon: e,
                                timeout: 3200,
                                transitionIn: "fadeInRight",
                                transitionOut: "fadeOut",
                                transitionInMobile: "fadeIn",
                                transitionOutMobile: "fadeOut"
                            };
                            break;
                        case "bottomLeft":
                            s = {
                                class: "iziToast-" + a || "",
                                title: n || "Title",
                                message: o || "toast message",
                                animateInside: !1,
                                position: "bottomLeft",
                                progressBar: !1,
                                icon: e,
                                timeout: 3200,
                                transitionIn: "fadeInRight",
                                transitionOut: "fadeOut",
                                transitionInMobile: "fadeIn",
                                transitionOutMobile: "fadeOut"
                            };
                            break;
                        case "topCenter":
                            s = {
                                class: "iziToast-" + a || "",
                                title: n || "Title",
                                message: o || "toast message",
                                animateInside: !1,
                                position: "topCenter",
                                progressBar: !1,
                                icon: e,
                                timeout: 3200,
                                transitionIn: "fadeInDown",
                                transitionOut: "fadeOut",
                                transitionInMobile: "fadeIn",
                                transitionOutMobile: "fadeOut"
                            };
                            break;
                        case "bottomCenter":
                            s = {
                                class: "iziToast-" + a || "",
                                title: n || "Title",
                                message: o || "toast message",
                                animateInside: !1,
                                position: "bottomCenter",
                                progressBar: !1,
                                icon: e,
                                timeout: 3200,
                                transitionIn: "fadeInUp",
                                transitionOut: "fadeOut",
                                transitionInMobile: "fadeIn",
                                transitionOutMobile: "fadeOut"
                            };
                            break;
                        default:
                            s = {
                                class: "iziToast-" + a || "",
                                title: n || "Title",
                                message: o || "toast message",
                                animateInside: !1,
                                position: "topRight",
                                progressBar: !1,
                                icon: e,
                                timeout: 3200,
                                transitionIn: "fadeInLeft",
                                transitionOut: "fadeOut",
                                transitionInMobile: "fadeIn",
                                transitionOutMobile: "fadeOut"
                            }
                    }
                    iziToast.show(s)
                })
            },
            teamHover: function (t) {
                l(t = ".no-touchevents .team-card-style-1").on("mouseover", function () {
                    var t = l(this).find(".social-btn");
                    setTimeout(function () {
                        t.addClass("hover")
                    }, 120)
                }), l(t).on("mouseout", function () {
                    var t = l(this).find(".social-btn");
                    setTimeout(function () {
                        t.removeClass("hover")
                    }, 120)
                })
            },
            countDown: function (t, i) {
                l(".countdown").each(function () {
                    var t = l(this),
                        a = l(this).data("date-time"),
                        e = l(this).data("labels");
                    (i || t).countdown(a, function (t) {
                        l(this).html(t.strftime('<div class="countdown-item"><div class="countdown-value">%D</div><div class="countdown-label">' + e["label-day"] + '</div></div><div class="countdown-item"><div class="countdown-value">%H</div><div class="countdown-label">' + e["label-hour"] + '</div></div><div class="countdown-item"><div class="countdown-value">%M</div><div class="countdown-label">' + e["label-minute"] + '</div></div><div class="countdown-item"><div class="countdown-value">%S</div><div class="countdown-label">' + e["label-second"] + "</div></div>"))
                    })
                })
            },
            animateProgress: function (t) {
                l(".progress-animate-fill").on("inview", function (t, a) {
                    var e = l(this).find(".progress-bar"),
                        i = e.attr("aria-valuenow");
                    a && (l(this).addClass("progress-in-view"), e.css("width", i + "%"))
                })
            },
            animateDigits: function (t) {
                l(".animated-digits").one("inview", function (t, a) {
                    var e = l(this).find(".animated-digits-digit > span"),
                        i = l(this).data("number");
                    a && e.animateNumber({
                        number: i
                    }, 1200)
                })
            },
            rangeSlider: function (t) {
                l(".range-slider").each(function () {
                    var t = l(this),
                        a = t.find(".ui-range-slider"),
                        i = {
                            dataStartMin: parseInt(a.parent().data("start-min"), 10),
                            dataStartMax: parseInt(a.parent().data("start-max"), 10),
                            dataMin: parseInt(a.parent().data("min"), 10),
                            dataMax: parseInt(a.parent().data("max"), 10),
                            dataStep: parseInt(a.parent().data("step"), 10),
                            valueMin: t.find(".ui-range-value-min span"),
                            valueMax: t.find(".ui-range-value-max span"),
                            valueMinInput: t.find(".ui-range-value-min input"),
                            valueMaxInput: t.find(".ui-range-value-max input")
                        };
                    noUiSlider.create(a[0], {
                        start: [i.dataStartMin, i.dataStartMax],
                        connect: !0,
                        step: i.dataStep,
                        range: {
                            min: i.dataMin,
                            max: i.dataMax
                        }
                    }), a[0].noUiSlider.on("update", function (t, a) {
                        var e = t[a];
                        a ? (i.valueMax.text(Math.round(e)), i.valueMaxInput.val(Math.round(e))) : (i.valueMin.text(Math.round(e)), i.valueMinInput.val(Math.round(e)))
                    })
                })
            },
            parallax: function () {
                ParallaxScroll.init()
            },
            pricingSwitch: function (n) {
                l((n = ".pricing-tabs") + "> li > a").on("click", function (t) {
                    var a = l(this),
                        e = a.data("period"),
                        i = a.parents(".pricing-plans");
                    i.find(n + "> li > a").removeClass("active"), a.addClass("active"), i.find(".pricing-card-price").removeClass("active"), i.find("." + e).addClass("active"), t.preventDefault
                })
            },
            googleMap: function (t) {
                l(t = ".google-map").length && l(t).each(function () {
                    var t = l(this).data("height"),
                        a = l(this).data("address"),
                        e = l(this).data("zoom"),
                        i = l(this).data("disable-controls"),
                        n = l(this).data("scrollwheel"),
                        o = l(this).data("marker"),
                        s = l(this).data("marker-title"),
                        r = l(this).data("styles");
                    l(this).height(t), l(this).gmap3({
                        address: a,
                        zoom: e,
                        disableDefaultUI: i,
                        scrollwheel: n,
                        styles: r
                    }).marker({
                        address: a,
                        icon: o
                    }).infowindow({
                        content: s
                    }).then(function (t) {
                        var a = this.get(0),
                            e = this.get(1);
                        e.addListener("mouseover", function () {
                            t.open(a, e)
                        }), e.addListener("mouseout", function () {
                            t.close(a, e)
                        })
                    })
                })
            }
        };
    l(function () {
        t.init()
    })
}(jQuery);