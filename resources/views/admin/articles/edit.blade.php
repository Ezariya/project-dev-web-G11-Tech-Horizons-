@extends('layouts.app1')

@section('title', "Modifier l'article : " . $article->title)

@section('content')
    <!-- Banner -->
    <section id="banner-edit-article">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Modifier l'article : {{ $article->title }}</h2>
                <p>Mettez à jour le contenu et le statut de l'article.</p>
            </header>
        </div>
    </section>

    <!-- Edit Article Form Section -->
    <section id="edit-article-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Modifier l'article : {{ $article->title }}</h2>

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

                    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="article-form">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">Titre :</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $article->title) }}"
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
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}" {{ $article->theme_id == $theme->id ? 'selected' : '' }}>
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
                                placeholder="Modifiez le contenu de l'article"
                            >{{ old('content', $article->content) }}</textarea>
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
                                <option value="publie" {{ $article->status == 'publie' ? 'selected' : '' }}>Publié</option>
                                <option value="retenu" {{ $article->status == 'retenu' ? 'selected' : '' }}>Retenu</option>
                                <option value="en_cours" {{ $article->status == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="refus" {{ $article->status == 'refus' ? 'selected' : '' }}>Refusé</option>
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
                            @if ($article->image_path)
                                <div class="current-image">
                                    <span>Image actuelle :</span>
                                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image actuelle" class="article-image-preview">
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button
                                type="submit"
                                class="button submit-button"
                                aria-label="Mettre à jour l'article : {{ $article->title }}"
                            >
                                Mettre à jour l'article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
