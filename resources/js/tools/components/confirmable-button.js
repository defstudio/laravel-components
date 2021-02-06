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

        let confirm_message;
        if ($button.hasClass('confirmable-danger')) {
            confirm_message = deftools.confirm.danger;
        } else if ($button.hasClass('confirmable-warning')) {
            confirm_message = deftools.confirm.warning();
        } else if ($button.hasClass('confirmable-success')) {
            confirm_message = deftools.confirm.success;
        }

        confirm_message.danger('', message).then(confirmed => {
            if (confirmed) {
                $button.trigger('click', {confirmed});
            }
        });
    }
});
