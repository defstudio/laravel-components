$(document).on('click', 'a.confirmable,button[type=button].confirmable,button.force-confirm.confirmable', function (evt, confirmed = false) {
    const $button = $(this);
    const message = $button.data('confirm-message');

    if (!confirmed) {
        evt.preventDefault();

        deftools.confirm.danger('', message).then(confirmed => {
            if (confirmed) {
                $button.trigger('click', {confirmed});
            }
        });
    }
});
