(function ($, MODULE_CONFIG) {
  	"use strict";
  	
	$.fn.uiJp = function(){

        return this.each(function()
        {
        	var self = $(this);
        	var opts = self.attr('ui-options') || self.attr('data-ui-options');
        	var attr = self.attr('ui-jp') || self.attr('data-ui-jp');
			
			var options = opts && eval('[' + opts + ']');
			if (options && $.isPlainObject(options[0])) {
				options[0] = $.extend({}, JP_CONFIG[attr], options[0]);
			}
			
			if(self[attr]){
				self[attr].apply(self, options);
			}else{
				uiLoad.load(MODULE_CONFIG[attr]).then( function(){
					self[attr].apply(self, options);
				});
			}
        });
	}

})(jQuery, MODULE_CONFIG);
