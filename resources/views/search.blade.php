@extends('base')

@php
    $user = session()->has('user')
    ? \App\Models\User::find(session('user'))
    : new \App\Models\User();
@endphp

@section('title', "Recherche")

@section('head')
    <!-- TOM SELECT -->
    <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    @parent
@endsection

@section('main-content')
    <section id="el-path" class="el-center-box">
        <div class="el-content-area">
            <ul>
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span>résultats de recherche pour {{ $Keyword }}</span></li>
            </ul>
        </div>
    </section>
    <section id="el-about-categorie" class="el-center-box" >
        <div class="el-content-area">
            <h2 class="el-title-categorie">Résultats de recherche pour « {{ $Keyword }} »</h2>
        </div>
    </section>
    <section id="el-articles" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid-articles">
                @include('layouts.article.component', ['articles' => $articles, 'user' => $user])
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script>
        function initializeOwlCarousel(element) {
            $(element).owlCarousel({
                items: 4,
                loop: true,
                nav: false,
                dots: false,
                autoplay: true,
                autoplaySpeed: 1000,
                smartSpeed: 1500,
                autoplayHoverPause: true,
                margin: 0,
                center: false
            });
            $(".el-article").each(function () {
                var $article = $(this);
                $article.find(".el-content img").on("click", function () {
                    var newSrc = $(this).attr("data-src");
                    $article.find(".el-boxImg img").attr("src", newSrc);
                }).css('cursor', 'pointer');
            });
        }
        function reinitializeAllOwlCarousels() {
            const owlCarousels = document.querySelectorAll("#el-articles .owl-carousel");
            owlCarousels.forEach(owlCarousel => {
                $(owlCarousel).trigger('destroy.owl.carousel'); // Détruire l'instance existante
                initializeOwlCarousel(owlCarousel); // Réinitialiser
            });
        }
        // Appel initial pour initialiser les sliders
        reinitializeAllOwlCarousels();
        document.addEventListener("htmx:afterOnLoad", function () {
            // Réinitialisation après chaque chargement htmx
            reinitializeAllOwlCarousels();
        });
    </script>
    <script>
        const initializedElements = new Set();

        function initializeTomSelect(element) {
            if (!initializedElements.has(element)) {
                new TomSelect(element, {plugins: {remove_button: {title: 'Supprimer'}}});
                initializedElements.add(element);
            }
        }

        function initializeAllTomSelects() {
            const selectsMultiple = document.querySelectorAll("select[multiple]");
            selectsMultiple.forEach(select => {
                initializeTomSelect(select);
            });
        }

        // Initialisation lors du chargement initial de la page
        initializeAllTomSelects();

        document.addEventListener("htmx:afterOnLoad", function () {
            // Initialisation après chaque chargement htmx
            console.log("chargement fini")
            initializeAllTomSelects();
        });
    </script>
@endsection
