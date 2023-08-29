@extends('base')

@section('title', "Déstockage")

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
                <li><a href="">Accueil</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span>Destockage</span></li>
            </ul>
        </div>
    </section>
    <section id="el-about-categorie" class="el-center-box" >
        <div class="el-content-area">
            <h2 class="el-title-categorie">Destockage</h2>
        </div>
    </section>
    <section id="el-filter-article" class="el-center-box" >
        <div class="el-content-area">
            <h2>filtrer</h2>
            <div class="el-grid-filter-article">
                <form>
                    <div class="el-ligne">
                        <div class="el-col">
                            <label for="color_id">couleur</label>
                            <select name="color_id[]" id="color_id" multiple>
                                <option value="1">Blue</option>
                                <option value="2">Jaune</option>
                                <option value="3">Vert</option>
                            </select>
                        </div>
                        <div class="el-col">
                            <label for="material_id">matière</label>
                            <select name="material_id[]" id="material_id" multiple>
                                <option value="1">Aluminium</option>
                                <option value="2">Bois</option>
                                <option value="3">Papier</option>
                            </select>
                        </div>
                        <div class="el-col">
                            <label for="availability_id">Disponibilité</label>
                            <select name="availability_id[]" id="availability_id" multiple>
                                <option value="1">En arrivage</option>
                                <option value="2">En stock</option>
                                <option value="3">épuisé</option>
                                <option value="4">sur commande</option>
                            </select>
                        </div>
                    </div>
                </form>
                <!-- <p class="result-count">Affichage de 1–32 sur 112 résultats</p> -->
            </div>
        </div>
    </section>
    <section id="el-articles" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid-articles">
                <article class="el-article">
                    <div class="el-boxImg">
                        <a href="./article.html">
                            <img src="./assets/img/ecriture/PL111018-Planet-design-3-300x300.png" alt="">
                        </a>
                        <a href="" class="el-favorite">
                            <i class="fas fa-heart"></i>
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <div class="el-content">
                        <a href="./article.html"><h2 class="el-name-article">Nom de l'article</h2></a>
                        <div class="owl-carousel">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" alt="">
                        </div>
                        <div class="el-footer-article">
                            <h3 class="el-ref-article">Réf.: PL119007</h3>
                            <a href="" id="el-add-devis"><img src="./assets/img/Add2devis-2.png" alt=""></a>
                            <a href="" id="el-add-catalogue"><img src="./assets/img/add2wish.png" alt=""></a>
                        </div>
                    </div>
                </article>
                <article class="el-article">
                    <div class="el-boxImg">
                        <a href="./article.html">
                            <img src="./assets/img/ecriture/PL111018-Planet-design-3-300x300.png" alt="">
                        </a>
                        <a href="" class="el-favorite">
                            <i class="fas fa-heart"></i>
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <div class="el-content">
                        <a href="./article.html"><h2 class="el-name-article">Nom de l'article</h2></a>
                        <div class="owl-carousel">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" alt="">
                        </div>
                        <div class="el-footer-article">
                            <h3 class="el-ref-article">Réf.: PL119007</h3>
                            <a href="" id="el-add-devis"><img src="./assets/img/Add2devis-2.png" alt=""></a>
                            <a href="" id="el-add-catalogue"><img src="./assets/img/add2wish.png" alt=""></a>
                        </div>
                    </div>
                </article>
                <article class="el-article">
                    <div class="el-boxImg">
                        <a href="./article.html">
                            <img src="./assets/img/ecriture/PL111018-Planet-design-3-300x300.png" alt="">
                        </a>
                        <a href="" class="el-favorite">
                            <i class="fas fa-heart"></i>
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <div class="el-content">
                        <a href="./article.html"><h2 class="el-name-article">Nom de l'article</h2></a>
                        <div class="owl-carousel">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" alt="">
                        </div>
                        <div class="el-footer-article">
                            <h3 class="el-ref-article">Réf.: PL119007</h3>
                            <a href="" id="el-add-devis"><img src="./assets/img/Add2devis-2.png" alt=""></a>
                            <a href="" id="el-add-catalogue"><img src="./assets/img/add2wish.png" alt=""></a>
                        </div>
                    </div>
                </article>
                <article class="el-article">
                    <div class="el-boxImg">
                        <a href="./article.html">
                            <img src="./assets/img/ecriture/PL111018-Planet-design-3-300x300.png" alt="">
                        </a>
                        <a href="" class="el-favorite">
                            <i class="fas fa-heart"></i>
                            <i class="far fa-heart"></i>
                        </a>
                    </div>
                    <div class="el-content">
                        <a href="./article.html"><h2 class="el-name-article">Nom de l'article</h2></a>
                        <div class="owl-carousel">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-RS.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/111018-VR.png" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112018-JN.jpg" alt="">
                            <img src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" data-src="./assets/img/ecriture/SITE STYLOS EN PLASTIQUE/112050-BA.png" alt="">
                        </div>
                        <div class="el-footer-article">
                            <h3 class="el-ref-article">Réf.: PL119007</h3>
                            <a href="" id="el-add-devis"><img src="./assets/img/Add2devis-2.png" alt=""></a>
                            <a href="" id="el-add-catalogue"><img src="./assets/img/add2wish.png" alt=""></a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="el-paginator">
                <a href="" class="el-btn">1</a>
                <a href="" class="el-btn">2</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script>
        $("#el-articles .owl-carousel").owlCarousel({
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
        $(".el-article").each(function() {
            var $article = $(this);
            $article.find(".el-content img").on("click", function () {
                var newSrc = $(this).attr("data-src");
                $article.find(".el-boxImg img").attr("src", newSrc);
            }).css('cursor', 'pointer');
        });
    </script>
    <script>
        const selectsMultiple = document.querySelectorAll("select[multiple]");
        selectsMultiple.forEach(select => {
            new TomSelect(select, {plugins: {remove_button: {title: 'Supprimer'}}})
        });
    </script>
@endsection
