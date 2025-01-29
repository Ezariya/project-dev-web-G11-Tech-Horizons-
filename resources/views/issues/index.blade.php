@extends('layouts.app1')

@section('title', 'Issues')

@section('content')
    <!-- Banner -->
    <section id="banner-issues">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Numéros</h2>
                <p>Gérez et consultez vos numéros facilement.</p>
            </header>
        </div>
    </section>

    <!-- Issues List Section -->
    <section id="issues-list" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Page Title -->
                    <h1 class="section-title">Liste des numéros</h1>

                    @auth
                        @if(auth()->user()->role->name === 'editeur')
                            <!-- Create New Issue Button -->
                            <div class="create-issue-button mb-4">
                                <a href="{{ route('issues.create') }}" class="button create-button">
                                    Créer un nouveau numéro
                                </a>
                            </div>
                        @endif
                    @endauth

                    <!-- Issues Table -->
                    <table class="issues-table">
                        <thead class="table-header">
                            <tr>
                                <th>Titre</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            @foreach ($issues as $issue)
                                @if($issue->is_public == 1)
                                    <!-- Show to guests -->
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            {{ $issue->title }}
                                        </td>
                                        <td class="table-cell actions-cell">
                                            <a href="{{ route('issues.show', $issue->id) }}" class="button view-button">
                                                Voir
                                            </a>
                                        </td>
                                    </tr>
                                @else
                                    <!-- Show to authenticated users -->
                                    @auth
                                        <tr class="table-row">
                                            <td class="table-cell">
                                                {{ $issue->title }}
                                            </td>
                                            <td class="table-cell actions-cell">
                                                <a href="{{ route('issues.show', $issue->id) }}" class="button view-button">
                                                    Voir
                                                </a>

                                                @if(auth()->user()->role->name === 'editeur')
                                                    <a href="{{ route('issues.edit', $issue->id) }}" class="button edit-button">
                                                        Modifier
                                                    </a>

                                                    <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" class="inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="button delete-button" onclick="return confirm('Voulez-vous vraiment supprimer ce numéro ?');">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endauth
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
