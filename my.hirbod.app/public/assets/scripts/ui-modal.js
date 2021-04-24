(function ($) {
	"use strict";
	
    $(document).on('click', '[ui-modal], [data-ui-modal]', function (e) {
        var $target = $(this).attr('ui-target') || $(this).attr('data-ui-target') || $(this).attr('data-target');
        $($target).on('hidden.bs.modal', function () {
		  $($target).attr('style','');
		})
    });

    //resize
    $(window).on('resize', function () {
    	var $w = $(window).width()
    	    ,$lg = 1200
    	    ,$md = 991
    	    ,$sm = 768
    	    ;
    	if($w > $lg){
    		$('.aside-lg').modal('hide');
    	}
    	if($w > $md){
    		$('#aside').modal('hide');
    		$('.aside-md, .aside-sm').modal('hide');
    	}
    	if($w > $sm){
    		$('.aside-sm').modal('hide');
    	}
    });

})(jQuery);
