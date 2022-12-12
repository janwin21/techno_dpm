@extends('layouts.app')

@section('content')
<!-- Card Editor Section Component -->
<div class="search-container d-flex flex-row" style="z-index: 100;">

    <!-- Card Editor Side Bar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark side-bar" style="width: 280px;">
        <div class="container-fluid bg-dark sticky-top pb-3" id="sidebar-wrapper">
            <a href="#!" class="d-flex align-items-center text-white text-decoration-none">
                <span class="fs-6 mt-3 mb-3 text-white"><i class="fas fa-edit"></i> Edit Card</span>
            </a>

            <div class="list-group">
                
                <a href="#" class="list-group-item list-group-item-action">

                    <!-- Card Component (IMAGE DETAILS) -->
                    <div class="card mb-5">
                        <img class="card-img" src="{{ asset('images/non-monster-images/dark-factory-of-mass-production.webp') }}" alt="search-bar-image">
                        <div class="card-img-overlay overlay-dark text-white card-button" data-toggle="setter-input">
                            <div class="darken-background">
                                <p><i class="far fa-image"></i>&nbsp;&nbsp;Image Details</p>
                            </div>
                            <p class="card-description">Choose an Image and Cards Template for you card.</p>
                        </div>
                    </div>

                </a>
                
                <a href="#" class="list-group-item list-group-item-action">

                    <!-- Card Component (UPPER DETAILS) -->
                    <div class="card m-0">
                        <img class="card-img" src="{{ asset('images/non-monster-images/scrap-factory.jpg') }}" alt="search-bar-image">
                        <div class="card-img-overlay overlay-dark text-white card-button" data-toggle="first-input">
                            <div class="darken-background">
                                <p><i class="fab fa-superpowers"></i>&nbsp;&nbsp;Upper Details</p>
                            </div>
                            <p class="card-description">Edit all the details at the upper parts of the cards (Except for link rating that can be found at the lower right part).</p>
                        </div>
                    </div>

                </a>
                
                <a href="#" class="list-group-item list-group-item-action">

                    <!-- Card Component (LOWER DETAILS) -->
                    <div class="card m-0">
                        <img class="card-img" src="{{ asset('images/non-monster-images/machine-conversion.png') }}" alt="search-bar-image">
                        <div class="card-img-overlay overlay-dark text-white card-button" data-toggle="second-input">
                            <div class="darken-background">
                                <p><i class="fas fa-sort-amount-down"></i>&nbsp;&nbsp;Lower Details</p>
                            </div>
                            <p class="card-description">Edit all the long detais of the cards. Parts of the Pendulum and Link card are also here.</p>
                        </div>
                    </div>

                </a>
                
                <a href="#" class="list-group-item list-group-item-action">

                    <!-- Card Component (FINAL DETAILS) -->
                    <div class="card m-0">
                        <img class="card-img" src="{{ asset('images/non-monster-images/shogun-gate.png') }}" alt="search-bar-image">
                        <div class="card-img-overlay overlay-dark text-white card-button" data-toggle="third-input">
                            <div class="darken-background">
                                <p><i class="fas fa-industry"></i>&nbsp;&nbsp;Final Details</p>
                            </div>
                            <p class="card-description">Input the final detail of the Cards including you, the creator of the card.</p>
                        </div>
                    </div>

                </a>

            </div>
        </div>
    </div>

    <!-- Card SVG Component -->
    <main class="search editor">
        <div class="container-fluid">
            
            <!-- MAIN CARD in SVG tag -->
            <div class="container-fluid description-container pt-3">
                @if ($card->card_name ?? '')
                    <form action="{{ url('card/update/' . $card->card_main_id . '/' .$card->user_id . '/' . (($card->card_image ?? '') ? $card->card_image : 'empty.png')) }}" method="POST" enctype="multipart/form-data">
                @elseif (!Auth::check())
                    <form action="{{ route('yugioh-card-maker') }}" method="POST" enctype="multipart/form-data">
                @else
                    <form action="{{ route('card.create', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                @endif
                    {{ method_field('GET') }}
                    @csrf

                    <!-- Inputs 1 -->
                    <div class="input-container">
                        <div class="alert alert-danger mb-2" role="alert">
                            <p>A simple danger alert—check it out!</p>
                            <button type="button" class="btn-close" aria-label="Close"></button>
                        </div>
                        <table>
                            <tr class="setter-input">
                                <td colspan="3">
                                    <label for="card_image">Card Image</label><br>
                                    <input type="file" class="card-file" name="card_image" style="display: none">
                                    <button type="button" class="btn btn-primary image-btn">Upload Image</button>
                                </td>
                            </tr>
                            <tr class="setter-input">
                                <td colspan="3">
                                    <label for="card_template">Card Template</label><br>
                                    <input type="text" id="template-input" name="card_template" value="{{ $card->card_template ?? 'effect-monster' }}" style="display: none;">
                                    <div class="row row-cols-1 row-sm-cols-2 row-cols-sm-3 card-template-container">
                                        <button class="card-template-btn"><img id="card-template-img" src="{{ asset('images/card-templates/normal-monster-card-template.png') }}" alt="card-template"></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="first-input">
                                <td colspan="3">
                                    <label for="card_name">Name</label><br>
                                    <input type="text" data-toggle=".card-name" name="card_name" placeholder="e.g. Blue-Eyes White Dragon" value="{{ $card->card_name ?? 'Caius the Shadow Monarch' }}">
                                </td>
                            </tr>
                            <tr class="first-input">
                                <td>
                                    <input type="text" name="card_attribute" style="display: none" value="{{ $card->card_attribute ?? 'dark' }}">
                                    <label for="card_attribute">Attribute</label><br>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('images/attributes-images/dark.png') }}" href="attribute">Dark
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark attribute-list" aria-labelledby="dropdownMenuButton2">
                                            <li><a class="dropdown-item" href="#!"><img src="{{ asset('images/attributes-images/dark.png') }}" href="attribute">Action</a>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" id="rarity-input" name="card_rarity" style="display: none" value="{{ $card->card_rarity ?? 'common' }}">
                                    <label for="card_rarity">Rarity</label><br>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $card->card_rarity ?? 'common' }}
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark rarity-list" aria-labelledby="dropdownMenuButton2">
                                            <li><a class="dropdown-item" href="#">Action</a>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="non_monster_type" style="display: none" value="{{ $card->non_monster_type ?? 'normal' }}">
                                    <label for="non_monster_type">Spell / Trap Type</label><br>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            Normal
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark non-monster-type-list" aria-labelledby="dropdownMenuButton2">
                                            <li><a class="dropdown-item" href="#">Action</a>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr class="first-input">
                                <td>
                                    <label for="card_level">Level</label><br>
                                    <input type="number" data-toggle="level" min="-12" max="12" name="card_level" value="{{ $card->card_level ?? '6' }}">
                                </td>
                                <td>
                                    <label for="card_rank">Rank</label><br>
                                    <input type="number" data-toggle="rank" min="1" max="13" name="card_rank" value="{{ $card->card_rank ?? '1' }}">
                                </td>
                                <td>
                                    <label for="link_rating">Link Rating</label><br>
                                    <input type="number" data-toggle="#link-rating" min="1" max="6" name="link_rating" value="{{ $card->link_rating ?? '1' }}">
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td colspan="2">
                                    <label for="card_effect">Effect</label><br>
                                    <input type="text" data-toggle=".card-effect" placeholder="e.g. Dragon/Normal" name="card_effect" data-restriction="monster" value="{{ $card->card_effect ?? 'Fiend / Effect' }}">
                                </td>
                                <td>
                                    <label for="card_atk">ATK</label><br>
                                    <input type="number" data-toggle="#card-atk" name="card_atk" min="0" data-restriction="monster" value="{{ $card->card_atk ?? '2400' }}">
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td colspan="2">
                                    <label for="card_summoning">Summoning Requirements</label><br>
                                    <input type="text" data-toggle=".card-summoning" placeholder="e.g. 2 Level 6 Monsters" name="card_summoning" data-restriction="monster" value="{{ $card->card_summoning ?? '2 Level 6 monsters' }}">
                                </td>
                                <td>
                                    <label for="card_def">DEF</label><br>
                                    <input type="number" data-toggle="#card-def" name="card_def" min="0" data-restriction="monster" value="{{ $card->card_def ?? '1000' }}">
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td>
                                    <label for="card_scale_left" class="scale-label scale-left">Left Scale</label><br>
                                    <input type="number" name="card_scale_left" data-toggle="#scale-left" min="0" min="12" data-restriction="scale" value="{{ $card->card_scale_left ?? '1' }}">
                                </td>
                                <td></td>
                                <td>
                                    <label for="card_scale_right" class="scale-label scale-right">Right Scale</label><br>
                                    <input type="number" name="card_scale_right" data-toggle="#scale-right" min="0" min="12" data-restriction="scale" value="{{ $card->card_scale_right ?? '1' }}">
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td>
                                    <label for="link_marker">Link Marker</label>
                                    <input type="text" class="link-marker-input" name="link_marker" style="display: none;" value="{{ $card->link_marker ?? 'top bottom-left bottom-right' }}">
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td>
                                    <button type="button" id="top-left" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="top-left">Top Left</button>
                                </td>
                                <td>
                                    <button type="button" id="top" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="top">Top</button>
                                </td>
                                <td>
                                    <button type="button" id="top-right" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="top-right">Top Right</button>
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td>
                                    <button type="button" id="left" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="left">Left</button>
                                </td>
                                <td></td>
                                <td>
                                    <button type="button" id="right" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="right">Right</button>
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td>
                                    <button type="button" id="bottom-left" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="bottom-left">Bottom Left</button>
                                </td>
                                <td>
                                    <button type="button" id="bottom" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="bottom">Bottom</button>
                                </td>
                                <td>
                                    <button type="button" id="bottom-right" class="btn btn-primary final-btn link-marker-btn" data-trigger="" data-value="bottom-right">Bottom Right</button>
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td colspan="3">
                                    <label for="card_pendulum_effect">Pendulum Description</label><br>
                                    <textarea name="card_pendulum_effect" data-toggle="pendulum-effect" data-restriction="scale">{{ $card->card_pendulum_effect ?? 'Card pendulum description is here...' }}</textarea>
                                </td>
                            </tr>
                            <tr class="second-input">
                                <td colspan="3">
                                    <label for="card_description">Description</label><br>
                                    <textarea name="card_description" data-toggle="description">{{ $card->card_description ?? 'If this card is Tribute Summoned: Target 1 card on the field; banish that target, and if you do, inflict 1000 damage to your opponent if it is a DARK monster.' }}</textarea>
                                </td>
                            </tr>
                            <tr class="third-input">
                                <td>
                                    <label for="card_id">ID</label><br>
                                    <input type="text" placeholder="e.g. SCK-000" name="card_id" data-toggle=".card-id" value="{{ $card->card_id ?? 'SCK-000' }}">
                                </td>
                                <td>
                                    <label for="card_serial_number">Serial Number</label><br>
                                    <input type="number" placeholder="e.g. 123456789" name="card_serial_number" data-toggle=".card-serial-number" value="{{ $card->card_serial_number ?? '123456789' }}">
                                </td>
                                <td>
                                    <label for="card_copyright">Copyright</label><br>
                                    <input type="text" placeholder="e.g. 2022 Author" name="card_copyright" data-toggle=".card-copyright" value="{{ $card->card_copyright ?? '2022 Author' }}">
                                </td>
                            </tr>
                            <tr class="third-input">
                                <td>
                                    <label>Stamp</label>
                                </td>
                            </tr>
                            <tr class="third-input">
                                <td class="row-radio">
                                    <button type="button" for="stamp" class="btn btn-primary stamp-btn">Limited Edition</button>
                                    <input type="radio" class="radio-input" name="card_stamp" value="limited-edition" style="display: none;" {{ (($card->card_stamp ?? '') == 'limited-edition') ? 'checked' : '' }}>
                                </td>
                                <td class="row-radio">
                                    <button type="button" for="stamp" class="btn btn-primary stamp-btn">Unlimited Edition</button>
                                    <input type="radio" class="radio-input" name="card_stamp" value="unlimited-edition" style="display: none;" {{ (($card->card_stamp ?? '') == 'unlimited-edition') ? 'checked' : '' }} {{ $card->card_stamp ?? 'checked' }}>
                                </td>
                            </tr>
                            <tr class="third-input">
                                <td>
                                    <label>Finish</label>
                                </td>
                            </tr>
                            <tr class="third-input">
                                <td>
                                    <button type="button" id="btnDownload" class="btn btn-secondary final-btn">Upload</button>
                                    <canvas id="myCanvas" width="443px" height="645px" style="display: none"></canvas><!-- HIDDEN CANVAS -->
                                    <img src="" style="display: none;" id="imgConverted"><!-- HIDDEN IMAGE -->
                                </td>
                                <td>
                                    @if (Auth::check())
                                        <button type="submit" class="btn btn-success final-btn submit-btn">{{ ($card->card_name ?? '') ? 'Update' : 'Save' }}</button>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                </form>
            </div>

        </div>
    </main>
    
    <nav class="col-3 bg-dark">
        <div class="position-fixed editor-preview">

            <!-- SVG Card Template -->
            <svg 
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                width="443px" height="645px">
    
                <!-- Apply styling (this is the only method to apply styles upon converting base64) -->
                <style>
                    text {
                        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                        font-weight: bolder;
                    }
                    
                    .card-name {
                        font-family: 'Roboto Slab', serif !important;
                        font-size: 3.15em;
                        font-weight: bold;
                        letter-spacing: -1px;
                    }
                    
                    .card-effect {
                        font-size: 2.05em;
                    }
                    
                    .card-details {
                        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                        font-size: 1.7em;
                        letter-spacing: -1px;
                        opacity: 0.9;
                    }
                    
                    .card-info, .pendulum-effect, .card-summoning {
                        font-family: 'Ubuntu', sans-serif;
                        opacity: 0.75;
                    }
                    
                    .card-name, .card-effect {
                        font-variant: small-caps;
                    }
    
                    .pendulum-scale {
                        font-family: 'Aleo', serif;
                        font-size: 3em;
                        font-weight: bolder;
                    }
    
                    #link-rating {
                        font-family: 'Orbitron', sans-serif;
                    }
                </style>
    
                <!-- Monster Image -->
                @if ($card->card_image ?? '')
                    <image class="card-image non-pendulum-image" x="50px" y="117px" width="343px" height="343px" xlink:href="{{ asset('images/user') . '/' . $card->user_id . '/' . $card->card_image }}"/>
        
                    <!-- Monster Image (PENDULUM) -->
                    <image class="card-image pendulum-image" x="27px" y="115px" width="389px" height="389px" xlink:href="{{ asset('images/user') . '/' . $card->user_id . '/' . $card->card_image }}"/>
                @else
                    <image class="card-image non-pendulum-image" x="50px" y="117px" width="343px" height="343px" xlink:href="{{ asset('images/monster-images/caius-the-shadow-monarch.png') }}"/>
        
                    <!-- Monster Image (PENDULUM) -->
                    <image class="card-image pendulum-image" x="27px" y="115px" width="389px" height="389px" xlink:href="{{ asset('images/monster-images/caius-the-shadow-monarch.png') }}"/>
                @endif
    
                <!-- Normal Monster Card Template -->
                <image id="card-template" x="0px" y="0px" width="443px" height="645px" xlink:href="{{ asset('images/card-templates/normal-monster-card-template.png') }}"/>
    
                <!-- LINK MARKERS (LINK) -->
                <g class="link-marker-group">
                    <image class="link-marker" x="0px" y="0px" width="443px" height="645px" xlink:href="{{ asset('images/link-marker-images/link-marker-top.png') }}"/>
                </g>
    
                <!-- Attribute Image -->
                <image id="card-attribute" x="378px" y="29px" width="40px" height="40px" xlink:href="{{ asset('') }}images/attributes-images/light.png"/>
    
                <!-- Card Level Group Image (RIGHT) -->
                <g class="card-level">
                    <image class="level" y="77px" width="28px" height="28px" xlink:href="{{ asset('images/star-images/level.png') }}"/>
                </g>
    
                <!-- Card Rank Group Image (LEFT) -->
                <g class="card-rank">
                    <image class="rank" y="77px" width="28px" height="28px" xlink:href="{{ asset('images/star-images/rank.png') }}"/>
                </g>
    
                <!-- Card Negative Level Group Image for Dark Synchro (LEFT) -->
                <g class="card-negative">
                    <image class="negative" y="77px" width="28px" height="28px" xlink:href="{{ asset('images/star-images/negative.png') }}"/>
                </g>
    
                <!-- Non-Monster Card Type Icon -->
                <image id="card-icon" x="370" y="82px" width="20px" height="20px" xlink:href="{{ asset('images/non-monster-type-images/continuous.png') }}"/>
    
                <!-- Text Formats -->
                <text class="unselectable" kerning="auto" fill="rgb(0, 0, 0)" font-size="8px">
    
                    <!-- Card Name -->
                    <tspan class="card-name" font-size="8px" fill="#000000" text-anchor="start" x="29px" y="57px"></tspan>
    
                    <!-- Card ATK -->
                    <tspan id="card-atk" font-size="17px" fill="#000000" text-anchor="end" x="323px" y="605px"></tspan>
    
                    <!-- Card DEF -->
                    <tspan id="card-def" font-size="17px" fill="#000000" text-anchor="end" x="413px" y="605px"></tspan>
    
                    <!-- Card Effect -->
                    <tspan class="card-effect" font-size="8px" fill="#000000" text-anchor="start" x="32px" y="502px"></tspan>
    
                    <!-- Card Summoning Requirements -->
                    <tspan class="card-summoning" font-size="8px" fill="#000000" text-anchor="start" x="32px" y="502px">4 Level 4 monsters</tspan>
    
                    <!-- Card ID -->
                    <tspan class="card-id card-details" font-size="8px" fill="#000000" text-anchor="end" x="390px" y="476px"></tspan>
    
                    <!-- Card Serial Number -->
                    <tspan class="card-serial-number card-details" font-size="8px" fill="#000000" text-anchor="start" x="20px" y="629px"></tspan>
    
                    <!-- Card Copyright -->
                    <tspan class="card-copyright card-details" font-size="8px" fill="#000000" text-anchor="end" x="400px" y="629px"></tspan>
                    
                    <!-- 
                        Card Description
                    -->
                    <tspan class="card-info" font-size="8px" fill="#000000" text-anchor="start" style="display: none;">
                        This is a monster's description box.
                    </tspan>
    
                </text>
    
                <!-- Text Formats (PENDULUM FORMAT) -->
                <text class="unselectable pendulum" kerning="auto" fill="rgb(0, 0, 0)" font-size="8px">
    
                    <!-- PENDULUM scale left -->
                    <tspan class="pendulum-scale" id="scale-left" font-size="8px" fill="#000000" text-anchor="middle" x="44px" y="465px"></tspan>
    
                    <!-- PENDULUM scale right -->
                    <tspan class="pendulum-scale" id="scale-right" font-size="8px" fill="#000000" text-anchor="middle" x="400px" y="465px"></tspan>
    
                    <!-- Card Serial Number -->
                    <tspan class="pendulum-effect" font-size="8px" fill="#000000" text-anchor="start" x="67px" y="419px"></tspan>
    
                </text>
    
                <!-- Text Formats (LINK FORMAT) -->
                <!-- Card DEF -->  
                <text class="unselectable link" kerning="auto" fill="rgb(0, 0, 0)" font-size="8px">
                    
                    <tspan id="link-rating" font-size="17px" fill="#000000" text-anchor="end" x="405px" y="605px">5</tspan>
    
                </text>
    
                <!-- Card Status -->
                <image class="card-status" x="410px" y="612px" width="20px" height="20px" xlink:href="{{ asset('images/status-images/unlimited-edition-image.png') }}"/>
    
                <!-- Card Back Sleeve -->
                <image id="back-sleeve" x="0px" y="0px" width="443px" height="645px" xlink:href="{{ asset('images/card-templates/back-card-template.jpg') }}"/>
    
            </svg>

        </div>
    </nav>

</div>
@endsection