@extends('layouts.app1')

@section('title', 'Modérer les conversations du thème : ' . $theme->name)

@section('content')
    <!-- Banner -->
    <section id="banner-moderate-conversations">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Modérer les conversations du thème : {{ $theme->name }}</h2>
                <p>Gérez et supprimez les conversations inappropriées.</p>
            </header>
        </div>
    </section>

    <!-- Conversations List Section -->
    <section id="moderate-conversations" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Conversations liées au thème : {{ $theme->name }}</h2>

                    @if($chats->isEmpty())
                        <p class="no-conversations">Aucune conversation à afficher.</p>
                    @else
                        <ul class="conversations-list">
                            @foreach($chats as $chat)
                                <li class="conversation-item">
                                    <p class="conversation-message">
                                        <strong>{{ $chat->user->name }}</strong>
                                        <span class="conversation-time">({{ $chat->created_at->diffForHumans() }})</span>:
                                        {{ $chat->message }}
                                    </p>
                                    <p class="conversation-article">
                                        Article:
                                        <a href="{{ route('articles.show', $chat->article_id) }}" class="article-link">
                                            {{ $chat->article->title }}
                                        </a>
                                    </p>

                                    <!-- Delete Button -->
                                    <form action="{{ route('responsable.conversations.delete', $chat->id) }}" method="POST" class="delete-conversation-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button delete-button" onclick="return confirm('Voulez-vous vraiment supprimer cette conversation ?');">
                                            Supprimer
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $chats->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
