@extends('layouts.app1')

@section('title', 'Pas de thème assigné')

@section('content')
    <!-- Banner -->
    <section id="banner-no-theme">
        <div class="overlay"></div>
        <div class="inner">
            <header class="align-center">
                <h2>Pas de thème assigné</h2>
                <p>Il semble que vous n'ayez pas encore de thème assigné. Veuillez contacter un administrateur pour en obtenir un.</p>
            </header>
        </div>
    </section>

    <!-- No Theme Assigned Message -->
    <section id="no-theme-message" class="wrapper style3">
        <div class="inner">
            <div class="box">
                <div class="content">
                    <p class="info-message">
                        {{ $message }}
                    </p>

                  
                </div>
            </div>
        </div>
    </section>
@endsection
