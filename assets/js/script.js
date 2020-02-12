/*
Demo-Addon
Diese JavaScript-Datei wird in der boot.php des Addons demo_addon eingebunden (rex_view::addJsFile)
*/

// jQuery closure (»Funktionsabschluss«)
// Erzeugt einen Scope, also einen privaten Bereich
// http://molily.de/javascript-core/#closures
(function ($) {

    // rex:ready
    // Führt Code aus, sobald der DOM vollständig geladen wurde
    // https://redaxo.org/doku/master/addon-assets#rexready
    $(document).on('rex:ready', function (event, container) {

        console.log('Demo-Addon Konfiguration ... Ausgabe auf der JS-Konsole');

    });

})(jQuery);
