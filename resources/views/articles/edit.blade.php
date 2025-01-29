@extends('layouts.app1')

@section('title', 'Modifier l\'article')

@section('content')
    <!-- Banner Section -->
    <section id="banner">
        <div class="inner">
            <h1>Modifier l'article</h1>
            <p>Apportez des modifications à votre article pour refléter vos idées les plus récentes.</p>
            <a href="#create-article-form-section" class="button special scrolly">Commencer</a>
        </div>
    </section>

    <!-- Main Content Section -->
    <section id="create-article-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h3 class="section-title">Formulaire de Modification</h3>

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

                    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="article-form">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="field">
                            <label for="title" class="form-label">Titre :</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $article->title) }}"
                                class="form-input"
                                required
                                placeholder="Entrez le titre de l'article"
                            >
                        </div>

                        <!-- Theme -->
                        <div class="field">
                            <label for="theme_id" class="form-label">Thème :</label>
                            <select id="theme_id" name="theme_id" class="form-select" required>
                                <option value="">-- Sélectionnez un thème --</option>
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}" {{ old('theme_id', $article->theme_id) == $theme->id ? 'selected' : '' }}>
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
                            >{{ old('content', $article->content) }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="field">
                            <label for="image" class="form-label">Image (optionnel) :</label>
                            <input type="file" id="image" name="image" accept="image/*" class="form-input">

                            @if ($article->image_path)
                                <div class="current-image">
                                    <span>Image actuelle :</span>
                                    <div class="image-box">
                                        <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="field align-center">
                            <button type="submit" class="button special">
                                Mettre à jour l'article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
