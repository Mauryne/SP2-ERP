@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-xl-4 my-5 mt-7 ml-8">
                <h1 class="display-4 text-center mb-3">
                    Création d'un compte
                </h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label>{{ __('Nom') }}</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Adresse mail') }}</label>

                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Mot de passe') }}</label>

                        <input placeholder="Indiquez votre mot de passe" id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>{{ __('Confirmation du mot de passe') }}</label>


                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-lg btn-block btn-primary mb-3">
                        {{ __('Créer un nouveau compte') }}
                    </button>

                    <!-- Link -->
                    <div class="text-center">
                        <small class="text-muted text-center">
                            Vous avez un compte ? <a href="login">Connectez-vous</a>.
                        </small>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
