/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

let $question_modal;


const default_options = {
    ok_text: '',
    abort_text: '',
    backdrop: true,
    keyboard: true,
    x_close: true,
    large: false,
}

$(document).ready(function () {
    $question_modal = $('#deftools_question_modal')
    $question_modal.modal({
        show: false,
        backdrop: true,
        keyboard: true,
    });

    default_options.abort_text = $question_modal.find('.modal-abort-button').text()
    default_options.ok_text = $question_modal.find('.modal-ok-button').text()
});


function reset_question_modal() {
    $question_modal.find('.modal-dialog').addClass('modal-sm');
    $question_modal.find('.modal-dialog').removeClass('modal-lg');

    $question_modal.find('.modal-header').removeClass('bg-danger');
    $question_modal.find('.modal-header').removeClass('bg-warning');
    $question_modal.find('.modal-header').removeClass('bg-primary');
    $question_modal.find('.modal-header').removeClass('bg-success');

    $question_modal.find('.modal-header .close').show();

    $question_modal.find('.modal-ok-button').removeClass('btn-danger');
    $question_modal.find('.modal-ok-button').removeClass('btn-warning');
    $question_modal.find('.modal-ok-button').removeClass('btn-primary');
    $question_modal.find('.modal-ok-button').removeClass('btn-success');
    $question_modal.find('.modal-ok-button').text(default_options.ok_text);

    $question_modal.find('.modal-abort-button').text(default_options.abort_text);


    $question_modal.find('.modal-title').html("");
    $question_modal.find('.modal-message').html("");

    $question_modal.off('.question_handling');
}

function show_modal(style, title, message, ok_action = null, abort_action = null, options = {}) {
    options = Object.assign({}, default_options, options);

    reset_question_modal();

    $question_modal.find('.modal-header').addClass(`bg-${style}`);

    if (!options.x_close) $question_modal.find('.modal-header .close').hide();

    $question_modal.find('.modal-ok-button').addClass(`btn-${style}`);
    $question_modal.find('.modal-ok-button').text(options.ok_text);

    $question_modal.find('.modal-abort-button').text(options.abort_text);

    $question_modal.find('.modal-title').html(title);
    $question_modal.find('.modal-message').html(message);


    if (ok_action !== null) $question_modal.on('click.question_handling', '.modal-ok-button', ok_action);
    if (abort_action !== null) $question_modal.on('click.question_handling', '.modal-abort-button', abort_action);

    $question_modal.modal({
        show: true,
        backdrop: true,
        keyboard: true,
    });
}


//Modal in modal
$(document).on('show.bs.modal', '.modal', function () {
    let zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function () {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});


export default {
    success: function (title, message, ok_action = null, abort_action = null, options = {}) {
        show_modal('primary', title, message, ok_action, abort_action, options);
    },
    warning: function (title, message, ok_action = null, abort_action = null, options = {}) {
        show_modal('warning', title, message, ok_action, abort_action, options);
    },
    primary: function (title, message, ok_action = null, abort_action = null, options = {}) {
        show_modal('primary', title, message, ok_action, abort_action, options);
    },
    secondary: function (title, message, ok_action = null, abort_action = null, options = {}) {
        show_modal('secondary', title, message, ok_action, abort_action, options);
    },
    danger: function (title, message, ok_action = null, abort_action = null, options = {}) {
        show_modal('danger', title, message, ok_action, abort_action, options);
    },


};


