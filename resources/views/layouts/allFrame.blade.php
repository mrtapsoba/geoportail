<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title')</title>
    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="{{ asset('images/logo_igb.png') }}" />
    <!--linear icon css-->
    <link rel="stylesheet" href="{{ asset('/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.min.css') }}">
    <!--animate.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!--owl.carousel.css-->
    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">
    <!--style.css-->
    <link rel="stylesheet" href="{{ asset('/css/accounts.css') }}">


    @yield('headLinks')

</head>

<body>
    <main>
        <div class="my-nav ">
            <a href="{% url 'home' %}"><img src="{{ asset('images/logo_igb.png') }}" alt=""></a>
            <div class="menu-btn">
                <a href="{{ route('geoportail') }}" @yield('geoportail')>
                    <i class="ic fa-regular fa-user"></i>
                    Geoportail
                </a>
                <a href="{{ route('clientProfile') }}" @yield('moncompte')><i class="ic fas fa-ticket-simple"></i>Mon
                    compte</a>
                <a href="{{ route('fonddecarte') }}" @yield('fonddecarte')><i class="ic fas fa-list"></i>Fond de carte</a>
                <a href="{{ route('thematique') }}" @yield('thematique')><i
                        class="ic fa-solid fa-cart-shopping"></i>Thematique</a>
                <a href="{{ route('contribution') }}" @yield('contribution')><i
                        class="ic fa-solid fa-cart-shopping"></i>Contributions</a>
                <a href="{{ route('demande') }}" @yield('demande')><i
                        class="ic fa-solid fa-cart-shopping"></i>Demandes</a>
            </div>
            <a class="submit-btn" href="{{ route('signout') }}"><i class="ic fas fa-door-open"></i> se
                deconnecter</a>
        </div>
        <div class="my-nav-phone">
            <div class="phone-actions">
                <a href="{% url 'home' %}"><img src="{{ asset('images/logo_igb.png') }}" alt=""></a>
                <div class="open-btn"><i class="ic fa-solid fa-bars"></i></div>
            </div>
            <div class="menu-btn">
                <div class="close-btn"><i class="ic fa-solid fa-xmark"></i></div>

                <a href="{{ route('geoportail') }}" @yield('geoportailPhone')>
                    <i class="ic fa-regular fa-user"></i>
                    Geoportail
                </a>

                <a href="{{ route('clientProfile') }}" @yield('moncomptePhone')><i class="ic fas fa-ticket-simple"></i>Mon
                    compte</a>
                <a href="{{ route('fonddecarte') }}" @yield('fonddecartePhone')><i class="ic fas fa-list"></i>Fond de
                    carte</a>
                <a href="{{ route('thematique') }}" @yield('thematiquePhone')><i
                        class="ic fa-solid fa-cart-shopping"></i>Thematique</a>
                <a href="{{ route('contribution') }}" @yield('contributionPhone')><i
                        class="ic fa-solid fa-cart-shopping"></i>Contributions</a>
                <a href="{{ route('demande') }}" @yield('demandePhone')><i
                        class="ic fa-solid fa-cart-shopping"></i>Demandes</a>
            </div>
        </div>
        <div class="contents">
            <div class="page-title">
                <h1>@yield('sectiontitle')</h1>
            </div>
            <div class="page-content">
                @yield('content')
            </div>
        </div>

    </main>



    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/fontawesome/js/all.min.js') }}"></script>
    <!--bootstrap.min.js-->
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--owl.carousel.js-->
    <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!--Custom JS-->
    <script src="{{ asset('/js/account.js') }}"></script>
    @yield('scripts')

</body>

</html>
