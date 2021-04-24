;(function($,Chart){
    'use strict';

    Chart.defaults.global.defaultColor = 'rgba(120,130,140,0.1)';
    Chart.defaults.global.defaultFontColor = '#818a91';
    Chart.defaults.scale.gridLines.color = 
    Chart.defaults.scale.gridLines.zeroLineColor = 
    'rgba(120,130,140,0.1)';

    var pluginName = "chart",
        defaults = {
            
        };

    // The actual plugin constructor
    function Plugin ( element, options ) {
        this.element = element;
        this._options = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    // Avoid Plugin.prototype conflicts
    $.extend( Plugin.prototype, {
        init: function() {
            this._chart = new Chart(this.element, this._options);
        },
        update: function( text ) {
            this._chart.update();
        }
    } );

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[ pluginName ] = function( options ) {
        return this.each( function() {
            if ( !$.data( this, "plugin_" + pluginName ) ) {
                $.data( this, "plugin_" +
                    pluginName, new Plugin( this, options ) );
            }
        } );
    };
})(jQuery,Chart);
