<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark" id="sidebar">
    <div class="container-fluid">
        @guest
            @if (Route::has('login'))
                <ul class="navbar-nav mb-md-3 mt-4">
                    <a href="{{ route('default') }}" class="navbar-brand">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </ul>
        @endif
    @else
        <!-- Brand -->
            <a class="navbar-brand mb-4 mt-4" href="#">
                <img src="../assets/img/logo.svg" class="navbar-brand-img mx-auto">
            </a>

            <!-- Push content down -->
            <div class="mt-6"></div>

            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <a class="nav-link text-white" href="{{ route('devices') }}">
                    <i class="fe fe-archive"></i> Équipements
                </a>
                <a class="nav-link text-white" href="{{ route('interventions') }}">
                    <i class="fe fe-clipboard"></i> Interventions
                </a>
                <a class="nav-link text-white" href="{{ route('users') }}">
                    <i class="fe fe-user"></i> Utilisateurs
                </a>
                <a class="nav-link text-white" href="{{ route('customers') }}">
                    <i class="fe fe-user-x"></i> Clients
                </a>
                <a class="nav-link text-white" href="{{ route('map') }}">
                    <i class="fe fe-map"></i> Carte
                </a>
                <a class="nav-link text-white" href="#">
                    <i class="fe fe-star"></i> Statistiques
                </a>
                @endguest
            </ul>

            <!-- Push content down -->
            <div class="mt-auto"></div>

            <!-- User (md) -->
            <div class="navbar-user d-none d-md-flex" id="sidebarUser">
            @guest
                @if (Route::has('login'))

                @endif
                @if (Route::has('register'))

                @endif
            @else
                <!-- Dropup -->
                    <div class="dropup">

                        <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Se déconnecter') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>

                        </div>
                    </div> <!-- / .navbar-collapse -->
                @endguest
            </div>
    </div>
</nav>
