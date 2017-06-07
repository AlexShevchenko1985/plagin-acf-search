(function ($, window, document) {
    'use strict';
    var page = {
        init: function () {
            page.checked();
        },
        checked: function () {
            $('#settings_form input').bind("change click select", function () {
                var $select_all = $('#settings_form input#checkAll'),
                    $checkboxes = $('#settings_form input[name="bd_acf_fields_array[]"]:enabled'),
                    checkboxes_size = $checkboxes.size(),
                    checkboxes_selected_size = $checkboxes.filter(':checked').size();
                if ($(this).attr('id') == $select_all.attr('id')) {
                    if ($select_all.is(':checked')) {
                        $checkboxes.attr('checked', true);
                    } else {
                        $checkboxes.attr('checked', false);
                    }
                } else {
                    if (checkboxes_size == checkboxes_selected_size) {
                        $select_all.attr('checked', true);
                    } else {
                        $select_all.attr('checked', false);
                    }
                }
            });
        },
        load: function () {
        },
        resize: function () {
        },
        scroll: function () {
        }
    };

    $(document).ready(page.init);
    $(window).on({
        'load': page.load,
        'resize': page.resize,
        'scroll': page.scroll
    });
})(jQuery, window, document);