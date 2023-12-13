<div class="my-nav ">
    <a href="{% url 'home' %}"><img src="{{ asset('images/logo_igb.png') }}" alt=""></a>
    <div class="menu-btn">
        <a href="{% url 'profile_view' %}" @yield('geoportail')>
            <i class="ic fa-regular fa-user"></i>
            Geoportail
        </a>
        <a href="{{ route('clientProfile') }}" @yield('moncompte')><i class="ic fas fa-ticket-simple"></i>Mon
            compte</a>
        <a href="{% url 'commande_view' %}" @yield('fonddecarte')><i class="ic fas fa-list"></i>Fond de carte</a>
        <a href="{{ route('thematique') }}" @yield('thematique')><i
                class="ic fa-solid fa-cart-shopping"></i>Thematique</a>
        <a href="{% url 'panier_view' %}" @yield('contribution')><i class="ic fa-solid fa-cart-shopping"></i>Contributions</a>
        <a href="{% url 'panier_view' %}" @yield('demande')><i class="ic fa-solid fa-cart-shopping"></i>Demandes</a>
    </div>
</div>
<div class="my-nav-phone">
    <div class="phone-actions">
        <a href="{% url 'home' %}"><img src="{{ asset('images/logo_igb.png') }}" alt=""></a>
        <div class="open-btn"><i class="ic fa-solid fa-bars"></i></div>
    </div>
    <div class="menu-btn">
        <div class="close-btn"><i class="ic fa-solid fa-xmark"></i></div>

        <a href="{% url 'profile_view' %}" @yield('geoportailPhone')>
            <i class="ic fa-regular fa-user"></i>
            Geoportail
        </a>

        <a href="{{ route('clientProfile') }}" @yield('moncomptePhone')><i class="ic fas fa-ticket-simple"></i>Mon
            compte</a>
        <a href="{% url 'commande_view' %}" @yield('fonddecartePhone')><i class="ic fas fa-list"></i>Fond de carte</a>
        <a href="{{ route('thematique') }}" @yield('thematiquePhone')><i
                class="ic fa-solid fa-cart-shopping"></i>Thematique</a>
        <a href="{% url 'panier_view' %}" @yield('contributionPhone')><i
                class="ic fa-solid fa-cart-shopping"></i>Contributions</a>
        <a href="{% url 'panier_view' %}" @yield('demandePhone')><i class="ic fa-solid fa-cart-shopping"></i>Demandes</a>
    </div>
</div>
