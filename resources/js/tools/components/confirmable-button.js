/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

$(document).on('click', 'a.confirmable,button[type=button].confirmable,button.force-confirm.confirmable', function (evt, confirmed = false) {
    const $button = $(this);
    const message = $button.data('confirm-message');

    if (!confirmed) {
        evt.preventDefault();

        let display_confirm_message;
        if ($button.hasClass('confirmable-danger')) {
            display_confirm_message = deftools.confirm.danger;
        } else if ($button.hasClass('confirmable-warning')) {
            display_confirm_message = deftools.confirm.warning();
        } else if ($button.hasClass('confirmable-primary')) {
            display_confirm_message = deftools.confirm.primary();
        } else if ($button.hasClass('confirmable-success')) {
            display_confirm_message = deftools.confirm.success;
        }

        display_confirm_message('', message).then(confirmed => {
            if (confirmed) {
                $button.trigger('click', {confirmed});
            }
        });
    }
});
