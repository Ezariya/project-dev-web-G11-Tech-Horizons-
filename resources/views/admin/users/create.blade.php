@extends('layouts.app1')

@section('title', 'Ajouter un nouvel utilisateur')

@section('content')
    <!-- Banner -->
    <section id="banner-create-user">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Ajouter un nouvel utilisateur</h2>
            </header>
        </div>
    </section>

    <!-- Create User Form Section -->
    <section id="create-user-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Ajouter un nouvel utilisateur</h2>

                    @if($errors->any())
                        <div class="alert-error">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST" class="user-form">
                        @csrf

                        <!-- Nom -->
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                required
                                class="form-input"
                                placeholder="Entrez le nom complet de l'utilisateur"
                            >
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                required
                                class="form-input"
                                placeholder="Entrez l'adresse email de l'utilisateur"
                            >
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                class="form-input"
                                placeholder="Définissez un mot de passe"
                            >
                        </div>

                        <!-- Confirmation du mot de passe -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                class="form-input"
                                placeholder="Confirmez le mot de passe"
                            >
                        </div>

                        <!-- Rôle -->
                        <div class="form-group">
                            <label for="role_id" class="form-label">Rôle</label>
                            <select
                                name="role_id"
                                id="role_id"
                                required
                                class="form-select"
                            >
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button
                                type="submit"
                                class="button submit-button"
                            >
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
