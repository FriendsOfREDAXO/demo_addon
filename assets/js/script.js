/*
Demo-AddOn
Diese JavaScript-Datei wird in der `boot.php` des AddOns `demo_addon` im Backend eingebunden (rex_view::addJsFile)
https://redaxo.org/doku/master/addon-assets
*/

// jQuery closure (»Funktionsabschluss«)
// Erzeugt einen Scope, also einen privaten Bereich
// http://molily.de/javascript-core/#closures
(function ($) {

    // rex:ready
    // Führt Code aus, sobald der DOM vollständig geladen wurde
    // https://redaxo.org/doku/master/addon-assets#rexready
    $(document).on('rex:ready', function (event, container) {

        // externe Links in neuem Fenster öffnen
        $('a[href^="http://"], a[href^="https://"]').filter(function () {
            // filter out links that have the same domain name as the current page
            return this.hostname && this.hostname !== location.hostname;
        })
            // add a CSS class of "extern" to each external link (for styling)
            .addClass('extern')
            // inform visitor that link will open in new window
            .attr({
                target: '_blank',
                title: function () { return this.title + '' }
            });

    });

})(jQuery);
