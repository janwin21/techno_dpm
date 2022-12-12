/* CARD JS (JQuery) for Card Editor */
"use strict";

// execute once the the document is completely loaded
$(document).ready(() => {

    // apply event to all card button
    const card_button = $('.card-button');
    const row_inputs = $('tr');
    const images = $('svg image, svg g .level, svg g .rank, svg #card-icon, svg .link-marker'); // serialize <svg> tag everytime the last button is cleck (third-input)

    card_button.click(event => {
        const cssSelector = event.currentTarget.dataset.toggle;

        row_inputs.fadeOut(250, () => {
            $(`.${cssSelector}`).fadeIn(250);
        });
    });

    // insert all card templates from input selection
    const card_template_container = $('.setter-input .card-template-container');  
    let text = '';

    for(let i = 0; i < card_templates.length; i++) {
        text += `<button type="button" class="card-template-btn" data-template="${card_templates[i]}"><img src="${source}/card-templates/${card_templates[i]}.png" alt="card-template"></button>`;
    }

    card_template_container.html(text);

    // insert all the input in the dropdown list
    const dropdown_list = $('.attribute-list, .rarity-list, .non-monster-type-list');
    const attr_list = $('.attribute-list');
    const rarity_list = $('.rarity-list');
    const non_monster_type_list = $('.non-monster-type-list');

    const insert_list = (parent, arr, has_image, name) => {
        let text = '';

        for(let i = 0; i < arr.length; i++) {
            if(has_image) {
                text += `<li><a class="dropdown-item" href="#!" data-name="${name}" data-has_image="true" data-value="${arr[i]}"><img src="${source}/attributes-images/${arr[i]}.png" href="attribute">${arr[i]}</a>`;
            } else {
                text += `<li><a class="dropdown-item" href="#!" data-name="${name}" data-has_value="false" data-value="${arr[i]}">${arr[i]}</a>`;
            }
        }

        parent.html(text);
    };

    const insert_output = (parent, value, has_image, inputCssSelector) => {
        if(has_image) {
            parent.html(`<img src="${source}/attributes-images/${value}.png" href="attribute">${value}`);
        } else {
            parent.text(value);
        }

        $(inputCssSelector).val(value);
    };

    const insert_event_to_btn = event => {
        const value = event.currentTarget.dataset.value;
        const has_image = event.currentTarget.dataset.has_image;
        const btn_attr = $(event.currentTarget).parent().parent().prev();
        const input = $(event.currentTarget).parent().parent().parent().prev().prev().prev();
        insert_output(btn_attr, value, has_image === 'true', input);
    };

    insert_list(attr_list, editor_attributes, true, 'attribute');
    insert_list(rarity_list, editor_rarity, false, 'rarity');
    insert_list(non_monster_type_list, non_monster_races, false, 'non-monster');

    dropdown_list.on('click', '.dropdown-item', insert_event_to_btn);

    // CLOSE ALERT
    const alert_danger = $('.alert-danger');
    alert_danger.fadeOut(250);

    alert_danger.on('click', 'button', () => {
        alert_danger.fadeOut(250);
    });

});