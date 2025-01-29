@extends('layouts.app1')

@section('title', 'Modifier le thème : ' . $theme->name)

@section('content')
    <!-- Banner -->
    <section id="banner-edit-theme">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Modifier le thème : {{ $theme->name }}</h2>
                <p>Apportez des modifications aux détails de votre thème.</p>
            </header>
        </div>
    </section>

    <!-- Edit Theme Form Section -->
    <section id="create-article-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Form Title -->
                    <h2 class="section-title">Modifier le thème : {{ $theme->name }}</h2>

                    <!-- Display Success and Error Messages -->
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

                    @if($errors->any())
                        <div class="alert-error">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('themes.update', $theme->id) }}" method="POST" class="theme-form">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name" class="form-label">Nom du thème :</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $theme->name) }}"
                                required
                                class="form-input"
                                placeholder="Entrez le nom du thème"
                            >
                        </div>

                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description" class="form-label">Description :</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                required
                                class="form-textarea"
                                placeholder="Entrez une description détaillée du thème"
                            >{{ old('description', $theme->description) }}</textarea>
                        </div>

                        <!-- Responsable Dropdown -->
                        <div class="form-group">
                            <label for="responsable_id" class="form-label">Responsable du thème :</label>
                            <select
                                id="responsable_id"
                                name="responsable_id"
                                required
                                class="select2 form-select"
                                aria-label="Sélectionnez un responsable pour le thème"
                            >
                                <option value="">-- Sélectionnez un responsable --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('responsable_id', $theme->responsable_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ ucfirst($user->role->name) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button
                                type="submit"
                                class="button submit-button"
                                aria-label="Mettre à jour le thème : {{ $theme->name }}"
                            >
                                Mettre à jour le thème
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Include Select2 CSS and JS -->
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.select2').select2({
                placeholder: 'Rechercher un responsable',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
