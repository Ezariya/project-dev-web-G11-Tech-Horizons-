@extends('layouts.app1')

@section('title', 'Tableau de bord du Responsable')

@section('content')
    <!-- Banner -->
    <section id="banner-dashboard">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Tableau de bord du Responsable</h2>
                <p>Gérez et consultez les informations liées à votre thème.</p>
            </header>
        </div>
    </section>

    <!-- Dashboard Section -->
    <section id="dashboard-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Theme Selection -->
                    <form action="{{ route('responsable.dashboard') }}" method="GET" class="theme-selection-form">
                        <label for="theme_id" class="form-label">Sélectionnez un thème :</label>
                        <select name="theme_id" id="theme_id" onchange="this.form.submit()" class="form-select">
                            @foreach ($themes as $themeOption)
                                <option value="{{ $themeOption->id }}" {{ $theme->id === $themeOption->id ? 'selected' : '' }}>
                                    {{ $themeOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <!-- Statistics -->
                    <div class="stats-grid">
                        <div class="stat-item">
                            <h3>Thème</h3>
                            <p>{{ $theme->name ?? 'N/A' }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>Abonnés</h3>
                            <p>Total : {{ $subscribersCount ?? 'N/A' }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>Articles</h3>
                            <p>Total : {{ $articlesCount ?? 'N/A' }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>Articles Publiés</h3>
                            <p>Total : {{ $theme->articles()->where('status', 'publie')->count() ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="actions-list">
                        <h3>Actions disponibles</h3>
                        <ul>
                            <li>
                                <a href="{{ route('responsable.subscriptions', ['theme_id' => $theme->id]) }}" class="action-link">
                                    Gérer les abonnements
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('responsable.articles.moderate', ['theme_id' => $theme->id]) }}" class="action-link">
                                    Consulter et modérer les articles
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('responsable.conversations.moderate', ['theme_id' => $theme->id]) }}" class="action-link">
                                    Modérer les conversations
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
