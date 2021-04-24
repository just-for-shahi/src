(function ($) {
  "use strict";
  
  $(document).on('click', '[ui-nav] a, [data-ui-nav] a', function (e) {
    var $this = $(e.target), $active, $li, $lis;
    $this.is('a') || ($this = $this.closest('a'));
    
    $li = $this.parent();
    $lis = $li.parents('li');

    $active = $li.closest( "nav" ).find('.active');

    $lis.addClass('active');
    ( $this.next().is('ul') && $li.toggleClass('active') ) || $li.addClass('active');
    
    $active.not($lis).not($li).removeClass('active');

    if($this.attr('href') && $this.attr('href') !=''){
      $(document).trigger('Nav:changed');
    }
  });

  // init the active class when page reload\
  $('[ui-nav] a, [data-ui-nav] a').filter( function() {
        return location.href.indexOf( $(this).attr('href') ) != -1;
  }).parents('li').addClass( 'active' ).siblings().removeClass('active');

})(jQuery);
