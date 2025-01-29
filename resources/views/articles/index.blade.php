@extends('layouts.app1')

@section('title', 'Articles')

@section('content')
    <!-- Banner Section -->
    <section id="banner">
        <div class="inner">
            <header class="align-center">
                <h2>Articles</h2>
                <p>Découvrez les derniers articles, thématiques et tendances de Tech Horizons.</p>
            </header>
        </div>
    </section>

    <!-- Articles Section -->
    <section id="articles" class="wrapper style2">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="align-center">Liste des articles</h2>

                    @auth
                        <div class="align-center articles-create-btn">
                            <a href="{{ route('articles.create') }}" class="button special">
                                Proposer un nouvel article
                            </a>
                        </div>
                    @endauth

                    @if($articles->isEmpty())
                        <p class="align-center">Aucun article disponible pour le moment.</p>
                    @else
                        <div class="articles-grid-style">
                            @foreach($articles as $article)
                                @php
                                    $show = false;
                                    $user = Auth::user();

                                    if ($article->status === 'publie') {
                                        $show = true;
                                    } elseif ($article->status === 'retenu') {
                                        if ($user) {
                                            if ($user->role->name === 'editeur' || $user->id === ($article->theme->responsable_id ?? 0)) {
                                                $show = true;
                                            } elseif ($user->role->name === 'abonne') {
                                                $isSubscribed = DB::table('theme_user')
                                                    ->where('user_id', $user->id)
                                                    ->where('theme_id', $article->theme->id ?? 0)
                                                    ->exists();
                                                $show = $isSubscribed;
                                            }
                                        }
                                    } elseif ($article->status === 'en_cours') {
                                        if ($user && (
                                            $user->id === $article->author_id ||
                                            $user->role->name === 'editeur' ||
                                            $user->id === ($article->theme->responsable_id ?? 0)
                                        )) {
                                            $show = true;
                                        }
                                    } elseif ($article->status === 'refus') {
                                        if ($user && $user->role->name === 'editeur') {
                                            $show = true;
                                        }
                                    }
                                @endphp

                                @if($show)
                                    <div class="article-box">
                                        @if ($article->image_path)
                                            <div class="article-image-index">
                                                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article">
                                            </div>
                                        @else
                                            <div class="article-image-index">
                                                <img src="{{ asset('images/default.jpg') }}" alt="Aucune image">
                                            </div>
                                        @endif
                                        <div class="article-content">
                                            <header class="align-center">
                                                <h3>
                                                    <a href="{{ route('articles.show', $article->id) }}">
                                                        {{ $article->title }}
                                                    </a>
                                                </h3>
                                            </header>
                                            <p>{{ Str::limit($article->content, 150) }}</p>
                                            <p>
                                                <strong>Thème :</strong> {{ $article->theme->name ?? 'Non défini' }} <br>
                                                <strong>Auteur :</strong> {{ $article->author->name ?? 'Inconnu' }} <br>
                                                <strong>Statut :</strong> {{ ucfirst($article->status) }}
                                            </p>

                                            @auth
                                                @if($user->role->name === 'editeur' || ($article->theme && $user->id === $article->theme->responsable_id) || $user->id === $article->author_id)
                                                    <div class="article-buttons-group">
                                                        <a href="{{ route('articles.edit', $article->id) }}" class="button small article-btn-edit">
                                                            Modifier
                                                        </a>
                                                        @if($user->role->name === 'editeur')
                                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="article-btn-delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="button alt small article-btn-delete">
                                                                    Supprimer
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="align-center articles-pagination">
                            <!-- Pagination Links -->
                            {{ $articles->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
