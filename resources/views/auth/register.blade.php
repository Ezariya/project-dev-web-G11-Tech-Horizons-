@extends('layouts.app1')

@section('title', 'Inscription')

@section('content')
    <!-- Banner Section -->
    <section id="banner-register">
        <div class="inner">
            <header class="align-center">
                <h2>Inscription</h2>
                <p>Rejoignez la communauté Tech Horizons en créant votre compte.</p>
            </header>
        </div>
    </section>

    <!-- Registration Form Section -->
    <section id="register-form" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <form method="POST" action="{{ route('register') }}" class="registration-form">
                        @csrf

                        <!-- Name -->
                        <div class="field">
                            <label for="name" class="form-label">{{ __('Nom') }}</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                class="form-input"
                            >
                            @error('name')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="field">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                class="form-input"
                            >
                            @error('email')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="field">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                class="form-input"
                            >
                            @error('password')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="field">
                            <label for="password_confirmation" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                class="form-input"
                            >
                            @error('password_confirmation')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <a href="{{ route('login') }}" class="login-link">
                                {{ __('Déjà inscrit ?') }}
                            </a>
                            <button type="submit" class="button primary">
                                {{ __('S\'inscrire') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
