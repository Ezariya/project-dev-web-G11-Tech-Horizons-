@extends('layouts.app1')

@section('title', 'Connexion')

@section('content')
    <!-- Banner Section -->
    <section id="banner-login">
        <div class="inner">
            <header class="align-center">
                <h2>Connexion</h2>
                <p>Connectez-vous pour accéder à votre compte Tech Horizons.</p>
            </header>
        </div>
    </section>

    <!-- Login Form Section -->
    <section id="login-form" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="session-status">
                                {{ session('status') }}
                            </div>
                        @endif

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
                                autocomplete="username"
                                class="form-input"
                            >
                            @error('email')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="field">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="form-input"
                            >
                            @error('password')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="form-actions">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-password-link">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                            <button type="submit" class="button primary">
                                {{ __('Log in') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
