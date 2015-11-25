// IIFE for faster access to $ and safe $ use
(function ($) {
    $(document).ready(function () {
        var selector = 'span[data-type="interactive"]';
        $(selector).each(function (index, element) {
            var html = element.outerHTML;
            html = html
                .replace(/<span /g, '<a href="#" onclick="jumpToExtensionManager();return false" target="_top" " ')
                .replace(/<\/span>/g, '</a>');
            $(selector).replaceWith(html);
        })
    });
}(jQuery));