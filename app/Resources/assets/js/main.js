const $ = require('jquery');
global.$ = global.jQuery = $;

(function ($) {

    // Menu mobile
    $(document).ready(function () {
        $('.button-collapse').sideNav({
                menuWidth: 300, // Default is 300
                edge: 'right', // Choose the horizontal origin
                closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                draggable: true, // Choose whether you can drag to open on touch screens,
            }
        );
    });

    // Slider
    $(document).ready(function () {
        $('.slider').slider();
    });

    // Menu déroulant
    $(".dropdown-button").dropdown();

    // Popup connexion
    $(document).ready(function () {
        $('#' + $('.modal').data('id')).modal();
    });

    // materialize
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 30, // Creates a dropdown of 15 years to control year,
        labelMonthNext: 'Mois suivant',
        labelMonthPrev: 'Mois précédent',
        labelMonthSelect: 'Selectionnez un mois',
        labelYearSelect: 'Selectionnez une année',
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
        monthsShort: ['Jan', 'Fev', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Dec'],
        weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        weekdaysLetter: ['D', 'L', 'Ma', 'Me', 'J', 'V', 'S'],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
    });
})(window.jQuery);

