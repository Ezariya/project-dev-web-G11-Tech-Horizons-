@extends('layouts.app1')

@section('title', 'Gérer les abonnements')

@section('content')
    <!-- Banner -->
    <section id="banner-manage-subscriptions">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Gérer les abonnements</h2>
                <p>Gérez les abonnements des utilisateurs pour votre thème.</p>
            </header>
        </div>
    </section>

    <!-- Manage Subscriptions Section -->
    <section id="manage-subscriptions-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Theme Selection -->
                    <form action="{{ route('responsable.subscriptions') }}" method="GET" class="theme-selection-form">
                        <label for="theme_id" class="form-label">Sélectionnez un thème :</label>
                        <select name="theme_id" id="theme_id" onchange="this.form.submit()" class="form-select">
                            @foreach ($themes as $themeOption)
                                <option value="{{ $themeOption->id }}" {{ isset($theme) && $theme->id === $themeOption->id ? 'selected' : '' }}>
                                    {{ $themeOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <!-- Subscribers List -->
                    <h3 class="section-subtitle">Abonnés au thème : {{ $theme->name }}</h3>
                    @if($subscribers->isEmpty())
                        <p class="no-subscribers">Aucun abonné pour ce thème.</p>
                    @else
                        <ul class="subscribers-list">
                            @foreach($subscribers as $subscriber)
                                @php
                                    $isBlocked = $subscriber->pivot->is_blocked ?? false;
                                @endphp
                                <li class="subscriber-item">
                                    <div class="subscriber-info">
                                        <p class="subscriber-name">{{ $subscriber->name }}</p>
                                        <p class="subscriber-email">{{ $subscriber->email }}</p>
                                        <p class="subscriber-status {{ $isBlocked ? 'status-blocked' : 'status-active' }}">
                                            {{ $isBlocked ? 'Bloqué' : 'Actif' }}
                                        </p>
                                    </div>
                                    <div class="subscriber-actions">
                                        <!-- Detach Subscription -->
                                        <form action="{{ route('responsable.subscriptions.detach', $subscriber->id) }}" method="POST" class="action-form">
                                            @csrf
                                            <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                                            <button type="submit" class="button detach-button" onclick="return confirm('Voulez-vous vraiment supprimer cet abonné ?');">
                                                Supprimer
                                            </button>
                                        </form>

                                        <!-- Block/Unblock Subscriber -->
                                        <form action="{{ route('responsable.subscriptions.toggleBlock', $subscriber->id) }}" method="POST" class="action-form">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                                            <button type="submit" class="button {{ $isBlocked ? 'unblock-button' : 'block-button' }}">
                                                {{ $isBlocked ? 'Débloquer' : 'Bloquer' }}
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Pagination -->
                        <div class="pagination-container">
                            {{ $subscribers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
