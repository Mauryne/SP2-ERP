<div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <div class="navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('default') }}" class="navbar-brand">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        @endif
                    @else
                    <!-- Navigation -->
                        <ul class="nav nav-pills nav-fill">
                            <x-nav-item href="{{ route('devices') }}" text="Équipements"></x-nav-item>
                            <x-nav-item href="{{ route('interventions') }}" text="Interventions"></x-nav-item>
                            <x-nav-item href="{{ route('users') }}" text="Utilisateurs"></x-nav-item>
                            <x-nav-item href="{{ route('customers') }}" text="Clients"></x-nav-item>
                            <x-nav-item href="{{ route('map') }}" text="Carte"></x-nav-item>
                        </ul>
                    @endguest
                </ul>
            </div>

            <!-- Right Side Of Navbar -->
            <div class="navbar-collapse collapse dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <x-nav-item class="mr-sm-2" href="{{ route('login') }}"
                                        text="{{ __('Se connecter') }}"></x-nav-item>
                        @endif
                        @if (Route::has('register'))
                            <x-nav-item href="{{ route('register') }}" text="{{ __('Nouvel utilisateur ?') }}"></x-nav-item>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Se déconnecter') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>
