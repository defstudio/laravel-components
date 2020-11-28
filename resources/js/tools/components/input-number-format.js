$(document).on('keyup', 'input.number-format', function (e) {
    const selection = window.getSelection().toString();
    if (selection !== '') return

    if ($.inArray(e.keyCode, [38, 40, 37, 39]) !== -1) return;

    const $input = $(this);

    format_number($input);

});

format_number($('input.number-format'));

function format_number($input) {
    $input.each(function () {

        let value = $(this).val();
        value = value.replace(/[\D\s._\-]+/g, "");
        value = value ? parseInt(value, 10) : 0;
        $(this).val(value.toLocaleString("it-IT"));
    })
}

$(document).on('submit', 'form', function () {
    const $form = $(this);

    $form.find('input.number-format').each(function () {
        const $input = $(this);

        let value = $input.val();
        value = value.replace(/[\D\s._\-]+/g, "");
        value = value ? parseInt(value, 10) : 0;
        $input.val(value);
    })
})
