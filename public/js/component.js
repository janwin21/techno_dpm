/* COMPONENT JS (JQuery) for Component Adjustment of All Pages */
"use strict";

// execute once the the document is completely loaded
$(document).ready(() => {

    // calculate the current position of the ovelayed paragraph title in the image menu list
    const overlay_card_description = $('.card .card-description');

    overlay_card_description.each((index, element) => {
        adjust_menu_card(element);
    });

    // slider functionality: slide up & down the card components once the <a> tag has been hovered
    const main_navigation = $('.navigation');

    main_navigation.on('mouseover', '.nav li a', event => {
        const card_box = $(event.target).children();

        card_box.slideDown(250);
        adjust_menu_card(card_box.find('.card-description')[0]);
    });

    main_navigation.on('mouseleave', '.nav li a', event => {
        $(event.target).children().slideUp(250);
    });


});