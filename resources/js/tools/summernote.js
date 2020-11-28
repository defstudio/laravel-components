require('../vendor/summernote-bs4');

export default {
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
