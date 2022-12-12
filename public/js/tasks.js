/* SVG Functionality */
"use strict";

// Wrapping SVG Text Data Algorithm ------->
// first function: get the width of the text by checking the text itself and its font family
const getTextWidth = (text, font = "500 12px sans-serif") => {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");
    context.font = font; // get the font to check the factors that will affect of wrapping text
    return context.measureText(text).width;
};

// second function: break a text by splitting it into array based on specified width size
const breakString = (word, maxWidth, hyphenCharacter='-', font) => {
    const characters = word.split("");
    const lines = [];
    let currentLine = "";

    characters.forEach((character, index) => {
        const nextLine = `${currentLine}${character}`;
        const lineWidth = getTextWidth(nextLine, font);

        if (lineWidth >= maxWidth) {
            const currentCharacter = index + 1;
            const isLastLine = characters.length === currentCharacter;
            const hyphenatedNextLine = `${nextLine}${hyphenCharacter}`;
            lines.push(isLastLine ? nextLine : hyphenatedNextLine);
            currentLine = "";
        } else {
            currentLine = nextLine;
        }

    });

    return { hyphenatedStrings: lines, remainingWord: currentLine };
};

// third function: break the text by invoking getTextWidth() and breakString() and return an array
const wrapLabel = (label, maxWidth, font) => {
    const words = label.split(" ");
    const completedLines = [];
    let nextLine = "";

    words.forEach((word, index) => {
        const wordLength = getTextWidth(`${word} `, font);
        const nextLineLength = getTextWidth(nextLine, font);

        if (wordLength > maxWidth) {
            const { hyphenatedStrings, remainingWord } = breakString(word, maxWidth, font);
            completedLines.push(nextLine, ...hyphenatedStrings);
            nextLine = remainingWord;
        } else if (nextLineLength + wordLength >= maxWidth) {
            completedLines.push(nextLine);
            nextLine = word;
        } else {
            nextLine = [nextLine, word].filter(Boolean).join(" ");
        }

        const currentWord = index + 1;
        const isLastWord = currentWord === words.length;
        
        if (isLastWord) {
            completedLines.push(nextLine);
        }
    });

    return completedLines.filter(line => line !== "");
};

// fourth function: a wrapping text functionality use in card description box to be invoke once a certain event listen
const wrap = (parent, cssSelector, text_container, text, summoning, total_width, n, l, xl, x, y) => {
    parent.find('.card-info, .pendulum-effect').remove();

    // comment descriptions apply to NON-PENDULUM monsters only
    let max_width = total_width; // 379 width in px
    let normal_length = n; // 325 characters
    let long_length = (summoning) ? 462 : l; // 552 characters
    let last_length = (summoning) ? 649 : xl; // 740 characters
    let font_size = 12; // 12 for default SVG font-size
    let x_pos = x; // description horizontal position in px
    let y_pos = y; // 519 for default y position value of card description in px
    let y_space = 14; // a space used by the descriptin if the card summonig text exist

    // set maximum width if the font size become smaller
    // decrement the font size if the text length reach the maximum length
    if(text.length > last_length) {
        font_size = 8;
        y_space = 11;
    } else if(text.length > long_length) {
        font_size = 9;
        y_space = 12;
    } else if(text.length > normal_length) {
        font_size = 11;
    }

    // set the font size of the card summoning requirements if exist
    if(summoning) {
        summoning.attr('font-size', `${font_size}px`)
            .attr('y', `${y}px`);
        y_pos += y_space;
    }

    // pass the text and width then get the array of the wrapped text
    const label = wrapLabel(text, max_width, `500 ${font_size}px sans-serif`);

    /* 
        loop the newly label to manipulate all the elements inside the array
        the element must be a cloned value of the text_container and modify its attributs and value
    */
    const wrappedText = label.map((word, index) => {
        let wrapped_word = word.split(' ').map(str => {
            return `<tspan>${str}</tspan>`
        }).join(' ');

        return text_container.clone()
            .attr('y', `${y_pos + (index * font_size)}px`)
            .attr('font-size', `${font_size}px`)
            .html(wrapped_word).show();
    });

    // iterate all the lines by appending every text in the <text> tag
    for(let i = 0; i < wrappedText.length; i++) {
        parent.append(wrappedText[i]);
    }
    
    justify_text(parent, cssSelector, x_pos, max_width);
}
// ------->

// Justify SVG Text Data Algorithm ------->
// justify a text but the last element of an array is always left aligned
const justify_text = (parent, cssSelector, x_pos, max_width) => {
    var lines = parent.children(cssSelector);

    for(var l = 0; l < lines.length; l++) {
        var line = lines[l];
        var total_width = max_width;
        var texts = line.getElementsByTagName('tspan');
        var width_of_texts = 0;

        for(var i = 0; i < texts.length; i++) {
            width_of_texts += texts[i].getBBox().width;
        }

        if(texts.length > 1) {
            var extra_space = (total_width - width_of_texts) / (texts.length - 1);
            var x = x_pos;

            for(var i = 0; i < texts.length; i++) {
                texts[i].setAttribute("x", x);
                x = x + texts[i].getBBox().width + extra_space;
                if(l === lines.length - 1) break;
            }
        }
    }
}
// ------->

// Star Manipulator Functionality ------->
// display Monster Card level from the Card Template (the last parameter must cloned already)
const display_star = (group, star_number, cloned_img) => {
    group.children().remove(); // remove the current elements for the insertion of the newly updated stars

    if(Number(star_number) == 0) return;

    let x = (Number(star_number) === 12) ? 371 : 365; // star level position in px (RIGHT)
    let excess = 2; // excess px
    let space = Number(cloned_img.attr('width').replace('px', '')) + excess; // space of the star (star width + a little space in px per each star)
    let star_type = cloned_img.attr('class');

    // start rank position in px (LEFT)
    if(star_type === 'rank') {
        x = (Number(star_number) === 13) ? 32 : (Number(star_number) === 12) ? 42 : 50;
        space = -space + ((Number(star_number) === 13) ? 1 : 0);
    } else if(star_type === 'negative') {
        x = (Math.abs(star_number) === 12) ? 41 : 50;
        space = -space;
    }
    
    group.children().remove(); // update the start by removing the current stars

    // output the input number of starts
    for(let i = 0; i < Math.abs(star_number); i++) {
        let img = cloned_img.clone();

        img.attr('x', `${x - (space * i)}`);
        single_serialize_to_base64(img);

        group.append(img);
    }
};
// ------->

// Image to Blob (Base64) Converter ------->
/*
    (Assumption) Convert the <svg> tag into a rasterized Bitmap image (PNG):
    - ALL the xlink_href of <image> tag should be converted into BLOB format
    - convert the <svg> tag itself into a XML + SVG base 64 format and insert it to <img> tag
    - insert the src content of <img> tag to <canvas> using PNG base64 dataURI
    - simply convert the <canvas> into PNG Image format and upload it using <a> tag
*/

// create a new image and convert the src into a BLOB format. Afterwards, insert the BLOB Content to the newly created image. (Assumption) use to converted BLOB before serializing the whole <svg> tag into XML format
const toDataURL = (src, callback, outputFormat) => {
    var img = new Image();

    img.crossOrigin = 'Anonymous';
    
    img.onload = function() {
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var dataURL;

        canvas.height = this.naturalHeight;
        canvas.width = this.naturalWidth;
        ctx.drawImage(this, 0, 0);
        dataURL = canvas.toDataURL(outputFormat); // 'image/png'
        callback(dataURL);
    };

    img.src = src;

    if (img.complete || img.complete === undefined) {
      img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
      img.src = src;
    }

}

// serialize SVG to XML format to Base64
const serialize_svg = (svgCssSelector, image) => {
    // Convert SVG to XML
    var svg = document.querySelector(svgCssSelector);

    // get svg data
    var xml = new XMLSerializer().serializeToString(svg);

    // make it base64
    var svg64 = btoa(unescape(encodeURIComponent(xml)));
    var b64Start = 'data:image/svg+xml;base64,';

    // prepend a "header"
    var image64 = b64Start + svg64;

    image.attr('src', image64);
}

// insert the hidden image's src to canvas context (HIDDEN IMAGE REQUIRED!)
const insert_to_canvas = (hidden_image, canvas) => {
    let base_image = new Image();
    const ctx = canvas.getContext("2d");

    base_image.src = $(hidden_image).attr('src');
    ctx.drawImage(base_image, 0, 0);
}

// convert the canvas into PNG and uplooad it
const download_png = (name, canvas) => {
    $(canvas).show();
    let href;

    // IE/Edge Support (PNG Only)
    if(window.navigator.msSaveBlob) {
        window.navigator.msSaveBlob(canvas.msToBlob(), `${name}.png`);
    } else {
        // All Browser support
        const a = document.createElement('a');

        document.body.append(a);
        href = a.href = canvas.toDataURL("image/png");
        a.download = `${name}.png`;
        a.click();
        document.body.appendChild(a);
    }

    $(canvas).hide();
    return href;
};

// (SNIPPET) code that used for TESTING SVG from several comversions and PNG upload
/*
    // SCRIPT
    // set the converted BLOB to the original xlink:href of all <image> tag in <text> container
    images.each((index, image) => {
        let xlink_href = $(image).attr('xlink:href');

        toDataURL(xlink_href, dataURL => {
            $(image).attr('xlink:href', dataURL);
        }, 'image/png');
    });

    // once all <image> has BLOB uri from their xlink:href, serialize the <svg> into Base64 XML + SVG format and insert it to the HIDDEN IMAGE that can be insert to the <canvas> later on
    document.querySelector('svg').addEventListener('load', function(){
        serialize_svg('svg', $('#imgConverted'));
    });

    // DOM selection for image insertion and upload
    // download button, (HIDDEN IMAGE) image converter, and (HIDDEN CANVAS) canvas
    const btnDownload = document.querySelector('#btnDownload');
    const imgConverted = document.querySelector('#imgConverted');
    const myCanvas = document.querySelector('#myCanvas');

    // invoke snippet for image insertion after the elements load
    document.querySelector('#imgConverted').addEventListener('load', function(){
        insert_to_canvas($('#imgConverted'), myCanvas);
    });

    // invoke PNG image download once the download button clicked
    btnDownload.addEventListener('click', () => {
        download_png('new-card', myCanvas);
    });

    <!-- TESTING for converting SVG to PNG -->
    <!-- HTML -->
    <button type="button" id="btnDownload" style="float: left;">Download</button>
    <canvas id="myCanvas" width="443px" height="645px" style="display: none"></canvas><!-- HIDDEN CANVAS -->
    <img src="" style="display: none;" id="imgConverted"><!-- HIDDEN IMAGE -->
*/
// NEW CONCEPT: upload PNG image with the combination user's input insertion and the serialization, insertion and conversion of Base64 up to the endpoint
const upload_card = (name, canvas, image, loading_element) => {
    serialize_svg('svg', image);
    loading_element.fadeIn(500);

    image.on('load', () => {
        insert_to_canvas(image, canvas.get()[0]);
        download_png(name, canvas.get()[0]);
        loading_element.fadeOut(500);
    });
};

// set the converted BLOB to the original xlink:href of all <image> tag in <text> container
const serialize_to_base64 = images => {
    images.each((index, image) => {
        let xlink_href = $(image).attr('xlink:href');

        toDataURL(xlink_href, dataURL => {
            $(image).attr('xlink:href', dataURL);
        }, 'image/png');
    });
};

const single_serialize_to_base64 = image => {
    let xlink_href = $(image).attr('xlink:href');

    toDataURL(xlink_href, dataURL => {
        $(image).attr('xlink:href', dataURL);
    }, 'image/png');
};

// NEW CONCEPT snippet
/*
    // SCRIPT
    const myCanvas = $('#myCanvas');
    const hiddenImg = $('#imgConverted');

    $('input[type=file]').on('change', event => {
        // insert image to SVG card <image> tag
        const source = URL.createObjectURL(event.target.files[0]);;
        card_image.attr('xlink:href', source);
        serialize_to_base64();
    });

    $('#btnDownload').click(() => {
        upload_card(name, myCanvas, hiddenImg, back_card);
    });

    <!-- TESTING for converting SVG to PNG -->
    <!-- HTML -->
    <button type="button" id="btnDownload">Download</button>
    <canvas id="myCanvas" width="443px" height="645px" style="display: none"></canvas><!-- HIDDEN CANVAS -->
    <img src="" style="display: block;" id="imgConverted"><!-- HIDDEN IMAGE -->
    <form action="" enctype="multipart/form-data">
        <input type="file">
    </form>
*/
// ------->

// Adjusting Card Name Size Functionality ------->
const modify_title_size = card_name => {
    /*
        Card Name section
        19 Characters - large font-size
        28 characters - normal font-size
        38 characters - small font-size
        36 and more characters - extra-small font-size
        $('.card-name') - is the element query
    */
    const NORMAL_LENGTH = 28; // px
    const LARGE_LENGTH = 34; // px
    let font_size = 3.15; // em
    let y_pos = 57; // px

    if(card_name.text().length > LARGE_LENGTH) {
        font_size = 2;
        y_pos -= 3;
    } else if(card_name.text().length > NORMAL_LENGTH) {
        font_size = 2.75;
        y_pos -= 1;
    }
    
    card_name.css('font-size', `${font_size}em`);
    card_name.attr('y', `${y_pos}px`);
};
// ------->

// Element Value Display Data Algorithm ------->
// a very useful utility to prevent developers creating multiple functions just to display the value one by one (the element parameter should by in jQuery element)
const display_value = (element, value, copyright) => {
    if(copyright) {
        if(element) element.html(`&copy;${value}`);
    } else {
        if(element) element.html(value);
    }
};
// ------->

// (LINK) Manipulate Link Arrows Functionality ------->
const link_arrow_on = position => {
    $(`#link-marker-${position}`).show();
}; // turn ON the link-arrow

const link_arrow_off = position => {
    $(`#link-marker-${position}`).hide();
}; // turn OFF the link-arrow

const link_arrow_toggle = position => {
    $(`#link-marker-${position}`).toggle();
}; // Toggle Show the link-arrow
// ------->

// Hover Menu Card Adjustment Functionality ------->
const adjust_menu_card = element => {
    const e = $(element);
    const s = e.prev();
    const space = 24; // card description padding top spacing

    s.css('padding-bottom', e.height() + space);
}
// ------->

let source = '';

$(document).ready(() => {
    // MAIN SOURCE
    const main_path = $('#main-path');
    source = main_path.attr('data-src');
});

// Insert In Accordion Functionality ------->
const insert_to_accordion = (parent, cloned_element, attribute, has_image) => { 
    let text = has_image ? `<img src="${source}/attributes-images/${attribute}.png" alt="image-${attribute}-attribute">&nbsp;&nbsp;${attribute}` : attribute;
    
    cloned_element.attr('data-value', attribute);
    cloned_element.html(text);

    parent.append(cloned_element);
};
// ------->

// AXIOS GET YGO PRO URI ------->
// This is a READ METHOD use to GET a data from YGOPRO API website
// Get all the data from restricted parameters and values     
const get_data = async (parameter, value) => {

    const response = await axios.get(`https://db.ygoprodeck.com/api/v7/cardinfo.php?${parameter}=${value}`);
   
    return response.data;

}

const get_all_data = async (query_params) => {

    try {
        const response = await axios.get(`https://db.ygoprodeck.com/api/v7/cardinfo.php?${query_params}`);
        return response.data;
    } catch(err) {
        return 'error'
    }
    
}

const get_system_data = async source => {

    try {
        const response = await axios.get(source, {
            headers: { 
                'Access-Control-Allow-Origin' : '*',
                'Access-Control-Allow-Methods':'GET,PUT,POST,DELETE,PATCH,OPTIONS',
            }
        });
        return response.data;
    } catch(err) {
        return 'error'
    }
    
}
// ------->
