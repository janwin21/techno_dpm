@extends('layouts.app')

@section('content')
<!-- Main Image Header -->
<div class="card main-header">
    
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" style="z-index: 0;">
        <!-- Image Background Collections -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/pages-backgrounds/background-image-1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/pages-backgrounds/background-image-2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/pages-backgrounds/background-image-3.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/pages-backgrounds/background-image-4.png" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Card Ovelay (Header) -->
    <div class="card-img-overlay">
        <div class="darken-background">

            <!-- Main Header (Title) -->
            <div class="card-block">
                <h1 class="text-white">Deck Pro Master</h1>
                <h1 class="text-white">ONLINE CARD & DECK</h1>
                <h1 class="text-white">MANAGEMENT</h1>

                <p class="text-white">A web application that helps you to create your own card and manage deck with the combination of the existing cards and the cards you created. Read the <strong>DOCUMENTATION</strong> to know about <strong>Yi-Gi-Oh</strong> and this <strong>DECK PRO MASTER</strong>.</p>
                
                <button class="btn btn-primary" type="button"><a href="{{ route('yugioh-card-maker') }}" style="color: white; text-decoration: none;">Create a Card</a></button>
                <button class="btn btn-outline-light" type="button">Documentation</button>
            </div>

            <!-- Sub Header (Card Overview) -->
            <div class="side-block d-flex flex-column justify-content-start align-items-end sub-card-header">
                <!--
                    <h4 class="text-white">Abyss Actor - Curtain Raiser</h4>
                    <p class="text-white">
                        [Fiend / Pendulum / Effect]
                    </p>
                    <p class="text-white card-type"><span><strong>Type:</strong> <img src="../images/attributes-images/dark.png" alt="attribute-icon"> <strong>DARK</strong></span></p>
                    <img src="../images/sample-cards/abyss-actor-curtain-raiser.png" alt="card-overview" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <p class="text-white mt-2">Pricing: <strong>$2.20</strong></p>
                -->
            </div>

        </div>

    </div>

</div>

<div class="container-fluid violet-divider"></div>

<div class="container-fluid px-4 py-4 mb-0" id="hanging-icons">
    <div class="container">
        <div class="row g-4 pb-5 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div class="card d-flex bg-dark text-white">
                    <img src="../images/monster-images/number-c39-utopia-ray-v.png" class="card-img" alt="...">
                    <div class="d-flex flex-column justify-content-center align-items-center card-img-overlay">
                        <i class="fab fa-creative-commons-share"></i>
                        <h5 class="card-title mb-3">Create your own Cards</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="{{ route('yugioh-card-maker') }}"><button class="btn btn-primary mt-4">Go to Card Editor</button></a>
                    </div>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="card d-flex bg-dark text-white">
                    <img src="../images/monster-images/elemental-hero-absoute-zero.jpg" class="card-img" alt="...">
                    <div class="d-flex flex-column justify-content-center align-items-center card-img-overlay">
                        <i class="fas fa-inbox"></i>
                        <h5 class="card-title mb-3">Manage your own Deck</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a><button class="btn btn-primary mt-4 disabled" style="opacity: 1;">Deck builder</button></a>
                    </div>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="card d-flex bg-dark text-white">
                    <img src="../images/monster-images/infernoid-nehemoth.png" class="card-img" alt="...">
                    <div class="d-flex flex-column justify-content-center align-items-center card-img-overlay">
                        <i class="fas fa-users"></i>
                        <h5 class="card-title mb-3">Join to our Community</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="{{ route('home') }}"><button class="btn btn-primary mt-4">Go to Dashboard</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid random-market-title pb-4">
    <div class="container mt-0">         
        <!-- Generated Card Container -->
        <div class="card bg-dark">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="../images/non-monster-images/gold-sarcophagus.jpg" class="img-fluid" alt="description-img">
                    <div class="card-img-overlay show-description-img d-flex flex-column justify-content-start align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="name" data-value="Gold Sarcophagus">
                        <h5 class="text-white">Random Cards at the Market</h5>
                        <p class="card-text figure2 text-white"><small>Gold Sarcophagus</small></p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><small class="text-muted">This section will generate 6 random cards at the market per 8 seconds.</small></p>
                        <h5 class="card-title text-white">Destributing Random Cards</h5>
                        <p class="card-text text-white">Check a picked cards of your like These cards are currently available not only from different marketing website, but only in the real card market.</p>

                        <!-- Card in Market Display -->
                        <div class="container-fluid cards-display py-4">
                            <div class="container d-flex flex-row flex-wrap align-items-center justify-content-around">
                                <!-- Available 7 Cards only -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-fluid violet-divider"></div>

<!-- Search Section Component -->
<div class="search-container d-flex flex-row" style="z-index: 100;">

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
                            <img class="card-img" src="../images/monster-images/lucifer-darklord-of-the-morningstar.png" alt="search-bar-image">
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
                                    <button class="btn" type="button" data-value="dark"><img src="../images/attributes-images/dark.png" alt="image-attribute">&nbsp&nbspDark</button>
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
                            <img class="card-img" src="../images/monster-images/darkest-diabolos-lord-of-the-lair.png" alt="search-bar-image">
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
                                    <button class="btn" type="button" data-value="dark"><img src="../images/attributes-images/dark.png" alt="image-attribute">&nbsp&nbspDark</button>
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
                                    <button class="btn" type="button" data-value="dark"><img src="../images/attributes-images/dark.png" alt="image-attribute">&nbsp&nbspDark</button>
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
                            <img class="card-img" src="../images/non-monster-images/spell-power-mastery.png" alt="search-bar-image">
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
                                    <button class="btn" type="button" data-value="dark"><img src="../images/attributes-images/dark.png" alt="image-attribute">&nbsp&nbspDark</button>
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
                                    <button class="btn" type="button" data-value="dark"><img src="../images/attributes-images/dark.png" alt="image-attribute">&nbsp&nbspDark</button>
                                </div>
                            </div>
                        </div>

                    </a>

                    <a href="#" class="list-group-item list-group-item-action">
    
                        <!-- Card Component (LONG DETAILS) -->
                        <div class="card m-0">
                            <img class="card-img" src="../images/monster-images/true-king-of-all-calamities.jpg" alt="search-bar-image">
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
    <main class="search">
        <div class="container-fluid">

            <!-- Website Brief Description (inside the Main Search Component) -->
            <div class="container-fluid description-container row row-cols-1 row-md-cols-2">

                <!-- Left Description -->
                <div class="card col-9 mb-3 mt-3 first-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../images/monster-images/neo-blue-eyes-ultimate-dragon.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="name" data-value="Neo Blue-Eyes Ultimate Dragon">
                                <p class="card-text figure1 text-white"><small><i>Figure 1</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Neo Blue-Eyes Ultimate Dragon</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/supreme-black-luster-soldier.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="name" data-value="Black Luster Soldier - Super Soldier">
                                <p class="card-text figure1 text-white"><small><i>Figure 2</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Black Luster Soldier - Super Soldier</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/the-legendary-exodia-incarnate.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="name" data-value="The Legendary Exodia Incarnate">
                                <p class="card-text figure1 text-white"><small><i>Figure 3</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>The Legendary Exodia Incarnate</small></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">December 29, 2021 (Wednesday, 11:40 AM)</small></p>
                                <h5 class="card-title text-white">Deck Pro Master</h5>
                                <p class="card-text text-white">A web application aims to create interesting cards that can be share in the community. It can also inserted to your deck with the existing cards that distributed into the market. You can look and upload other's created card and even insert it to your own deck.</p>
                                <p class="card-text"><small class="text-muted"><a href="#">See the Community</a></small></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Description -->
                <div class="card col-3 mb-3 mt-3 second-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img src="../images/description-images/description-1.jpg" class="img-fluid" alt="description-img">
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">December 29, 2021 (Wednesday, 1:35 AM)</small></p>
                                <h5 class="card-title text-white">Yu-Gi-Oh Card Maker</h5>
                                <p class="card-text text-white">Create your <strong>OWN</strong> cards using our card editor. Share your owned card to the community (login is required). Learn the parts of the cards before proceeding to Card Editor.</p>
                                <p class="card-text"><small class="text-muted"><a href="#">Create you Own Card</a></small></p>
                            </div>
                        </div>
                    </div>
                </div>        

                <!-- Left Description -->
                <div class="card col-9 mb-3 mt-3 first-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../images/non-monster-images/card-destruction.webp" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-start align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="name" data-value="Card Destruction">
                                <h5 class="text-white">Create your Own Deck</h5>
                                <p class="card-text figure2 text-white" style="margin-top: 0;"><small>Card Destruction</small></p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">December 29, 2021 (Wednesday, 6:12 PM)</small></p>
                                <h5 class="card-title text-white">Deck Management</h5>
                                <p class="card-text text-white">Create your own deck together with exiting and your created cards. Login is required to manage your deck. You can publish the whole deck to the community.</p>
                                <p class="card-text"><small class="text-muted"><a href="#">Manage your Deck</a></small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left Description -->
                <div class="card col-9 mb-3 pb-2 first-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-6 img-container">
                            <img src="../images/monster-images/archlord-kristya.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="herald">
                                <p class="card-text figure1 text-white"><small><i>Herald Archetype (Light Type)</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Archlord Kristya</small></p>
                            </div>
                        </div>
                        <div class="col-md-6 img-container">
                            <img src="../images/monster-images/darklord-asmodeus.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="darklord">
                                <p class="card-text figure1 text-white"><small><i>Darklord Archetype (Dark Type)</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Darklord Asmodeus</small></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">Fairy Archetype Cards Pack</small></p>
                                <h5 class="card-title text-white">Light & Dark Booster Pack</h5>
                                <p class="card-text text-white">Fairy (天てん使し Tenshi "Angel") is a Type of monster often represented by beings such as sprites, angels, or in some occasions, anything that represents organic and mechanical beings of advanced extraterrestrial origin. They're primarily LIGHT, although there are also those of all six common Attributes.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left Description -->
                <div class="card col-9 mb-3 pb-2 first-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../images/monster-images/inzektor-exa-beetle.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="inzektor">
                                <p class="card-text figure1 text-white"><small><i>Inzektor Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Inzektor Exa-Beetle</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/neo-galaxy-eyes-photon-dragon.webp" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="photon">
                                <p class="card-text figure1 text-white"><small><i>Photon Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Neo Galaxy-Eyes Photon Dragon</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/evolsaur-solda.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="evolsaur">
                                <p class="card-text figure1 text-white"><small><i>Evolsaur Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Evolzar Solda</small></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">Basic Archetype Cards Pack</small></p>
                                <h5 class="card-title text-white">Order of Chaos Booster Pack</h5>
                                <p class="card-text text-white">Order of Chaos contains many cards from the Yu-Gi-Oh! ZEXAL anime, including cards used by Yuma Tsukumo, Astral, Reginald Kastle, Kite Tenjo, Lillybot, Kaze and Number 96. The TCG version of this set also includes cards used by Alexis Rhodes, Tetsu Trudge, Greiger and Elsworth.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Description -->
                <div class="card col-3 mb-3 second-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img src="../images/description-images/description-2-order-of-chaos.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">Order of Chaos</small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left Description -->
                <div class="card col-9 mb-3 pb-2 first-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../images/monster-images/peformapal-sky-magician.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="performapal">
                                <p class="card-text figure1 text-white"><small><i>Performapal Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Performapal Sky Magician</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/odd-eyes-pendulum-dragon.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="odd-eyes">
                                <p class="card-text figure1 text-white"><small><i>Odd-Eyes Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Odd-Eyes Pendulum Dragon</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/ddd-wave-king-caesar.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="d/d">
                                <p class="card-text figure1 text-white"><small><i>D/D Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>D/D/D Wave King Ceasar</small></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">Basic Archetype Cards Pack</small></p>
                                <h5 class="card-title text-white">Pendulum Era Booster Pack</h5>
                                <p class="card-text text-white">Pendulum Monster Cards are a new kind of card that blurs the line between Monsters and Spells! They can be Summoned as monsters to attack or defend, or you can activate them as Spell Cards in your Pendulum Zones to activate extra special abilities and allow you to Pendulum Summon.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Description -->
                <div class="card col-3 mb-3 second-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img src="../images/description-images/decriptin-3-master-of-pendulum.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">Master of Pendulum</small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Left Description -->
                <div class="card col-9 mb-3 pb-2 first-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../images/monster-images/raviel-lord-of-phantasms-shimmering-scrapper.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="sacred beast">
                                <p class="card-text figure1 text-white"><small><i>Sacred Beast Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Raviel, Lord of Phantasms - Shimmering Scraper</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/slifer-the-sky-dragon.png" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="egyptian god">
                                <p class="card-text figure1 text-white"><small><i>Egyptian God Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Slifer the Sky Dragon</small></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/monster-images/number-ic1000-numerounius-numerounia.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="archetype" data-value="numeron">
                                <p class="card-text figure1 text-white"><small><i>Numeron Archetype</i></p></small></p>
                                <p class="card-text figure2 text-white"><small>Number iC1000: Numerounius Numerounia</small></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">Legendary Archetype Cards Pack</small></p>
                                <h5 class="card-title text-white">Supreme Ruler Booster Pack</h5>
                                <p class="card-text text-white">Pendulum Monster Cards are a new kind of card that blurs the line between Monsters and Spells! They can be Summoned as monsters to attack or defend, or you can activate them as Spell Cards in your Pendulum Zones to activate extra special abilities and allow you to Pendulum Summon.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Description -->
                <div class="card col-3 mb-3 second-description bg-dark">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img src="../images/description-images/description-4-monster-box.jpg" class="img-fluid" alt="description-img">
                            <div class="card-img-overlay show-description-img d-flex flex-column justify-content-end align-items-start">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted">Monster Box</small></p>
                                <h5 class="card-title text-white">Legendary Collection</h5>
                                <p class="card-text text-white">Legendary Collection is a TCG collector's set, and the first set in the Legendary Collection series.</p>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

            <div class="container-fluid box-divider mt-4"></div>

            <!-- Search Title -->
            <section class="search-title pt-5 pd-3 text-center container bg-dark">
                <div class="row py-lg-2 title-container">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light" style="font-size: 2.5em !important; color: white;">Card Library</h1>
                        <p class="lead text-muted">Navigate all the existing cards that distributed in the market. This cards exist around the world and most of them are available at the market (card, toy, or collectables markets). Fell free to roam.</p>
                        <p>
                            <a href="#!" class="btn btn-primary my-2 search-btn">Search a Card</a>
                            <a href="#" class="btn btn-secondary my-2">Go at the Top</a>
                        </p>
                    </div>
                </div>
            </section>

            <!-- Searched Queue (Category) -->
            <div class="category-container alert alert-dark d-flex flex-row flex-wrap justify-content-start align-items-center" role="alert">
                <div class="alert alert-info category p-0" role="alert">
                    <strong style="text-align: center; margin-left: 4px;">Category 1</strong>
                    <button type="button" style="display: none;"><i class="fas fa-times"></i></button>
                </div>
            </div>
        
            <!-- Card Collection Component -->
            <div class="album py-5 card-collection d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row row-cols-1 row-sm-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">

                        <!-- Card Details Component -->
                        <div class="col mb-4" style="display: none;">
                            <div class="card bg-dark text-white">
                                <img src="../images/sample-cards/stellarknight-zefraxciton.png" class="card-img" alt="card-collection">
                                <div class="card-img-overlay">
                                    <h5 class="card-title">Stellarknight Zefraxciton&nbsp;<img src="../images/attributes-images/light.png" alt="attribute"></h5>
                                    <p class="card-text" data-id="" data-description="">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="pricing">
                                        <small class="text-muted">Website Price</small>
                                        <small class="text-muted">Pricing: <strong>$1.78</strong></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <button type="button" class="btn btn-primary load-more-btn" style="width: 25%;">Load More...</button>
            </div>

        </div>
    </main>

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
                    <img class="modal-card-image" src="../images/sample-cards/stellarknight-zefraxciton.png" alt="card-image">
                    <h6>Stellarknight Zefraxciton</h6>
                    <p><strong>Attribute:</strong> <strong>Dark</strong>&nbsp;<img src="../images/attributes-images/light.png" alt="attribute"></p>
                    <p><strong>Star:</strong> 1 <img src="../images/star-images/level.png" alt="level"> / 1 <img src="../images/star-images/rank.png" alt="level"> / <strong>LINK</strong>-1</p>
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

<!-- Qoutes Section Component -->
<div class="qoutes">
    <div class="container">
    
        <!-- Three columns of qoute details -->
        <div class="row p-3">

            <div class="qoute-title">
                <h3 style="color: black;">One of the Best Qoutes</h3>
            </div>

            <div class="col-lg-4 mt-5">
                <img class="character-img" src="../images/character-images/yugi.jpg" alt="character-image">
                <h4 class="mt-3">Yugi Yami</h4>
                <p>"If you can't understand the darkness in your opponent's heart, you will never comprehend the pain and suffering of the others."</p>
                <button class="btn btn-dark mb-3 qoutes-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-value="dark magician" data-parameter="archetype">Dark Magician Deck</button>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4 mt-5 waiting-remove">
                <img src="../images/character-images/kaiba.jpg" alt="character-image">
                <h4 class="mt-3">Seto Kaiba</h4>
                <p>"The future is unlimited and the past is but a trace of memory."</p>
                <button class="btn btn-dark mb-3 qoutes-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-value="blue-eyes" data-parameter="archetype">Blue-Eyes Deck</button>
            </div><!-- /.col-lg-4 -->

            <div class="col-lg-4 mt-5 waiting-remove">
                <img src="../images/character-images/atlas.jpg" alt="character-image">
                <h4 class="mt-3">Jack Atlas</h4>
                <p>"Giving up everything has made me finally realize...there was something in the depths of my heart holding me up..."</p>
                <button class="btn btn-dark mb-3 qoutes-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-value="archfiend" data-parameter="archetype">Archfiend Deck</button>
            </div><!-- /.col-lg-4 -->

        </div><!-- /.row -->

    </div>
</div>

<!-- Footer -->
<footer class="page-footer font-small blue">
    
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2022 Copyright:
        <a href="{{ url('/') }}"> DeckProMaster.com</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
@endsection