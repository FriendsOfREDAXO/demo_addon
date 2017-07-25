// jQuery closure (»Funktionsabschluss«)
// Erzeugt einen Scope, also einen privaten Bereich
// http://molily.de/javascript-core/#closures
(function ($) {

    // Document Ready
    // Führt Code aus, sobald der DOM vollständig geladen wurde
    // https://api.jquery.com/ready/
    $(document).ready(function () {

        console.log('Demo-Addon');

    });
})(jQuery);