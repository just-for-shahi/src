"use strict";

// Class definition

var KTKanbanBoardDemo = function() {
    // Private functions
    var _demo1 = function() {
        var kanban = new jKanban({
            element: '#kt_kanban_1',
            gutter: '0',
            widthBoard: '250px',
            boards: [{
                    'id': '_inprocess',
                    'title': 'در جریان',
                    'item': [{
                            'title': '<span class="font-weight-bold">می تونید من رو درگ کنید</span>'
                        },
                        {
                            'title': '<span class="font-weight-bold">خرید</span>'
                        }
                    ]
                }, {
                    'id': '_working',
                    'title': 'کار کردن',
                    'item': [{
                            'title': '<span class="font-weight-bold">کاری بکنید!</span>'
                        },
                        {
                            'title': '<span class="font-weight-bold">اجرا کردن</span>'
                        }
                    ]
                }, {
                    'id': '_done',
                    'title': 'انجام شده',
                    'item': [{
                            'title': '<span class="font-weight-bold">خیلی خوب</span>'
                        },
                        {
                            'title': '<span class="font-weight-bold">اکی</span>'
                        }
                    ]
                }
            ]
        });
    }

    var _demo2 = function() {
        var kanban = new jKanban({
            element: '#kt_kanban_2',
            gutter: '0',
            widthBoard: '250px',
            boards: [{
                    'id': '_inprocess',
                    'title': 'در جریان',
                    'class': 'primary',
                    'item': [{
                            'title': '<span class="font-weight-bold">می تونید من رو درگ کنید</span>',
                            'class': 'light-primary',
                        },
                        {
                            'title': '<span class="font-weight-bold">خرید</span>',
                            'class': 'light-primary',
                        }
                    ]
                }, {
                    'id': '_working',
                    'title': 'کار کردن',
                    'class': 'success',
                    'item': [{
                            'title': '<span class="font-weight-bold">کاری بکنید!</span>',
                            'class': 'light-success',
                        },
                        {
                            'title': '<span class="font-weight-bold">اجرا کردن</span>',
                            'class': 'light-success',
                        }
                    ]
                }, {
                    'id': '_done',
                    'title': 'انجام شده',
                    'class': 'danger',
                    'item': [{
                            'title': '<span class="font-weight-bold">خیلی خوب</span>',
                            'class': 'light-danger',
                        },
                        {
                            'title': '<span class="font-weight-bold">اکی</span>',
                            'class': 'light-danger',
                        }
                    ]
                }
            ]
        });
    }

    var _demo3 = function() {
        var kanban = new jKanban({
            element: '#kt_kanban_3',
            gutter: '0',
            widthBoard: '250px',
            click: function(el) {
                alert(el.innerHTML);
            },
            boards: [{
                    'id': '_todo',
                    'title': 'انجام بده',
                    'class': 'light-primary',
                    'dragTo': ['_working'],
                    'item': [{
                            'title': 'انجام وظیفه',
                            'class': 'primary'
                        },
                        {
                            'title': 'خرید',
                            'class': 'primary'
                        }
                    ]
                },
                {
                    'id': '_working',
                    'title': 'کار کردن',
                    'class': 'light-warning',
                    'item': [{
                            'title': 'کاری بکنید!',
                            'class': 'warning'
                        },
                        {
                            'title': 'اجرا کردن',
                            'class': 'warning'
                        }
                    ]
                },
                {
                    'id': '_done',
                    'title': 'انجام شده',
                    'class': 'light-success',
                    'dragTo': ['_working'],
                    'item': [{
                            'title': 'خیلی خوب',
                            'class': 'success'
                        },
                        {
                            'title': 'اکی',
                            'class': 'success'
                        }
                    ]
                },
                {
                    'id': '_notes',
                    'title': 'نکات',
                    'class': 'light-danger',
                    'item': [{
                            'title': 'دست نزن',
                            'class': 'danger'
                        },
                        {
                            'title': 'وارد نشوید',
                            'class': 'danger'
                        }
                    ]
                }
            ]
        });
    }

    var _demo4 = function() {
        var kanban = new jKanban({
            element: '#kt_kanban_4',
            gutter: '0',
            click: function(el) {
                alert(el.innerHTML);
            },
            boards: [{
                    'id': '_backlog',
                    'title': 'جمع شدن',
                    'class': 'light-dark',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                        	            <img alt="Pic" src="assets/media/users/300_24.jpg" />
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">بهینه سازی سئو</span>
                        	            <span class="label label-inline label-light-success font-weight-bold">در حال پردازش</span>
                        	        </div>
                        	    </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                        	            <span class="symbol-label font-size-h4">A.D</span>
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">حسابرس</span>
                        	            <span class="label label-inline label-light-danger font-weight-bold">در حال انجام</span>
                        	        </div>
                        	    </div>
                            `,
                        }
                    ]
                },
                {
                    'id': '_todo',
                    'title': 'انجام بده',
                    'class': 'light-danger',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                        	            <img alt="Pic" src="assets/media/users/300_16.jpg" />
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">راه اندازی سرور</span>
                        	            <span class="label label-inline label-light-dark font-weight-bold">تکمیل شده</span>
                        	        </div>
                        	    </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                        	            <img alt="Pic" src="assets/media/users/300_15.jpg" />
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">گزارشگر</span>
                        	            <span class="label label-inline label-light-warning font-weight-bold">خبر</span>
                        	        </div>
                        	    </div>
                            `,
                        }
                    ]
                },
                {
                    'id': '_working',
                    'title': 'کار کردن',
                    'class': 'light-primary',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                            	         <img alt="Pic" src="assets/media/users/300_24.jpg" />
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">بازاریابی</span>
                        	            <span class="label label-inline label-light-danger font-weight-bold">نقشه ها</span>
                        	        </div>
                        	    </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-light-info mr-3">
                        	            <span class="symbol-label font-size-h4">A.P</span>
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">حسابرس</span>
                        	            <span class="label label-inline label-light-primary font-weight-bold">انجام شده</span>
                        	        </div>
                        	    </div>
                            `,
                        }
                    ]
                },
                {
                    'id': '_done',
                    'title': 'انجام شده',
                    'class': 'light-success',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                        	            <img alt="Pic" src="assets/media/users/300_11.jpg" />
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">بهینه سازی سئو</span>
                        	            <span class="label label-inline label-light-success font-weight-bold">در حال پردازش</span>
                        	        </div>
                        	    </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-success mr-3">
                        	            <img alt="Pic" src="assets/media/users/300_20.jpg" />
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">مدیر تیم</span>
                        	            <span class="label label-inline label-light-danger font-weight-bold">در حال پردازش</span>
                        	        </div>
                        	    </div>
                            `,
                        }
                    ]
                },
                {
                    'id': '_deploy',
                    'title': 'استقرار',
                    'class': 'light-primary',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-light-warning mr-3">
                        	            <span class="symbol-label font-size-h4">D.L</span>
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">بهینه سازی سئو</span>
                        	            <span class="label label-inline label-light-success font-weight-bold">در حال پردازش</span>
                        	        </div>
                        	    </div>
                            `,
                        },
                        {
                            'title': `
                                <div class="d-flex align-items-center">
                        	        <div class="symbol symbol-light-danger mr-3">
                        	            <span class="symbol-label font-size-h4">E.K</span>
                        	        </div>
                        	        <div class="d-flex flex-column align-items-start">
                        	            <span class="text-dark-50 font-weight-bold mb-1">مطالعه </span>
                        	            <span class="label label-inline label-light-warning font-weight-bold">برنامه ریزی شده</span>
                        	        </div>
                        	    </div>
                            `,
                        }
                    ]
                }
            ]
        });

        var toDoButton = document.getElementById('addToDo');
        toDoButton.addEventListener('click', function() {
            kanban.addElement(
                '_todo', {
                    'title': `
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-light-primary mr-3">
                                <img alt="Pic" src="assets/media/users/300_14.jpg" />
                            </div>
                            <div class="d-flex flex-column align-items-start">
                                <span class="text-dark-50 font-weight-bold mb-1">مطالعه </span>
                                <span class="label label-inline label-light-success font-weight-bold">برنامه ریزی شده</span>
                            </div>
                        </div>
                    `
                }
            );
        });

        var addBoardDefault = document.getElementById('addDefault');
        addBoardDefault.addEventListener('click', function() {
            kanban.addBoards(
                [{
                    'id': '_default',
                    'title': 'New Board',
                    'class': 'primary-light',
                    'item': [{
                            'title': `
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-success mr-3">
                                        <img alt="Pic" src="assets/media/users/300_13.jpg" />
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span class="text-dark-50 font-weight-bold mb-1">Payment Modules</span>
                                        <span class="label label-inline label-light-primary font-weight-bold">In development</span>
                                    </div>
                                </div>
                        `},{
                            'title': `
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-success mr-3">
                                        <img alt="Pic" src="assets/media/users/300_12.jpg" />
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                    <span class="text-dark-50 font-weight-bold mb-1">New Project</span>
                                    <span class="label label-inline label-light-danger font-weight-bold">در حال انجام</span>
                                </div>
                            </div>
                        `}
                    ]
                }]
            )
        });

        var removeBoard = document.getElementById('removeBoard');
        removeBoard.addEventListener('click', function() {
            kanban.removeBoard('_done');
        });
    }

    // Public functions
    return {
        init: function() {
            _demo1();
            _demo2();
            _demo3();
            _demo4();
        }
    };
}();

jQuery(document).ready(function() {
    KTKanbanBoardDemo.init();
});
