@extends('layouts.app')

@section('content')
<!-- Search Section Component -->
<div class="search-container d-flex flex-row" style="z-index: 100;">

    <var data-read="{{ url('card-image/read') }}" id="read" style="display: none;"></var>
    <var data-src="{{ url('deck/update') }}" id="url" style="display: none;"></var>
    <var data-id="{{ $deck->deck_id }}" id="var" style="display: none;"></var>
    <var data-main="{{ $deck->main_deck }}" id="main" style="display: none;"></var>
    <var data-extra="{{ $deck->extra_deck }}" id="extra" style="display: none;"></var>
    <var data-side="{{ $deck->side_deck }}" id="side" style="display: none;"></var>

    <!-- Search Side Bar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark side-bar" style="width: 280px;">
        <div class="container-fluid bg-dark sticky-top" id="sidebar-wrapper">
            <a href="..." class="d-flex align-items-center text-white text-decoration-none">
                <span class="fs-6 mt-3 mb-3 text-white"><i class="fas fa-search"></i> Search Card</span>
            </a>
            <form action="" method="GET">
                <div class="list-group">
                    
                    <a href="#" class="list-group-item list-group-item-action">
    
                        <!-- Card Component (PRIMARY DETAILS) -->
                        <div class="card m-0">
                            <img class="card-img" src="{{ asset('images/monster-images/lucifer-darklord-of-the-morningstar.png') }}" alt="search-bar-image">
                            <div class="card-img-overlay overlay-dark text-white">
                                <div class="darken-background">
                                    <p><i class="fab fa-product-hunt"></i>&nbsp;&nbsp;Primary Detail</p>
                                </div>
                                <p class="card-description">All the primary search from the upper parts of the cards are here. All the inputs here are case-insensitive.</p>
                            </div>
                        </div>
                            
                        <!-- Primary Search Form Component -->
                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Name</label>
                            <input type="text" class="form-control shadow-none mt-1 mb-2" id="formGroupExampleInput" placeholder="e.g. Dark Magician" value="" data-parameter="name">
                        </div>

                        <!-- Attribute Accordion Form Component -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Monster Attributes
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <input type="text" class="form-control shadow-none mt-1 mb-2" value="" data-parameter="attribute">

                                    <!-- Attribute Buttons -->
                                    <button class="btn" type="button" data-value="dark"><img src="{{ asset('images/attributes-images/dark.png') }}" alt="image-attribute">&nbsp&nbspDark</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-1 mb-0">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-white" scope="col">Stars</th>
                                        <th class="text-white" scope="col">Input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><label class="star" for="level">Level</label></td>
                                        <td><input type="number" class="star-input form-control shadow-none mt-1 mb-2" id="level" min="1" max="12" style="width: 100%;" value="" data-parameter="level"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="star" for="rank">Rank</label></td>
                                        <td><input type="number" class="star-input form-control shadow-none mt-1 mb-2" id="rank" min="1" max="13" style="width: 100%;" value="" data-parameter="level"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="star" for="link-rating">Link Rating</label></td>
                                        <td><input type="number" class="star-input form-control shadow-none mt-1 mb-2" id="link-rating" min="1" max="8" style="width: 100%;" value="" data-parameter="link"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
    
                    </a>
                    
                    <a href="#" class="list-group-item list-group-item-action">
    
                        <!-- Card Component (SECONDARY DETAILS) -->
                        <div class="card m-0">
                            <img class="card-img" src="{{ asset('images/monster-images/darkest-diabolos-lord-of-the-lair.png') }}" alt="search-bar-image">
                            <div class="card-img-overlay overlay-dark text-white">
                                <div class="darken-background">
                                    <p><i class="fab fa-staylinked"></i>&nbsp;&nbsp;Secondary Detail</p>
                                </div>
                                <p class="card-description">Search the lower parts. This section is for Monster Cards only. (Except for Archetype)</p>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Archetype</label>
                            <input type="text" class="form-control shadow-none mt-1 mb-2 monster" id="formGroupExampleInput" placeholder="e.g. Blue-Eyes" value="" data-parameter="archetype">
                        </div>
                        
                        <!-- Types Accordion Form Component -->
                        <div class="accordion accordion-flush" id="accordionFlushExample1">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Monster Types
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample1">
                                    <input type="text" class="form-control shadow-none mt-1 mb-2" value="" data-parameter="type">

                                    <!-- Attribute Buttons -->
                                    <button class="btn" type="button" data-value="dark"><img src="{{ asset('images/attributes-images/dark.png') }}" alt="image-attribute">&nbsp&nbspDark</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Races Accordion Form Component -->
                        <div class="accordion accordion-flush" id="accordionFlushExample2">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Monster Races
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample2">
                                    <input type="text" class="form-control shadow-none mt-1 mb-2" value="" data-parameter="race">

                                    <!-- Attribute Buttons -->
                                    <button class="btn" type="button" data-value="dark"><img src="{{ asset('images/attributes-images/dark.png') }}" alt="image-attribute">&nbsp&nbspDark</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-1 mb-0">
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-white" scope="col">Name</th>
                                        <th class="text-white" scope="col">Input</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><label class="star" for="ATK">ATK</label></td>
                                        <td><input type="number" class="form-control shadow-none mt-1 mb-2" id="ATK" min="0" style="width: 100%;" value="" data-parameter="atk"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="star" for="DEF">DEF</label></td>
                                        <td><input type="number" class="form-control shadow-none mt-1 mb-2" id="DEF" min="0" style="width: 100%;" value="" data-parameter="def"></td>
                                    </tr>
                                    <tr>
                                        <td><label class="star" for="scale">Scale</label></td>
                                        <td><input type="number" class="form-control shadow-none mt-1 mb-2" id="scale" min="0" max="12" style="width: 100%;" value="" data-parameter="scale"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
    
                    </a>

                    <a href="#" class="list-group-item list-group-item-action">
    
                        <!-- Card Component (NON MONSTER DETAILS) -->
                        <div class="card m-0">
                            <img class="card-img" src="{{ asset('images/non-monster-images/spell-power-mastery.png') }}" alt="search-bar-image">
                            <div class="card-img-overlay overlay-dark text-white">
                                <div class="darken-background">
                                    <p><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Spell / Trap Detail</p>
                                </div>
                                <p class="card-description">This is a Spell, Trap, and Skill Card section. (Remove first all the details from the Monster section first for a preise search)</p>
                            </div>
                        </div>
                        
                        <!-- Types Accordion Form Component (NON-MONSTER) -->
                        <div class="accordion accordion-flush mt-3" id="accordionFlushExample2">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    Card Types
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample2">
                                    <input type="text" class="form-control shadow-none mt-1 mb-2" value="" data-parameter="type">

                                    <!-- Attribute Buttons -->
                                    <button class="btn" type="button" data-value="dark"><img src="{{ asset('images/attributes-images/dark.png') }}" alt="image-attribute">&nbsp&nbspDark</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Races Accordion Form Component (NON-MONSTER) -->
                        <div class="accordion accordion-flush mb-2" id="accordionFlushExample3">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    Card Races
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample3">
                                    <input type="text" class="form-control shadow-none mt-1 mb-2" value="" data-parameter="race">

                                    <!-- Attribute Buttons -->
                                    <button class="btn" type="button" data-value="dark"><img src="{{ asset('images/attributes-images/dark.png') }}" alt="image-attribute">&nbsp&nbspDark</button>
                                </div>
                            </div>
                        </div>

                    </a>

                    <a href="#" class="list-group-item list-group-item-action">
    
                        <!-- Card Component (LONG DETAILS) -->
                        <div class="card m-0">
                            <img class="card-img" src="{{ asset('images/monster-images/true-king-of-all-calamities.jpg') }}" alt="search-bar-image">
                            <div class="card-img-overlay overlay-dark text-white">
                                <div class="darken-background">
                                    <p><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Long Detail</p>
                                </div>
                                <p class="card-description">All the detailed search from the lower parts of the cards are here. Make a precise search.</p>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Card ID</label>
                            <input type="number" class="form-control shadow-none mt-1 mb-2" id="formGroupExampleInput" placeholder="ID Number" value="" data-parameter="id">
                        </div>

                        <div class="form-group mt-3">
                            <label for="formGroupExampleInput">Description</label>
                            <textarea class="form-control shadow-none mt-1 mb-2" id="formGroupExampleInput" placeholder="A precise card description..." data-parameter="description"></textarea>
                        </div>

                    </a>

                    <button class="btn btn-primary mb-5 search-btn" type="submit">Search</button>

                </div>
            </form>
        </div>
    </div>

    <!-- Search Main Component -->
    <main class="search existing">
        <div class="container-fluid">

            <!-- CARDS COLLECTION SECTION -->
            <div class="container-fluid description-container row row-cols-1 row-md-cols-2">

                <div class="deck-alert alert alert-danger mb-0" role="alert" style="display: none;">
                    <p>A simple danger alert—check it out!</p>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>

                <!-- Existing Cards Collection -->
                <div class="container mt-3 existing-btn">
                    <button class="btn btn-success btn-label disabled">Existing Cards</button>
                </div>

                <!-- Searched Queue (Category) -->
                <div class="category-collection alert alert-dark d-flex flex-row flex-wrap justify-content-start align-items-start" role="alert">
                    <div class="alert alert-info category p-0" role="alert">
                        <strong style="text-align: center; margin-left: 4px;">Category 1</strong>
                        <button type="button" style="display: none;"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="existing-deck container mt-3">
                    <ul class="cards-collection d-flex flex-row flex-wrap justify-content-start align-items-center">
                        <li class="draggable-img copyrighted-card" data-contained="collection" data-system="" data-id="" data-type="" data-src=""><img src="{{ asset('images/sample-cards/exploder-dragon-wing.png') }}" alt="cards-collection"></li>
                    </ul>
                </div>

                <!-- Owned Cards Collection -->
                <div class="container mt-3 existing-btn">
                    <button class="btn btn-primary load-more-btn">Load More...</button>
                    <button class="btn btn-success btn-label disabled">Your Cards</button>
                </div>

                <div class="existing-deck container mt-3">
                    <ul class="cards-collection d-flex flex-row flex-wrap justify-content-start align-items-center owned-cards-container">
                        @foreach (Auth::user()->card_images as $card_image)
                            <li 
                                class="draggable-img owned-cards" 
                                data-contained="collection" 
                                data-system="<DPM>" 
                                data-id="{{ $card_image->card_image_main_id }}" 
                                data-type="" 
                                data-src="{{ asset('images/user/' . Auth::user()->id . '/album/' . $card_image->card_image) }}" 
                                data-source="{{ url('card-image/read/' . $card_image->card_image_main_id) }}" 
                                data-img="{{ asset('images/user/' . Auth::user()->id . '/album/' . $card_image->card_image) }}">
                                    <img src="{{ asset('images/user/' . Auth::user()->id . '/album/' . $card_image->card_image) }}" alt="cards-collection" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></li>
                        @endforeach  
                    </ul>
                </div>
                
            </div>        

        </div>
    </main>

    <!-- DECK SECTTION -->
    <nav class="col-5 bg-dark">
        <div class="position-fixed existing existing-nav owned-side-deck" id="sidebar-wrapper" style="width: 40.5%;">

            <!-- Main Deck Section -->
            <div class="container mt-3 existing-btn">
                <button class="btn btn-primary btn-disable btn-label disabled">Main Deck</button>
                <button class="btn btn-secondary btn-label save-box float-end"><a href="{{ url('home') }}" style="color: white; text-decoration: none; margin: 0; padding: 0;">Back</a></button>
                <button class="btn btn-success btn-label save-box float-end">Save</button>
                <button class="btn btn-danger btn-label disabled delete-box float-end">Delete Card</button><br>
                <input class="deck-name" type="text" placeholder="e.g. <Deck> Name" value="{{ $deck->deck_name }}">
            </div>

            <div class="existing-deck container mt-3 dropbox update-box main-deck-container" data-type="main">
                <ul class="d-flex flex-row flex-wrap justify-content-start align-items-center" style="margin-left: 1rem !important;">
                    <!--<li class="draggable-img" data-contained="main"><img src="../images/sample-cards/slifer-the-sky-dragon.png" alt="cards-collection"></li>-->
                </ul>
            </div>

            <!-- Extra Deck Section -->
            <div class="container mt-3 existing-btn">
                <button class="btn btn-primary btn-disable btn-label disabled">Extra Deck</button>
            </div>

            <div class="existing-deck container mt-3 dropbox update-box extra-deck-container" data-type="extra">
                <ul class="d-flex flex-row flex-wrap justify-content-start align-items-center" style="margin-left: 1rem !important;">
                    <!--<li class="draggable-img" data-contained="extra"><img src="../images/sample-cards/dark-magician-of-chaos.png" alt="cards-collection"></li>-->
                </ul>
            </div>

            <!-- Side Deck Section -->
            <div class="container mt-3 existing-btn">
                <button class="btn btn-primary btn-disable btn-label disabled">Side Deck</button>
            </div>

            <div class="existing-deck container mt-3 dropbox update-box side-deck-container" data-type="side">
                <ul class="d-flex flex-row flex-wrap justify-content-start align-items-center" style="margin-left: 1rem !important;">
                    <!--<li class="draggable-img" data-contained="side"><img src="../images/sample-cards/abyss-actor-curtain-raiser.png" alt="cards-collection"></li>-->
                </ul>
            </div>

            <!-- ADD SPACE -->
            <div class="container mt-3 space-btn"></div>

        </div>
    </nav>

</div>

<!-- Card Details Modal Component -->
<div class="modal fade card-modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border: none; border-radius: 0;">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Name of the Set Deck</h5>
                <button type="button" class="btn-close card-modal-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid mb-3 modal-box">
                    <img class="modal-card-image" src="{{ asset('images/sample-cards/stellarknight-zefraxciton.png') }}" alt="card-image">
                    <h6>Stellarknight Zefraxciton</h6>
                    <p><strong>Attribute:</strong> <strong>Dark</strong>&nbsp;<img src="{{ asset('images/attributes-images/light.png') }}" alt="attribute"></p>
                    <p><strong>Star:</strong> 1 <img src="{{ asset('images/star-images/level.png') }}" alt="level"> / 1 <img src="{{ asset('images/star-images/rank.png') }}" alt="level"> / <strong>LINK</strong>-1</p>
                    <p><strong>Type:</strong> Pedulum Effect Monster</p>
                    <p><strong>Race:</strong> Fiend</p>
                    <p><strong>ATK / DEF:</strong> 1900 / 0</p>
                    <div class="market-price">
                        <p>Market Name: <strong>$2.28</strong></p>
                    </div>
                    <p><strong>Card Description:</strong></p>
                    <p>[Pendulum Effect] You cannot Pendulum Summon monsters, except "tellarknight" and "Zefra" monsters. This effect cannot be negated.
                        [Monster Effect] If this card is Normal, Flip, or Pendulum Summoned: You can target 1 other "tellarknight" or "Zefra" card in your Monster Zone or Pendulum Zone, and 1 Set card your opponent controls; destroy them. You can only use this effect of "Stellarknight Zefraxciton" once per turn.
                    </p>
                    <hr>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary card-modal-close-btn" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
@endsection