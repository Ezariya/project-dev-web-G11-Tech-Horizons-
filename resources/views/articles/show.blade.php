@extends('layouts.app1')

@section('title', $article->title)

@section('content')
    <!-- Banner Section -->
    <section id="banner">
        <div class="inner">
            <header class="align-center">
                <h2>{{ $article->title }}</h2>
                <p>Découvrez les détails et engagez des discussions autour de cet article.</p>
            </header>
        </div>
    </section>

    <!-- Article Details Section -->
    <section id="article-details" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Article Details -->
                    <article>
                        <h2 class="article-title">{{ $article->title }}</h2>

                        <!-- Article Image -->
                        @if ($article->image_path)
                            <div class="article-image">
                                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article" loading="lazy">
                            </div>
                        @endif
                         <br><br><br><br><br><br><br><br><br><br><br><br>
                        <p class="article-meta">
                            <strong>Thème :</strong> {{ $article->theme->name ?? 'Non défini' }} <br>
                            <strong>Auteur :</strong> {{ $article->author->name ?? 'Inconnu' }} <br>
                            <strong>Statut :</strong> {{ ucfirst($article->status) }}
                        </p>

                        <!-- Article Content -->
                        <div class="article-content">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                    </article>

                    <!-- Edit Article Button -->
                    @auth
                        @if(auth()->id() === $article->author_id)
                            <div class="edit-button-container">
                                <a href="{{ route('articles.edit', $article->id) }}" class="button special">
                                    Modifier cet article
                                </a>
                            </div>
                        @endif
                    @endauth

                    <!-- Average Rating -->
                    <h3 class="average-rating">Moyenne des notes : {{ number_format($moyenne, 2) }}</h3>

                    <!-- Rating Section -->
                    <section id="rating" class="rating-section">
                        <h3 class="rating-header">Noter cet article</h3>

                        @auth
                            @if($userRating)
                                <!-- If user already rated -->
                                <form action="{{ route('ratings.update', $article->id) }}" method="POST" class="rating-form">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="rating">Votre note (1 à 5) :</label>
                                        <input
                                            type="number"
                                            name="rating"
                                            id="rating"
                                            min="1"
                                            max="5"
                                            value="{{ $userRating->rating }}"
                                            required
                                        >
                                    </div>
                                    <div class="button-group">
                                        <button type="submit" class="button primary">
                                            Modifier
                                        </button>
                                        <form action="{{ route('ratings.destroy', $article->id) }}" method="POST" class="inline-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button danger">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </form>
                            @else
                                <!-- If user hasn't rated yet -->
                                <form action="{{ route('ratings.store', $article->id) }}" method="POST" class="rating-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rating">Votre note (1 à 5) :</label>
                                        <input
                                            type="number"
                                            name="rating"
                                            id="rating"
                                            min="1"
                                            max="5"
                                            required
                                        >
                                    </div>
                                    <button type="submit" class="button primary">
                                        Envoyer
                                    </button>
                                </form>
                            @endif
                        @else
                            <p class="login-prompt">
                                <a href="{{ route('login') }}" class="login-link">
                                    Connectez-vous
                                </a> pour noter cet article.
                            </p>
                        @endauth
                    </section>

                    <!-- Chat Section with Infinite Scroll -->
                    <section id="chat" class="chat-section">
                        <h3 class="chat-header">Discussions</h3>

                        @auth
                            <!-- Chat Form -->
                            <form action="{{ route('chats.store', $article->id) }}" method="POST" id="chat-form" class="chat-form">
                                @csrf
                                <textarea
                                    name="message"
                                    id="message"
                                    rows="3"
                                    placeholder="Écrivez votre message..."
                                    required
                                ></textarea>
                                <button type="submit" class="button primary">
                                    Envoyer
                                </button>
                            </form>
                        @endauth

                        @auth
                            <!-- Chat Messages with Infinite Scroll -->
                            <div id="chat-container" class="chat-container">
                                <ul id="chat-messages" class="chat-messages">
                                    @foreach($chats as $chat)
                                        <li class="chat-message">
                                            <p class="chat-message-text">
                                                <strong>{{ $chat->user->name }}:</strong> {{ $chat->message }}
                                            </p>
                                            <p class="chat-message-time">
                                                {{ $chat->created_at->diffForHumans() }}
                                            </p>

                                            <!-- Delete Button for Editor or Responsable -->
                                            @if(auth()->user()->role->name === 'editeur' || auth()->id() === $article->theme->responsable_id)
                                                <form action="{{ route('chats.destroy', $chat->id) }}" method="POST" class="chat-delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button danger">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endauth
                    </section>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts for Chat Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Infinite Scroll for Chat Messages
            const chatContainer = document.getElementById('chat-container');
            const chatMessages = document.getElementById('chat-messages');
            const loadingSpinner = document.getElementById('loading-spinner');

            let page = 1;
            let loading = false;
            let hasMoreMessages = true;

            chatContainer.addEventListener('scroll', async function () {
                if (chatContainer.scrollTop === 0 && hasMoreMessages && !loading) {
                    loading = true;
                    // Show loading spinner if you have one
                    // loadingSpinner.classList.remove('hidden');

                    try {
                        page++;
                        const response = await fetch(`{{ url('chats') }}?article_id={{ $article->id }}&page=${page}`, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                        });

                        if (response.ok) {
                            const data = await response.json();
                            if (data.html) {
                                chatMessages.insertAdjacentHTML('afterbegin', data.html);
                            } else {
                                hasMoreMessages = false; // No more messages to load
                            }
                        }
                    } catch (error) {
                        console.error('Error loading messages:', error);
                    } finally {
                        loading = false;
                        // Hide loading spinner if you have one
                        // loadingSpinner.classList.add('hidden');
                    }
                }
            });

            // AJAX Submission for Chat Form
            const chatForm = document.getElementById('chat-form');
            const messageInput = document.getElementById('message');

            if (chatForm) {
                chatForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const formData = new FormData(chatForm);

                    try {
                        const response = await fetch(chatForm.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const newMessage = document.createElement('li');
                            newMessage.classList.add('chat-message');
                            newMessage.innerHTML = `
                                <p class="chat-message-text">
                                    <strong>${data.user.name}:</strong> ${data.message}
                                </p>
                                <p class="chat-message-time">
                                    ${data.created_at_diff}
                                </p>
                                ${data.can_delete ? `
                                    <form action="${data.delete_route}" method="POST" class="chat-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button danger">
                                            Supprimer
                                        </button>
                                    </form>
                                ` : ''}
                            `;
                            chatMessages.appendChild(newMessage);
                            messageInput.value = '';
                            chatContainer.scrollTop = chatContainer.scrollHeight;
                        } else {
                            console.error('Error posting message:', response.statusText);
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    </script>
@endsection
