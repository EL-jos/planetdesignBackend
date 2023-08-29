@php
    $routesBGWhite = ['identification', 'article', 'subcategory', 'category', 'login', 'register', 'contact'];
    //dd(in_array(explode('/',Request::path())[0], $routesBGWhite));
    $user = session()->has('user')
    ? \App\Models\User::find(session('user'))
    : new \App\Models\User();
    //dd($user->quotes);
@endphp
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "PLANETDESIGN")</title>
    @section('head')
        <!-- OWL CAROUSEL -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;800&display=swap" rel="stylesheet">
        <!-- CUSTOM STYLE -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <!-- HTMLX -->
        <script src="https://unpkg.com/htmx.org@1.9.4"></script>

    @show
</head>
<body>
<header id="el-header-page">
    <section id="el-search-and-my-acoumpt" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid">
                <p class="el-phone-number"><i class="fas fa-phone-alt"></i> (+212) 522 450 187 – (+212) 522 450 194</p>
                <p>Du lundi au vendredi de 9h00 à 18h45 – Samedi 9h à 12h45</p>
                <a href="@if($user->exists) javascript:; @else {{ route( 'identification.page') }} @endif"
                   @if($user->exists) onclick="document.getElementById('el-logout-form').submit()" @endif
                   class="el-btn el-account">
                    <form id="el-logout-form" method="POST" action="{{ route('logout.user') }}">
                        @csrf
                    </form>
                    @if($user->exists)
                        Déconnexion
                    @else
                        <i class="far fa-user"></i>
                        Identification
                    @endif
                </a>
                <button class="el-btn el-btn-search el-center-box"><i class="fas fa-search"></i></button>
                <form action="{{ route('search.page') }}" method="POST" class="el-container-search">
                    @csrf
                    <input type="search" name="Keyword" placeholder="Rechercher..." />
                    <button type="submit" class="el-btn"><i class="fas fa-times"></i></button>
                </form>
            </div>
        </div>
    </section>
    <section id="el-subheader-middle" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid">
                <a href="{{ route('home.page') }}" class="el-logo">
                    <img src="https://planetdesign.ma/wp-content/uploads/2019/09/Logo.png" alt="Logo Planet Design">
                </a>
                <form method="POST" action="{{ route('search.page') }}" class="el-search">
                    @csrf
                    <input type="search" name="Keyword" placeholder="Rechercher" />
                    <button type="submit" class="el-center-box"><i class="fas fa-search"></i></button>
                </form>
                @if($user->exists)
                    <ul>
                        <li class="el-icon">
                            <a href="{{ route('catalog.page', $user) }}" class="el-center-box">
                                <i class="fas fa-list"></i><span id="el-nb-catalog">{{ $user->catalogs->count() }}</span>
                            </a>
                            <p>Mon catalogue</p>
                        </li>
                        <li class="el-icon">
                            <a href="{{ route('quote.page', $user) }}" class="el-center-box">
                                <i class="fas fa-briefcase"></i><span id="el-nb-quote">{{ $user->quotes->count() }}</span>
                            </a>
                            <p>Mon devis</p>
                        </li>
                        <li class="el-icon">
                            <a href="{{ route('favorites.page', $user) }}" class="el-center-box">
                                <i class="far fa-heart"></i><span id="el-nb-favorite">{{ $user->favorites->count() }}</span>
                            </a>
                            <p>Mes favoris</p>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </section>
    <section id="el-navbar-phone" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid">
                <a href="{{ route('home.page') }}" class="el-icon-home el-center-box">
                    <i class="fas fa-home"></i>
                </a>
                <button id="el-open-menu-pone" class="el-btn">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                    Menu
                </button>
                <nav id="el-menu-desktop">
                    <ul id="el-menu-desktop-level-1">
                        @foreach($menuCategories as $category)
                            <li>
                                <a href="{{ route('category.show', $category) }}">
                                    {{ $category->name }} <i class="fas fa-caret-down"></i>
                                </a>
                                <ul id="el-menu-desktop-level-2">
                                    @foreach($category->subcategories as $subcategory)
                                        <li>
                                        <a href="{{ route('subcategory.show', $subcategory) }}" class="el-center-box">
                                            <img src="{{ asset($subcategory->image->path) }}" alt=" {{ $category->name }} {{ $subcategory->name }}">
                                            <p>{{ $subcategory->name }}</p>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <a href="{{ route('arrival.page') }}" class="el-btn"><i class="fas fa-plus"></i> Nouvel arrivage</a>
                <div  id="el-container-menu-phone">
                    <div class="accordion-container">
                        @foreach($menuCategories as $category)
                            <div class="accordion-header">
                                <i class="fas fa-angle-down"></i> <a href="{{ route('category.show', $category) }}">{{ $category->name }}</a>
                            </div>
                            <div class="accordion-content">
                                <ul>
                                    @foreach($category->subcategories as $subcategory)
                                        <li>
                                            <a href="{{ route('subcategory.show', $subcategory) }}">
                                                <img src="{{ asset($subcategory->image->path) }}" alt="">
                                                <p>{{ $subcategory->name }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
<main id="page-content" @class(['el-bg-white' => in_array(explode('/',Request::path())[1] ??  null, $routesBGWhite)])>
    @yield('main-content')
    <section id="el-forces" class="el-center-box">
        <div class="el-content-area">
            <h2 class="el-title">nos forces</h2>
            <div class="owl-carousel">
                <div class="el-force">
                    <img src="./assets/img/forces/Ellipse-4.png" alt="">
                    <h2>stock disponible</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                    </p>
                </div>
                <div class="el-force">
                    <img src="./assets/img/forces/Ellipse-4-copie.png" alt="">
                    <h2>importations sur mesure</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                    </p>
                </div>
                <div class="el-force">
                    <img src="./assets/img/forces/Ellipse-4-copie-2.png" alt="">
                    <h2>gestion de commandes</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                    </p>
                </div>
                <div class="el-force">
                    <img src="./assets/img/forces/Ellipse-4-copie-3.png" alt="">
                    <h2>atelier de marquage</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                    </p>
                </div>
                <div class="el-force">
                    <img src="./assets/img/forces/Ellipse-4-copie-4.png" alt="">
                    <h2>livraison express</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, iste maiores officiis nihil quasi autem! Corporis eos quod dolorem, quidem officiis modi vel sequi veritatis deleniti quas, rem obcaecati nostrum.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="el-contact" class="el-center-box">
        <div class="el-content-area">
            <!-- <div class="el-bg-image">
                <img src="./assets/img/F1.jpg" alt="" class="el-img">
            </div> -->
            <div class="el-carte">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d830.9008786328053!2d-7.611325712414987!3d33.589642241631125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7cd618c747d2f%3A0xf4fbcd02b4aaa0da!2sPlanet%20Design!5e0!3m2!1sen!2sma!4v1617957474908!5m2!1sen!2sma" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="el-grid-content">
                <ul class="el-coordonnees">
                    <li>
                        <div class="el-icon el-center-box"><i class="fas fa-map-marker"></i></div>
                        <p>
                            <a target="_blank" href="https://www.google.com/maps/dir/33.5740928,-7.6251136/planet+design/@33.5818494,-7.6259624,15z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0xda7cd618c747d2f:0xf4fbcd02b4aaa0da!2m2!1d-7.6106337!2d33.5897294?entry=ttu">
                                140, Rue de Strasbourg, Kissariat Lahrizi, 1er étage N°10 Derb Omar, Casablanca</p>
                        </a>

                    </li>
                    <li>
                        <div class="el-icon el-center-box"><i class="fas fa-phone"></i></div>
                        <p>
                            <a href="tel:+212522450187">(+212) 522 450 187</a>
                            <a href="tel:+212522450194">(+212) 522 450 194</a>
                        </p>
                    </li>
                    <li>
                        <div class="el-icon el-center-box"><i class="fas fa-phone"></i></div>
                        <p>
                            <a href="tel:+212666616475">(+212) 666 616 475</a>
                            <a href="tel:+212662015268">(+212) 662 015 268</a>
                        </p>
                    </li>
                    <li>
                        <div class="el-icon el-center-box"><i class="fas fa-phone"></i></div>
                        <p>
                            <a href="tel:+212522450194">(+212) 522 450 194</a>
                        </p>
                    </li>
                    <li>
                        <div class="el-icon el-center-box"><i class="fas fa-envelope"></i></div>
                        <p>
                            <a href="mailto:contact.planetdesign@gmail.com">contact.planetdesign@gmail.com</a>
                            <a href="mailto:contact@planetdesign.ma">contact@planetdesign.ma</a>
                        </p>
                    </li>
                </ul>
                <article class="el-form-contact">
                    <form>
                        <h2>contactez-nous</h2>
                        <div class="el-ligne">
                            <input type="text" placeholder="Nom*">
                        </div>
                        <div class="el-ligne">
                            <input type="text" placeholder="E-mail*">
                        </div>
                        <div class="el-ligne">
                            <input type="text" placeholder="Nom de la société*">
                        </div>
                        <div class="el-ligne">
                            <input type="text" placeholder="Numéro de portable*">
                        </div>
                        <div class="el-ligne el-texarea">
                            <textarea name="" id="" placeholder="Message"></textarea>
                        </div>
                        <button class="el-btn">envoyer</button>
                    </form>
                </article>
            </div>
        </div>
    </section>
    <footer class="el-center-box">
        <div class="el-content-area">
            <article>
                <div class="el-block">
                    <h2>menu</h2>
                    <ul>
                        <li><a href="./categorie.html">ecriture</a></li>
                        <li><a href="./categorie.html">bureau & event</a></li>
                        <li><a href="./categorie.html">loisirs & bien être</a></li>
                        <li><a href="./categorie.html">technologie</a></li>
                        <li><a href="{{ route('destocking.page') }}">déstockage</a></li>
                        <li><a href="{{ route('arrival.page') }}">nouvel arrivage</a></li>
                    </ul>
                </div>
                <div class="el-block">
                    <h2>services</h2>
                    <ul>
                        <!-- <li><a href="">mon compte</a></li> -->
                        <li><a href="{{ route('quote.page', $user) }}">demande devis</a></li>
                        <li><a href="{{ route('catalog.page', $user) }}">ajouter au catalogue</a></li>
                        <li><a href="{{ route('favorites.page', $user) }}">favoris</a></li>
                        <li><a href="{{ route('business.page') }}">l'objets de la semaine</a></li>
                        <li><a href="{{ route('catalogs.page') }}">catalogue</a></li>
                    </ul>
                </div>
                <div class="el-block el-newsletter">
                    <h2>Ne manquez pas nos nouveautés et nos offres</h2>
                    <p>Depuis plus de 20 ans que nous sommes importateur fournisseur d’objets publicitaires et d’articles promotionnels et cadeaux d’entreprise à Casablanca – MAROC.</p>
                    <form>
                        <input type="email" placeholder="Votre adresse mail" />
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
                <div class="el-block el-reseaux">
                    <h2>Suivez-nous sur:</h2>
                    <ul>
                        <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fab fa-instagram"></i></a></li>
                        <li><a href=""><i class="fab fa-twitter"></i></a></li>
                        <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href=""><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </article>
            <p class="el-copyright">
                Copyright © 2021 Planet Design
            </p>
        </div>
    </footer>
</main>
<div id="el-whatsapp-container">
    <p class="el-info">
        Besoin d'aide? <strong> Discuter avec nous </strong>
    </p>
    <button>
        <svg id="el-plus-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 12H20M12 4V20" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg id="el-whatsapp-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.6 6.31999C16.8669 5.58141 15.9943 4.99596 15.033 4.59767C14.0716 4.19938 13.0406 3.99622 12 3.99999C10.6089 4.00135 9.24248 4.36819 8.03771 5.06377C6.83294 5.75935 5.83208 6.75926 5.13534 7.96335C4.4386 9.16745 4.07046 10.5335 4.06776 11.9246C4.06507 13.3158 4.42793 14.6832 5.12 15.89L4 20L8.2 18.9C9.35975 19.5452 10.6629 19.8891 11.99 19.9C14.0997 19.9001 16.124 19.0668 17.6222 17.5816C19.1205 16.0965 19.9715 14.0796 19.99 11.97C19.983 10.9173 19.7682 9.87634 19.3581 8.9068C18.948 7.93725 18.3505 7.05819 17.6 6.31999ZM12 18.53C10.8177 18.5308 9.65701 18.213 8.64 17.61L8.4 17.46L5.91 18.12L6.57 15.69L6.41 15.44C5.55925 14.0667 5.24174 12.429 5.51762 10.8372C5.7935 9.24545 6.64361 7.81015 7.9069 6.80322C9.1702 5.79628 10.7589 5.28765 12.3721 5.37368C13.9853 5.4597 15.511 6.13441 16.66 7.26999C17.916 8.49818 18.635 10.1735 18.66 11.93C18.6442 13.6859 17.9355 15.3645 16.6882 16.6006C15.441 17.8366 13.756 18.5301 12 18.53ZM15.61 13.59C15.41 13.49 14.44 13.01 14.26 12.95C14.08 12.89 13.94 12.85 13.81 13.05C13.6144 13.3181 13.404 13.5751 13.18 13.82C13.07 13.96 12.95 13.97 12.75 13.82C11.6097 13.3694 10.6597 12.5394 10.06 11.47C9.85 11.12 10.26 11.14 10.64 10.39C10.6681 10.3359 10.6827 10.2759 10.6827 10.215C10.6827 10.1541 10.6681 10.0941 10.64 10.04C10.64 9.93999 10.19 8.95999 10.03 8.56999C9.87 8.17999 9.71 8.23999 9.58 8.22999H9.19C9.08895 8.23154 8.9894 8.25465 8.898 8.29776C8.8066 8.34087 8.72546 8.403 8.66 8.47999C8.43562 8.69817 8.26061 8.96191 8.14676 9.25343C8.03291 9.54495 7.98287 9.85749 8 10.17C8.0627 10.9181 8.34443 11.6311 8.81 12.22C9.6622 13.4958 10.8301 14.5293 12.2 15.22C12.9185 15.6394 13.7535 15.8148 14.58 15.72C14.8552 15.6654 15.1159 15.5535 15.345 15.3915C15.5742 15.2296 15.7667 15.0212 15.91 14.78C16.0428 14.4856 16.0846 14.1583 16.03 13.84C15.94 13.74 15.81 13.69 15.61 13.59Z" fill="#ffffff"/>
        </svg>
    </button>
    <section id="el-popup-whatsapp">
        <header class="el-popup-header">
            <h2>Démarrer une conversation</h2>
            <p>Salut! Cliquez sur l'un de nos membres ci-dessous pour discuter sur WhatsApp</p>
        </header>
        <main class="el-el-popup-content">
            <p class="el-info">L'équipe répond généralement en quelques minutes.</p>
            <article class="el-user-info">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=212666616475">
                    <div class="el-icon">
                        <img src="{{ asset('assets/img/1wqa1.jpeg')}}" alt="">
                    </div>
                    <p>(212) 666 616 475</p>
                </a>
            </article>
            <article class="el-user-info">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=212662015268">
                    <div class="el-icon">
                        <img src="{{ asset('assets/img/1wqa1.jpeg')}}" alt="">
                    </div>
                    <p>(212) 662 015 268</p>
                </a>
            </article>
        </main>
    </section>
</div>
    @section('scripts')
        <!-- JQUERY -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> -->
        <script src="{{ asset('js/cdnjs.cloudflare.com_ajax_libs_jquery_1.12.0_jquery.min.js') }}"></script>
        <!-- OWL CAROUSEL -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
        <script src="{{ asset('js/cdnjs.cloudflare.com_ajax_libs_OwlCarousel2_2.3.4_owl.carousel.min.js') }}"></script>
        <!-- FONT AWESOME -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script> -->
        <script src="{{ asset('js/font-awesome-all.min.js') }}"></script>
        <!-- SWEET ALERT -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const el_container_search = document.querySelector('.el-container-search');

            document.querySelector('.el-btn-search').addEventListener('click', () => {
                el_container_search.classList.add('el-active');
            });
            document.querySelector('.el-container-search .el-btn').addEventListener('click', () => {
                el_container_search.classList.remove('el-active');
            });
        </script>
        <script>
            $(document).ready(function(){

                $("#el-forces .owl-carousel").owlCarousel({
                    items: 1,
                    loop: true,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 1000,
                    smartSpeed: 1500,
                    autoplayHoverPause: true,
                    center: true,
                    responsiveClass: true,
                    responsive:{
                        0: {
                            items: 1
                        },
                        769: {
                            items: 2,
                            center: false,
                            margin: 20
                        }
                    }
                });
                $(".owl-carousel").owlCarousel({
                    items: 1,
                    loop: true,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 1000,
                    smartSpeed: 1500,
                    autoplayHoverPause: true
                });
            });

            window.addEventListener('scroll', e => {
                let el_header_page = document.getElementById('el-header-page');
                el_header_page.classList.toggle('el-active', window.scrollY > 0)
            });

            const btn_menu_phone = document.querySelector("#el-navbar-phone .el-btn");
            btn_menu_phone.addEventListener('click', () => {
                btn_menu_phone.classList.toggle('el-active');
                document.querySelector("#el-container-menu-phone").classList.toggle('el-active');
            });

            const headers = document.querySelectorAll(".accordion-header");
            headers.forEach(header => {
                header.addEventListener("click", function() {
                    this.classList.toggle("active");
                    const content = this.nextElementSibling;
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        this.querySelector(".svg-inline--fa").classList.remove("fa-angle-up");
                        this.querySelector(".svg-inline--fa").classList.add("fa-angle-down");
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                        this.querySelector(".svg-inline--fa").classList.remove("fa-angle-down");
                        this.querySelector(".svg-inline--fa").classList.add("fa-angle-up");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function(){

                $('.main-carousel').owlCarousel({
                    items: 1,
                    loop: true,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 1 },
                        1000: { items: 1 }
                    }
                });

                $('.nav-carousel').owlCarousel({
                    items: 2,
                    loop: true,
                    nav: false,
                    dots: true,
                    margin: 10,
                    //center: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    responsiveClass: true,
                    /* responsive: {
                      0: { items: 3 },
                      600: { items: 3 },
                      1000: { items: 3 }
                    } */
                });

            });
        </script>
        <script>
            const whatsappContainer = document.getElementById('el-whatsapp-container');
            const whatsappBtn = whatsappContainer.querySelector('#el-whatsapp-container button');
            const el_info = whatsappContainer.querySelector('#el-whatsapp-container > .el-info');
            const el_plus_icon = whatsappBtn.querySelector('#el-whatsapp-container button #el-plus-icon');
            const el_whatsapp_icon = whatsappBtn.querySelector('#el-whatsapp-container button #el-whatsapp-icon');
            const el_popup_whatsapp = whatsappContainer.querySelector('#el-popup-whatsapp');
            whatsappBtn.addEventListener('click', () => {
                whatsappContainer.classList.toggle('el-active')
                // Réinitialisation des animations
                if (whatsappContainer.classList.contains('el-active')) {
                    //whatsappBtn.style.animation = 'none';
                    el_whatsapp_icon.style.transform = "translate(-50%, -50%) rotate(180deg)";
                    el_whatsapp_icon.style.opacity = "0";
                    el_plus_icon.style.transform = "translate(-50%, -50%) rotate(180deg)";
                    el_plus_icon.style.opacity = "1";
                    el_popup_whatsapp.style.opacity = "1";
                    el_popup_whatsapp.style.transform = "translateY(-20px)";
                    el_popup_whatsapp.style.visibility = "visible";
                    el_popup_whatsapp.style.pointerEvents = "auto";
                    el_info.style.opacity = "0";
                    el_info.style.transform = "translateY(20px)";
                    el_info.style.visibility = "hidden";
                    el_info.style.pointerEvents = "none";
                }else{
                    el_whatsapp_icon.style.transform = "translate(-50%, -50%)";
                    el_whatsapp_icon.style.opacity = "1";
                    el_plus_icon.style.transform = "translate(-50%, -50%)";
                    el_plus_icon.style.opacity = "0";
                    el_popup_whatsapp.style.opacity = "0";
                    el_popup_whatsapp.style.transform = "translateY(40px)";
                    el_popup_whatsapp.style.visibility = "hidden";
                    el_popup_whatsapp.style.pointerEvents = "none";
                    el_info.style.opacity = "1";
                    el_info.style.transform = "translateY(0)";
                    el_info.style.visibility = "visible";
                    el_info.style.pointerEvents = "auto";
                }
            })
        </script>
        @if(session()->has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Valide',
                    text: "{!! session('success') !!}"
                });
            </script>
        @elseif(session()->has('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "{!! session('error') !!}"
                });
            </script>
        @elseif(session()->has('warning'))
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Votre attention',
                    text: "{!! session('warning') !!}"
                });
            </script>
        @elseif(session()->has('info'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Information',
                    text: "{!! session('info') !!}"
                });
            </script>
        @elseif($errors->any())
            <script>
                var errorMessages = "<ul>";
                @foreach ($errors->all() as $error)
                    errorMessages += "<li>{{ $error }}</li>";
                @endforeach
                    errorMessages += "</ul>";

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: errorMessages
                });
            </script>
        @endif
    @show
</body>
</html>
