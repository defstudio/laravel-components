window.deftools = {}

//<editor-fold desc="Axios">
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.axios.interceptors.request.use(function (config) {
    // noinspection JSUnresolvedVariable
    if (config.spinner ?? true) {
        deftools.spinner.show();
    }
    return config;
});

window.axios.interceptors.response.use(function (response) {
    // noinspection JSUnresolvedVariable
    if (response.config.spinner ?? true) {
        deftools.spinner.hide();
    }

    return response;
}, function (error) {
    deftools.spinner.hide(true);
    return Promise.reject(error);
});

window.axios.download = response => {
    const FileSaver = require('file-saver');
    let headerLine = response.headers['content-disposition']
    let startFileNameIndex = headerLine.indexOf('=') + 1
    let filename = headerLine.substring(startFileNameIndex)
    FileSaver.saveAs(response.data, filename);
}

let default_error_messages = {
    403: "Non disponi dei permessi necessari per completare l'operazione",
    401: "Non disponi dei permessi necessari per completare l'operazione",
    422: "I dati non sono validi",
    default: "Si è verificato un errore"
};
window.axios.handle = (error, $form = null, messages = {}) => {
    messages = $.extend({}, default_error_messages, messages || {});

    //verifica se si tratta di un errore generico
    if (error.response === undefined) {
        deftools.message.danger('Error', messages.default);
        console.error(error);
    } else {
        switch (error.response.status) {
            case 422: //validation error
                if ($form === null) {
                    deftools.message.danger('Error', messages[422]);
                    console.error(error);
                } else {
                    let invalid_fields = error.response.data.errors;

                    let errors = [];

                    $.each(invalid_fields, (field, reasons) => {
                        console.error(`invalid data for field ${field}`, reasons);

                        errors.push(...reasons);

                        const normalized_field = field.replace(/\.([\w\*]*)/g, "[$1]");

                        let $input = $($form[0].elements[normalized_field]);

                        let $feedback = $input.find('~.invalid-feedback');
                        if ($feedback.length === 0) {
                            $feedback = $("<div class='invalid-feedback'></div>");
                            $input.after($feedback);
                        }

                        $feedback.html(reasons.join("<br>"));
                        $input.addClass('is-invalid');

                        $input.trigger('def::invalid_field');
                    });


                    if (errors.length > 0) {
                        let error_message = "<ul>";
                        for (const error of errors.filter((value, index, self) => self.indexOf(value) === index)) {
                            error_message += `<li>${error}</li>`;
                        }
                        error_message += "</ul>";

                        deftools.message.danger('Error', error_message, false);
                    } else {
                        deftools.message.danger('Error', messages[422]);
                    }
                }
                break;
            case 403: //Unauthorized
                deftools.message.danger('Error', messages[403]);
                console.error(error);
                break;
            case 401: //Forbidden
                deftools.message.danger('Error', messages[403]);
                console.error(error);
                break;
            default:
                deftools.message.danger('Error', messages.default);
                console.error(error);
                break;
        }
    }
}
//</editor-fold>

//<editor-fold desc="Spinner">

let spin_count = 0;
deftools.spinner = {
    show: (message = '') => {
        spin_count++;
        if (spin_count === 1) {
            $('#spinner').addClass('visible');
        }

        if (message) {
            deftools.spinner.message(message);
        }
    },
    hide: (with_message = false) => {
        spin_count--;
        if (spin_count <= 0) {
            spin_count = 0;
            deftools.spinner.message('');
            $('#spinner').removeClass('visible');
        } else if (with_message) {
            deftools.spinner.message('');
        }
    },
    hide_all: () => {
        spin_count = 0;
        deftools.spinner.message('');
        $('#spinner').removeClass('visible');
    },
    message: message => {
        $('#spinner .message').html(message);
    }
}
//</editor-fold>

//<editor-fold desc="Numbers">
deftools.numbers = {
    random: (min, max) => Math.floor(Math.random() * (max - min + 1)) + min,
}
//</editor-fold>

//<editor-fold desc="Arrays">
deftools.arrays = {
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
let $question_modal;

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

deftools.modal = {
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
deftools.confirm = {
    danger: function (title, message) {
        return new Promise((resolve) => {
            deftools.modal.danger(title, message, function () {
                resolve(true);
            }, function () {
                resolve(false);
            });
        });
    },
    success: function (title, message) {
        return new Promise((resolve) => {
            deftools.modal.success(title, message, function () {
                resolve(true);
            }, function () {
                resolve(false);
            });
        });
    },
    warning: function (title, message) {
        return new Promise((resolve) => {
            deftools.modal.warning(title, message, function () {
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

deftools.message = {
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
    danger: function (title, message, small=true) {
        reset_message_modal();

        if(!small){
            $message_modal.find('.modal-dialog').removeClass('modal-sm');
        }

        $message_modal.find('.modal-header').addClass('bg-danger');
        $message_modal.find('.modal-title').html(title);
        $message_modal.find('.modal-message').html(message);
        $message_modal.modal('show');
    },
};
//</editor-fold>

//<editor-fold desc="Templates">
const $templates = $('#templates');
deftools.templates = {
    make: function (selector, $destination = null, data = null, context = null) {
        let $element;
        if (context) {
            $element = $templates.find(`[data-context=${context}] ${selector}`).eq(0).clone();
        } else {
            $element = $templates.find(selector).eq(0).clone();
        }

        if ($element.length === 0) {
            console.error(`[deftools] Template not found: ${selector}`);
            return null;
        }

        if ($destination) {
            $destination.append($element);
        }

        if (data) {
            return deftools.templates.compile($element, data);
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

            let value = deftools.arrays.get(data, key);
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

            $.each(deftools.arrays.get(data, array_key), (loop_key, loop_value) => {
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
                        let value = deftools.arrays.get(loop_value, key);

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

        axios.get(route('users.generate_password', {size: data_size, dataset: dataset}))
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
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $('body').popover({
        placement: 'bottom',
        container: 'body',
        html: true,
        selector: '[data-toggle="popover"]',
    });
});
//</editor-fold>

//<editor-fold desc="Boostrap MultiSelect">

$('select[multiple]').selectpicker();

//</editor-fold>

//<editor-fold desc="Remember Selected Tab">
$(document).ready(function () {
    let $tabs_to_be_remembered = $('.remeber-selected-tab');
    $tabs_to_be_remembered.on('click', 'a[data-toggle="tab"]', function () {
        let $tab = $(this);
        let $tabs = $tab.closest('.remeber-selected-tab');

        window.localStorage.setItem($tabs.attr('id') + "_active_tab", $tab.attr('href'));
    });
    $tabs_to_be_remembered.each(function () {
        let $tabs = $(this);

        let active_tab = window.localStorage.getItem($tabs.attr('id') + "_active_tab");
        if (active_tab) {
            $tabs.find('a[href="' + active_tab + '"]').tab('show');
        }
    });
});
//</editor-fold>

//<editor-fold desc="Allows open Modal from Modal">
$(document).on('show.bs.modal', '.modal', function () {
    let zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function () {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});
//</editor-fold>

//<editor-fold desc="Summernote">
deftools.summernote = {
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
deftools.summernote.setup();

//</editor-fold>

//<editor-fold desc="Custom File Input">
$(document).on("change", '.def-components-file-input', function () {
    const $file_input = $(this);
    let original_text = $file_input.data('original_text');

    if (original_text === '') {
        original_text = $file_input.siblings(".custom-file-label").html();
        $file_input.data('original_text', original_text);
    }
    let fileName = $file_input.val().split("\\").pop();

    if (fileName === "") {
        $file_input.siblings(".custom-file-label").removeClass("selected").html(original_text);
    } else {
        $file_input.siblings(".custom-file-label").addClass("selected").html(fileName);
    }
});
//</editor-fold>

//<editor-fold desc="Template Attachment">
$(document).on('click', '.template-attachment-modal .template-attachment-download-button', function () {
    const $button = $(this);
    const url = $button.data('url');
    const columns = $button.data('columns');

    axios.post(url, {columns: columns}, {responseType: 'blob'})
        .then(response => axios.download(response))
        .catch(error => axios.handle(error))
});
//</editor-fold>

//<editor-fold desc="Toggable Sections">
// noinspection JSJQueryEfficiency
if ($('.section-toggle-switch').length > 0) {
    $(document).on('change', '.section-toggle-switch', function () {
        deftools.sync_toggable_sections();
    })

    deftools.sync_toggable_sections = ($context = null) => {

        $context = $context ?? $(document);

        hide_toggable_sections($context);

        show_activated_sections($context);

    }


    function hide_toggable_sections($context) {
        $context.find('.toggable-section').addClass('hidden');
    }

    function show_activated_sections($context) {
        const switches = retrieve_switches_status($context);

        const $toggable_sections = $context.find('.toggable-section');

        for (const switch_key in switches) {
            if (switches.hasOwnProperty(switch_key)) {
                this[switch_key] = switches[switch_key];
            }
        }

        $toggable_sections.each(function () {
            const $toggable_section = $(this);
            const condition = $toggable_section.data('toggle-if');

            if (!condition) return;

            const visible = eval(condition);

            if (visible) {
                $toggable_section.removeClass('hidden');
            }
        })
    }

    function retrieve_switches_status($context) {
        let $toggle_switches = $context.find('.section-toggle-switch');

        let switches = {}

        $toggle_switches.each(function () {
            let $switch = $(this);
            if ($switch.prop('tagName') === 'SELECT') {
                const selected_value = $switch.val();
                const switch_id = get_switch_id($switch);

                $switch.find('option').each(function () {
                    const option_key = $(this).attr('value');

                    switches[`${switch_id}_${option_key}`] = option_key === selected_value;
                });
            } else {
                $switch = $switch.find('.custom-control-input');
                const switch_id = get_switch_id($switch);
                switches[switch_id] = !!$switch.prop('checked');
            }
        });
        return switches;

    }


    function get_switch_id($switch) {
        let switch_id = $switch.data('switch-name');

        if (!switch_id) {
            switch_id = $switch.attr('id');
        }

        return switch_id;
    }


    deftools.sync_toggable_sections();
}

//</editor-fold>

//<editor-fold desc="Zoomables">
$(document).on('click', '.apply-zoom', function () {
    const $target = $(this).closest('.zoomable');

    $target.toggleClass('zoomed');
});
//</editor-fold>

//<editor-fold desc="Input Number Format">
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
//</editor-fold>

//<editor-fold desc="Forms">

deftools.form = {
    reset: $form => {
        $form.find('input:not(.disable-reset):not(.templates *), select:not(.disable-reset):not(.templates *), textarea:not(.disable-reset):not(.templates *)').each(function () {
            let $field = $(this);
            if ($field.attr('type') === 'checkbox') {
                $field.prop('checked', false);
            } else {
                $field.val('');
            }
            $field.removeClass('is-invalid');
        });
        $form.find('.reset-by-clear').html('');
        $form.find('.reset-by-hide').hide();
    },
    read: $form => {
        return $form.find("input:not(.templates *), select:not(.templates *), textarea:not(.templates *)").serializeJSON();
    },
    get_value: ($form, name) => {
        return $form.find(`input[name=${name}]:not(.templates *), select[name=${name}]:not(.templates *)`).val();
    },
}

//Form ajax validation
$(document).ready(function () {
    $('form[data-ajax-validation-url]').each(function () {

        let form_ok = false;
        $(this).submit(function () {
            if (form_ok) return true;

            const $form = $(this);

            const form_data = new FormData($form.get(0));

            const validation_url = $form.data('ajax-validation-url');

            axios.post(validation_url, form_data)
                .then(response => {
                    form_ok = true;
                    $form.trigger('def::form-submitted');
                    $form.submit();
                })
                .catch(error => {
                    $form.trigger('def::invalid-form');
                    axios.handle(error, $form)
                });


            return false;
        })
    })
});
//</editor-fold>
