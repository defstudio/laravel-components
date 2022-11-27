window.axios = require('axios').default;
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

                        // noinspection RegExpRedundantEscape
                        const normalized_field = field.replace(/\.([-\w\*]*)/g, "[$1]");

                        let $input = $($form[0].elements[normalized_field]);

                        if(!$input.hasClass("hide-validation-message")){
                            let $feedback = $input.find('~.invalid-feedback');
                            if ($feedback.length === 0) {
                                $feedback = $("<div class='invalid-feedback'></div>");
                                $input.after($feedback);
                            }

                            $feedback.html(reasons.join("<br>"));
                        }

                        if($input.attr('type') === 'file'){
                            $input.val('');
                            $input.change();
                        }

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
