/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

$(document).ready(function () {
    $('select[multiple]').selectpicker();

    $(document).on('change', '.custom-select.order-by-selection', function () {
        const $selector = $(this);
        const selected = $selector.val();

        if (selected.length === 1) {
            const $selected_option = $selector.find(':selected');
            $selected_option.remove();
            $selector.prepend($selected_option);
        }
    })
});
