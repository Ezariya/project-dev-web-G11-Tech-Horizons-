@extends('layouts.app1')

@section('title', 'Réinitialiser le mot de passe')

@section('content')
    <!-- Banner Section -->
    <section id="banner-password-reset">
        <div class="inner">
            <header class="align-center">
                <h2>Réinitialiser le mot de passe</h2>
                <p>Entrez votre nouveau mot de passe pour accéder à nouveau à votre compte.</p>
            </header>
        </div>
    </section>

    <!-- Password Reset Form Section -->
    <section id="password-reset-form" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <form method="POST" action="{{ route('password.store') }}" class="password-reset-form">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Address -->
                        <div class="field">
                            <label for="email" class="form-label">{{ __('Adresse Email') }}</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $request->email) }}"
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
                            <label for="password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
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
                        <div class="form-actions align-center">
                            <button type="submit" class="button primary">
                                {{ __('Réinitialiser le mot de passe') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
