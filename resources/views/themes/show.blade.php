@extends('layouts.app1')

@section('title', $theme->name)

@section('content')
    <!-- Banner -->
    <section id="banner-theme-details">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>{{ $theme->name }}</h2>
                <p>Découvrez les détails et les articles associés à ce thème.</p>
            </header>
        </div>
    </section>

    <!-- Theme Details Section -->
    <section id="theme-details-section" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
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

                    <!-- Theme Information -->
                    <h2 class="section-title">{{ $theme->name }}</h2>
                    <p class="theme-description">
                        {{ $theme->description }}
                    </p>

                    <!-- Subscribe/Unsubscribe Buttons -->
                    @auth
                        <div class="subscription-buttons">
                            @php
                                $isSubscribed = DB::table('theme_user')
                                    ->where('user_id', auth()->id())
                                    ->where('theme_id', $theme->id)
                                    ->exists();
                            @endphp

                            @if($isSubscribed)
                                <form action="{{ route('themes.unsubscribe', $theme->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button
                                        type="submit"
                                        title="Se désabonner de ce thème"
                                        class="button unsubscribe-button"
                                        onclick="return confirm('Voulez-vous vraiment vous désabonner de ce thème ?');"
                                        aria-label="Se désabonner de {{ $theme->name }}"
                                    >
                                        Se désabonner
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('themes.subscribe', $theme->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button
                                        type="submit"
                                        title="S'abonner à ce thème"
                                        class="button subscribe-button"
                                        aria-label="S'abonner à {{ $theme->name }}"
                                    >
                                        S'abonner
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endauth

                    <!-- Associated Articles -->
                    <h3 class="section-subtitle">Articles associés</h3>
                    @if($theme->articles->isEmpty())
                        <p class="no-articles">Aucun article pour ce thème.</p>
                    @else
                        <ul class="articles-list">
                            @foreach($theme->articles as $article)
                                @php
                                    $canView = false;

                                    switch ($article->status) {
                                        case 'publie':
                                            $canView = true;
                                            break;
                                        case 'retenu':
                                            if (auth()->check()) {
                                                $isSubscribed = DB::table('theme_user')
                                                    ->where('user_id', auth()->id())
                                                    ->where('theme_id', $theme->id)
                                                    ->exists();

                                                $canView = $isSubscribed ||
                                                    auth()->user()->role->name === 'editeur' ||
                                                    auth()->user()->id === $theme->responsable_id;
                                            }
                                            break;
                                        case 'en_cours':
                                            $canView = auth()->check() && (
                                                auth()->user()->id === $article->author_id ||
                                                auth()->user()->role->name === 'editeur' ||
                                                auth()->user()->id === $theme->responsable_id
                                            );
                                            break;
                                        case 'refus':
                                            $canView = auth()->check() && auth()->user()->role->name === 'editeur';
                                            break;
                                        default:
                                            $canView = false;
                                    }
                                @endphp

                                @if($canView)
                                    <li class="article-item">
                                        <a
                                            href="{{ route('articles.show', $article->id) }}"
                                            class="article-link"
                                            aria-label="Voir l'article : {{ $article->title }}"
                                        >
                                            {{ $article->title }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                    <!-- Edit Theme Button for Authorized Users -->
                    @auth
                        @if(auth()->user()->role->name === 'editeur' || (auth()->user()->role->name === 'responsable' && auth()->id() === $theme->responsable_id))
                            <div class="edit-theme-button">
                                <a
                                    href="{{ route('themes.edit', $theme->id) }}"
                                    class="button edit-button"
                                    aria-label="Modifier le thème : {{ $theme->name }}"
                                >
                                    Modifier ce thème
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Include Select2 CSS and JS (if needed) -->
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.select2').select2({
                placeholder: 'Rechercher un responsable',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush