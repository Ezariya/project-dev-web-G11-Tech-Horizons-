@extends('layouts.app1')

@section('title', "Modifier l'utilisateur : " . $user->name)

@section('content')
    <!-- Banner -->
    <section id="banner-edit-user">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Modifier l'utilisateur : {{ $user->name }}</h2>
            </header>
        </div>
    </section>

    <!-- Edit User Form Section -->
    <section id="edit-user-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Modifier l'utilisateur : {{ $user->name }}</h2>

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

                    @if(session('error'))
                        <div class="alert-error">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="user-form">
                        @csrf
                        @method('PATCH')

                        <!-- Nom -->
                        <div class="form-group">
                            <label for="name" class="form-label">Nom</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $user->name) }}"
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
                                value="{{ old('email', $user->email) }}"
                                required
                                class="form-input"
                                placeholder="Entrez l'adresse email de l'utilisateur"
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
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group">
                            <label for="password" class="form-label">Mot de passe (laisser vide pour ne pas modifier)</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-input"
                                placeholder="Laissez vide pour conserver l'ancien mot de passe"
                            >
                        </div>

                        <!-- Confirmation du mot de passe -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmation du mot de passe</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-input"
                                placeholder="Confirmez le mot de passe"
                            >
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button
                                type="submit"
                                class="button submit-button"
                            >
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
