@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-xl-4 my-5 mt-7 ml-8">

                <!-- Heading -->
                <h1 class="display-4 text-center mb-3">
                    Réinitialisation du mot de passe
                </h1>
                <br>
                <br>
                <br>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label>{{ __('Adresse mail') }}</label>

                            <input placeholder="nom@adresse.com" id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-lg btn-block btn-primary mb-3">
                            Rénitialiser le mot de passe
                        </button>

                        <!-- Link -->
                        <div class="text-center">
                            <small class="text-muted text-center">
                                Vous vous souvenez de votre mot de passe ? <a href="{{ route('login') }}">Connectez-vous</a>.
                            </small>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

