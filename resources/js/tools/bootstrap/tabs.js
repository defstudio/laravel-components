$(document).ready(function () {
    let $tabs_to_be_remembered = $('.remeber-selected-tab');

    $tabs_to_be_remembered.on('click', 'a[data-toggle="tab"]', function () {
        let $tab = $(this);
        let $tabs = $tab.closest('.remeber-selected-tab');

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
