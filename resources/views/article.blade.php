@extends('base')

@php
    $user = session()->has('user')
    ? \App\Models\User::find(session('user'))
    : new \App\Models\User();
@endphp

@section('title', $article->name)

@section('head')
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <!-- TOM SELECT -->
    <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    @parent
@endsection

@section('main-content')
    <section id="el-path" class="el-center-box">
        <div class="el-content-area">
            <ul>
                <li><a href="">Accueil</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><a href="{{ route('category.show', $article->subcategory->category) }}">{{ $article->subcategory->category->name }}</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><a href="{{ route('subcategory.show', $article->subcategory) }}">{{ $article->subcategory->name }}</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span>{{ $article->name }}</span></li>
            </ul>
        </div>
    </section>
    <section id="el-details-article" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid-details-article">
                <h2 class="el-name-article">{{ $article->name }}</h2>
                <legend class="el-ref-article">Réf.: {{ $article->reference }}</legend>
                <div class="el-container">
                    <article class="el-single-product">
                        <img class="el-big-picture" src="{{ asset($article->images->first()->path) }}" alt="">
                        @if($article->images->count() > 1)
                            <div class="el-nav-picture owl-carousel">
                                @foreach($article->images as $image)
                                    <img src="{{ asset($image->path) }}" data-src="{{ asset($image->path) }}" alt="">
                                @endforeach
                            </div>
                        @endif
                    </article>
                    <article class="el-info-article">
                        <div class="accordion">
                            <h3>Informations sur le produit ?</h3>
                            <div>
                                <h2>Details:</h2>
                                <p>{!! $article->description !!}</p>
                                <h2>Couleur:</h2>
                                <select name="color_id[]" id="color_id" multiple>
                                    @foreach($article->colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                <p class="el-disponibility">{{ $article->availability->name }}</p>
                                <h2>Quantité désirée</h2>
                                <input type="number" name="quantity" id="quantity" min="1" value="1" />
                            </div>
                        </div>
                        @if($user->exists)
                            <a href="javascript:;"
                               hx-get="{{ route('favorite', ['user' => $user, 'article' => $article]) }}"
                               hx-trigger="click"
                               hx-target="#el-btn-favorite span"
                               class="el-btn"
                                id="el-btn-favorite">
                                <span>
                                    @include('layouts.favorite.favorite', ['user' => $user, 'article' => $article])
                                </span>
                                Ajouter à la liste de favoris
                            </a>
                            <a href="javascript:;" id="el-add-catalog" class="el-btn">
                                <i class="fas fa-list"></i>
                                Ajouter au catalogue
                            </a>
                            <a href="javascript:;" id="el-add-quote" class="el-btn">
                                <i class="fas fa-file-alt"></i>
                                Ajouter au devis
                            </a>
                        @endif
                        <a href="{{ route('generate.pdf', $article) }}" target="_blank" class="el-btn">
                            <i class="fas fa-print"></i>
                            Imprimer fiche produit
                        </a>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script>
        $(".el-nav-picture.owl-carousel").owlCarousel({
            items: 3,
            loop: true,
            nav: false,
            dots: false,
            autoplay: true,
            autoplaySpeed: 1000,
            smartSpeed: 1500,
            autoplayHoverPause: true,
            margin: 5,
            center: true,
            responsive:{
                1400: {
                    items: 3,
                    center: true,
                    margin: 20,
                    nav: true
                },
            }
        });
        $(".el-nav-picture img").on("click", function () {
            var newSrc = $(this).attr("data-src");
            $(".el-big-picture").attr("src", newSrc);
        });
    </script>
    <script>
        const selectsMultiple = document.querySelectorAll("select[multiple]");
        selectsMultiple.forEach(select => {
            new TomSelect(select, {plugins: {remove_button: {title: 'Supprimer'}}})
        });
    </script>
    <script>
        $( function() {
            $( ".accordion" ).accordion({
                collapsible: true,
                heightStyle: "content"
            });
        });
    </script>
    <script>
        $('#el-add-catalog').on('click', function() {

            const selectedColors = $('#color_id').val();

            if(selectedColors){
                $.ajax({
                    url: "{{ route('addCatalog.article', $article) }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        color_id: selectedColors,
                    },
                    success: function(response) {
                        if(response.code === 0){
                            Swal.fire({
                                icon: 'success',
                                title: 'Valide',
                                html: `${response.message}`
                            });
                            document.getElementById("el-nb-catalog").textContent = response.nb;
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error(errorThrown);
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: 'Veilliez selectionner un ou des couleur(s)'
                });
            }


        });

        $('#el-add-quote').on('click', function() {

            const selectedColors = $('#color_id').val();
            const quantity = $('#quantity').val();

            if(selectedColors){
                $.ajax({
                    url: "{{ route('addQuote.article', $article) }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        color_id: selectedColors,
                        quantity: quantity
                    },
                    success: function(response) {
                        if(response.code === 0){
                            Swal.fire({
                                icon: 'success',
                                title: 'Valide',
                                html: `${response.message}`
                            });
                            document.getElementById("el-nb-quote").textContent = response.nb;
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error(errorThrown);
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: 'Veilliez selectionner un ou des couleur(s)'
                });
            }


        });
    </script>
@endsection
