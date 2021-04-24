(function ($) {
  	"use strict";
  	
	var promise = false,
		deferred = $.Deferred();
	$.fn.uiInclude = function(){
		if(!promise){
			promise = deferred.promise();
		}
		//console.log('start: includes');
		
		compile(this);

		function compile(node){
			node.find('[ui-include], [data-ui-include]').each(function(){
				var that = $(this),
					url  = that.attr('ui-include') || that.attr('data-ui-include');
				promise = promise.then( 
					function(){
						//console.log('start: compile '+ url);
						var request = $.ajax({
							url: eval(url),
							method: "GET",
							dataType: "text"
						});
						//console.log('start: loading '+ url);
						var chained = request.then(
							function(text){
								//console.log('done: loading '+ url);
								var ui = that.replaceWithPush( text );
				    			ui.find('[ui-jp], [data-ui-jp]').uiJp();
								ui.find('[ui-include], [data-ui-include]').length && compile(ui);
							}
						);
						return chained;
					}
				);
			});
		}

		deferred.resolve();
		return promise;
	}

	$.fn.replaceWithPush = function(o) {
	    var $o = $(o);
	    this.replaceWith($o);
	    return $o;
	}

})(jQuery);
