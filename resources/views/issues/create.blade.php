@extends('layouts.app1')

@section('title', 'Créer un nouveau numéro')

@section('content')
    <!-- Banner -->
    <section id="banner-create-issue">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Créer un nouveau numéro</h2>
                <p>Créez un nouveau numéro pour votre publication.</p>
            </header>
        </div>
    </section>

    <!-- Create Issue Form Section -->
    <section id="create-issue-form" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h1 class="section-title">Créer un nouveau numéro</h1>

                    <form action="{{ route('issues.store') }}" method="POST" class="issue-form space-y-6">
                        @csrf

                        <!-- Titre du numéro -->
                        <div class="field">
                            <label for="title" class="form-label">Titre du numéro :</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                required
                                class="form-input"
                            >
                        </div>

                        <!-- Checkbox pour rendre public -->
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="is_public"
                                name="is_public"
                                value="1"
                                class="checkbox-input"
                            >
                            <label for="is_public" class="checkbox-label">
                                Rendre public
                            </label>
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
                                <option value="draft">Brouillon</option>
                                <option value="published">Publié</option>
                                <option value="archived">Archivé</option>
                            </select>
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
                            <div id="selected-articles" class="selected-articles"></div>
                            <!-- Conteneur pour stocker les identifiants sélectionnés -->
                            <div id="hidden-article-inputs"></div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="field">
                            <button
                                type="submit"
                                class="button primary-button"
                            >
                                Créer le numéro
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
            tag.textContent = title;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = "remove-tag-btn";
            removeBtn.textContent = '×';
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
    </script>
@endsection
