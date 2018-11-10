window._ = require('lodash');
window.Noty = require('noty');

_window = (self == top) ? window : parent.window;
_document = (self == top) ? document : parent.document;

_window.Noty.overrideDefaults({
    theme: 'mint',
    timeout: 3000
});

window.$$ = {};
$$.ajax = function (url, options) {
    if (typeof url === "object") {
        options = url;
        url = undefined;
    }
    var settings = {};
    if (options.success) {
        settings.success = options.success;
    }
    var options = $.extend(options, {
        headers: {'X-CSRF-TOKEN': MA.csrfToken},
        error: function (jqXHR, textStatus, errorThrown) {
            switch (jqXHR.status) {
                case 422:
                    $.each(jqXHR.responseJSON.errors, function (key, message) {
                        $$.noty({
                            type: 'warning',
                            text: message
                        });
                    });
                    break;
                default:
                    $$.noty({
                        type: 'error',
                        layout: 'center',
                        text: jqXHR.responseJSON.message
                    });
            }

        },
        success: function (data, textStatus, jqXHR) {
            settings.success(data, textStatus, jqXHR);
        }
    });
    $.ajax(url, options);
};
$$.noty = function (options) {
    new _window.Noty(options).show();
};