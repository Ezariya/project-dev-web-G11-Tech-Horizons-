@extends('layouts.app1')

@section('title', 'Modifier le numéro : ' . $issue->title)

@section('content')
    <!-- Banner -->
    <section id="banner-edit-issue">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Modifier le numéro : {{ $issue->title }}</h2>
                <p>Modifiez les détails de votre numéro et gérez les articles associés.</p>
            </header>
        </div>
    </section>

    <!-- Edit Issue Form Section -->
    <section id="edit-issue-form" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <form action="{{ route('issues.update', $issue->id) }}" method="POST" class="issue-form space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Titre du numéro -->
                        <div class="field">
                            <label for="title" class="form-label">Titre du numéro :</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $issue->title) }}"
                                required
                                class="form-input"
                            >
                            @error('title')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Checkbox pour rendre public -->
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="is_public"
                                name="is_public"
                                value="1"
                                {{ old('is_public', $issue->is_public) ? 'checked' : '' }}
                                class="checkbox-input"
                            >
                            <label for="is_public" class="checkbox-label">
                                Rendre public
                            </label>
                            @error('is_public')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sélection du statut -->
                        <div class="field">
                            <label for="status" class="form-label">Statut :</label>
                            <select
                                id="status"
                                name="status"
                                required
                                class="form-select"
                            >
                                <option value="draft" {{ old('status', $issue->status) === 'draft' ? 'selected' : '' }}>Brouillon</option>
                                <option value="published" {{ old('status', $issue->status) === 'published' ? 'selected' : '' }}>Publié</option>
                                <option value="archived" {{ old('status', $issue->status) === 'archived' ? 'selected' : '' }}>Archivé</option>
                            </select>
                            @error('status')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sélecteur d'articles -->
                        <div class="field">
                            <label for="article-selector" class="form-label">Sélectionner des articles :</label>
                            <input
                                type="text"
                                id="article-selector"
                                list="article-list"
                                placeholder="Tapez pour rechercher..."
                                class="form-input"
                            >
                            <datalist id="article-list">
                                @foreach($articles as $article)
                                    <option value="{{ $article->title }}"></option>
                                @endforeach
                            </datalist>
                            <div id="selected-articles" class="selected-articles">
                                @foreach($issue->articles as $article)
                                    <span class="selected-tag">
                                        {{ $article->title }}
                                        <button type="button" class="remove-article-btn" data-article-id="{{ $article->id }}">
                                            ×
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                            <div id="hidden-article-inputs">
                                @foreach($issue->articles as $article)
                                    <input type="hidden" name="article_ids[]" value="{{ $article->id }}">
                                @endforeach
                            </div>
                            @error('article_ids')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="field">
                            <button
                                type="submit"
                                class="button primary-button"
                            >
                                Mettre à jour le numéro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Récupération des éléments
        const articleSelector = document.getElementById('article-selector');
        const selectedArticlesDiv = document.getElementById('selected-articles');
        const hiddenInputsDiv = document.getElementById('hidden-article-inputs');

        // Création d'un dictionnaire titre -> id pour les articles
        const articles = @json($articles->pluck('id', 'title'));

        // Fonction pour ajouter un article sélectionné
        function addArticle(title) {
            const articleId = articles[title];
            if (!articleId) return; // Si l'article n'existe pas, arrêter

            // Vérifier si l'article a déjà été ajouté
            if (document.querySelector(`input[name="article_ids[]"][value="${articleId}"]`)) {
                articleSelector.value = '';
                return;
            }

            // Créer un tag pour l'article sélectionné
            const tag = document.createElement('span');
            tag.className = "selected-tag";
            tag.textContent = title + " ";

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = "remove-article-btn";
            removeBtn.textContent = '×';
            removeBtn.dataset.articleId = articleId;
            removeBtn.addEventListener('click', () => {
                tag.remove();
                // Supprimer l'input caché correspondant
                const input = document.querySelector(`input[name="article_ids[]"][value="${articleId}"]`);
                if (input) input.remove();
            });

            tag.appendChild(removeBtn);
            selectedArticlesDiv.appendChild(tag);

            // Créer un input caché pour soumettre l'article sélectionné
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'article_ids[]';
            hiddenInput.value = articleId;
            hiddenInputsDiv.appendChild(hiddenInput);

            articleSelector.value = '';
        }

        // Écouter l'événement de changement sur le sélecteur d'articles
        articleSelector.addEventListener('change', () => {
            const title = articleSelector.value.trim();
            if (title) {
                addArticle(title);
            }
        });

        // Attacher des écouteurs aux boutons de suppression existants pour les articles pré-sélectionnés
        document.querySelectorAll('.remove-article-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const articleId = btn.dataset.articleId;
                const tag = btn.parentElement;
                tag.remove();
                const input = document.querySelector(`input[name="article_ids[]"][value="${articleId}"]`);
                if (input) input.remove();
            });
        });
    </script>
@endsection
