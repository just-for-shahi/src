(function ($, MODULE_CONFIG) {
  	"use strict";
  
	$.fn.taburl = function(){

		var plugin  = this;

        plugin.each(function()
        {
        	update();
        	$(document).on("Nav:changed", function(){
        		setTimeout(update, 50);
        	});
        	function update(){
        		$('[data-toggle="tab"]').filter( function() {
				   return location.href.indexOf( $(this).attr('data-target') ) != -1;
				}).trigger('click');
        	}
        });

        return plugin;
	}

})(jQuery);
