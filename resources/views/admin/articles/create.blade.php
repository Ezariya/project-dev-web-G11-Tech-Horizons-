@extends('layouts.app1')

@section('title', 'Ajouter un nouvel article')

@section('content')
    <!-- Banner -->
    <section id="banner-create-article">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Ajouter un nouvel article</h2>
                <p>Créez et publiez de nouveaux articles pour les utilisateurs.</p>
            </header>
        </div>
    </section>

    <!-- Create Article Form Section -->
    <section id="create-article-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Ajouter un article</h2>

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

                    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="article-form">
                        @csrf

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">Titre :</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                required
                                class="form-input"
                                placeholder="Entrez le titre de l'article"
                            >
                        </div>

                        <!-- Theme -->
                        <div class="form-group">
                            <label for="theme_id" class="form-label">Thème :</label>
                            <select
                                id="theme_id"
                                name="theme_id"
                                required
                                class="form-select"
                            >
                                <option value="">-- Sélectionnez un thème --</option>
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}" {{ old('theme_id') == $theme->id ? 'selected' : '' }}>
                                        {{ $theme->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Content -->
                        <div class="form-group">
                            <label for="content" class="form-label">Contenu :</label>
                            <textarea
                                id="content"
                                name="content"
                                rows="10"
                                required
                                class="form-textarea"
                                placeholder="Rédigez le contenu de l'article"
                            >{{ old('content') }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status" class="form-label">Statut :</label>
                            <select
                                id="status"
                                name="status"
                                required
                                class="form-select"
                            >
                                <option value="publie" {{ old('status') == 'publie' ? 'selected' : '' }}>Publié</option>
                                <option value="retenu" {{ old('status') == 'retenu' ? 'selected' : '' }}>Retenu</option>
                                <option value="en_cours" {{ old('status') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="refus" {{ old('status') == 'refus' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </div>

                        <!-- Image -->
                        <div class="form-group">
                            <label for="image" class="form-label">Image (optionnel) :</label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                class="form-input"
                            >
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button
                                type="submit"
                                class="button submit-button"
                                aria-label="Ajouter l'article"
                            >
                                Ajouter l'article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
