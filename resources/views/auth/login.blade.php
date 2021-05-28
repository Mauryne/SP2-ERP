@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-xl-4 my-5 mt-7 ml-8">

                <!-- Heading -->
                <h1 class="display-4 text-center mb-3">
                    Page de connexion
                </h1>
                <br>
                <br>
                <br>
                <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email address -->
                    <div class="form-group">

                        <!-- Label -->
                        <label>Adresse mail</label>

                        <!-- Input -->
                        <input placeholder="Indiquez votre adresse mail" id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <div class="row">
                            <div class="col">

                                <!-- Label -->
                                <label>Mot de passe</label>

                            </div>
                            <div class="col-auto">

                                <!-- Help text -->
                                <a href="{{ route('password.request') }}" class="form-text small text-muted">
                                    Mot de passe oublié ?
                                </a>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Input group -->
                        <div class="input-group input-group-merge">

                            <!-- Input -->
                            <input placeholder="Indiquez votre mot de passe" id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-lg btn-block btn-primary mb-3">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
