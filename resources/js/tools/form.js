const form = {
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


            const $submit_button = $(document.activeElement);

            const submit_value = $submit_button.attr('value');

            if ($submit_button.hasClass('ajax-validation-disabled')) {
                form_ok = true;
                $form.trigger('def::form-submitted');
                $form.submit();
            }


            const $form = $(this);


            if ($submit_button.hasClass('confirmable')) {
                const message = $submit_button.data('confirm-message');
                deftools.confirm.danger('', message).then(confirmed => {
                    if (confirmed) {
                        validate_data($form, submit_value);
                    }
                });
            } else {
                validate_data($form, submit_value);
            }

            return false;
        });

        function validate_data($form, submit_value) {
            $form.find('.is-invalid').removeClass('is-invalid');

            const form_data = new FormData($form.get(0));
            form_data.set('submit_value', submit_value);

            const validation_url = $form.data('ajax-validation-url');

            axios.post(validation_url, form_data)
                .then(response => {
                    form_ok = true;

                    $form.append(`<input type="hidden" name="submit_value" value="${submit_value}">`);
                    $form.trigger('def::form-submitted');
                    $form.submit();
                })
                .catch(error => {
                    $form.trigger('def::invalid-form');
                    axios.handle(error, $form)
                });
        }
    });


});

export default form;
