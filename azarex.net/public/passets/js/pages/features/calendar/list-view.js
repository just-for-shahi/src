"use strict";

var KTCalendarListView = function() {

    return {
        //main function to initiate the module
        init: function() {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

                isRTL: KTUtil.isRTL(),
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                height: 800,
                contentHeight: 750,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                views: {
                    dayGridMonth: { buttonText: 'ماه' },
                    timeGridWeek: { buttonText: 'هفته' },
                    timeGridDay: { buttonText: 'روز' },
                    listDay: { buttonText: 'لیست' },
                    listWeek: { buttonText: 'لیست' }
                },

                defaultView: 'listWeek',
                defaultDate: TODAY,

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                events: [
                    {
                        title: 'رویداد یک روز کامل',
                        start: YM + '-01',
                        description:  'این یک متن تستی است برای توضیحات',
                        className: "fc-event-danger fc-event-solid-warning"
                    },
                    {
                        title: 'گزارش نویسی',
                        start: YM + '-14T13:30:00',
                        description:  'این یک متن تستی است برای توضیحات',
                        end: YM + '-14',
                        className: "fc-event-success"
                    },
                    {
                        title: 'سفر کاری',
                        start: YM + '-02',
                        description:  'این یک متن تستی است برای توضیحات',
                        end: YM + '-03',
                        className: "fc-event-primary"
                    },
                    {
                        title:  'انتشار محصول',
                        start: YM + '-03',
                        description:  'این یک متن تستی است برای توضیحات',
                        end: YM + '-05',
                        className: "fc-event-light fc-event-solid-primary"
                    },
                    {
                        title: 'شام',
                        start: YM + '-12',
                        description:  'این یک متن تستی است برای توضیحات',
                        end: YM + '-10'
                    },
                    {
                        id: 999,
                        title: 'تکرار رویداد',
                        start: YM + '-09T16:00:00',
                        description:  'این یک متن تستی است برای توضیحات',
                        className: "fc-event-danger"
                    },
                    {
                        id: 1000,
                        title: 'تکرار رویداد',
                        description:  'این یک متن تستی است برای توضیحات',
                        start: YM + '-16T16:00:00'
                    },
                    {
                        title: 'کنفرانس',
                        start: YESTERDAY,
                        end: TOMORROW,
                        description:  'این یک متن تستی است برای توضیحات',
                        className: "fc-event-primary"
                    },
                    {
                        title: 'ملاقات',
                        start: TODAY + 'T10:30:00',
                        end: TODAY + 'T12:30:00',
                        description:  'این یک متن تستی است برای توضیحات',
                    },
                    {
                        title: 'ناهار',
                        start: TODAY + 'T12:00:00',
                        className: "fc-event-info",
                        description:  'این یک متن تستی است برای توضیحات',
                    },
                    {
                        title: 'ملاقات',
                        start: TODAY + 'T14:30:00',
                        className: "fc-event-warning",
                        description:  'این یک متن تستی است برای توضیحات',
                    },
                    {
                        title: 'ساعت تولد',
                        start: TODAY + 'T17:30:00',
                        className: "fc-event-info",
                        description:  'این یک متن تستی است برای توضیحات',
                    },
                    {
                        title: 'شام',
                        start: TOMORROW + 'T05:00:00',
                        className: "fc-event-solid-danger fc-event-light",
                       description:  'این یک متن تستی است برای توضیحات',
                    },
                    {
                        title: 'جشن تولد',
                        start: TOMORROW + 'T07:00:00',
                        className: "fc-event-primary",
                        description:  'این یک متن تستی است برای توضیحات',
                    },
                    {
                        title: 'کلیک روی گوگل',
                        url: 'http://google.com/',
                        start: YM + '-28',
                        className: "fc-event-solid-info fc-event-light",
                        description:  'این یک متن تستی است برای توضیحات',
                    }
                ],

                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }
            });

            calendar.render();
        }
    };
}();

jQuery(document).ready(function() {
    KTCalendarListView.init();
});
