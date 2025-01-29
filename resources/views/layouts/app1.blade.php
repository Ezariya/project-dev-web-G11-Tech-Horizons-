<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Tech Horizons')</title>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="font-sans antialiased">

    <!-- Page Wrapper -->
    <div id="page-wrapper">

        <!-- Header -->
        <header id="header" class="alt">
            <div class="logo">
                <a href="{{ url('/') }}">Tech Horizons</a>
            </div>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="button">Connexion</a>
                    <a href="{{ route('register') }}" class="button">Inscription</a>
                @endguest
                @auth
                    <a href="{{ route('profile.edit') }}" class="button">{{ auth()->user()->name }}</a>
                @endauth
            </div>
            <a href="#menu" class="toggle" aria-controls="menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </header>

        <!-- Navigation -->
        <nav id="menu">
            <ul class="links">
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li><a href="{{ route('articles.index') }}">Articles</a></li>
                <li><a href="{{ route('issues.index') }}">Numéros</a></li>
                <li><a href="{{ route('themes.index') }}">Thèmes</a></li>

                @auth
                <li><a href="{{ route('history.manage') }}">history manage</a></li>

                    @if(auth()->user()->role->name === 'editeur')
                        <li><a href="{{ route('admin.dashboard') }}">Administration</a></li>
                    @elseif(auth()->user()->role->name === 'responsable')
                        <li><a href="{{ route('responsable.dashboard') }}">Responsable</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="button special">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer id="footer" class="wrapper">
            <div class="inner">
                <section>
                    <div class="box">
                        <div class="content">
                            <h2 class="align-center">À propos de Tech Horizons</h2>
                            <hr>
                            <p class="align-center">
                                Bienvenue sur <strong>Tech Horizons</strong>, votre source d'articles techniques et d'actualités sur le monde de la technologie.
                                Découvrez, apprenez et explorez les dernières tendances et innovations.
                            </p>
                            <p class="align-center">
                                <small>&copy; 2025 Tech Horizons. Tous droits réservés.
                                Le contenu de ce site est publié sous licence Creative Commons BY-NC-SA.</small>
                            </p>

                        </div>
                    </div>
                </section>
            </div>
        </footer>

    </div>

    <!-- JavaScript Libraries -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.scrolly.min.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollex.min.js') }}"></script>

    <!-- Custom jQuery Scripts -->
    <script src="{{ asset('js/custom.jquery.js') }}"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
