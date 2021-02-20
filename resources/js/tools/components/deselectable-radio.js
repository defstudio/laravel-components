$(document).on('click', '.custom-control-label', function (e) {
    const $radio = $(this).closest('.custom-radio').find('input');
    if ($radio.is(':checked')) {
        e.preventDefault();
        $radio.prop('checked', false);
    }
})
