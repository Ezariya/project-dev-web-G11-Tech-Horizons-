@extends('layouts.app1')

@section('title', 'Gérer l\'historique de navigation')

@section('content')
    <!-- Banner -->
    <section id="banner-history">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Gérer l'historique de navigation</h2>
                <p>Filtrez et gérez votre historique de navigation facilement.</p>
            </header>
        </div>
    </section>

    <!-- History Section -->
    <section id="history-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Historique de navigation</h2>

                    <!-- Filters -->
                    <form method="GET" action="{{ route('history.manage') }}" class="filters-form">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="field">
                                <label for="theme_id" class="form-label">Thème</label>
                                <select name="theme_id" id="theme_id" class="form-select">
                                    <option value="">-- Tous les thèmes --</option>
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->id }}" {{ request('theme_id') == $theme->id ? 'selected' : '' }}>
                                            {{ $theme->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label for="search" class="form-label">Recherche</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                       class="form-input" placeholder="Titre de l'article...">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="field">
                                    <label for="start_date" class="form-label">Date de début</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                                           class="form-input">
                                </div>
                                <div class="field">
                                    <label for="end_date" class="form-label">Date de fin</label>
                                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                           class="form-input">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="button primary-button mt-4">
                            Filtrer
                        </button>
                    </form>

                    <!-- History List -->
                    @if($histories->isEmpty())
                        <p class="no-history">Aucun historique de navigation disponible.</p>
                    @else
                        <ul class="history-list">
                            @foreach($histories as $history)
                                <li class="history-item">
                                    <a href="{{ route('articles.show', $history->article->id) }}" class="history-link">
                                        {{ $history->article->title }}
                                    </a>
                                    <p class="history-details">
                                        Thème : {{ $history->article->theme->name ?? 'Non défini' }}<br>
                                        Visité le {{ $history->created_at }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                        <div class="pagination-container">
                            {{ $histories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
