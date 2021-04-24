"use strict";

var KTCardTools = function () {
    // Toastr
    var initToastr = function() {
        toastr.options.showDuration = 1000;
    }

    // Demo 1
    var demo1 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_1');

        // Toggle event handlers
        card.on('beforeCollapse', function(card) {
            setTimeout(function() {
                toastr.info('قبل از حادثه سقوط اخراج شد!');
            }, 100);
        });

        card.on('afterCollapse', function(card) {
            setTimeout(function() {
                toastr.warning('قبل از حادثه سقوط اخراج شد!');
            }, 2000);
        });

        card.on('beforeExpand', function(card) {
            setTimeout(function() {
                toastr.info('قبل از گسترش رویداد اخراج شد!');
            }, 100);
        });

        card.on('afterExpand', function(card) {
            setTimeout(function() {
                toastr.warning('پس از گسترش رویداد اخراج شد!');
            }, 2000);
        });

        // Remove event handlers
        card.on('beforeRemove', function(card) {
            toastr.info('قبل از حذف رویداد اخراج!');

            return confirm('مطمئن هستید که این کارت را حذف می کنید؟');  // remove card after user confirmation
        });

        card.on('afterRemove', function(card) {
            setTimeout(function() {
                toastr.warning('پس از حذف رویداد اخراج شد!');
            }, 2000);
        });

        // Reload event handlers
        card.on('reload', function(card) {
            toastr.info('رویداد لندو اخراج شد!');

            KTApp.block(card.getSelf(), {
                overlayColor: '#ffffff',
                type: 'loader',
                state: 'primary',
                opacity: 0.3,
                size: 'lg'
            });

            // update the content here

            setTimeout(function() {
                KTApp.unblock(card.getSelf());
            }, 2000);
        });
    }

    // Demo 2
    var demo2 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_2');

        // Toggle event handlers
        card.on('beforeCollapse', function(card) {
            setTimeout(function() {
                toastr.info('قبل از حادثه سقوط اخراج شد!');
            }, 100);
        });

        card.on('afterCollapse', function(card) {
            setTimeout(function() {
                toastr.warning('قبل از حادثه سقوط اخراج شد!');
            }, 2000);
        });

        card.on('beforeExpand', function(card) {
            setTimeout(function() {
                toastr.info('قبل از گسترش رویداد اخراج شد!');
            }, 100);
        });

        card.on('afterExpand', function(card) {
            setTimeout(function() {
                toastr.warning('پس از گسترش رویداد اخراج شد!');
            }, 2000);
        });

        // Remove event handlers
        card.on('beforeRemove', function(card) {
            toastr.info('قبل از حذف رویداد اخراج!');

            return confirm('مطمئن هستید که این کارت را حذف می کنید؟');  // remove card after user confirmation
        });

        card.on('afterRemove', function(card) {
            setTimeout(function() {
                toastr.warning('پس از حذف رویداد اخراج شد!');
            }, 2000);
        });

        // Reload event handlers
        card.on('reload', function(card) {
            toastr.info('رویداد لندو اخراج شد!');

            KTApp.block(card.getSelf(), {
                overlayColor: '#000000',
                type: 'spinner',
                state: 'primary',
                opacity: 0.05,
                size: 'lg'
            });

            // update the content here

            setTimeout(function() {
                KTApp.unblock(card.getSelf());
            }, 2000);
        });
    }

    // Demo 3
    var demo3 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_3');

        // Toggle event handlers
        card.on('beforeCollapse', function(card) {
            setTimeout(function() {
                toastr.info('قبل از حادثه سقوط اخراج شد!');
            }, 100);
        });

        card.on('afterCollapse', function(card) {
            setTimeout(function() {
                toastr.warning('قبل از حادثه سقوط اخراج شد!');
            }, 2000);
        });

        card.on('beforeExpand', function(card) {
            setTimeout(function() {
                toastr.info('قبل از گسترش رویداد اخراج شد!');
            }, 100);
        });

        card.on('afterExpand', function(card) {
            setTimeout(function() {
                toastr.warning('پس از گسترش رویداد اخراج شد!');
            }, 2000);
        });

        // Remove event handlers
        card.on('beforeRemove', function(card) {
            toastr.info('قبل از حذف رویداد اخراج!');

            return confirm('مطمئن هستید که این کارت را حذف می کنید؟');  // remove card after user confirmation
        });

        card.on('afterRemove', function(card) {
            setTimeout(function() {
                toastr.warning('پس از حذف رویداد اخراج شد!');
            }, 2000);
        });

        // Reload event handlers
        card.on('reload', function(card) {
            toastr.info('رویداد لندو اخراج شد!');

            KTApp.block(card.getSelf(), {
                type: 'loader',
                state: 'success',
                message: 'لطفا صبر کنید...'
            });

            // update the content here

            setTimeout(function() {
                KTApp.unblock(card.getSelf());
            }, 2000);
        });

        // Reload event handlers
        card.on('afterFullscreenOn', function(card) {
            toastr.warning('After fullscreen on event fired!');
            var scrollable = $(card.getBody()).find('> .kt-scroll');

            if (scrollable) {
                scrollable.data('original-height', scrollable.css('height'));
                scrollable.css('height', '100%');

                KTUtil.scrollUpdate(scrollable[0]);
            }
        });

        card.on('afterFullscreenOff', function(card) {
            toastr.warning('After fullscreen off event fired!');
            var scrollable = $(card.getBody()).find('> .kt-scroll');

            if (scrollable) {
                var scrollable = $(card.getBody()).find('> .kt-scroll');
                scrollable.css('height', scrollable.data('original-height'));

                KTUtil.scrollUpdate(scrollable[0]);
            }
        });
    }

    // Demo 4
    var demo4 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_4');

        // Toggle event handlers
        card.on('beforeCollapse', function(card) {
            setTimeout(function() {
                toastr.info('قبل از حادثه سقوط اخراج شد!');
            }, 100);
        });

        card.on('afterCollapse', function(card) {
            setTimeout(function() {
                toastr.warning('قبل از حادثه سقوط اخراج شد!');
            }, 2000);
        });

        card.on('beforeExpand', function(card) {
            setTimeout(function() {
                toastr.info('قبل از گسترش رویداد اخراج شد!');
            }, 100);
        });

        card.on('afterExpand', function(card) {
            setTimeout(function() {
                toastr.warning('پس از گسترش رویداد اخراج شد!');
            }, 2000);
        });

        // Remove event handlers
        card.on('beforeRemove', function(card) {
            toastr.info('قبل از حذف رویداد اخراج!');

            return confirm('مطمئن هستید که این کارت را حذف می کنید؟');  // remove card after user confirmation
        });

        card.on('afterRemove', function(card) {
            setTimeout(function() {
                toastr.warning('پس از حذف رویداد اخراج شد!');
            }, 2000);
        });

        // Reload event handlers
        card.on('reload', function(card) {
            toastr.info('رویداد لندو اخراج شد!');

            KTApp.block(card.getSelf(), {
                type: 'loader',
                state: 'primary',
                message: 'لطفا صبر کنید...'
            });

            // update the content here

            setTimeout(function() {
                KTApp.unblock(card.getSelf());
            }, 2000);
        });

        // Reload event handlers
        card.on('afterFullscreenOn', function(card) {
            toastr.warning('After fullscreen on event fired!');
            var scrollable = $(card.getBody()).find('> .kt-scroll');

            if (scrollable) {
                scrollable.data('original-height', scrollable.css('height'));
                scrollable.css('height', '100%');

                KTUtil.scrollUpdate(scrollable[0]);
            }
        });

        card.on('afterFullscreenOff', function(card) {
            toastr.warning('After fullscreen off event fired!');
            var scrollable = $(card.getBody()).find('> .kt-scroll');

            if (scrollable) {
                var scrollable = $(card.getBody()).find('> .kt-scroll');
                scrollable.css('height', scrollable.data('original-height'));

                KTUtil.scrollUpdate(scrollable[0]);
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initToastr();

            // init demos
            demo1();
            demo2();
            demo3();
            demo4();
        }
    };
}();

jQuery(document).ready(function() {
    KTCardTools.init();
});
