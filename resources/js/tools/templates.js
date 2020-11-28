const $templates = $('#templates');

export default {
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
