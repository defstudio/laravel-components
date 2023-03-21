$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    
    const $body = $('body')
    $body.popover({
        placement: 'bottom',
        container: 'body',
        html: true,
        selector: '[data-toggle="popover"]',
    });
    
    $body.click(function (e) {
        if (typeof $(e.target).data('original-title') == 'undefined' && $(e.target).parents('[data-toggle="popover"]').length === 0) {
            $('[data-original-title]').popover('hide');
        }
    });
});
