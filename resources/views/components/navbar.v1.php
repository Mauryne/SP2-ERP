<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark">

    <!-- Brand -->
    <a class="navbar-brand mb-4 mt-4" href="#">
        <img src="../assets/img/logo.svg" class="navbar-brand-img mx-auto" alt="...">
    </a>

    <!-- Navigation -->
        @guest
            @if (Route::has('login'))
            <ul class="navbar-nav mb-md-3 mt-4">
                <a href="{{ route('default') }}" class="navbar-brand">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </ul>
            @endif
        @else
        <ul class="navbar-nav mb-md-3 mt-8">
            <a class="nav-link" href="{{ route('devices') }}">
                <i class="fe fe-archive"></i> Équipements
            </a>
            <a class="nav-link" href="{{ route('interventions') }}">
                <i class="fe fe-clipboard"></i> Interventions
            </a>
            <a class="nav-link" href="{{ route('users') }}">
                <i class="fe fe-user"></i> Utilisateurs
            </a>
            <a class="nav-link" href="{{ route('customers') }}">
                <i class="fe fe-user-x"></i> Clients
            </a>
            <a class="nav-link" href="{{ route('map') }}">
                <i class="fe fe-map"></i> Carte
            </a>
            <a class="nav-link" href="#">
                <i class="fe fe-star"></i> Statistiques
            </a>
        @endguest
        </ul>



</nav>

