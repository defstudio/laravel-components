$(document).on('click', '.apply-zoom', function () {
    const $target = $(this).closest('.zoomable');

    $target.toggleClass('zoomed');
});
