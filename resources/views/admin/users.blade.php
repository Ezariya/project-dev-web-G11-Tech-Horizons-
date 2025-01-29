@extends('layouts.app1')

@section('title', 'Gestion des utilisateurs')

@section('content')
    <!-- Banner -->
    <section id="banner-manage-users">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Gestion des utilisateurs</h2>
                <p>Administrez, modifiez ou bloquez les comptes utilisateurs de la plateforme.</p>
            </header>
        </div>
    </section>

    <!-- Manage Users Section -->
    <section id="manage-users-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <h2 class="section-title">Gestion des utilisateurs</h2>

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

                    <!-- Button to Add a New User -->
                    <div class="add-user-button">
                        <a href="{{ route('admin.users.create') }}" class="button create-button">
                            Ajouter un nouvel utilisateur
                        </a>
                    </div>

                    @if($users->isEmpty())
                        <p class="no-users">Aucun utilisateur trouvé.</p>
                    @else
                        <table class="users-table">
                            <thead class="table-header">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Bloqué ?</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach($users as $user)
                                    @if(Auth::check() && Auth::id() === $user->id)
                                        @continue
                                    @endif
                                    <tr class="table-row">
                                        <td class="table-cell">
                                            {{ $user->id }}
                                        </td>
                                        <td class="table-cell">
                                            {{ $user->name }}
                                        </td>
                                        <td class="table-cell">
                                            {{ $user->email }}
                                        </td>
                                        <td class="table-cell">
                                            {{ $user->role->name }}
                                        </td>
                                        <td class="table-cell">
                                            {{ $user->blocked ? 'Oui' : 'Non' }}
                                        </td>
                                        <td class="table-cell actions-cell">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                               class="button edit-button"
                                               aria-label="Modifier l'utilisateur : {{ $user->name }}">
                                                Modifier
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Confirmez la suppression de cet utilisateur ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button delete-button" aria-label="Supprimer l'utilisateur : {{ $user->name }}">
                                                    Supprimer
                                                </button>
                                            </form>

                                            <!-- Block/Unblock Button -->
                                            <form action="{{ route('admin.users.block', $user->id) }}" method="POST" class="block-form" onsubmit="return confirm('Confirmez le blocage/déblocage de cet utilisateur ?');">
                                                @csrf
                                                <button type="submit" class="button block-button" aria-label="Bloquer/Débloquer l'utilisateur : {{ $user->name }}">
                                                    Bloquer/Débloquer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
