export default {
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
