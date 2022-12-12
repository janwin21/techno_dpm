/* DECK JS (JQuery) for Deck Builder */
"use strict";

// execute once the the document is completely loaded
$(document).ready(() => {

    // MAIN DECK ID
    const deck_read = $('#read').attr('data-read');
    const deck_id = $('#var').attr('data-id');
    const deck_src = $('#url').attr('data-src');
    const main_deck_data = $('#main').attr('data-main');
    const extra_deck_data = $('#extra').attr('data-extra');
    const side_deck_data = $('#side').attr('data-side');

    // set modal event
    const set_modal_event = async event => {
        if(event.currentTarget.dataset.system != '<DPM>') {
            const response = await get_data('id', event.currentTarget.dataset.id);
            set_modal(response);
        }
    };

    /*
    console.log(main_deck_data);
    console.log(extra_deck_data);
    console.log(side_deck_data);
    */

    let allData = '';

    // prepare data values
    const get_deck_value = deck => {
        if(deck === 'none') return null;

        let deck_arr = [];

        deck.replaceAll('<>', '/').split('<separator>').forEach(data => {
            if(data) {
                const system_index = data.substring(0, 5);
                const id_index = data.split('(src)')[0].replace('<YGO>', '').replace('<DPM>', '');
                const src_index = data.split('(src)')[1].split('(type)')[0];
                const type_index = (data.split('(type)')[1]) ? data.split('(type)')[1] : '';

                deck_arr.push({
                    'system': system_index,
                    'id': id_index,
                    'src': src_index,
                    'type': type_index
                });
            }
        });

        return deck_arr;
    };

    const main_deck_arr = get_deck_value(main_deck_data);
    const extra_deck_arr = get_deck_value(extra_deck_data);
    const side_deck_arr = get_deck_value(side_deck_data);

    // generate existing cards from the Saved Deck
    const insert_cards = (deck_container, deck_arr, type) => {

        if(!deck_arr) return;

        let text_html = '';

        deck_arr.forEach(async data => {

            if(data.system == '<YGO>') {

                allData.forEach(eachData => {
                    if(data.id == eachData.id) {
                        
                        text_html += `
                            <li class="draggable-img ui-draggable 
                                ui-draggable-handle set-modal-event copyrighted-cards" data-contained="${type}" 
                                data-system="${data.system}"
                                data-id="${data.id}"
                                data-type="${data.type}"
                                data-src="${eachData.card_images[0].image_url}"
                                data-img="${eachData.card_images[0].image_url}"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                    
                                <img src="${eachData.card_images[0].image_url}" alt="cards-collection">
                            </li>
                        `;

                        deck_container.html(text_html);
                        return;
                    }
                });

            } else {
                
                await $.get(data.src)
                    .done(function() { 
                        text_html += `
                            <li class="draggable-img ui-draggable 
                                ui-draggable-handle set-modal-event owned-cards" data-contained="${type}" 
                                data-system="${data.system}"
                                data-id="${data.id}"
                                data-type="${data.type}"
                                data-src="${data.src}"
                                data-img="${data.src}"
                                data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                    
                                <img src="${data.src}" alt="cards-collection">
                            </li>
                        `;

                        deck_container.html(text_html);
                    }).fail(function() {})
                
            }
                

        });

        setTimeout(() => {
            deck_container.on('click', '.set-modal-event', set_modal_event);
            deck_container.children().draggable(drag_event_no_revert);
        }, 1000);

    };

    // insert cards in collection container
    let q_params = '';
    let start_index = 0; // staring index of the cards
    const max_cards = 21; // limit of the cards per page
    const deck_size = 60;
    const extra_deck_size = 15;
    const card_limit = 3;

    // search utility
    const body = $('html, body');
    const search_body = $('.card-collection');

    // DRAG & DROP FUNCTIONALITY
    const drag_event = {
        containment: 'document',
        revert: true,
        helper: 'clone'
    };

    const drag_event_no_revert = {
        containment: 'document',
        revert: false,
        helper: 'clone'
    }

    $('.draggable-img').draggable(drag_event);

    $('.dropbox').droppable({
        tolerance: 'touch',
        accept: '.draggable-img',
        over: (event, ui) => {
            const btn = $(event.target).prev().children().first();
            btn.addClass('hovered-correct');
        },
        out: (event, ui) => {
            const btn = $(event.target).prev().children().first();
            btn.removeClass('hovered-correct');
            btn.removeClass('hovered-wrong');
        },
        drop: (event, ui) => {
            const btn = $(event.target).prev().children().first();
            const deck_type = event.target.dataset.type;
            const element = ui.draggable;

            btn.removeClass('hovered-correct');
            btn.removeClass('hovered-wrong');

            const data_id = element.attr('data-id');

            if(element.attr('data-contained') === 'collection') {
                if(card_restriction(data_id) < card_limit) {

                    if(deck_type === 'extra' || deck_type === 'side') {

                        if($(event.target).children().children().length >= extra_deck_size) {
                            alert_error(extra_deck_size)
                            return;
                        }
                        
                        if(extra_deck_monsters.includes(element.attr('data-type')) || deck_type === 'side' || element.attr('data-system') == '<DPM>') {
                            const cloned_ui = element.clone().attr('data-contained', deck_type).click(set_modal_event).draggable(drag_event_no_revert);
            
                            $(event.target).children().append(cloned_ui);

                            auto_save();
                        }

                        return;
                    }

                    if($(event.target).children().children().length >= deck_size) {
                        alert_error(deck_size)
                        return;
                    }

                    if(extra_deck_monsters.includes(element.attr('data-type'))) return;

                    const cloned_ui = element.clone().attr('data-contained', deck_type).click(set_modal_event).draggable(drag_event_no_revert);

                    $(event.target).children().append(cloned_ui);

                } else {
                    deck_alert.children().first().text(`You can ONLY pick ${card_limit} SAME cards from the Collection..`);
                    deck_alert.fadeIn(250);
            
                    body.animate({
                        scrollTop: body.offset().top
                    }, 1000);
                }
            } else if(element.attr('data-contained') !== deck_type) {
                if(deck_type === 'extra' || deck_type === 'side') {

                    if($(event.target).children().children().length >= extra_deck_size) {
                        alert_error(extra_deck_size)
                        return;
                    }
                    
                    if(extra_deck_monsters.includes(element.attr('data-type')) || deck_type === 'side' || element.attr('data-system') == '<DPM>') {
                        $(event.target).children().append(element.attr('data-contained', deck_type).click(set_modal_event));

                        auto_save();
                    }

                    return;
                }

                if($(event.target).children().children().length >= deck_size) {
                    alert_error(deck_size)
                    return;
                }

                if(extra_deck_monsters.includes(element.attr('data-type'))) return;

                $(event.target).children().append(element.attr('data-contained', deck_type).click(set_modal_event));
            }

            auto_save();

        }
    });

    get_all_data('').then(response => {
        allData = response.data;
        insert_cards($('.main-deck-container').children().first(), main_deck_arr, 'main');
        insert_cards($('.extra-deck-container').children().first(), extra_deck_arr, 'extra');
        insert_cards($('.side-deck-container').children().first(), side_deck_arr, 'side');
    });

    // delete cards in your deck
    const delete_box = $('.delete-box');

    delete_box.droppable({
        tolerance: 'touch',
        accept: '.draggable-img',
        over: () => {
            delete_box.css('opacity', 0.5);
        },
        out: () => {
            delete_box.css('opacity', 1);
        },
        drop: (event, ui) => {
            const element = ui.draggable;

            delete_box.css('opacity', 1);
            
            if(element.attr('data-contained') !== 'collection') {
                $(element).remove();
                auto_save();
            }
        }
    });

    // generate all the exisiting attributes, types, races in YU-GI-OH
    /* attributes */
    const flush_collapseOne = $('#flush-collapseOne');
    const flush_btnOne = flush_collapseOne.children().last();
    const clone_flush_btnOne = flush_btnOne.clone();
    
    /* types */
    const flush_collapseTwo = $('#flush-collapseTwo');
    const flush_btnTwo = flush_collapseTwo.children().last();
    const clone_flush_btnTwo = flush_btnTwo.clone();
    
    /* races */
    const flush_collapseThree = $('#flush-collapseThree');
    const flush_btnThree = flush_collapseThree.children().last();
    const clone_flush_btnThree = flush_btnThree.clone();
    
    /* types (NON_MONSTER) */
    const flush_collapseFour = $('#flush-collapseFour');
    const flush_btnFour = flush_collapseFour.children().last();
    const clone_flush_btnFour = flush_btnFour.clone();
    
    /* races (NON_MONSTER) */
    const flush_collapseFive = $('#flush-collapseFive');
    const flush_btnFive = flush_collapseFive.children().last();
    const clone_flush_btnFive = flush_btnFive.clone();

    // remove the dump attribute <button> tag
    flush_btnOne.remove();
    flush_btnTwo.remove();
    flush_btnThree.remove();
    flush_btnFour.remove();
    flush_btnFive.remove();

    // insert all the cloned elements to the specified accordion
    monster_attributes.forEach(attribute => {
        insert_to_accordion(flush_collapseOne, clone_flush_btnOne.clone(), attribute, true);
    });

    monster_types.forEach(type => {
        insert_to_accordion(flush_collapseTwo, clone_flush_btnTwo.clone(), type, false);
    });

    monster_races.forEach(race => {
        insert_to_accordion(flush_collapseThree, clone_flush_btnThree.clone(), race, false);
    });

    non_monster_types.forEach(type => {
        insert_to_accordion(flush_collapseFour, clone_flush_btnFour.clone(), type, false);
    });

    non_monster_races.forEach(race => {
        insert_to_accordion(flush_collapseFive, clone_flush_btnFive.clone(), race, false);
    });

    // apply event to all attribute types, races buttons
    const apply_insert_attribute = () => {
        apply_function_to_accordion('#flush-collapseOne button', flush_collapseOne);
        apply_function_to_accordion('#flush-collapseTwo button', flush_collapseTwo);
        apply_function_to_accordion('#flush-collapseThree button', flush_collapseThree);
        apply_function_to_accordion('#flush-collapseFour button', flush_collapseFour);
        apply_function_to_accordion('#flush-collapseFive button', flush_collapseFive);
    };

    const apply_function_to_accordion = (cssSelector, flush_collapse) => {
        $(cssSelector).click(event => {
            flush_collapse.find('input').val(event.currentTarget.dataset.value);
            start_index = 0;
            apply_to_inputs(true);
        });
    };

    apply_insert_attribute(); // invoke all accordion

    // MANIPULATE URI
    // URI Access & Manipulation Section
    const qoute_btns = $('.qoutes-btn');
    const card_modal_title = $('.modal-header .modal-title');
    const card_modal_body = $('.modal-body'); // container / parent
    const card_detail_node = $('.modal-box'); // children
    const card_detail_box = card_detail_node.clone(); // clone
    const card_modal_close_btn = $('.card-modal-close-btn'); // modal close button

    card_detail_node.remove(); // remove cards container

    card_modal_close_btn.click(() => {
        card_modal_body.children().fadeOut(250, () => {
            card_modal_body.children().remove(); // delete all the existing elements
        });
    });

    /* ROUTE TESTING */
    qoute_btns.click(async event => {
        const parameter = event.currentTarget.dataset.parameter;
        const value = event.currentTarget.dataset.value;
        const response = await get_data(parameter, value);

        set_modal(response);
    });

    const set_modal = response => {

        if(!response.card_template) {
        
            response.data.forEach(d => {
                const card_box = card_detail_box.clone().hide();

                /* CONTAINER */
                const title_box = card_modal_title;
                const children = card_box.children();

                /* CHILDREN */
                const img_box = children.first();
                const name_box = children.first().next();
                const attribute_box = children.first().next().next();
                const level_box = children.first().next().next().next();
                const type_box= children.first().next().next().next().next();
                const race_box = children.first().next().next().next().next().next();
                const ad_box = children.first().next().next().next().next().next().next();
                const market_box = children.first().next().next().next().next().next().next().next();
                const desc_box = children.first().next().next().next().next().next().next().next().next().next();

                /* REQUESTED DATA */
                const src = d.card_images[0].image_url;
                const archetype = (d.archetype) ? d.archetype : 'No';
                const name = d.name;
                const attribute = (d.attribute) ? d.attribute : d.type.replace(' Card', '');
                const level = (d.level) ? d.level : 'NA';
                const type = d.type;
                const race = d.race;
                const atk = (d.atk) ? d.atk : 'NA';
                const def = (d.def) ? d.def : 'NA';
                let price_desc = "";

                const star_level = !type.toLowerCase().includes('xyz') ? level : 0;
                const rank_level = type.toLowerCase().includes('xyz') ? level : 0;
                const link_level = type.toLowerCase().includes('link') ? d.linkval : 0;

                Object.entries(d.card_prices[0]).forEach(([key, value]) => {
                    price_desc += `<p>${key.split('_').join(' ')}: <strong>$${value}</strong></p>`;
                });

                const desc = d.desc.replace('----------------------------------------', '')
                .replace('[ Pendulum Effect ]', '<strong style="font-weight: bolder">[ Pendulum Effect ]</strong>')
                .replace('[ Monster Effect ]', '<strong style="font-weight: bolder">[ Monster Effect ]</strong>');

                /* MANIPULATE THE MODAL */
                img_box.attr('src', src);
                title_box.text(`${archetype} Archetype Deck`);
                name_box.text(name);
                
                attribute_box.html(`Attribute:</strong> <strong>${attribute}</strong>&nbsp;<img src="${source}/attributes-images/${attribute.toLowerCase()}.png" alt="${attribute}">`);

                level_box.html(`<strong>Star:</strong> ${star_level} <img src="${source}/star-images/level.png" alt="level"> / ${rank_level} <img src="${source}/star-images/rank.png" alt="level"> / <strong>LINK</strong>-${link_level}`);

                type_box.html(`<strong>Type:</strong> ${type}`);
                race_box.html(`<strong>Race:</strong> ${race}`);
                ad_box.html(`<strong>ATK / DEF:</strong> ${atk} / ${def}`);
                market_box.html(price_desc);
                desc_box.html(desc);

                card_modal_body.append(card_box);
                card_box.fadeIn(250);

            });

        } else {

            let card_box = card_detail_box.clone()

            let html_text = `
                <img class="modal-card-image" src="${source_link}" alt="card-image" style="width: 100%; margin-bottom: 1.75rem;">
                <h6>${response.card_name}</h6>
                <p><strong>Attribute:</strong> <strong>${response.card_attribute.toUpperCase()}</strong></p>
                <p><strong>Effect:</strong> ${response.card_effect}</p>
                <p><strong>Card Description:</strong></p>
                <p>
                    ${response.card_description}
                </p>
                <hr>
            `

            card_box.html(html_text);
            card_modal_body.append(card_box);
            card_box.fadeIn(250);
        }
        
    };

    // COLLECTION INSERTION UPDATE
    const existing_card_collection = $('.cards-collection')[0]; // existing card container
    const existing_card_node = $(existing_card_collection).children().first(); // original
    const existing_card_box = existing_card_node.clone(); // clone

    existing_card_node.remove();

    const update_collection = (response, scrollable, system) => {
        const total_length = start_index + max_cards;

        if(response === 'error') {
            $(existing_card_collection).children().fadeOut(250);
            return;
        }

        $(existing_card_collection).children().remove(); // remove all previous cards

        response.data.forEach((d, i, arr) => {
            if(i < total_length) {

                const new_card = existing_card_box.clone()
                    .attr('data-bs-toggle', 'modal')
                    .attr('data-bs-target', '#staticBackdrop')
                    .draggable(drag_event);
            
                // REQUESTED DATA
                const src = d.card_images[0].image_url;
                const id = d.id;
                const type = d.type;

                // MANIPULATE COLLECTION
                new_card.html(`<img src="${src}" alt="cards-collection">`);

                new_card.attr('data-id', id)
                    .attr('data-system', system)
                    .attr('data-type', type)
                    .attr('data-src', src)
                    .click(async () => {
                        const response = await get_data('id', id);
                        set_modal(response);
                    });

                $(existing_card_collection).append(new_card);
                new_card.fadeIn(250);
            
            }

        });
    
        if(scrollable) {
            body.animate({
                scrollTop: body.offset().top
            }, 1000);
        }
        
    }
    
    // SEARCH CONTAINER
    const search_container = $('.search-container');
    const search_inputs = $(search_container.find("input, textarea"));
    const search_btn = $('.search-btn');
    const load_more_btn = $('.load-more-btn');

    // apply functions to all inputs
    const apply_to_inputs = async scrollable => {
        let value = '';

        category_container.children().remove(); // remove all category boxes first
        insert_alert_box('All');

        search_inputs.each((index, element) => {
            if($(element).attr('class') !== 'deck-name') {
                const parameter = $(element).attr('data-parameter');
                const output = $(element).val();

                if(output.length != 0) {

                    if(parameter === 'link' && value.includes('level')) {} else {
                        value += `${parameter}=${output}<s>`;
                    }

                    insert_alert_box(output);
                }
            }
        });

        q_params = value.split('<s>').join('&');
        const response = await get_all_data(q_params);
        
        if(response === "error") {
            load_more_btn.fadeOut(250);
        } else if(start_index + max_cards < response.data.length) {
            load_more_btn.fadeIn(250); // display the load btn
        } else {
            load_more_btn.fadeOut(250);
        }
        
        update_collection(response, scrollable, '<YGO>');

    }

    // alert category
    const category_container = $('.category-collection');
    const alert_category_node = $('.category'); // original
    const alert_category_box = alert_category_node.clone(); // clone

    alert_category_node.remove(); // remove the original

    // insert alert category box
    const insert_alert_box = parameter => {
        category_container.append(alert_category_box.clone().children().first().text(parameter).next().parent());
    }

    search_btn.click(event => {
        event.preventDefault();
        start_index = 0;
        apply_to_inputs(true);
    });

    search_inputs.change(() => {
        start_index = 0;
        apply_to_inputs(true);
    });

    insert_alert_box('All');
    apply_to_inputs(false); // call the search from the start

    // add more cards functionality
    load_more_btn.click(async () => {
        const response = await get_all_data(q_params);
        const data_length = response.data.length;
    
        if(start_index + max_cards < data_length) {
            start_index += max_cards;
            if(start_index + max_cards < data_length) load_more_btn.fadeIn(250)
            else load_more_btn.fadeOut(250)
        } else {
            load_more_btn.fadeOut(250)
        }
    
        update_collection(response, false, '<YGO>');
    });

    // AUTO UPDATE
    const update_box = $('.update-box');
    let main = '', extra = '', side = '';

    // CARD IN DECK LIMIT RESTRICTION
    const card_restriction = id => {
        const strings = main + extra + side;
        let counter = 0;

        strings.split('<separator>').forEach(data => {
            if(data.split('(src)')[0].includes(`<YGO>${id}`)) {
                counter++;
            }
        });

        return counter;
    };

    // AUTO SAVE DATA
    const deck_name = $('.deck-name');

    const auto_save = async () => {
        main = '', extra = '', side = '';

        update_box.each((index, element) => {
            const deck_type = element.dataset.type;
            const list_box = $(element).children().children();
            list_box.each((i, el) => {
                const query_value = `${el.dataset.system}${el.dataset.id}(src)${el.dataset.src}(type)${el.dataset.type}`;

                switch(deck_type) {
                    case 'main':
                        main += query_value + '<separator>';
                        break;
                    case 'extra':
                        extra += query_value + '<separator>';
                        break;
                    case 'side':
                        side += query_value + '<separator>';
                        break;
                }

            });
        });

        /* SAVE STATEMENTS HERE */ 
        /*
        console.log('URI', deck_src);
        console.log('ID', deck_id);
        console.log('NAME', deck_name.val());
        console.log('MAIN', main);
        console.log('SIDE', extra);
        console.log('EXTRA', side);
        */
        main = (main) ? main.replaceAll('/', '<>') : 'none';
        extra = (extra) ? extra.replaceAll('/', '<>') : 'none';
        side = (side) ? side.replaceAll('/', '<>') : 'none';

        const response = await get_system_data(`${deck_src}/${deck_id}/${deck_name.val()}/${main}/${extra}/${side}`);

        console.log(response.data);
        
    }

    // save button
    $('.save-box').click(auto_save);

    // alert error
    const deck_alert = $('.deck-alert');
    const deck_alert_btn = deck_alert.find('button');

    deck_alert_btn.click(() => {
        deck_alert.fadeOut(250);
    });

    const alert_error = size => {
        deck_alert.children().first().text(`This DECK should have ONLY ${size} limited cards.`);
        deck_alert.fadeIn(250);
        
        body.animate({
            scrollTop: body.offset().top
        }, 1000);
    }

    // EVENT CARDS FUNCTIONALITY (CLICK)
    const owned_cards_container = $('.owned-cards-container, .owned-side-deck');

    let source_link;

    owned_cards_container.on('click', '.owned-cards', async event => {
        let response;

        if(event.currentTarget.dataset.source) {
            response= await get_system_data(event.currentTarget.dataset.source);
        } else {
            response= await get_system_data(`${deck_read}/${event.currentTarget.dataset.id}`);
        }

        source_link = event.currentTarget.dataset.img;
        set_modal(response.data);
    });
});