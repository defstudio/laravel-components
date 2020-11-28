let spin_count = 0;

export default {
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
