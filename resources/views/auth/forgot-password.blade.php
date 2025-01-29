@extends('layouts.app1')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
    <!-- Banner Section -->
    <section id="banner-password-reset">
        <div class="inner">
            <header class="align-center">
                <h2>Réinitialiser le mot de passe</h2>
                <p>Entrez votre adresse email pour recevoir un lien de réinitialisation.</p>
            </header>
        </div>
    </section>

    <!-- Password Reset Form Section -->
    <section id="password-reset-form" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Info Message -->
                    <div class="info-message">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="session-status">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="password-reset-form">
                        @csrf

                        <!-- Email Address -->
                        <div class="field">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                class="form-input"
                            >
                            @error('email')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="button primary">
                                {{ __('Envoyer le lien de réinitialisation') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
