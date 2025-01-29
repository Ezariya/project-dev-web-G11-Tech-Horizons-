@extends('layouts.app1')

@section('title', 'Créer un nouveau thème')

@section('content')
    <!-- Banner -->
    <section id="banner-create-theme">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Créer un nouveau thème</h2>
                <p>Ajoutez un nouveau thème pour organiser vos contenus.</p>
            </header>
        </div>
    </section>

    <!-- Create Theme Form Section -->
    <section id="create-article-form-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <!-- Form Title -->
                    <h2 class="section-title">Créer un nouveau thème</h2>

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

                    @if($errors->any())
                        <div class="alert-error">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('themes.store') }}" method="POST" class="theme-form">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name" class="form-label">Nom du thème :</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="form-input"
                                placeholder="Entrez le nom du thème"
                            >
                        </div>

                        <!-- Description Field -->
                        <div class="form-group">
                            <label for="description" class="form-label">Description :</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                required
                                class="form-textarea"
                                placeholder="Entrez une description détaillée du thème"
                            >{{ old('description') }}</textarea>
                        </div>

                        <!-- Hidden Responsable ID -->
                        <input type="hidden" name="responsable_id" value="{{ auth()->id() }}">

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button
                                type="submit"
                                class="button submit-button"
                            >
                                Créer le thème
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
