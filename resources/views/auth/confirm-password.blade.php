@extends('layouts.app1')

@section('title', 'Confirmer le mot de passe')

@section('content')
    <!-- Banner Section -->
    <section id="banner-confirm-password">
        <div class="inner">
            <header class="align-center">
                <h2>Confirmer le mot de passe</h2>
                <p>Veuillez confirmer votre mot de passe pour accéder à cette zone sécurisée.</p>
            </header>
        </div>
    </section>

    <!-- Password Confirmation Section -->
    <section id="confirm-password" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <div class="info-message">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}" class="password-form">
                        @csrf

                        <!-- Password -->
                        <div class="field">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="form-input"
                            >
                            @error('password')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="button primary">
                                {{ __('Confirmer') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
