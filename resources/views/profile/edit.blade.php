@extends('layouts.app1')

@section('title', 'Profile')

@section('content')
    <!-- Styles spécifiques à cette page -->
    <style>
        /* Styles du Banner */
        #banner-profile {
            position: relative;
            width: 100%;
            height: 40vh;
            background: url('../images/profile-banner.jpg') center center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        #banner-profile .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        #banner-profile .inner {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 20px;
        }

        #banner-profile h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        #banner-profile p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        /* Styles des Sections */
        .section-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        /* Styles des Boutons */
        .button {
            display: inline-block;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            border: none;
            border-radius: 4px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .create-button {
            background-color: #4c6ef5;
            color: white;
        }

        .create-button:hover {
            background-color: #364fc7;
        }

        .primary-button {
            background-color: #28a745;
            color: white;
        }

        .primary-button:hover {
            background-color: #218838;
        }

        .edit-button {
            background-color: #f59e0b;
            color: white;
        }

        .edit-button:hover {
            background-color: #d97706;
        }

        .danger-button {
            background-color: #ef4444;
            color: white;
        }

        .danger-button:hover {
            background-color: #dc2626;
        }

        /* Styles des Modals */
        .modal {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal.hidden {
            display: none;
        }

        .modal-content {
            background-color: white;
            dark:bg-gray-800;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        /* Styles des Formulaires */
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.375rem;
            background-color: #fff;
            color: #333;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #4c6ef5;
            outline: none;
            ring: 2px solid #4c6ef5;
        }

        /* Styles des Messages d'Erreur */
        .text-red-600 {
            color: #dc2626;
        }

        .text-green-600 {
            color: #16a34a;
        }

        /* Styles Responsives */
        @media (max-width: 768px) {
            #banner-profile {
                height: 50vh;
            }

            #banner-profile h2 {
                font-size: 28px;
            }

            #banner-profile p {
                font-size: 16px;
            }

            .button {
                width: 100%;
                padding: 0.5rem 1rem;
            }

            .create-button {
                width: 100%;
            }
        }
        #profile-management {
            padding: 40px;
        }
    </style>

    <!-- Banner -->
    <section id="banner-issues">
        <div class="overlay"></div>
        <div class="inner">
            <header class="text-center">
                <h2>Profile</h2>
                <p>
                    Manage your account's profile information, update your password, and delete your account.
                </p>
            </header>
        </div>
    </section>

    <!-- Profile Management Section -->
    <section id="profile-management" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="section-title">Informations du profil</h2>
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <!-- Nom -->
                    <div>
                        <label for="name" class="form-label">Nom</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            autofocus
                            autocomplete="name"
                            class="form-input"
                        >
                        @if ($errors->get('name'))
                            <p class="text-red-600 text-sm mt-2">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            autocomplete="username"
                            class="form-input"
                        >
                        @if ($errors->get('email'))
                            <p class="text-red-600 text-sm mt-2">{{ $errors->first('email') }}</p>
                        @endif

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-4">
                                <p class="text-sm text-gray-800 dark:text-gray-200">
                                    Votre adresse e-mail n'est pas vérifiée.

                                    <button type="submit" form="send-verification" class="underline text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        Cliquez ici pour renvoyer le lien de vérification.
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-sm text-green-600 dark:text-green-400">
                                        Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="button bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                        Enregistrer
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-600 dark:text-green-400"
                        >
                            Enregistré.
                        </p>
                    @endif
                </form>
            </div>

            <!-- Update Password -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="section-title">Mettre à jour le mot de passe</h2>
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <!-- Mot de passe actuel -->
                    <div>
                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                        <input
                            type="password"
                            id="current_password"
                            name="current_password"
                            required
                            autocomplete="current-password"
                            class="form-input"
                        >
                        @if ($errors->get('current_password'))
                            <p class="text-red-600 text-sm mt-2">{{ $errors->first('current_password') }}</p>
                        @endif
                    </div>

                    <!-- Nouveau mot de passe -->
                    <div>
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="form-input"
                        >
                        @if ($errors->get('password'))
                            <p class="text-red-600 text-sm mt-2">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <!-- Confirmer le mot de passe -->
                    <div>
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="form-input"
                        >
                        @if ($errors->get('password_confirmation'))
                            <p class="text-red-600 text-sm mt-2">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>

                    <button type="submit" class="button bg-green-600 hover:bg-green-700 focus:ring-green-500">
                        Enregistrer
                    </button>

                    @if (session('status') === 'password-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-green-600 dark:text-green-400"
                        >
                            Enregistré.
                        </p>
                    @endif
                </form>
            </div>

            <!-- Delete User Account -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h2 class="section-title">Supprimer le compte</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.
                </p>

                <button
                    type="button"
                    class="button bg-red-600 hover:bg-red-700 focus:ring-red-500"
                    onclick="openModal('confirm-user-deletion')"
                >
                    Supprimer le compte
                </button>

                <!-- Delete Account Modal -->
                <div id="confirm-user-deletion" class="modal hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="modal-content">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Êtes-vous sûr de vouloir supprimer votre compte ?</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
                        </p>
                        <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                            @csrf
                            @method('delete')

                            <!-- Mot de passe -->
                            <div>
                                <label for="password" class="form-label">Mot de passe</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    class="form-input"
                                >
                                @if ($errors->get('password'))
                                    <p class="text-red-600 text-sm mt-2">{{ $errors->first('password') }}</p>
                                @endif
                            </div>

                            <div class="flex justify-end gap-4">
                                <button type="button" onclick="closeModal('confirm-user-deletion')" class="button bg-gray-200 text-gray-800 hover:bg-gray-300 focus:ring-gray-500">
                                    Annuler
                                </button>
                                <button type="submit" class="button bg-red-600 hover:bg-red-700 focus:ring-red-500">
                                    Supprimer le compte
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts spécifiques à cette page -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
