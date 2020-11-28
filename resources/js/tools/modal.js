let $question_modal;

//Modal in modal
$(document).on('show.bs.modal', '.modal', function () {
    let zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function () {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});


$(document).ready(function () {
    $question_modal = $('#deftools_question_modal')
    $question_modal.modal({
        show: false,
        keyboard: true
    });
});


function reset_question_modal() {
    $question_modal.find('.modal-dialog').addClass('modal-sm');
    $question_modal.find('.modal-dialog').removeClass('modal-lg');
    $question_modal.find('.modal-header').removeClass('bg-danger');
    $question_modal.find('.modal-header').removeClass('bg-warning');
    $question_modal.find('.modal-header').removeClass('bg-success');
    $question_modal.find('.modal-ok-button').removeClass('btn-danger');
    $question_modal.find('.modal-ok-button').removeClass('btn-warning');
    $question_modal.find('.modal-ok-button').removeClass('btn-success');
    $question_modal.find('.modal-title').html("");
    $question_modal.find('.modal-message').html("");

    $question_modal.off('.question_handling');
}

export default {
    success: function (title, message, ok_action = function () {
    }, abort_action = function () {
    }) {
        reset_question_modal();
        $question_modal.find('.modal-header').addClass('bg-success');
        $question_modal.find('.modal-ok-button').addClass('btn-success');
        $question_modal.find('.modal-title').html(title);
        $question_modal.find('.modal-message').html(message);

        $question_modal.on('click.question_handling', '.modal-ok-button', ok_action);
        $question_modal.on('click.question_handling', '.modal-abort-button', abort_action);

        $question_modal.modal('show');
    },
    warning: function (title, message, ok_action = null, abort_action = null, large = false) {
        reset_question_modal();
        if (large) $question_modal.find('.modal-dialog').removeClass('modal-sm');
        if (large) $question_modal.find('.modal-dialog').addClass('modal-lg');
        $question_modal.find('.modal-header').addClass('bg-warning');
        $question_modal.find('.modal-ok-button').addClass('btn-warning');
        $question_modal.find('.modal-title').html(title);
        $question_modal.find('.modal-message').html(message);


        if (ok_action !== null) $question_modal.on('click.question_handling', '.modal-ok-button', ok_action);

        if (abort_action !== null) $question_modal.on('click.question_handling', '.modal-abort-button', abort_action);

        $question_modal.modal('show');
    },
    danger: function (title, message, ok_action = function () {
    }, abort_action = function () {
    }) {
        reset_question_modal();
        $question_modal.find('.modal-header').addClass('bg-danger');
        $question_modal.find('.modal-ok-button').addClass('btn-danger');
        $question_modal.find('.modal-title').html(title);
        $question_modal.find('.modal-message').html(message);

        $question_modal.on('click.question_handling', '.modal-ok-button', ok_action);
        $question_modal.on('click.question_handling', '.modal-abort-button', abort_action);

        $question_modal.modal('show');
    },
};
