/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

if (!window.route) {
    window.route = {};
}

require('./tools/axios');
require('./tools/echo');
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


if ($('.section-toggle-switch').length > 0) {

    $(document).on('change', '.section-toggle-switch', function () {
        deftools.sync_toggable_sections();
    })


    function hide_toggable_sections($context) {
        $context.find('.toggable-section').addClass('hidden');
    }

    function show_activated_sections($context) {
        const switches = retrieve_switches_status($context);

        const $toggable_sections = $context.find('.toggable-section');

        for (const switch_key in switches) {
            if (switches.hasOwnProperty(switch_key)) {
                this[switch_key] = switches[switch_key];
            }
        }

        $toggable_sections.each(function () {
            const $toggable_section = $(this);
            const condition = $toggable_section.data('toggle-if');

            if (!condition) return;

            const visible = eval(condition);

            if (visible) {
                $toggable_section.removeClass('hidden');
            }
        })
    }

    function retrieve_switches_status($context) {
        let $toggle_switches = $context.find('.section-toggle-switch');

        let switches = {}

        $toggle_switches.each(function () {
            let $switch = $(this);
            if ($switch.prop('tagName') === 'SELECT') {
                const selected_value = $switch.val();
                const switch_id = get_switch_id($switch);

                $switch.find('option').each(function () {
                    const option_key = $(this).attr('value');

                    switches[`${switch_id}_${option_key}`] = option_key === selected_value;
                });
            } else {
                $switch = $switch.find('.custom-control-input');
                const switch_id = get_switch_id($switch);
                switches[switch_id] = !!$switch.prop('checked');
            }
        });
        return switches;

    }

    function get_switch_id($switch) {
        let switch_id = $switch.data('switch-name');

        if (!switch_id) {
            switch_id = $switch.attr('id');
        }

        return switch_id;
    }

    deftools.sync_toggable_sections = function ($context = null) {

        $context = $context ?? $(document);

        hide_toggable_sections($context);

        show_activated_sections($context);

    }

    deftools.sync_toggable_sections();
}
