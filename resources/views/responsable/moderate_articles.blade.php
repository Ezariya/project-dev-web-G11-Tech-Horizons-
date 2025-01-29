@extends('layouts.app1')

@section('title', 'Modérer les articles du thème : ' . $theme->name)

@section('content')
    <!-- Banner -->
    <section id="banner-moderate-articles">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Modérer les articles du thème : {{ $theme->name }}</h2>
                <p>Gérez et mettez à jour les articles associés à ce thème.</p>
            </header>
        </div>
    </section>

    <!-- Moderate Articles Section -->
    <section id="moderate-articles-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Page Title -->
                    <h2 class="section-title">Articles liés au thème : {{ $theme->name }}</h2>

                    @if($articles->isEmpty())
                        <p class="no-articles">Aucun article à afficher.</p>
                    @else
                        <table class="articles-table">
                            <thead class="table-header">
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Image</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach($articles as $article)
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            <a href="{{ route('articles.show', $article->id) }}" class="article-link">
                                                {{ $article->title }}
                                            </a>
                                        </td>
                                        <td class="table-cell">
                                            {{ $article->author->name ?? 'Inconnu' }}
                                        </td>
                                        <td class="table-cell">
                                            @if ($article->image_path)
                                                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article" class="article-image">
                                            @else
                                                Aucun
                                            @endif
                                        </td>
                                        <td class="table-cell">
                                            {{ ucfirst($article->status) }}
                                        </td>
                                        <td class="table-cell actions-cell">
                                            <!-- Update Status Form -->
                                            <form action="{{ route('responsable.articles.updateStatus', $article->id) }}" method="POST" class="update-status-form">
                                                @csrf
                                                <div class="flex items-center space-x-2">
                                                    <select name="status" class="status-select">
                                                        <option value="publie" {{ $article->status === 'publie' ? 'selected' : '' }}>Publié</option>
                                                        <option value="retenu" {{ $article->status === 'retenu' ? 'selected' : '' }}>Retenu</option>
                                                        <option value="en_cours" {{ $article->status === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                                        <option value="refus" {{ $article->status === 'refus' ? 'selected' : '' }}>Refusé</option>
                                                    </select>
                                                    <button type="submit" class="button update-button" aria-label="Mettre à jour le statut de l'article : {{ $article->title }}">
                                                        Mettre à jour
                                                    </button>
                                                </div>
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
