window.tools = {
    route: route,
}

//<editor-fold desc="Modals">

//question modal
let $question_modal = $('#tools_question_modal');
$question_modal.modal({
    show: false,
    keyboard: true
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

tools.modal = {
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
//</editor-fold>

//<editor-fold desc="Messages">
//message modal
let $message_modal = $('#tools_message_modal');
$message_modal.modal({
    show: false,
    keyboard: true
});

function reset_message_modal() {
    $message_modal.find('.modal-header').removeClass('bg-danger');
    $message_modal.find('.modal-header').removeClass('bg-warning');
    $message_modal.find('.modal-header').removeClass('bg-success');
    $message_modal.find('.modal-title').html("");
    $message_modal.find('.modal-message').html("");
}

tools.message = {
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
    danger: function (title, message) {
        reset_message_modal();
        $message_modal.find('.modal-header').addClass('bg-danger');
        $message_modal.find('.modal-title').html(title);
        $message_modal.find('.modal-message').html(message);
        $message_modal.modal('show');
    },
};
//</editor-fold>

//<editor-fold desc="Password">
$(document).on('click', '.password-generator', function (e) {
    e.preventDefault();
    console.log('password generation');
    let $generator = $(this);

    let target = $generator.data('target');
    let $password_field = $(target);

    let target_confirmation = $password_field.data('confirmation');
    let $confirmation_field = $(target_confirmation);

    if ($password_field.length > 0) {

        let data_size = $password_field.data('password-size');
        let dataset = $password_field.data('character-set');

        axios.get(tools.route('users.generate_password', {size: data_size, dataset: dataset}))
            .then(response => {
                let password = response.data;
                $password_field.val(password);
                $confirmation_field.val(password);

                $password_field.attr('type', 'text');
            })
            .catch(error => console.error(error));

    }
});
//</editor-fold>

//<editor-fold desc="Tooltips">
$('[data-toggle="tooltip"]').tooltip();
$('[data-toggle="popover"]').popover();
//</editor-fold>

//<editor-fold desc="Boostrap MultiSelect">

$('select[multiple]').selectpicker();

//</editor-fold>

//<editor-fold desc="Summernote">
window.tools.summernote = {
    setup: () => {
        let $summernotes = $(".summernote:not(#templates *):not('.summernote-setup')");

        $summernotes.each(function () {
            let $element = $(this);

            let options = {
                toolbar: []
            };

            if ($element.data('enable-style')) {
                options.toolbar.push(['style', ['style']]);
            }

            if ($element.data('enable-font')) {
                options.toolbar.push(['font', ['bold', 'underline', 'clear']]);
            }

            if ($element.data('enable-color')) {
                options.toolbar.push(['color', ['color']]);
            }

            if ($element.data('enable-paragraphs')) {
                options.toolbar.push(['para', ['ul', 'ol', 'paragraph']]);
            }

            if ($element.data('enable-tables')) {
                options.toolbar.push(['table', ['table']]);
            }

            if ($element.data('enable-insert')) {
                options.toolbar.push(['insert', ['link', 'picture', 'video']]);
            }

            options.toolbar.push(['view', ['fullscreen', 'codeview']]);


            $element.summernote(options);
            $element.addClass('summernote-setup');
        });
    }
};
tools.summernote.setup();

//</editor-fold>
