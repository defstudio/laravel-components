$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('body').popover({
        placement: 'bottom',
        container: 'body',
        html: true,
        selector: '[data-toggle="popover"]',
    });
});
