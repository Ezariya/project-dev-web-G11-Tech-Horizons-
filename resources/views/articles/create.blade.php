@extends('layouts.app1')

@section('title', 'Proposer un nouvel article')

@section('content')
    <!-- Banner Section -->
    <section id="banner">
        <div class="inner">
            <h1>Proposer un Nouvel Article</h1>
            <p>Partagez vos idées et contributions avec la communauté Tech Horizons.</p>
            <a href="#create-article-form-section" class="button special scrolly">Commencer</a>
        </div>
    </section>

    <!-- Main Content Section -->
    <section id="create-article-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h3 class="section-title">Formulaire de Proposition</h3>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data"  class="article-form">
                        @csrf

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">Titre :</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-input"
                                value="{{ old('title') }}"
                                required
                                placeholder="Entrez le titre de l'article"
                            >
                        </div>

                        <!-- Theme -->
                        <div class="field">
                            <label for="theme_id" class="form-label">Thème :</label>
                            <select
                                id="theme_id"
                                name="theme_id"
                                class="form-select"
                                required
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
                        <div class="field">
                            <label for="content" class="form-label">Contenu :</label>
                            <textarea
                                id="content"
                                name="content"
                                rows="10"
                                class="form-textarea"
                                required
                                placeholder="Décrivez votre article en détail..."
                            >{{ old('content') }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="field">
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
                        <div class="field align-center">
                            <button type="submit" class="button special">
                                Envoyer la Proposition
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
