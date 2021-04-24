(function ($) {
	"use strict";
	
    $(document).on('click', '[ui-toggle-class], [data-ui-toggle-class]', function (e) {
        e.preventDefault();
        var $self = $(this);
        var attr = $self.attr('data-ui-toggle-class') || $self.attr('ui-toggle-class');
        var target = $self.attr('data-ui-target') || $self.attr('ui-target');
		var classes = ( attr && attr.split(',')) || '',
			targets = (target && target.split(',')) || Array($self),
			key = 0;
		$.each(classes, function( index, value ) {
			var target = $( targets[(targets.length && key)] ),
                current = target.attr('data-ui-class'),
                _class = classes[index];

            (current != _class) && target.removeClass( target.attr('data-ui-class') );
			target.toggleClass(classes[index]);
			target.attr('data-ui-class', _class);
			key ++;
		});
		$self.toggleClass('active');

    });
})(jQuery);
