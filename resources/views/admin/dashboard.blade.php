@extends('layouts.app1')

@section('title', 'Tableau de bord de l\'Éditeur')

@section('content')
    <!-- Banner -->
    <section id="banner-editor-dashboard">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Tableau de bord de l'Éditeur</h2>
                <p>Gérez les utilisateurs, les articles et suivez les statistiques clés de la plateforme.</p>
            </header>
        </div>
    </section>

    <!-- Editor Dashboard Section -->
    <section id="editor-dashboard-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Tableau de bord de l'Éditeur</h2>

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

                    <!-- Statistics Grid -->
                    <div class="stats-grid">
                        <div class="stat-item">
                            <h3>Utilisateurs</h3>
                            <p>Total : {{ $userCount ?? 'N/A' }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>Thèmes</h3>
                            <p>Total : {{ $themeCount ?? 'N/A' }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>Numéros</h3>
                            <p>Total : {{ $issueCount ?? 'N/A' }}</p>
                        </div>
                        <div class="stat-item">
                            <h3>Articles</h3>
                            <p>Total : {{ $articleCount ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Actions List -->
                    <ul class="editor-actions-list">
                        <li>
                            <a href="{{ route('admin.users') }}" class="action-link">
                                Gérer les utilisateurs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles') }}" class="action-link">
                                Gérer les articles
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
