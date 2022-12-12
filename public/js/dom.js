/* DOM Manipulation (JQuery) */
"use strict";

// fixed instances
const grayish = 'rgb(224, 224, 224)';
const black = 'black';
const steelblue = 'rgb(70,130,180)'; // STEEL BLUE RARE
const magenta = 'rgb(139,0,139)'; // DARK MAGENTA RARE
const gold = 'rgb(218, 165, 32)'; // GOLD SUPER RARE
const firebrick = 'rgb(178,34,34)'; // FIREBRICK ULTRA RARE

// execute once the the document is completely loaded
$(document).ready(() => {
    // text instances
    const text_box = $('text').first(); // get the <text> container that holds multiple <tspan> tag
    const pendulum_effect_box = text_box.next(); // get the second <text> container for PENDULUM format

    const description_node = $('.card-info')[0]; // get the card description <tspan> tag
    const description_box = $(description_node).clone(); // clone the node before removing the original node from the <text> container

    const pendulum_node = $('.pendulum-effect')[0]; // get the node of PENDULUM text
    const pendulum_box = $(pendulum_node).clone(); // clone the PENDULUM text of <tspan> before removing the original node from the <text> container

    const link_marker_node = $('.link-marker')[0]; // get the node of LINK image
    const link_marker_box = $(link_marker_node).clone(); // clone the LINK image of <tspan> before removing the original node from the <g> container

    // get the level & rank image node
    const level_img_node = $('.level')[0];
    const rank_img_node = $('.rank')[0];
    const negative_img_node = $('.negative')[0];

    // clone the level & rank image node before removing the original node
    const level_img_box = $(level_img_node).clone(); 
    const rank_img_box = $(rank_img_node).clone();  
    const negative_img_box = $(negative_img_node).clone(); 

    // LINK instances
    const link_marker_group = $('.link-marker-group'); // group of link marker images
    const link_markers = [
        'link-marker-top', 'link-marker-top-left', 'link-marker-top-right', 
        'link-marker-bottom', 'link-marker-bottom-left', 'link-marker-bottom-right',
        'link-marker-left', 'link-marker-right'
    ]; // LINK_MARKERS

    // card from EXTRA DECK array
    const extra_deck_types = [
        'fusion-monster', 'synchro-monster', 'xyz-monster', 'dark-synchro-monster', 'link-monster',
        'pendulum-fusion-monster', 'pendulum-synchro-monster', 'pendulum-xyz-monster', 
        'pendulum-dark-synchro-monster', 'pendulum-unity-monster' 

    ];

    // add & remove all unecessary elements to not cause problem to the new added child elements
    $('.card-info').remove();
    $('.pendulum-effect').remove();
    $('.card-level').children().remove();
    $('.card-rank').children().remove();
    $('.card-negative').children().remove();
    link_marker_node.remove();
    
    link_markers.forEach(link_marker => {
        const cloned_marker = link_marker_box.clone().hide();
        cloned_marker.attr('id', link_marker);
        cloned_marker.attr('xlink:href', `${source}/link-marker-images/${link_marker}.png`);
        link_marker_group.append(cloned_marker);
    });

    // star output functionality that displays star image base on the card template type
    const define_star = (star_number, is_xyz) => {
        card_negative.hide();
        card_level.hide();
        card_rank.hide();

        if(!is_xyz) {
            if(star_number < 0) {
                display_star(card_negative, star_number, negative_img_box);
                card_negative.show()
            } else {
                display_star(card_level, star_number, level_img_box);
                card_level.show()
            }
        } else {
            display_star(card_rank, star_number, rank_img_box);
            card_rank.show()
        }
    };

    // edition stamp functionality that displays stamp color based on specified type of edition in the market
    const define_edition = limited_edition => {
        if(limited_edition) {
            card_status.attr('xlink:href', `${source}/status-images/limited-edition-image.png`);
        } else {
            card_status.attr('xlink:href', `${source}/status-images/unlimited-edition-image.png`);
        }

        single_serialize_to_base64(card_status);
    }

    // set monster card's attribute functionality that displays attrbute icon image of a monster otherwise display a spell and trap attribute icon
    const define_attribute = attribute => {
        card_attribute.attr('xlink:href', `${source}/attributes-images/${attribute}.png`);
        single_serialize_to_base64(card_attribute);
    }

    // wrap update functionality (TESTING & DEFAULT) ------->
    const print_desc = () => {
        wrap(text_box, '.card-info', description_box, text, card_summoning, 379, 325, 552, 740, 32, description_y);
    };

    /* PENDULUM */
    const print_desc_pendulum = () => {
        wrap(pendulum_effect_box, '.pendulum-effect', pendulum_box, pendulum_text, null, 310, 274, 354, 518, 67, 421);
    };

    // change the main template of the card and adjust some elements
    let description_y = 519; // card description vertical position in px

    const define_card_template = type => {
        let font_color = black;
        let non_pendulum_image = $('.non-pendulum-image');
        let pendulum_image = $('.pendulum-image');
        let effect_x = 32, effect_y = 502, effect_size = 2.05;
        let text_anchor = 'start';
        let card_id_x, card_id_y, card_id_text_anchor;
        is_xyz = type.includes('xyz');

        // non-monster card section
        if(type.includes('trap') || type.includes('spell')) {
            effect_x = 400, effect_y = 98;
            description_y = 500, effect_size = 2.5;
            text_anchor = 'end';

            card_atk.hide();
            card_def.hide();
            define_star(0, is_xyz);

            // TRAP
            if(type.includes('trap')) {
                display_value(card_effect, '[Trap Card]');
                define_type('normal', 'Trap Card');
            } 
            // SPELL
            else {
                display_value(card_effect, '[Spell Card]');
                define_type('normal', 'Spell Card');
            }
        } else {
            effect_x = 32, effect_y = 502;
            description_y = 519, effect_size = 2.05;
            text_anchor = 'start';

            card_atk.show();
            card_def.show();
            define_type('normal', 'Spell Card');
            display_value(card_effect, `[${effect}]`);
        }

        // adjust certain text for non-monster card template
        card_effect.attr('x', effect_x);
        card_effect.attr('y', effect_y);
        card_effect.attr('style', `font-size:${effect_size}em`);
        card_effect.attr('text-anchor', text_anchor);

        // XYZ section
        if(is_xyz) {
            font_color = grayish;
        } else {
            font_color = black;
        }

        // PENDULUM section
        if(type.includes('pendulum')) {
            // card id adjustment
            card_id_x = 32;
            card_id_y = 604;
            card_id_text_anchor = "start"; // text alignment adjustment

            // PENDULUM description box adjustment
            pendulum_effect_box.show();
            
            // PENDULUM swap card image
            non_pendulum_image.hide();
            pendulum_image.show();
        } else {
            // card id adjustment
            card_id_x = 390;
            card_id_y = 476;
            card_id_text_anchor = "end"; // text alignment adjustment
 
            pendulum_effect_box.hide(); // hide PENDULUM effect
            
            // PENDULUM swap card image
            non_pendulum_image.show();
            pendulum_image.hide();
        }

        // LINK section
        if(type.includes('link')) {  
            card_id_x = 360; // card id x position adjustment
            define_star(0, false);
            link_marker_group.show();
            link_rating.show();
            card_def.hide();
        } else {
            if(!type.includes('pendulum')) card_id_x = 390; // card id x position adjustment
            // define card level if the card is not a non-monster card
            link_marker_group.hide();
            link_rating.hide();
            if(type.includes('monster')) {
                define_star(level, is_xyz);
                link_marker_group.hide();
                link_rating.hide();
                card_def.show();
            } else {
                define_star(0, is_xyz);
            }
        }

        // cards from EXTRA DECK adjustment
        if(extra_deck_types.includes(type)) {
            if(!card_summoning) card_summoning = $('.card-summoning');
            card_summoning.show();
        } else {
            if(card_summoning) card_summoning.hide();
            card_summoning = null;
        }

        // manipulate the overall color
        card_name.css('fill', font_color);

        if(type.includes('pendulum')) font_color = black; // (XYZ) set again the color into black if it is combined by a PENDULUM template (since the bottom of the card is not black)

        card_id.css('fill', font_color);
        card_serial_number.css('fill', font_color);
        card_copyright.css('fill', font_color);

        // adjust card id position
        card_id.attr('x', `${card_id_x}px`);
        card_id.attr('y', `${card_id_y}px`);
        card_id.attr('text-anchor', card_id_text_anchor);

        // set the template from xlink:href of <image> tag
        card_template.attr('xlink:href', `${source}/card-templates/${type}-card-template.png`);
        let xlink_href = card_template.attr('xlink:href');

        single_serialize_to_base64(card_template);

        // update description boxes
        print_desc();
        print_desc_pendulum();
    };

    // for non-monster only: a functionality that displays icon base on speficied card type (the effect parameter does have no '[]' curly bracket as it is already written inside the function)
    const define_type = (type, effect) => {
        const space = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; // space for non-monster card icon

        if(type !== 'normal') {
            card_effect.html(`[${effect}${space}]`);
            card_icon.attr('xlink:href', `${source}/non-monster-type-images/${type}.png`).show();
            single_serialize_to_base64(card_icon);
        } else {
            card_effect.html(`[${effect}]`);
            card_icon.hide();
        }
    };

    // TESING & DEFAULT SETTINGS
    // default value: BLUE_EYES WHITE DRAGON

    // set card details for card editor (TESTING & DEFAULT) ------->
    // class attribute instances
    const card_name = $('.card-name');
    const card_level = $('.card-level');
    const card_negative = $('.card-negative');
    const card_rank = $('.card-rank');
    const card_effect = $('.card-effect');
    const card_id = $('.card-id');
    const card_serial_number = $('.card-serial-number');
    const card_copyright = $('.card-copyright');
    let card_summoning = $('.card-summoning');
    let is_xyz;
    
    // id attribute instances
    const card_atk = $('#card-atk');
    const card_def = $('#card-def');
    const card_scale_left = $('#scale-left');
    const card_scale_right = $('#scale-right');
    const link_rating = $('#link-rating');

    // <image> xlink:href instances
    const card_image = $('.card-image');
    const card_template = $('#card-template');
    const card_attribute = $('#card-attribute');
    const card_icon = $('#card-icon').hide();
    const card_status = $('.card-status'); // pertains to card edition

    // other instances
    let name = 'Caius the Shadow Monarch';
    let type = 'effect-monster'; // it can be 'trap' OR 'spell'
    let attribute = 'dark'; // it can be 'trap' OR 'spell'
    let effect = 'Fiend / Effect';
    let rarity = 'common';
    let summoning_requirements = '2 Spellcaster monsters'
    let level = 6;
    let link_rating_value = 2;
    let limited_edition = false;
    let atk = 2400;
    let def = 1000;
    let id = 'SCK-000';
    let serial_number = '0123456789';
    let copyright = '&copy;2020 YGOPRO.ORG';

    // PENDULUM instances
    let scale_left = 1; // default value
    let scale_right = 1; // default value
    // ------->

    // data sample text instances (TESTING & DEFAULT) ------->
    let text = 'If this card is Tribute Summoned: Target 1 card on the field; banish that target, and if you do, inflict 1000 damage to your opponent if it is a DARK monster.';
    let pendulum_text = 'You must control no monsters to activate this card. If a Pendulum Monster you control battles, your opponent cannot activate Trap Cards until the end of the Damage Step. Unless you have a "Magician" card or "Odd-Eyes" card in your other Pendulum Zone, this card\'s Pendulum Scale becomes 4.';
    // ------->

    // invoke card template change and adjust some elements based on selected monster type (TESTING & DEFAULT) ------->
    // define_card_template(type);
    // ------->

    // invoke setting attribute (TESTING & DEFAULT) ------->
    // define_attribute(attribute);
    // ------->

    // invoke star output (TESTING & DEFAULT) ------->
    // define_star(level, is_xyz);
    // ------->

    // invoke card edition output (TESTING & DEFAULT) ------->
    // define_edition(limited_edition);
    // ------->

    // invoke non-monster card icon display (TESTING & DEFAULT) ------->
    // define_type('ritual', 'Trap Card');
    // ------->

    // (LINK) invoke link-marker switch (TESTING & DEFAULT) ------->
    // link_arrow_on('top');
    // link_arrow_on('bottom-left');
    // link_arrow_on('bottom-right');
    // ------->

    // invoke the wrap method (TESTING & DEFAULT) ------->
    /* description */ // print_desc();
    /* PENDULUM */ // print_desc_pendulum();
    // ------->

    // invoke display card details functionality (TESTING & DEFAULT) ------->
    /*
    display_value(card_atk, atk);
    display_value(card_def, def);
    display_value(card_id, id);
    display_value(card_serial_number, serial_number);
    display_value(card_copyright, copyright);
    display_value(card_name, name); modify_title_size(card_name);
    display_value(card_summoning, summoning_requirements);
    display_value(card_effect, `[${effect}]`);
    display_value(card_scale_left, scale_left); // PENDULUM scale left
    display_value(card_scale_right, scale_right); // PENDULUM scale right
    display_value(link_rating, link_rating_value);
    */
    // ------->

    // get all <img> tag inside the <svg> tag for converting all <image> xlink:href into PNG Base64
    const images = $('svg image, svg g .level, svg g .rank, svg #card-icon, svg .link-marker');
    const image_file = $('.card-file');

    $('.image-btn').click(() => {
        image_file.click();
    });;

    image_file.on('change', event => {
        // insert image to SVG card <image> tag
        const source = URL.createObjectURL(event.target.files[0]);;
        card_image.attr('xlink:href', source);
        serialize_to_base64(images);
    }); // INPUT MANIPULATION (IMAGE INSERTION)

    // remove the loading image (back sleeve) if the whole card is ready
    const back_card = $('#back-sleeve');

    $('svg').on('load', () => {
        back_card.fadeOut(500);
    });

    back_card.hide();

    serialize_to_base64(images); // trigger at the start of the program performance

    // INPUT MANIPUALTION: define card template
    const card_template_container = $('.setter-input .card-template-container');
    const template_input = $('#template-input');

    card_template_container.on('click', '.card-template-btn', event => {
        alert_danger.fadeOut(250);
        type = event.currentTarget.dataset.template.replace('-card-template', '');
        define_card_template(type);
        template_input.val(type);
    });

    // INPUT MANIPULATION: DATA ALGORITHM (KEYEVENT)
    const card_inputs = $('.input-container input[type=text], .input-container input[type=number], .input-container textarea');
    const card_text_update = event => {
        alert_danger.fadeOut(250);
        const cssSelector = (event.currentTarget.dataset.toggle) ? event.currentTarget.dataset.toggle : '';
        const value = event.currentTarget.value;

        if(event.currentTarget.dataset.restriction) {
            if(event.currentTarget.dataset.restriction === 'monster') {
                if(type.includes('trap') || type.includes('spell')) {
                    alert_danger.children().first().text('This is only for Monster card input.');
                    alert_danger.fadeIn(250);
                    return;
                }
            } else if(event.currentTarget.dataset.restriction === 'scale') {
                if(!type.includes('pendulum')) {
                    alert_danger.children().first().text('This is only for Pendulum Monster card input.');
                    alert_danger.fadeIn(250);
                    $("html, body").animate({ scrollTop: 0 }, "fast");
                    return;
                }
            }
        }

        // modify card's title font-size
        if(cssSelector.includes('card-name')) {
            name = value;
            modify_title_size($(cssSelector));
        }

        // modify card's star level
        if(cssSelector === 'level' || cssSelector === 'rank') {
            if(restric_input(cssSelector)) define_star(value, is_xyz);
        } else if(cssSelector === 'pendulum-effect' || cssSelector === 'description') {
            // PENDULUM
            if(cssSelector === 'pendulum-effect') {
                pendulum_text = event.currentTarget.value;
                print_desc_pendulum();
            }

            if(cssSelector === 'description') {
                text = event.currentTarget.value;
                print_desc();
            }
        } else if(cssSelector === '.card-effect') {
            display_value($(cssSelector), `[${value}]`);
        } else {
            // LINK
            if(cssSelector === '#link-rating') {
                if(restric_input('link')) display_value($(cssSelector), value);
            } else {
                if(cssSelector === '.card-copyright') display_value($(cssSelector), value, true);
                else display_value($(cssSelector), value);
            }
        }
    }

    card_inputs.on('click', card_text_update);
    card_inputs.on('keyup', card_text_update);
    card_inputs.on('change', card_text_update);

    // INPUT MANIPULATION: BUTTON INPUT
    const dropdown_list = $('.attribute-list, .rarity-list, .non-monster-type-list');
    const set_color = r => {
        rarity = r;
        if(r === 'common') card_name.css('fill', (type.includes('xyz') ? grayish : black));
        if(r === 'rare') card_name.css('fill', steelblue);
        if(r === 'elite') card_name.css('fill', magenta);
        if(r === 'super rare') card_name.css('fill', gold);
        if(r === 'ultra rare') card_name.css('fill', firebrick);
    };

    dropdown_list.on('click', '.dropdown-item', event => {
        alert_danger.fadeOut(250);
        const name = event.currentTarget.dataset.name;
        const value = event.currentTarget.dataset.value;

        switch(name) {
            case 'attribute':
                attribute = value;
                define_attribute(attribute);
                break;
            case 'rarity':
                set_color(value);
                break;
            case 'non-monster':
                if(restric_input('non-monster')) {
                    display_value(card_effect, `[${value}]`);
                    define_type(value.toLowerCase(), `${type.replace(type.substring(0, 1), type.substring(0, 1).toUpperCase())} Card`);
                }
                break;
        }
    });

    // INPUT MANIPULATION: STAMP EDITION
    const stamp_btn = $('.stamp-btn');

    stamp_btn.on('click', event => {
        alert_danger.fadeOut(250);
        const radio_stamp = $(event.currentTarget).next().click();
        define_edition(radio_stamp.val() === 'limited-edition');
    });

    // INPUT MANIPULATION: LINK MARKERS
    const link_marker_btn = $('.link-marker-btn');
    const link_marker_input = $('.link-marker-input');

    link_marker_btn.click(event => {
        alert_danger.fadeOut(250);

        if(!type.includes('link')) {
            alert_danger.children().first().text('This is only for Link Monster card input.');
            alert_danger.fadeIn(250);
            return;
        }

        const is_trigger = event.target.dataset.trigger === 'true';
        const value = event.target.dataset.value;
        let input = '';

        if(is_trigger) {
            event.target.dataset.trigger = '';
        } else {
            event.target.dataset.trigger = 'true';
        }

        link_arrow_toggle(value);
        link_marker_btn.each((index, element) => {
            input += (element.dataset.trigger === 'true') ? ` ${element.dataset.value}` : '';
        });

        link_marker_input.val(input);
    });

    // INPUT RESTRICTION
    const alert_danger = $('.alert-danger'); // ALERT COMPONENT (ERROR)
    const restric_input = name => {
        let restricted;

        if(name) {
            if(name === 'non-monster') {
                // non-monster restriction input
                if(restricted = type.includes('spell') || type.includes('trap')) {
                    return restricted;
                } else {
                    alert_danger.children().first().text('This is only for Spell and Trap card input.');
                    alert_danger.fadeIn(250);
                }
            }

            // LINK MONSTER
            if(name === 'link') {
                if(restricted = type.includes('link')) {
                    return restricted;
                } else {
                    alert_danger.children().first().text('This is only for Link Monster card input.');
                    alert_danger.fadeIn(250);
                    return restricted;
                }
            }

            if(name === 'level' || name === 'rank') {

                // LINK MONSTER
                if(!type.includes('link')) {

                    // XYZ MONSTER
                    if(name === 'rank') {
                        if(restricted = type.includes('xyz')) {
                            return restricted;
                        } else {
                            alert_danger.children().first().text('This is only for Non-XYZ Monster card input.');
                            alert_danger.fadeIn(250);
                        }
                    }

                    // NON-XYZ MONSTER
                    if(name === 'level') {
                        if(restricted = !type.includes('xyz')) {
                            return restricted;
                        } else {
                            alert_danger.children().first().text('This is only for XYZ Monster card input.');
                            alert_danger.fadeIn(250);
                        }
                    }

                } else {
                    alert_danger.children().first().text('This is only for Non-Link Monster card input.');
                    alert_danger.fadeIn(250);
                }

            }

        }

        return restricted;
    }

    // UPLOAD FUNCTIONALITY
    const myCanvas = $('#myCanvas');
    const hiddenImg = $('#imgConverted');

    $('#btnDownload').click(() => {
        console.log(hiddenImg.attr('src'));
        console.log(upload_card(name, myCanvas, hiddenImg, back_card));
    });

    // set value at the start
    const stamp_input = $('.radio-input');
    let is_monster = true;

    card_inputs.each((index, element) => {
        if($(element).attr('name') === 'card_template') {
            type = $(element).val();
            define_card_template(type);
            is_monster = type.includes('monster');
        } else if($(element).attr('name') === 'card_attribute') {
            define_attribute($(element).val());
        } else if($(element).attr('name') === 'link_rating') {
            display_value(link_rating, $(element).val());
        } else if($(element).attr('name') === 'link_marker') {
            $(element).val().split(' ').forEach(marker => {
                link_arrow_on(marker);
                $(`#${marker}`).attr('data-trigger', 'true');
            });
        } else if($(element).attr('name') === 'non_monster_type') {
            if(!is_monster) {
                define_type($(element).val(), `${type.replace(type.substring(0, 1), type.substring(0, 1).toUpperCase())} Card`);
            }
            $(element).trigger('click');
        } else if($(element).attr('name') === 'card_rarity') {
            set_color($(element).val());
            $(element).trigger('click');
        } else {
            if($(element).attr('name') === 'card_scale_left') {
                display_value(card_scale_left, $(element).val()); // PENDULUM scale left
            } else if($(element).attr('name') === 'card_scale_right') {
                display_value(card_scale_right, $(element).val()); // PENDULUM scale right
            } else if($(element).attr('name') == 'card_level' || $(element).attr('name') == 'card_rank') {
                if($(element).attr('name') == 'card_level') {
                    define_star(Number($(element).val()), is_xyz);
                }
            } else {
                $(element).trigger('click');
            }
        }
    });

    stamp_input.each((index, element) => {
        if($(element).is(':checked')) {
            $(element).prev().click();
        }
    });
    
});
