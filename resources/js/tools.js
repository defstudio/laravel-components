window.tools = {}

//<editor-fold desc="Laravel Routes">
// noinspection JSUnresolvedVariable
tools.route = route;
//</editor-fold>

//<editor-fold desc="Numbers">
tools.numbers = {
    random: (min, max) => Math.floor(Math.random() * (max - min + 1)) + min,
}
//</editor-fold>

//<editor-fold desc="Arrays">
tools.arrays = {
    get: (obj, path, def = undefined) => {
        let stringToPath = function (path) {

            // If the path isn't a string, return it
            if (typeof path !== 'string') return path;

            // Create new array
            let output = [];

            // Split to an array with dot notation
            path.split('.').forEach(function (item) {

                // Split to an array with bracket notation
                item.split(/\[([^}]+)]/g).forEach(function (key) {

                    // Push to the new array
                    if (key.length > 0) {
                        output.push(key);
                    }

                });

            });

            return output;

        };

        // Get the path as an array
        path = stringToPath(path);

        // Cache the current object
        let current = obj;

        // For each item in the path, dig into the object
        for (let i = 0; i < path.length; i++) {

            // If the item isn't found, return the default (or null)
            if (current[path[i]] === undefined) return def;

            // Otherwise, update the current  value
            current = current[path[i]];

        }

        return current;
    }
}
//</editor-fold>

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

//<editor-fold desc="Confirm">
tools.confirm = {
    danger: function (title, message) {
        return new Promise((resolve) => {
            tools.modal.danger(title, message, function () {
                resolve(true);
            }, function () {
                resolve(false);
            });
        });
    },
    success: function (title, message) {
        return new Promise((resolve) => {
            tools.modal.success(title, message, function () {
                resolve(true);
            }, function () {
                resolve(false);
            });
        });
    },
    warning: function (title, message) {
        return new Promise((resolve) => {
            tools.modal.warning(title, message, function () {
                resolve(true);
            }, function () {
                resolve(false);
            });
        });
    }
}
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

//<editor-fold desc="Templates">
const $templates = $('#templates');
tools.templates = {
    make: function (selector, $destination = null, data = null, context = null) {
        let $element;
        if (context) {
            $element = $templates.find(`[data-context=${context}] ${selector}`).eq(0).clone();
        } else {
            $element = $templates.find(selector).eq(0).clone();
        }

        if ($element.length === 0) {
            console.error(`[Tools] Template not found: ${selector}`);
            return null;
        }

        if ($destination) {
            $destination.append($element);
        }

        if (data) {
            return tools.templates.compile($element, data);
        } else {
            return $element;
        }
    },
    compile: function ($template, data) {
        if ($template.length === 0) {
            console.error("Empty template, cannot compile");
            return $template;
        }

        if (data === null) return $template;

        $template.find('[data-show-if]').each(function () {

            let $element = $(this);
            let conditions = $element.data('show-if');


            let and_conditions = conditions.split('&&');

            let all_condition_valid = and_conditions.every(and_condition => {

                let or_conditions = and_condition.split('||');

                return or_conditions.some(condition => {

                    if (condition.substring(0, 1) === '!') {
                        condition = condition.substr(1);
                        return data[condition] === undefined || !data[condition];
                    } else {
                        return data[condition] !== undefined && data[condition];
                    }
                });

            });


            if (!all_condition_valid) {
                $element.remove();
            }


        });


        $template.addClass('template-under-processing');
        $template.wrap('<div class="template-container"></div>');

        let $container = $template.closest('.template-container');

        let html = $container.html();

        let matched_keys = html.match(new RegExp(`:[_A-Za-z0-9\.]*:`, "g"));
        for (let key of matched_keys) {
            key = key.split(':').join('');

            let value = tools.arrays.get(data, key);
            if (value !== undefined) {
                html = html.replace(new RegExp(`\\:${key}\\:`, "g"), value);
            }
        }

        $container.html(html);


        $template = $container.find('.template-under-processing');
        $template.removeClass('template-under-processing');
        $container.after($template);
        $container.remove();


        $template.find('[data-loop]').each(function () {
            let $element = $(this);

            let array_key = $element.data('loop');
            $element.removeAttr("data-loop");

            let $loop_template = $element.clone();

            $.each(tools.arrays.get(data, array_key), (loop_key, loop_value) => {
                let $new = $loop_template.clone();

                $element.after($new);

                let $wrap = $new.wrap('<div/>').parent();


                let matched_keys = $wrap.html().match(new RegExp(`:[_A-Za-z0-9\.]*:`, "g"));
                for (let key of matched_keys) {
                    key = key.split(':').join('');

                    if (key === 'value') {
                        $wrap.html($wrap.html().replace(new RegExp(":value:", "g"), loop_value));
                        $wrap.val($wrap.val().replace(new RegExp(":value:", "g"), loop_value));
                    } else if (key === 'key') {
                        $wrap.html($wrap.html().replace(new RegExp(":key:", "g"), loop_key));
                        $wrap.val($wrap.val().replace(new RegExp(":key:", "g"), loop_key));
                    } else {
                        key = key.replace('value.', '');
                        let value = tools.arrays.get(loop_value, key);

                        if (value === undefined) value = '';
                        $wrap.html($wrap.html().replace(new RegExp(`:value.${key}:`, "g"), value));
                        $wrap.val($wrap.val().replace(new RegExp(`:value.${key}:`, "g"), value));
                    }


                }

                $wrap.replaceWith($wrap.children());


            });

            $element.remove();
        });


        return $template;
    }
}
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
tools.summernote = {
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
