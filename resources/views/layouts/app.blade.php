<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tab Icon --><link rel="icon" type="image/png" href="{{ asset('images/attributes-images/dark.png') }}">
    <!-- Tab Icon Compatilibity --><link rel="shortcut icon" type="image/png" href="{{ asset('images/attributes-images/dark.png') }}">
    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- 'Roboto', sans-serif -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!-- 'Roboto Slab', serif -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <!-- 'Ubuntu', sans-serif -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <!-- 'Nunito', sans-serif -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <!-- 'Aleo', serif -->
    <link href="https://fonts.googleapis.com/css2?family=Aleo:wght@700&display=swap" rel="stylesheet">
    <!-- 'Orbitron', sans-serif -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <!-- 'Oswald', sans-serif -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <!-- LARAVEL DEFAULT FONTS -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js" integrity="sha512-u9akINsQsAkG9xjc1cnGF4zw5TFDwkxuc9vUp5dltDWYCSmyd0meygbvgXrlc/z7/o4a19Fb5V0OUE58J7dcyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- JS Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script><!-- ALL PAGES -->
    <script src="{{ asset('js/variable.js') }}"></script><!-- ALL PAGES -->
    <script src="{{ asset('js/tasks.js') }}"></script><!-- ALL PAGES -->
    <script src="{{ asset('js/component.js') }}"></script><!-- ALL PAGES -->

    @if (str_contains(Request::route()->getName(), 'main') || str_contains(Request::route()->getName(), 'home'))
        <script src="{{ asset('js/timer.js') }}"></script><!-- Applicable only to HOME & DASHBOARD page -->
    @endif

    @if (str_contains(Request::route()->getName(), 'main'))
        <script src="{{ asset('js/main.js') }}"></script><!-- Applicable only to HOME page -->
    @elseif (str_contains(Request::route()->getName(), 'home'))
        <script src="{{ asset('js/dashboard.js') }}"></script><!-- Applicable only to Dashboard Page -->
    @elseif (
        str_contains(Request::route()->getName(), 'yugioh-card-maker') ||
        str_contains(Request::route()->getName(), 'yugioh-card-maker-user')
    )
        <script src="{{ asset('js/dom.js') }}"></script><!-- Applicable only to Card Editor Page -->
        <script src="{{ asset('js/card.js') }}"></script><!-- Applicable only to Card Editor Page -->
    @elseif (
        str_contains(Request::route()->getName(), 'deck-reader') ||
        str_contains(Request::route()->getName(), 'deck-builder')
    )
        <script src="{{ asset('js/deck.js') }}"></script><!-- Applicable only for Deck Management Page -->
        <!-- JQUERY UI -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endif

    <!-- CSS Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"><!-- FOR AUTHENTICATION ONLY -->
</head>
<body>

    <!-- Navigation Component (Main) -->
    <header class="p-2 text-white navigation sticky-top">
        <div class="container">
            <div class="d-flex flex-wrap align-items-start justify-content-between justify-content-lg-between">

                <!-- Navigation List (LEFT) -->
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-start mb-md-0 w-75">
                    
                    <!-- Image Icon -->
                    <li class="title unselectable">
                        <img src="{{ asset('images/page-icons/dmp-icon.png') }}" alt="main-icon">
                        <a class="text-white" href="{{ url('/') }}" style="text-decoration: none">{{ config('app.name', 'Laravel') }}</a>
                    </li>
                    <li><a href="{{ url('/') }}" class="nav-link px-2 text-white {{ str_contains(Request::route()->getName(), 'main') ? 'active' : '' }}">Home</a></li>
                    <li><a href="#" class="nav-link px-2 text-white bar-img-content">
                        Documentation

                        <!-- Card Component (DOCUMENTATION) -->
                        <div class="card m-0" style="left: 0;display: none;">
                            <img class="card-img" src="{{ asset('images/monster-images/arcana-force-x-the-light-ruler.jpg') }}" alt="menu-image">
                            <div class="card-img-overlay overlay-dark text-white">
                                <div class="darken-background">
                                    <p>&#9750; Documentation</p>
                                </div>
                                <p class="card-description">An important materials you need to know to adopt in the World of YUGIOH.</p>
                            </div>
                        </div>

                    </a></li>
                    
                    <!-- Dropdown Component -->
                    <li>
                        <div class="dropdown">
                            <div class="btn text-white dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Station
                            </div>
                            <ul class="dropdown-menu dropdown-menu-dark w-100" aria-labelledby="dropdownMenuButton2">
                                <a class="dropdown-item" href="{{ route('yugioh-card-maker') }}">Make a Card</a>
                                <hr class="dropdown-divider">
                                <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                            </ul>
                        </div>
                    </li>

                    <li><a href="#" class="nav-link px-2 text-white">About</a></li>

                </ul>
        
                <!-- Navigation List (RIGHT) -->
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 d-flex flex-row justify-content-end mb-md-0 w-25">

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="nav-link px-2 text-white bar-img-content {{ str_contains(Request::url(), 'login') ? 'active' : '' }}">
                                {{ __('Login') }}

                                <!-- Card Component (LOGIN) -->
                                <div class="card m-0" style="right: 0;display: none;">
                                    <img class="card-img" src="{{ asset('images/non-monster-images/spacegate.png') }}" alt="menu-image">
                                    <div class="card-img-overlay overlay-dark text-white">
                                        <div class="darken-background">
                                            <p>&#9734; Log-in</p>
                                        </div>
                                        <p class="card-description">Save your newly created Card and Manage your Deck with the existing Cards and your Cards.</p>
                                    </div>
                                </div>
                            </a></li>
                        @endif

                        @if (Route::has('register'))
                            <li style="margin-right: -4.5rem;"><a href="{{ route('register') }}" class="nav-link px-2 text-white bar-img-content {{ str_contains(Request::url(), 'register') ? 'active' : '' }}">
                                {{ __('Register') }}

                                <!-- Card Component (REGISTER) -->
                                <div class="card m-0" style="right: 0;display: none;">
                                    <img class="card-img" src="{{ asset('images/non-monster-images/magical-gate-of-miracles.png') }}" alt="menu-image">
                                    <div class="card-img-overlay overlay-dark text-white">
                                        <div class="darken-background">
                                            <p>&#9733; Register</p>
                                        </div>
                                        <p class="card-description">Join our Community. Publish your Cards or Deck and see what the Community talks about it.</p>
                                    </div>
                                </div>
                            </a></li>
                        @endif
                    @else

                        @if (
                            str_contains(Request::route()->getName(), 'main') || 
                            str_contains(Request::route()->getName(), 'yugioh-card-maker') ||
                            str_contains(Request::route()->getName(), 'deck')
                        )
                            <!-- HOME -->
                            <li><a href="{{ route('home') }}" class="nav-link px-2 text-white bar-img-content">
                                {{ __('Dashboard') }}

                                <!-- Card Component (LOGIN) -->
                                <div class="card m-0" style="right: 0;display: none;">
                                    <img class="card-img" src="{{ asset('images/monster-images/number-c69-heraldry-crest-of-horror.png') }}" alt="menu-image">
                                    <div class="card-img-overlay overlay-dark text-white">
                                        <div class="darken-background">
                                            <p>&#9734; Dashboard</p>
                                        </div>
                                        <p class="card-description">You already login your account. You can go to the dashboard byu clicking this button.</p>
                                    </div>
                                </div>
                            </a></li>
                        @endif

                        <!-- LOGOUT -->
                        <li style="margin-right: -4.5rem;"><a href="{{ route('logout') }}" class="nav-link px-2 text-white bar-img-content" onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();
                        ">
                            Logout

                            <!-- Card Component (LOG-OUT) -->
                            <div class="card m-0" style="right: 0;display: none;">
                                <img class="card-img" src="{{ asset('images/monster-images/treeborn-frog.webp') }}" alt="menu-image">
                                <div class="card-img-overlay overlay-dark text-white">
                                    <div class="darken-background">
                                        <p>&#9734; {{ __('Logout') }}</p>
                                    </div>
                                    <p class="card-description">Thank you for visiting <strong>Deck Pro Master</strong>. Enjoy your Day.</p>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </a></li>
                    @endguest

                </ul>

            </div>
        </div>
    </header>

    <!-- Navigation Component (Button) -->
    <div class="container-fluid navigation-offcanvas">
        <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"><i class="fas fa-bars"></i></button>
    </div>

    <!-- OffCanvas Navigation -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">

        <!-- OffCanvas Header -->
        <div class="offcanvas-header">
            <h6 class="offcanvas-title" id="offcanvasWithBackdropLabel">Navigation</h6>
            <button type="button" class="text-reset text-white" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>

        <!-- OffCanvas Body -->
        <div class="offcanvas-body p-0 overflow-auto">

            <!-- List-Group Component -->
            <div class="list-group">
                <a href="{{ url('/') }}" class="list-group-item list-group-item-action">Go to Home</a>
                <a href="#" class="list-group-item list-group-item-action">

                    <!-- Card Component (DOCUMENTATION) -->
                    <div class="card m-0">
                        <img class="card-img" src="{{ asset('images/monster-images/arcana-force-x-the-light-ruler.jpg') }}" alt="menu-image">
                        <div class="card-img-overlay overlay-dark text-white">
                            <div class="darken-background">
                                <p>&#9750; Documentation</p>
                            </div>
                            <p class="card-description">An important materials you need to know to adopt in the World of YUGIOH.</p>
                        </div>
                    </div>

                </a>
                <a href="{{ route('yugioh-card-maker') }}" class="list-group-item list-group-item-action">Make a Card</a>
                <a href="#" class="list-group-item list-group-item-action">About</a>

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="list-group-item list-group-item-action">

                            <!-- Card Component (LOGIN) -->
                            <div class="card m-0">
                                <img class="card-img" src="{{ asset('images/non-monster-images/spacegate.png') }}" alt="menu-image">
                                <div class="card-img-overlay overlay-dark text-white">
                                    <div class="darken-background">
                                        <p>&#9734; {{ __('Login') }}</p>
                                    </div>
                                    <p class="card-description">Save your newly created Card and Manage your Deck with the existing Cards and your Cards.</p>
                                </div>
                            </div>

                        </a>
                    @endif

                    @if (Route::has('login'))
                        <a href="{{ route('register') }}" class="list-group-item list-group-item-action">

                            <!-- Card Component (REGISTER) -->
                            <div class="card m-0">
                                <img class="card-img" src="{{ asset('images/non-monster-images/magical-gate-of-miracles.png') }}" alt="menu-image">
                                <div class="card-img-overlay overlay-dark text-white">
                                    <div class="darken-background">
                                        <p>&#9733; {{ __('Register') }}</p>
                                    </div>
                                    <p class="card-description">Join our Community. Publish your Cards or Deck and see what the Community talks about it.</p>
                                </div>
                            </div>

                        </a>
                    @endif
                @else

                    @if (str_contains(Request::route()->getName(), 'main'))
                        <a href="{{ route('register') }}" class="list-group-item list-group-item-action">

                            <!-- Card Component (DASHBOARD) -->
                            <div class="card m-0">
                                <img class="card-img" src="{{ asset('images/monster-images/number-c69-heraldry-crest-of-horror.png') }}" alt="menu-image">
                                <div class="card-img-overlay overlay-dark text-white">
                                    <div class="darken-background">
                                        <p>&#9733; {{ __('Dashboard') }}</p>
                                    </div>
                                    <p class="card-description">You already login your account. You can go to the dashboard byu clicking this button.</p>
                                </div>
                            </div>

                        </a>
                    @endif

                    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" onclick="
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    ">

                        <!-- Card Component (LOGOUT) -->
                        <div class="card m-0">
                            <img class="card-img" src="{{ asset('images/monster-images/treeborn-frog.webp') }}" alt="menu-image">
                            <div class="card-img-overlay overlay-dark text-white">
                                <div class="darken-background">
                                    <p>&#9733; {{ __('Logout') }}</p>
                                </div>
                                <p class="card-description">Thank you for visiting Deck Pro Master. Enjoy your Day.</p>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </a>
                @endguest
            </div>

        </div>

    </div>

    <!-- MAIN SRC PATH -->
    <img data-src="{{ asset('/images') }}" id="main-path" style="display: none;">

    <!-- COMPONENTS LINK -->
    @yield('content')

</body>
</html>
