<div>
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark">
        <div>
                <ul class="navbar-nav">
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
                            <x-nav-item class="mr-3" href="{{ route('customers') }}" text="Clients"></x-nav-item>
                            <x-nav-item href="{{ route('map') }}" text="Carte"></x-nav-item>
                        </ul>
                    @endguest
                </ul>

            <div>
                    @guest
                        @if (Route::has('login'))

                        @endif
                        @if (Route::has('register'))

                        @endif
                    @else
                        <div class="nav-item dropdown">
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
                </div>
            </div>
        </div>
    </nav>
</div>
