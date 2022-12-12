/* DASHBOARD JS (JQuery) for Dashboard */
"use strict";

// execute once the the document is completely loaded
$(document).ready(() => {

    // generate 1 random card from the right side bar
    const card_side = $('#card-side');
    const max_generate = 1;

    const random_cards_generate = async () => {
        const response = await get_all_data('');
        const data = response.data;
        let html = '';

        card_side.slideUp(250, async () => {

            let id;

            for(let i = 0; i < max_generate; i++) {
                const d = data[Math.floor(Math.random() * data.length)];
                const name = d.name;
                const desc = d.desc;
                id = d.id;
                html += `
                    <div class="card-body">
                        <h5 class="card-title" id="card-side-name">${name}</h5>
                        <p class="card-text" id="card-side-description"><small>${desc}</small></p>
                    </div>
                `;
            }

            card_side.attr('data-value', id);
            card_side.html(html);
            card_side.slideDown(250);

        });

    };

    card_side.on('click', async event => {
        const parameter = event.currentTarget.dataset.parameter;
        const value = event.currentTarget.dataset.value;
        const response = await get_data(parameter, value);

        set_modal(response);
    });

    random_cards_generate();

    // set timer to continuously generate cards every certain tick
    const second_per_tick = 8000;
    const generate_card__timer = new Timer(random_cards_generate, second_per_tick);
    
    generate_card__timer.start();

    // MODAL FUNCTIONALITY
    const card_modal_title = $('.modal-header .modal-title');
    const card_modal_body = $('.modal-body'); // container / parent
    const card_detail_node = $('.modal-box'); // children
    const card_detail_box = card_detail_node.clone(); // clone
    const card_modal_close_btn = $('.card-modal-close-btn'); // modal close button

    card_detail_node.remove(); // remove cards container

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
    
    card_modal_close_btn.click(() => {
        card_modal_body.children().fadeOut(250, () => {
            card_modal_body.children().remove(); // delete all the existing elements
        });
    });

    // at the top scroll functionality
    const body = $('html, body');
    const at_the_top = $('.at-the-top');

    at_the_top.click(() => {
        body.animate({
            scrollTop: body.offset().top
        }, 1000);
    });

    // add photos to the card album
    const card_input = $('.card-input');
    const submit_btn = $('.submit-btn');
    
    $('.upload-btn').click(() => {
        card_input.click();
    });

    card_input.on('change', () => {
        submit_btn.click();
    });

    // hover the delete button
    const card_album_container = $('.card-album-container');

    card_album_container.on('mouseover', '.card-album-box', event => {
        $(event.currentTarget).children().last().slideDown(250);
    })

    card_album_container.on('mouseleave', '.card-album-box', event => {
        $(event.currentTarget).children().last().slideUp(250);
    })

    let source_link;

    card_album_container.on('click', '.card-album-box', async event => {
        const response = await get_system_data(event.currentTarget.dataset.source);
        source_link = event.currentTarget.dataset.img;

        set_modal(response.data);
    })

});