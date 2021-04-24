(function ($) {
	'use strict';

    
    $('[ui-jp], [data-ui-jp]').uiJp();
    $('body').uiInclude();
    $('[data-toggle="tooltip"]').tooltip();

    init();
    function init(){
      $('[data-toggle="tooltip"]').tooltip();
    }

    // pjax
    $(document).on('pjaxStart', function() {
        $('#aside').modal('hide');
        $('body').removeClass('modal-open').find('.modal-backdrop').remove();
        $('.navbar-toggleable-sm').collapse('hide');
    });
    
    if ($.support.pjax) {
      $.pjax.defaults.maxCacheLength = 0;
      var container = $('.pjax-container');
      $(document).on('click', 'a[data-pjax], [data-pjax] a, #aside a, .item a', function(event) {
        if($(".pjax-container").length == 0 || $(this).hasClass('no-ajax')){
          return;
        }
        $.pjax.click(event, {container: container, timeout: 6000, fragment: '.pjax-container'});
      });

      $(document).on('pjax:start', function() {
        $( document ).trigger( "pjaxStart" );
      });
      // fix js
      $(document).on('pjax:end', function(event) {
        
        $(event.target).find('[ui-jp], [data-ui-jp]').uiJp();
        $(event.target).uiInclude();

        $( document ).trigger( "pjaxEnd" );
        
        init();
      });
    }

    // blockui
    if ($.blockUI) {
      $(document).on('click', '#subnav .navside a, #subnav .item-title', function() { 
          $('#list').block({
            message: '<i class="fa fa-lg fa-refresh fa-spin"></i>' ,
            css: {
				fontFamily: 'iransans',
              border: 'none', 
              backgroundColor: 'transparent',
              color: '#fff',
              padding: '30px',
              width: '100%'
            },
            timeout: 1000
          }); 
      });

      $(document).on('click', '#list .item-title', function() { 
          $('#detail').block({
            message: '<i class="fa fa-lg fa-refresh fa-spin"></i>' ,
            css: {
			  fontFamily: 'iransans',
              border: 'none', 
              backgroundColor: 'transparent',
              color: '#fff',
              padding: '30px',
              width: '100%'
            },
            timeout: 1000
          }); 
      });
    }

})(jQuery);
