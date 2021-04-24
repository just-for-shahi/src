"use strict";

var KTTreeview = function () {

    var _demo1 = function () {
        $('#kt_tree_1').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder"
                },
                "file" : {
                    "icon" : "fa fa-file"
                }
            },
            "plugins": ["types"]
        });
    }

    var _demo2 = function () {
        $('#kt_tree_2').jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-warning"
                },
                "file" : {
                    "icon" : "fa fa-file  text-warning"
                }
            },
            "plugins": ["types"]
        });

        // handle link clicks in tree nodes(support target="_blank" as well)
        $('#kt_tree_2').on('select_node.jstree', function(e,data) {
            var link = $('#' + data.selected).find('a');
            if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                if (link.attr("target") == "_blank") {
                    link.attr("href").target = "_blank";
                }
                document.location.href = link.attr("href");
                return false;
            }
        });
    }

    var _demo3 = function () {
        $('#kt_tree_3').jstree({
            'plugins': ["wholerow", "checkbox", "types"],
            'core': {
                "themes" : {
                    "responsive": false
                },
                'data': [{
                        "text": "با قابلیت چک باکس",
                        "children": [{
                            "text": "انتخاب شده",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "آیکون سفارشی",
                            "icon": "fa fa-warning text-danger"
                        }, {
                            "text": "باز شده",
                            "icon" : "fa fa-folder text-default",
                            "state": {
                                "opened": true
                            },
                            "children": ["گره دیگر"]
                        }, {
                            "text": "آیکون سفارشی",
                            "icon": "fa fa-warning text-waring"
                        }, {
                            "text": "گره غیرفعال",
                            "icon": "fa fa-check text-success",
                            "state": {
                                "disabled": true
                            }
                        }]
                    },
                    "انتخاب"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-warning"
                },
                "file" : {
                    "icon" : "fa fa-file  text-warning"
                }
            },
        });
    }

    var _demo4 = function() {
        $("#kt_tree_4").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data': [{
                        "text": "گره والد",
                        "children": [{
                            "text": "انتخاب شده",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "آیکون سفارشی",
                            "icon": "flaticon2-hourglass-1 text-danger"
                        }, {
                            "text": "باز شده",
                            "icon" : "fa fa-folder text-success",
                            "state": {
                                "opened": true
                            },
                            "children": [
                                {"text": "گره دیگر", "icon" : "fa fa-file text-waring"}
                            ]
                        }, {
                            "text": "دیگر آیکون سفارشی",
                            "icon": "flaticon2-drop text-waring"
                        }, {
                            "text": "گره غیرفعال",
                            "icon": "fa fa-check text-success",
                            "state": {
                                "disabled": true
                            }
                        }, {
                            "text": "زیر گره",
                            "icon": "fa fa-folder text-danger",
                            "children": [
                                {"text": "آیتم 1", "icon" : "fa fa-file text-waring"},
                                {"text": "آیتم 2", "icon" : "fa fa-file text-success"},
                                {"text": "آیتم 3", "icon" : "fa fa-file text-default"},
                                {"text": "آیتم 4", "icon" : "fa fa-file text-danger"},
                                {"text": "آیتم 5", "icon" : "fa fa-file text-info"}
                            ]
                        }]
                    },
                    "گره دیگر"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-primary"
                },
                "file" : {
                    "icon" : "fa fa-file  text-primary"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "contextmenu", "state", "types" ]
        });
    }

    var _demo5 = function() {
        $("#kt_tree_5").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                },
                // so that create works
                "check_callback" : true,
                'data': [{
                        "text": "گره والد",
                        "children": [{
                            "text": "انتخاب شده",
                            "state": {
                                "selected": true
                            }
                        }, {
                            "text": "آیکون سفارشی",
                            "icon": "flaticon2-warning text-danger"
                        }, {
                            "text": "باز شده",
                            "icon" : "fa fa-folder text-success",
                            "state": {
                                "opened": true
                            },
                            "children": [
                                {"text": "گره دیگر", "icon" : "fa fa-file text-waring"}
                            ]
                        }, {
                            "text": "دیگر آیکون سفارشی",
                            "icon": "flaticon2-bell-5 text-waring"
                        }, {
                            "text": "گره غیرفعال",
                            "icon": "fa fa-check text-success",
                            "state": {
                                "disabled": true
                            }
                        }, {
                            "text": "زیر گره",
                            "icon": "fa fa-folder text-danger",
                            "children": [
                                {"text": "آیتم 1", "icon" : "fa fa-file text-waring"},
                                {"text": "آیتم 2", "icon" : "fa fa-file text-success"},
                                {"text": "آیتم 3", "icon" : "fa fa-file text-default"},
                                {"text": "آیتم 4", "icon" : "fa fa-file text-danger"},
                                {"text": "آیتم 5", "icon" : "fa fa-file text-info"}
                            ]
                        }]
                    },
                    "گره دیگر"
                ]
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder text-success"
                },
                "file" : {
                    "icon" : "fa fa-file  text-success"
                }
            },
            "state" : { "key" : "demo2" },
            "plugins" : [ "dnd", "state", "types" ]
        });
    }

    var _demo6 = function() {
        $("#kt_tree_6").jstree({
            "core": {
                "themes": {
                    "responsive": false
                },
                // so that create works
                "check_callback": true,
                'data': {
                    'url': function(node) {
                        return HOST_URL + '/api//jstree/ajax_data.php';
                    },
                    'data': function(node) {
                        return {
                            'parent': node.id
                        };
                    }
                }
            },
            "types": {
                "default": {
                    "icon": "fa fa-folder text-primary"
                },
                "file": {
                    "icon": "fa fa-file  text-primary"
                }
            },
            "state": {
                "key": "demo3"
            },
            "plugins": ["dnd", "state", "types"]
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            _demo1();
            _demo2();
            _demo3();
            _demo4();
            _demo5();
            _demo6();
        }
    };
}();

jQuery(document).ready(function() {
    KTTreeview.init();
});
