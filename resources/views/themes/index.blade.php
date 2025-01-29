@extends('layouts.app1')

@section('title', 'Liste des thèmes')

@section('content')
    <!-- Banner -->
    <section id="banner-themes-list">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Liste des thèmes</h2>
                <p>Parcourez et gérez les thèmes disponibles.</p>
            </header>
        </div>
    </section>

    <!-- Themes List Section -->
    <section id="themes-list-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Page Title -->
                    <h2 class="section-title">Liste des thèmes</h2>

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

                    <!-- Themes List -->
                    @if($themes->isEmpty())
                        <p class="no-themes">Aucun thème disponible pour le moment.</p>
                    @else
                        <ul class="themes-list">
                            @foreach($themes as $theme)
                                <li class="theme-item">
                                    <div class="theme-info">
                                        <a href="{{ route('themes.show', $theme->id) }}" class="theme-name">
                                            {{ $theme->name }}
                                        </a>
                                        <p class="theme-description">
                                            {{ Str::limit($theme->description, 150, '...') }}
                                        </p>
                                    </div>

                                    @auth
                                        @if(auth()->user()->role->name === 'editeur' || (auth()->user()->role->name === 'responsable' && auth()->id() === $theme->responsable_id))
                                            <div class="theme-actions">
                                                <!-- Update Button -->
                                                <a href="{{ route('themes.edit', $theme->id) }}" class="button edit-button" aria-label="Modifier le thème : {{ $theme->name }}">
                                                    Modifier
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('themes.destroy', $theme->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Confirmez la suppression de ce thème ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button delete-button" aria-label="Supprimer le thème : {{ $theme->name }}">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </li>
                            @endforeach
                        </ul>

                        <!-- Pagination -->
                       
                    @endif

                    <!-- Create Button for Authorized Users -->
                    @auth
                        @if(auth()->user()->role->name === 'editeur' || auth()->user()->role->name === 'responsable')
                            <div class="create-theme-button">
                                <a href="{{ route('themes.create') }}" class="button create-button" aria-label="Créer un nouveau thème">
                                    Créer un nouveau thème
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
