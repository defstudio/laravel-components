let $message_modal;

$(document).ready(function () {
    $message_modal = $('#deftools_message_modal');
    $message_modal.modal({
        show: false,
        keyboard: true
    });
});

function reset_message_modal() {
    $message_modal.find('.modal-header').removeClass('bg-danger');
    $message_modal.find('.modal-header').removeClass('bg-warning');
    $message_modal.find('.modal-header').removeClass('bg-success');
    $message_modal.find('.modal-title').html("");
    $message_modal.find('.modal-message').html("");
    $message_modal.find('.modal-dialog').addClass('modal-sm');
}

export default {
    success: function (title, message) {
        reset_message_modal();
        $message_modal.find('.modal-header').addClass('bg-success');
        $message_modal.find('.modal-title').html(title);
        $message_modal.find('.modal-message').html(message);
        $message_modal.modal('show');
    },
    warning: function (title, message) {
        reset_message_modal();
        $message_modal.find('.modal-header').addClass('bg-warning');
        $message_modal.find('.modal-title').html(title);
        $message_modal.find('.modal-message').html(message);
        $message_modal.modal('show');
    },
    danger: function (title, message, small = true) {
        reset_message_modal();

        if (!small) {
            $message_modal.find('.modal-dialog').removeClass('modal-sm');
        }

        $message_modal.find('.modal-header').addClass('bg-danger');
        $message_modal.find('.modal-title').html(title);
        $message_modal.find('.modal-message').html(message);
        $message_modal.modal('show');
    },
};
