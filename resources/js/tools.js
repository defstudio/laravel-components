require('./tools/axios');
require('./tools/password');
require('./tools/components');
require('./tools/bootstrap');
require('./tools/vue');


window.deftools = {
    spinner: require('./tools/spinner').default,
    numbers: require('./tools/numbers').default,
    arrays: require('./tools/arrays').default,
    modal: require('./tools/modal').default,
    confirm: require('./tools/confirm').default,
    message: require('./tools/message').default,
    templates: require('./tools/templates').default,
    summernote: require('./tools/summernote').default,
    form: require('./tools/form').default,
}
