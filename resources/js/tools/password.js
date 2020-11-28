$(document).ready(function () {
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
});
