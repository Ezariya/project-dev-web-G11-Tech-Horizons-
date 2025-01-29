@extends('layouts.app1')

@section('title', 'Discussion sur : ' . $article->title)

@section('content')
    <!-- Banner -->
    <section id="banner-discussion">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Discussion sur : {{ $article->title }}</h2>
                <p>Partagez vos pensées et engagez une discussion constructive.</p>
            </header>
        </div>
    </section>

    <!-- Discussion Section -->
    <section id="discussion-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h3 class="section-title">Messages</h3>
                    <div id="chat-messages" class="chat-messages">
                        @forelse($chats as $chat)
                            <div class="chat-message">
                                <p class="message-text">
                                    <strong>{{ $chat->user->name }} :</strong>
                                    {{ $chat->message }}
                                </p>
                                <small class="message-time">
                                    Posté {{ $chat->created_at->diffForHumans() }}
                                </small>

                                @if(auth()->check() && (auth()->id() === $chat->user_id || in_array(auth()->user()->role->name, ['responsable', 'editeur'])))
                                    <form action="{{ route('chats.destroy', $chat->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button danger-button">
                                            Supprimer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <p class="no-messages">Aucun message pour le moment.</p>
                        @endforelse
                    </div>

                    @auth
                        <h3 class="section-subtitle">Poster un nouveau message</h3>
                        <form action="{{ route('chats.store', $article->id) }}" method="POST" class="post-message-form">
                            @csrf
                            <div class="field">
                                <label for="message" class="form-label">Votre message :</label>
                                <textarea name="message" id="message" rows="3" required class="form-input"></textarea>
                            </div>
                            <button type="submit" class="button primary-button">
                                Envoyer
                            </button>
                        </form>
                    @endauth

                    @guest
                        <p class="login-prompt">
                            <a href="{{ route('login') }}" class="login-link">
                                Connectez-vous
                            </a> pour participer à la discussion.
                        </p>
                    @endguest
                </div>
            </div>
        </div>
    </section>
@endsection
