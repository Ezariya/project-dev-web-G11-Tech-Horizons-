@extends('layouts.app1')

@section('title', 'Gestion des articles')

@section('content')
    <!-- Banner -->
    <section id="banner-manage-articles">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Gestion des articles</h2>
                <p>Visualisez, éditez et gérez les articles de la plateforme.</p>
            </header>
        </div>
    </section>

    <!-- Manage Articles Section -->
    <section id="manage-articles-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Gestion des articles</h2>

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

                    <!-- Button to Add a New Article -->
                    <div class="add-article-button">
                        <a href="{{ route('admin.articles.create') }}" class="button create-button">
                            Ajouter un nouvel article
                        </a>
                    </div>

                    @if($articles->isEmpty())
                        <p class="no-articles">Aucun article trouvé.</p>
                    @else
                        <table class="articles-table">
                            <thead class="table-header">
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Statut</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach($articles as $article)
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            {{ $article->id }}
                                        </td>
                                        <td class="table-cell">
                                            {{ $article->title }}
                                        </td>
                                        <td class="table-cell">
                                            {{ $article->author->name ?? 'Inconnu' }}
                                        </td>
                                        <td class="table-cell">
                                            {{ ucfirst($article->status) }}
                                        </td>
                                        <td class="table-cell">
                                            @if ($article->image_path)
                                                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article" class="article-image">
                                            @else
                                                Aucun
                                            @endif
                                        </td>
                                        <td class="table-cell actions-cell">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                                               class="button edit-button"
                                               aria-label="Modifier l'article : {{ $article->title }}"
                                            >
                                                Modifier
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Confirmez la suppression de cet article ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button delete-button" aria-label="Supprimer l'article : {{ $article->title }}">
                                                    Supprimer
                                                </button>
                                            </form>

                                            <!-- Change Status Button -->
                                            <form action="{{ route('admin.articles.changeStatus', $article->id) }}" method="POST" class="status-form">
                                                @csrf
                                                <button type="submit" class="button status-button" aria-label="Changer le statut de l'article : {{ $article->title }}">
                                                    Changer le statut
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $articles->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
