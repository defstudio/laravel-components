$(document).on("change", '.def-components-file-input', function () {
    const $file_input = $(this);
    let original_text = $file_input.data('original_text');

    if (original_text === '') {
        original_text = $file_input.siblings(".custom-file-label").html();
        $file_input.data('original_text', original_text);
    }

    let fileName = $.map($file_input.prop('files'), file_data => file_data.name).join(', ');

    if (fileName === "") {
        $file_input.siblings(".custom-file-label").removeClass("selected").html(original_text);
    } else {
        $file_input.siblings(".custom-file-label").addClass("selected").html(fileName);
    }
});
