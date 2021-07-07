/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */


const multiselect = {
    setup: () => {
        $('select[multiple]:not(.selectpicker-enabled)').each(function () {
            const $select = $(this);
            $select.selectpicker();
            $select.addClass('selectpicker-enabled');
        });
    }
}


$(document).ready(function () {
    multiselect.setup();

    $(document).on('change', '.custom-select.order-by-selection', function () {
        const $selector = $(this);
        const selected = $selector.val();

        if (selected.length === 1) {
            const $selected_option = $selector.find(':selected');
            $selected_option.remove();
            $selector.prepend($selected_option);
        }
    });
});

export default multiselect;
