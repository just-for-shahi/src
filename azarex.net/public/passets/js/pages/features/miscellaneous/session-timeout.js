"use strict";

var KTSessionTimeoutDemo = function () {
    var initDemo = function () {
        $.sessionTimeout({
            title: 'اعلان ریدایرکت',
            message: 'منقضی شدن سشن.',
            keepAliveUrl: HOST_URL + '/api//session-timeout/keepalive.php',
            redirUrl: '?p=page_user_lock_1',
            logoutUrl: '?p=page_user_login_1',
            warnAfter: 5000, //warn after 5 seconds
            redirAfter: 15000, //redirect after 15 secons,
            ignoreUserActivity: true,
            countdownMessage: 'ریدایرکت {timer} ثانیه.',
            countdownBar: true
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initDemo();
        }
    };
}();

jQuery(document).ready(function() {
    KTSessionTimeoutDemo.init();
});
