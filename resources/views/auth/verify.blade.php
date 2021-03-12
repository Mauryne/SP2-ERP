@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérifier votre email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un mail de vérification a été envoyé à votre adresse mail.') }}
                        </div>
                    @endif

                    {{ __('Avant de poursuivre, veuillez consulter vos mails.') }}
                    {{ __('Si vous n\'avez reçu aucun mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Cliquez ici pour en demander un autre.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
