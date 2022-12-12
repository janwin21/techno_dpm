/* MAIN JS (JQuery) for Main Page */
"use strict";

// execute once the the document is completely loaded
$(document).ready(() => {

    // darken the background of the header everytime a certain menu bar that has an image content has been hovered
    const bar_image_content = $('.bar-img-content');
    const darken_background = $('.main-header .darken-background');

    // search utility
    const body = $('html, body');
    const search_body = $('.card-collection');

    bar_image_content.on('mouseover', () => {
        darken_background.addClass('darken');
    });

    bar_image_content.on('mouseleave', () => {
        darken_background.removeClass('darken');
    });

    // prevent all the <tag> in the side bar to function
    $('.side-bar .list-group a, .side-bar a').click(event => {
        event.preventDefault();
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

    apply_insert_attribute(); // invoke

    // modify only one table. remove the value of all inputs except to the recent modified input
    const star_input = $('table .star-input');

    star_input.click(event => {
        star_input.each((index, element) => {
            if(element == event.currentTarget) {

            } else {
                $(element).val('');
            }
        });
    });

    // remove all alert categories once the close button is clicked
    const category_container = $('.category-container');
    const alert_category_node = $('.category'); // original
    const alert_category_box = alert_category_node.clone(); // clone
    const card_modal = $('.card-modal');

    const remove_itself = event => {
        const parent = $(event.currentTarget).parent();
        const text = parent.children().first().text();

        if(text !== 'All') {
            parent.fadeOut(250, () => {
                parent.remove()
            });
        }
    };

    alert_category_node.remove(); // remove the original

    // insert alert category box
    const insert_alert_box = parameter => {
        category_container.append(alert_category_box.clone().children().first().text(parameter).next().click(remove_itself).parent());
    }

    // manipulate the card library
    const card_collection = $('.card-collection').children().children().first(); // container
    const collection_node = card_collection.children().first(); // original
    const collection_box = collection_node.clone(); // clone

    collection_node.remove(); // remove the original

    // insert cards in collection container
    let q_params = '';
    let start_index = 0; // staring index of the cards
    const max_cards = 15; // limit of the cards per page

    const update_collection = (response, scrollable) => {
        const total_length = start_index + max_cards;
        const text_limit = 140; // limit the description text

        if(response === 'error') {
            card_collection.children().fadeOut(250);
            return;
        }

        card_collection.children().remove(); // remove all previous cards

        response.data.forEach((d, i, arr) => {
            if(i < total_length) {

                const new_card = collection_box.clone()
                    .attr('data-bs-toggle', 'modal')
                    .attr('data-bs-target', '#staticBackdrop');
            
                // REQUESTED DATA
                const src = d.card_images[0].image_url;
                const id = d.id;
                const name = d.name;
                const attribute = (d.attribute) ? d.attribute : d.type.replace(' Card', '');
                const desc = d.desc.replace('----------------------------------------', '')
                .replace('[ Pendulum Effect ]', '<strong style="font-weight: bolder">[ Pendulum Effect ]</strong>')
                .replace('[ Monster Effect ]', '<strong style="font-weight: bolder">[ Monster Effect ]</strong>');
                let market_pricing;

                Object.entries(d.card_prices[0]).forEach(([key, value]) => {
                    if(key === 'tcgplayer_price') {
                        market_pricing = `
                            <small class="text-muted">${key.split('_').join(' ')}</small>
                            <small class="text-muted">Pricing: <strong>$${value}</strong></small>
                        `;
                    } else {
                        return;
                    }
                });

                // MANIPULATE COLLECTION
                new_card.html(`    
                    <div class="card bg-dark text-white">
                        <img src="${src}" class="card-img" alt="card-collection">
                        <div class="card-img-overlay">
                            <h5 class="card-title">${name}&nbsp;<img src="../images/attributes-images/${attribute.toLowerCase()}.png" alt="${attribute}"></h5>
                            <p class="card-text" data-id="${id}">${desc}</p>
                            <div class="pricing">${market_pricing}</div>
                        </div>
                    </div>
                `);

                // set a manipulative code here...
                const description_box = new_card.children().last().children().first().next().children().first().next()
                const description = description_box.text();

                if(description.length > text_limit) {
                    description_box.text(description.slice(0, text_limit) + '...');
                } else {
                    description_box.text(description);
                }

                new_card.click(async () => {
                    const response = await get_data('id', id);
                    set_modal(response);
                });

                card_collection.append(new_card);
                new_card.fadeIn(250);
            
            }

        });
    
        if(scrollable) {
            body.animate({
                scrollTop: search_body.offset().top - 35
            }, 1000);
        }
        
    }

    // MANIPULATE URI
    // URI Access & Manipulation Section
    const qoute_btns = $('.qoutes-btn');
    const card_modal_title = $('.modal-header .modal-title');
    const card_modal_body = $('.modal-body'); // container / parent
    const card_detail_node = $('.modal-box'); // children
    const card_detail_box = card_detail_node.clone(); // clone
    const card_modal_close_btn = $('.card-modal-close-btn'); // modal close button

    card_detail_node.remove(); // remove cards container

    // ACCESS to ALL Manupulative Elements
    /*
    console.log("SET DECK: ", card_modal_title[0]);
    const children = card_detail_box.children();
    console.log("IMG SRC: ", children.first().attr('src'));
    console.log("NAME: ", children.first().next().text());
    console.log("ATTRIBUTE: ", children.first().next().next().html());
    console.log("LEVEL: ", children.first().next().next().next().html());
    console.log("TYPE: ", children.first().next().next().next().next().html());
    console.log("RACE: ", children.first().next().next().next().next().next().html());
    console.log("ATK / DEF: ", children.first().next().next().next().next().next().next().html());
    console.log("MARKET: ", children.first().next().next().next().next().next().next().next().html());
    console.log("DESCRIPTION: ", children.first().next().next().next().next().next().next().next().next().next().html());
    */

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
            
            attribute_box.html(`Attribute:</strong> <strong>${attribute}</strong>&nbsp;<img src="../images/attributes-images/${attribute.toLowerCase()}.png" alt="${attribute}">`);

            level_box.html(`<strong>Star:</strong> ${star_level} <img src="../images/star-images/level.png" alt="level"> / ${rank_level} <img src="../images/star-images/rank.png" alt="level"> / <strong>LINK</strong>-${link_level}`);

            type_box.html(`<strong>Type:</strong> ${type}`);
            race_box.html(`<strong>Race:</strong> ${race}`);
            ad_box.html(`<strong>ATK / DEF:</strong> ${atk} / ${def}`);
            market_box.html(price_desc);
            desc_box.html(desc);

            card_modal_body.append(card_box);
            card_box.fadeIn(250);

        });
        
    };

    // https://db.ygoprodeck.com/api/v7/cardinfo.php?name=dark magician&attribute=dark&level=7&archetype=Dark Magician&type=Normal Monster&race=spellcaster&id=46986421&desc=The ultimate wizard in terms of attack and defense.&link=0

    // SEARCH CONTAINER
    const search_container = $('.search-container');
    const search_inputs = $(search_container.find('input, textarea'));
    const search_btn = $('.search-btn');
    const load_more_btn = $('.load-more-btn');

    // apply functions to all inputs
    const apply_to_inputs = async scrollable => {
        let value = '';

        category_container.children().remove(); // remove all category boxes first
        insert_alert_box('All');

        search_inputs.each((index, element) => {
            const parameter = $(element).attr('data-parameter');
            const output = $(element).val();

            if(output.length != 0) {

                if(parameter === 'link' && value.includes('level')) {} else {
                    value += `${parameter}=${output}<s>`;
                }

                insert_alert_box(output);
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
        
        update_collection(response, scrollable);

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

        update_collection(response, false);
    });

    // create random 7 cards in the Random Cards in the Market
    const card_display = $('.cards-display .container');
    const max_generate = 6;

    const random_cards_generate = async () => {
        const response = await get_all_data('');
        const data = response.data;
        let html = '';

        card_display.fadeOut(250, async () => {

            let id;

            for(let i = 0; i < max_generate; i++) {
                const d = data[Math.floor(Math.random() * data.length)];
                const src = d.card_images[0].image_url;
                id = d.id;
                html += `<a href="#"><img src="${src}" alt="display-market-card" data-id="${id}"></a>`;
            }

        
            const response = await get_data('id', id);

            card_display.html(html);
            card_display.fadeIn(250);

            modify_side_header(response.data[0]);

        });

    };

    card_display.on('click', 'img', async event => {
        const response = await get_data('id', event.target.dataset.id);
        modify_side_header(response.data[0]);
        generate_card__timer.reset();
    });

    const modify_side_header = d => {
        sub_card_header.fadeOut(250, () => {

            /* REQUEST DATA*/
            const src = d.card_images[0].image_url;
            const id = d.id;
            const name = d.name;
            const attribute = (d.attribute) ? d.attribute : d.type.replace(' Card', '');
            const type = d.type;
            let market_pricing;

            Object.entries(d.card_prices[0]).forEach(([key, value]) => {
                if(key === 'tcgplayer_price') {
                    market_pricing = `
                        <p class="text-white mt-2">Pricing: <strong>$${value}</strong></p>
                    `;
                } else {
                    return;
                }
            });

            /* MANIPULATE DATA */
            const html = `
                <h4 class="text-white">${name}</h4>
                <p class="text-white">
                    [${type}]
                </p>
                <p class="text-white card-type"><span><strong>Type:</strong> <img src="../images/attributes-images/${attribute.toLowerCase()}.png" alt="${attribute}-icon"> <strong>${attribute.toUpperCase()}</strong></span></p>
                <img src="${src}" alt="card-overview" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="${id}">
                ${market_pricing}
            `;

            sub_card_header.html(html);
            sub_card_header.fadeIn(250);

        });

    };

    random_cards_generate();

    // set timer to continuously generate cards every certain tick
    const second_per_tick = 8000;
    const generate_card__timer = new Timer(random_cards_generate, second_per_tick);
    
    generate_card__timer.start();

    // sub header manipulation functionality
    const sub_card_header = $('.sub-card-header');
    
    sub_card_header.on('click', 'img', async event => {
        const response = await get_data('id', event.target.dataset.id);
        set_modal(response);
    });

    // show every picture from description section
    const description_img = $('.show-description-img');
    
    description_img.click(async event => {
        const response = await get_data(event.currentTarget.dataset.parameter, event.currentTarget.dataset.value);
        set_modal(response);
    });

});
