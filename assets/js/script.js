/*
Demo-Addon
Diese JavaScript-Datei wird in der boot.php des Addons demo_addon eingebunden (rex_view::addJsFile)
*/

// jQuery closure (»Funktionsabschluss«)
// Erzeugt einen Scope, also einen privaten Bereich
// http://molily.de/javascript-core/#closures
(function ($) {

    // Document Ready
    // Führt Code aus, sobald der DOM vollständig geladen wurde
    // https://api.jquery.com/ready/
    $(document).ready(function () {

        console.log('Demo-Addon ... Ausgabe auf der JS-Konsole');

    });
})(jQuery);
