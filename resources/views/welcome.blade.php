@extends('layouts.app1')

@section('title', 'Tech Horizons - Accueil')

@section('content')
    <!-- Banner Section -->
    <section id="banner">
        <div class="inner">
            <h1>Tech Horizons</h1>
            <p>Explorez les frontières de la technologie avec nos articles approfondis et nos analyses exclusives.</p>
            <a href="#one" class="button special scrolly">Découvrir</a>
        </div>
    </section>

    <!-- Section 1: About the Site -->
    <section id="one" class="wrapper style2" style="text-align: center;">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <header class="align-center">
                        <h2>À propos de Tech Horizons</h2>
                        <p>Votre guide incontournable dans le monde des technologies émergentes.</p>
                    </header>
                    <hr>
                    <p>Chez Tech Horizons, notre mission est de fournir des articles de qualité couvrant une large gamme de sujets technologiques. Que vous soyez un passionné de gadgets, un professionnel IT, ou simplement curieux des dernières innovations, vous trouverez ici des ressources précieuses pour rester informé et inspiré.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Latest Articles -->
    <section id="articles" class="wrapper style3">
        <div class="inner">
            <header class="align-center">
                <h2>Derniers Articles</h2>
                <p>Découvrez les dernières publications de nos experts en technologie.</p>
            </header>
            <div class="grid-style">
                @if($articles->isEmpty())
                    <p class="align-center">Aucun article disponible pour le moment.</p>
                @else
                    @foreach($articles as $article)
                        <div class="box">
                            <div class="image fit">
                                @if ($article->image_path)
                                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" alt="Aucune image">
                                @endif
                            </div>
                            <div class="content">
                                <header class="align-center">
                                    <h3>
                                        <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                                    </h3>
                                </header>
                                <p>{{ \Illuminate\Support\Str::limit($article->content, 150) }}</p>
                                <ul class="actions align-center">
                                    <li><a href="{{ route('articles.show', $article->id) }}" class="button alt">Lire Plus</a></li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Section 3: Highlighted Themes -->
    <section id="themes" class="wrapper style2">
        <div class="inner">
            <header class="align-center">
                <h2>Thèmes en Vedette</h2>
                <p>Plongez dans nos thèmes populaires pour découvrir des articles captivants.</p>
            </header>
            <div class="grid-style">
                @php
                    $highlightedThemes = $themes->take(2); // Limit to 2 themes
                @endphp
                @foreach($highlightedThemes as $theme)
                    <div class="box">
                        <div class="image fit">
                            <img src="{{ asset('images/pic02.jpg') }}" alt="{{ $theme->name }}">
                        </div>
                        <div class="content">
                            <header class="align-center">
                                <h2>{{ $theme->name }}</h2>
                            </header>
                            <hr>
                            <p>{{ \Illuminate\Support\Str::limit($theme->description, 150) }}</p>
                            <a href="{{ route('themes.show', $theme->id) }}" class="button alt">Découvrir</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 4: Why Choose Tech Horizons -->
    <section id="four" class="wrapper style3">
        <div class="inner">
            <header class="align-center">
                <h2>Pourquoi choisir Tech Horizons ?</h2>
                <p>Des informations fiables et à jour sur les technologies modernes.</p>
            </header>
            <p class="align-center">Notre équipe de rédacteurs dévoués s'efforce de démystifier les concepts techniques complexes, les rendant accessibles et compréhensibles pour tous. Que vous soyez un passionné de technologie, un professionnel du secteur, ou simplement curieux, Tech Horizons est votre destination privilégiée pour tout ce qui concerne l'innovation et la technologie.</p>
        </div>
    </section>
@endsection
