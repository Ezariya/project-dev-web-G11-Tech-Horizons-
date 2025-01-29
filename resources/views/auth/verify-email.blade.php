@extends('layouts.app1')

@section('title', 'Vérification de l\'adresse e-mail')

@section('content')
    <!-- Banner Section -->
    <section id="banner-verify-email">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Vérifiez votre adresse e-mail</h2>
                <p>Un lien de vérification a été envoyé à votre e-mail. Cliquez sur ce lien pour continuer.</p>
            </header>
        </div>
    </section>

    <!-- Verification Section -->
    <section id="verify-email-form" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <p class="info-message">
                        {{ __('Merci pour votre inscription ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ? Si vous n\'avez pas reçu l\'e-mail, nous vous en enverrons un autre avec plaisir.') }}
                    </p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="session-status">
                            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de l\'inscription.') }}
                        </div>
                    @endif

                    <div class="form-actions">
                        <form method="POST" action="{{ route('verification.send') }}" class="verification-form">
                            @csrf

                            <button type="submit" class="button resend-button">
                                {{ __('Renvoyer l\'e-mail de vérification') }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf

                            <button type="submit" class="button logout-button">
                                {{ __('Déconnexion') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
