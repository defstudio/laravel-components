/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

require('../lib/summernote-bs4');

const summernote = {
    setup: () => {
        let $summernotes = $(".summernote:not(#templates *):not('.summernote-setup')");

        $summernotes.each(function () {
            summernote.setup_on_element($(this))
        });
    },

    setup_on_element: ($element, callbacks = {}) => {
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

        options.callbacks = callbacks;

        $element.summernote(options);
        $element.addClass('summernote-setup');
    }
};

setTimeout(() => summernote.setup(), 500);

export default summernote


