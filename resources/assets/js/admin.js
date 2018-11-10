require('./bootstrap');

var Selector = {
    contentWrapper: '.content-wrapper',
    navTabs: '.MA_tabs .nav-tabs',
    navContent: '.MA_tabs .tab-content'
};

window.MA_menuRename = function (from, to, text) {
    $('a[href="#' + from + '"]', $(Selector.navTabs, _document)).prop('href', '#' + to).children('span').text(text);
    $('#' + from, $(Selector.navContent, _document)).prop('id', to);
};

$('.MA_menu a:not([href="#"])').click(function (e) {
    e.preventDefault();

    $('.MA_menu .active').removeClass('active');
    $(this).parent('li').addClass('active').closest('.treeview').addClass('active');
});

$(document).on('click', '[data-tab]', function (e) {
    e.preventDefault();
    var $this = $(this);
    var tab = $this.data('tab');

    if (!$('a[href="#' + tab.name + '"]', $(Selector.navTabs, _document)).length) {
        var $li = $('<li/>').appendTo($(Selector.navTabs, _document));
        var $a = $('<a/>', {
            href: '#' + tab.name
        }).data('toggle', 'tab')
            .append($('<span/>', {text: tab.text})).appendTo($li);
        var $button = $('<button/>').append($('<i/>').addClass('fa fa-close')).appendTo($a);

        var $div = $('<div/>').addClass('tab-pane').prop('id', tab.name).appendTo($(Selector.navContent, _document));
        var $iframe = $('<iframe/>', {src: $this.prop('href')}).appendTo($div);
    } else {
        $a = $('a[href="#' + tab.name + '"]', $(Selector.navTabs, _document));
    }

    $('a[href="#' + tab.name + '"]', $(Selector.navTabs, _document)).parent('li').addClass('active').siblings().removeClass('active');
    $('#' + tab.name, $(Selector.navContent, _document)).addClass('active').siblings().removeClass('active');
});

$(Selector.navTabs, _document).on('click', 'a', function (e) {
    e.preventDefault();
    e.stopPropagation();

    if (e.target.nodeName == 'I') {
        var tab = $(this).prop('href').split('#')[1];
        $('#' + tab, $(Selector.navContent, _document)).remove();
        $(this).parent('li').remove();

        if (!$('li.active', $(Selector.navTabs, _document)).length) {
            $('a:last', $(Selector.navTabs, _document)).tab('show');
        }
    } else {
        $(this).tab('show');
    }
});