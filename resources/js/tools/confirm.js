/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

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
    primary: function (title, message) {
        return new Promise((resolve) => {
            deftools.modal.primary(title, message, function () {
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
