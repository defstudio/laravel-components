/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

$(document).ready(function () {
    let $tabs_to_be_remembered = $('.remember-selected-tab');

    $tabs_to_be_remembered.on('click', 'a[data-toggle="tab"]', function () {
        let $tab = $(this);
        let $tabs = $tab.closest('.remember-selected-tab');

        window.localStorage.setItem($tabs.attr('id') + "_active_tab", $tab.attr('href'));
    });

    $tabs_to_be_remembered.each(function () {
        let $tabs = $(this);

        let active_tab = window.localStorage.getItem($tabs.attr('id') + "_active_tab");
        if (active_tab) {
            $tabs.find('a[href="' + active_tab + '"]').tab('show');
        }
    });
});
