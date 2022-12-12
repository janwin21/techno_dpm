@extends('layouts.app')

@section('content')
<!-- Card Editor Section Component -->
<div class="search-container d-flex flex-row" style="z-index: 100;">

    <!-- Card Editor Side Bar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark side-bar" style="width: 280px;">
        <div class="container-fluid bg-dark sticky-top pb-3" id="sidebar-wrapper">
            <a href="#!" class="d-flex align-items-center text-white text-decoration-none">
                <span class="fs-6 mt-3 mb-3 text-white"><i class="fab fa-guilded"></i> Side Builder</span>
            </a>

            <div class="list-group">
                
                <a href="#!" class="list-group-item list-group-item-action" style="cursor: default;">

                    <!-- Card Component (CARD MAKER DETAILS) -->
                    <div class="card mb-5" style="cursor: default;">
                        <img class="card-img" src="{{ asset('images/monster-images/road-warrior.jpg') }}" alt="search-bar-image" style="cursor: default;">
                        <div class="card-img-overlay overlay-dark text-white card-button" data-toggle="setter-input" style="cursor: default;">
                            <div class="darken-background">
                                <p><i class="fas fa-inbox"></i>&nbsp;&nbsp;YuGiOh Deck Builder</p>
                            </div>
                            <p class="card-description">Create your own Card. You can publish it or put it to your deck.</p>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="formGroupExampleInput">Deck Name</label>
                        <form action="{{ url('deck/create/') . '/' . Auth::user()->id }}" method="POST">
                            {{ method_field('GET') }}
                            @csrf

                            <input type="text" class="form-control shadow-none mt-1 mb-2 monster" id="formGroupExampleInput" name="deck_name" placeholder="e.g. Starter Deck" value="" data-parameter="archetype">
                            <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 0.5rem;">Create</button>
                        </form>
                    </div>

                </a>
                
                <a href="{{ route('yugioh-card-maker') }}" class="list-group-item list-group-item-action">

                    <!-- Card Component (CARD MAKER DETAILS) -->
                    <div class="card mb-5">
                        <img class="card-img" src="{{ asset('images/monster-images/dark-strike-fighter.png') }}" alt="search-bar-image">
                        <div class="card-img-overlay overlay-dark text-white card-button" data-toggle="setter-input">
                            <div class="darken-background">
                                <p><i class="fas fa-mask"></i>&nbsp;&nbsp;YuGiOh Card Maker</p>
                            </div>
                            <p class="card-description">Build your own deck with existing and owned card.</p>
                        </div>
                    </div>

                </a>

            </div>
        </div>
    </div>

    <!-- Dashboard Component -->
    <main class="search">
        <div class="container-fluid dashboard row row-cols-1 row-md-cols-2">

            <div class="container left col-9">
                <div class="title bg-dark">
                    <div class="card card-title-dashboard bg-dark text-white">
                        <img src="{{ asset('images/monster-images/number-c69-heraldry-crest-of-horror.png') }}" class="card-img" alt="...">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <p>Welcome {{ Auth::user()->name }} to</p>
                            <h2 class="card-title">Deck Pro Master</h2>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                    <h4>Dashboard</h4>
                    <p>All you data privacy are secured, you have a right to choose to share or private all your owned cards and decks. You can also navigate all other's shared cards and decks for more ideas. Please be aware of what you act inside the community.</p>
                </div>
                <div class="jumbotron bg-dark" id="deck-collection">
                    <h4>Deck Collection</h4>
                    <p>The Main Deck (Japanese: メインのデッキ Mein no Dekki), usually simply referred to as the <strong>Deck (デッキ Dekki)</strong>, is a pile of cards that a Duelist can draw from. Each Duelist uses their own Main Deck in a Duel.</p>
                    <hr>
                    <p>There are built-in deck that compiled by our website. You can modify it and share it the community. Default Deck: <strong>Qliphort</strong>, <strong>Infernoid</strong>, & <strong>Cyber</strong> Deck</p>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">ID</th>
                                <th scope="col">Deck Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->decks as $deck)
                                <tr>
                                    <th scope="row">{{ $data['deck_counter']++ }}</th>
                                    <td>{{ $deck->deck_id }}</td>
                                    <td class="d-flex flex-row flex-row justify-content-between align-items-center">
                                        {{ $deck->deck_name }}
                                        <div class="d-flex flex-row flex-row justify-content-end align-items-center">
                                            <button type="button" class="btn btn-primary"><a href="{{ url('deck/read') . '/' . $deck->deck_id }}">Edit</a></button>
                                            <button type="button" class="btn btn-danger"><a href="{{ url('deck/delete') . '/' . $deck->deck_id }}">Delete</a></button>
                                            <button type="button" class="btn btn-success"><a href="{{ url('deck_chart') . '/' . $deck->deck_id }}">Stats</a></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="jumbotron bg-dark mt-3 mb-3" id="card-collection">
                    <h4>Card Data Collection</h4>
                    <p>
                        A card type (with a lowercase "t") refers to the three main types of cards: <strong>Monster</strong>, <strong>Spell</strong>, & <strong>Trap</strong>.
                        <br><br>
                        The term is distinct from monster Types (with a capital "T"). Cards that check card types, such as "Ordeal of a Traveler", usually specify "Monster, Spell, or Trap" in parentheses to avoid confusion.</p>
                    <hr>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">ID</th>
                                <th scope="col">Card Name <button type="button" class="btn btn-secondary" style="float: right; padding: 0.25rem 0.5rem;"><a href="{{ url('card_pdf') }}">Convert to PDF</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->cards as $card)
                                <tr>
                                    <th scope="row">{{ $data['card_counter']++ }}</th>
                                    <td>{{ $card->card_main_id }}</td>
                                    <td class="d-flex flex-row flex-row justify-content-between align-items-center">
                                        {{ $card->card_name }}
                                        <div class="d-flex flex-row flex-row justify-content-end align-items-center">
                                            <button type="button" class="btn btn-primary"><a href="{{ url('yugioh-card-maker/' . Auth::user()->id . '/' . $card->card_main_id) }}">Edit</a></button>
                                            <button type="button" class="btn btn-danger"><a href="{{ url('card/delete/' . $card->card_main_id . '/' . Auth::user()->id . '/' . $card->card_image) }}">Delete</a></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="jumbotron bg-dark mt-3 mb-3" id="card-collection">
                    <h4>Cards Album</h4>
                    <p>This is a collection of photos (image of cards) that used in the actual management of the Deck. Nothing else will exist exludes all the photos here and the existing cards from your Deck Builder. Click the <strong>Upload Card Image</strong> at the right side of your screen to add cards from your album.</p>
                    <hr>
                    <p>
                        <strong>Take Note: </strong>Set an <strong>ID</strong> at the right side before uploading the image (column <strong>ID</strong> can be found at <strong>Card Data Collection</strong>). This will give you some information effect once you click the uploaded image.
                    </p>
                    <div class="card-album-container row row-cols-1 row-sm-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5">
                        <!-- Card Details Component -->
                        @foreach (Auth::user()->card_images as $card_image)
                            <!------------------------------------------------------------------->
                            <div class="col mb-4 card-album-box" data-source="{{ url('card-image/read/' . $card_image->card_image_main_id) }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-img="{{ asset('images/user/' . Auth::user()->id . '/album/' . $card_image->card_image) }}" style="cursor: pointer;">
                                <div class="card bg-dark text-white">
                                    <img src="{{ asset('images/user/' . Auth::user()->id . '/album/' . $card_image->card_image) }}" class="card-img" alt="card-collection">
                                </div>
                                <button class="btn btn-danger" style="width: 100%; border-radius: 0; padding: 0; display: none;"><a style="text-decoration: none; color: white;" href="{{ url('card-image/delete/' . $card_image->card_image_id . '/' . Auth::user()->id . '/' . $card_image->card_image) }}">Delete</a></button>
                            </div>
                            <!------------------------------------------------------------------->
                        @endforeach
                    </div>
                </div>

                <div class="jumbotron bg-dark mt-3" id="card-collection"></div>
            </div>

            <div class="container right col-3 p-0">
                <div class="card m-0 bg-dark mb-3 profile-box">
                    <div class="card-body">
                        <h5 class="card-title">{{ Auth::user()->email }}</h5>
                        <p class="card-text"><small>Click the button below to navigate the Dashboard at the top.</small></p>
                        <a href="#" class="btn btn-primary at-the-top" style="width: 100%;">Go at the top</a>
                        <button type="button" class="btn btn-success upload-btn" style="width: 100%; border-radius: 0;">Upload Card Image</button>
                        <form action="{{ url('card-image/create/' . Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            {{ method_field('GET') }}
                            @csrf
                            <input type="file" class="card-input" name="card_image" style="display: none;">
                            <button type="submit" class="submit-btn" style="display: none;">submit</button>
                            <input type="text" class="bg-dark" name="card_main_id" placeholder="Place ID Here..." style="width: 100%; border-radius: 0; border: none;" required>
                        </form>
                    </div>
                </div>
                <div class="card m-0 bg-dark mb-3" id="card-side" style="display: none" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-parameter="id" data-value="">
                    <div class="card-body">
                        <h5 class="card-title" id="card-side-name">Black Rose Dragon</h5>
                        <p class="card-text" id="card-side-description"><small>Some quick example text to build on the card title and make up the bulk of the card's content.</small></p>
                    </div>
                </div>
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
@endsection
