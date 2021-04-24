'use strict';

// Class definition
var KTDualListbox = function() {
    // Private functions
    var initDualListbox = function() {
        // Dual Listbox
        var listBoxes = $('.dual-listbox');

        listBoxes.each(function() {
            var $this = $(this);
            // get titles
            var availableTitle = ($this.attr('data-available-title') != null) ? $this.attr('data-available-title') : 'گزینه های موجود';
            var selectedTitle = ($this.attr('data-selected-title') != null) ? $this.attr('data-selected-title') : 'انتخاب گزینه ها';

            // get button labels
            var addLabel = ($this.attr('data-add') != null) ? $this.attr('data-add') : 'افزودن';
            var removeLabel = ($this.attr('data-remove') != null) ? $this.attr('data-remove') : 'حذف';
            var addAllLabel = ($this.attr('data-add-all') != null) ? $this.attr('data-add-all') : 'افزودن همه';
            var removeAllLabel = ($this.attr('data-remove-all') != null) ? $this.attr('data-remove-all') : 'حذف همه';

            // get options
            var options = [];
            $this.children('option').each(function() {
                var value = $(this).val();
                var label = $(this).text();
                options.push({
                    text: label,
                    value: value
                });
            });

            // get search option
            var search = ($this.attr('data-search') != null) ? $this.attr('data-search') : '';

            // init dual listbox
            var dualListBox = new DualListbox($this.get(0), {
                addEvent: function(value) {
                    console.log(value);
                },
                removeEvent: function(value) {
                    console.log(value);
                },
                availableTitle: availableTitle,
                selectedTitle: selectedTitle,
                addButtonText: addLabel,
                removeButtonText: removeLabel,
                addAllButtonText: addAllLabel,
                removeAllButtonText: removeAllLabel,
                options: options,
            });

            if (search == 'false') {
                dualListBox.search.classList.add('dual-listbox__search--hidden');
            }
        });
    };

    return {
        // public functions
        init: function() {
            initDualListbox();
        },
    };
}();

jQuery(document).ready(function() {
    KTDualListbox.init();
});
