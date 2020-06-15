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

        /* EP-Liste - alle öffnen/schliessen */
        $('a.btn-open').on('click', function (event) {
            event.preventDefault();
            $('.panel-collapse').collapse('show');
            $('a.btn-open').hide();
            $('a.btn-close').show();
        });
        $('a.btn-close').on('click', function (event) {
            event.preventDefault();
            $('.panel-collapse').collapse('hide');
            $('a.btn-close').hide();
            $('a.btn-open').show();
        });

    });

})(jQuery);
