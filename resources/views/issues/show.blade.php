@extends('layouts.app1')

@section('title', 'Détails du numéro : ' . $issue->title)

@section('content')
    <!-- Banner -->
    <section id="banner-issue-details">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Détails du numéro : {{ $issue->title }}</h2>
                <p>Consultez les informations et les articles associés à ce numéro.</p>
            </header>
        </div>
    </section>

    <!-- Issue Details Section -->
    <section id="issue-details" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Titre et statut du numéro -->
                    <h2 class="section-title">{{ $issue->title }}</h2>
                    <p class="issue-info">
                        <strong>Statut :</strong> {{ ucfirst($issue->status) }}<br>
                        <strong>Public :</strong> {{ $issue->is_public ? 'Oui' : 'Non' }}
                    </p>

                    <!-- Liste des articles associés -->
                    <h3 class="subsection-title">Articles associés :</h3>
                    @if($issue->articles->isEmpty())
                        <p class="no-articles">Aucun article associé à ce numéro.</p>
                    @else
                        <ul class="articles-list">
                            @foreach($issue->articles as $article)
                                <li>
                                    <a href="{{ route('articles.show', $article->id) }}" class="article-link"
                                       aria-label="Voir l'article : {{ $article->title }}">
                                        {{ $article->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Bouton Modifier visible aux éditeurs -->
                    @auth
                        @if(auth()->user()->role->name === 'editeur')
                            <div class="edit-button-container">
                                <a href="{{ route('issues.edit', $issue->id) }}"
                                   class="button edit-button"
                                   aria-label="Modifier le numéro : {{ $issue->title }}">
                                    Modifier ce numéro
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
