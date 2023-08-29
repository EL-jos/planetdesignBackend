@extends('base')

@section('main-content')
    <section id="el-slider" class="el-center-box">
        <div class="el-content-area">
            <div class="owl-carousel">
                <img src="./assets/img/sliders/ECRITURE-1024x392.jpg" alt="">
                <img src="./assets/img/sliders/Bureau-events-2023-1024x392.jpg" alt="">
                <img src="./assets/img/sliders/COFFRESTS-ACCESSOIRES-1024x392.jpg" alt="">
                <img src="./assets/img/sliders/PAUSE-GOURMANDE-1024x392.jpg" alt="">
            </div>
        </div>
    </section>
    <section id="el-offres" class="el-center-box">
        <div class="el-content-area">
            <h2 class="el-title">nos offres</h2>
            <div class="el-container">
                <div class="el-grid-offres">
                    <article class="el-offre">
                        <a href="{{ route('catalogs.page') }}">
                            <img class="el-img" src="{{ asset('assets/img/offres/CATALOGUES-2023-1024x449.png') }}" alt="" />
                        </a>
                    </article>
                    <article class="el-offre"><a href="{{ route('arrival.page') }}">
                            <img class="el-img" src="{{ asset('assets/img/offres/Nouvel-arrivage.jpg') }}" alt="" />
                        </a></article>
                    <article class="el-offre"><a href="{{ route('destocking.page') }}">
                            <img class="el-img" src="{{ asset('assets/img/offres/Destockage.png') }}" alt="" />
                        </a></article>
                </div>
                <aside>
                    <div class="owl-carousel">
                        <img src="./assets/img/offres/Offre-spécial-Planet-design-01.png" alt="">
                        <img src="./assets/img/offres/Offre-spécial-Planet-design-02.png" alt="">
                        <img src="./assets/img/offres/Offre-spécial-Planet-design-03.png" alt="">
                        <img src="./assets/img/offres/Offre-spécial-Planet-design-04.png" alt="">
                    </div>
                    <div class="el-content">
                        <div class="el-icon el-center-box"><i class="far fa-heart"></i></div>
                        <h3>les bonnes affaires</h3>
                        <p>Des remises exceptionnelles d’objets publicitaires à découvrir dans cette rubrique. </p>
                        <a href="{{ route('business.page') }}" class="el-btn">JE DÉCOUVRE <i class="fas fa-chevron-right"></i></a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <section id="el-categories" class="el-center-box">
        <div class="el-content-area">
            <h2 class="el-title">nos catégories</h2>
            <div class="el-grid-categories">
                @foreach($categories as $category)
                    <article class="el-categorie">
                    <img src="{{ asset($category->image->path) }}" alt="{{ $category->name }}" class="el-img">
                    <div class="el-nom-categorie">
                        <h2>{{ $category->name }}</h2>
                    </div>
                    <div class="el-content">
                        <h2>{{ $category->name }}</h2>
                        <p>{!! substr(htmlspecialchars_decode($category->description), 0, 200) . '...' !!}</p>
                        <a href="{{ route('category.show', $category) }}" class="el-btn">DÉCOUVRE</a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    <section id="el-about" class="el-center-box">
        <div class="el-content-area">
            <div class="el-container">
                <article class="el-presentation">
                    <div class="el-container-title">
                        <h2>
                            À PROPOS DE NOUS
                            <span>Nous connaitre</span>
                        </h2>
                        <div class="el-carre"></div>
                    </div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi a saepe alias, nulla earum fuga tenetur praesentium numquam ipsa adipisci voluptatem, nostrum voluptas voluptate cupiditate nihil maxime quam ipsam ad?</p>
                    <a href="" class="el-btn">Voir plus</a>
                </article>
                <article class="el-container-img">
                    <img src="./assets/img/2.png" alt="">
                </article>
            </div>
            <div class="el-container-countdown">
                <div class="el-countdown">
                    <h2>2751</h2>
                    <p>Clients Satisfaits</p>
                </div>
                <div class="el-countdown">
                    <h2>2751</h2>
                    <p>Commandes</p>
                </div>
                <div class="el-countdown">
                    <h2>2751</h2>
                    <p>Articles Vendus</p>
                </div>
                <div class="el-countdown">
                    <h2>2751</h2>
                    <p>Clients Satisfaits</p>
                </div>
            </div>
        </div>
    </section>
@endsection
