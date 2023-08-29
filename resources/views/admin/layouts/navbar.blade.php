@php
    $route = request()->route()->getName()
@endphp
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="{{ asset('assets/admin/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Material Dashboard 2</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'category.')]) href="{{ route('category.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'subcategory.')]) href="{{ route('subcategory.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Sous catégorie</span>
                </a>
            </li>
           <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'color.')]) href="{{ route('color.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Couleurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'material.')]) href="{{ route('material.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Matières</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'availability.')]) href="{{ route('availability.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Disponibilités</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'article.')]) href="{{ route('article.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Articles</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'banner.')]) href="{{ route('banner.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Banners</span>
                </a>
            </li>
            <li class="nav-item">
                <a @class(['nav-link text-white', 'active bg-gradient-primary' => str_contains($route, 'deal.')]) href="{{ route('deal.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Affaires</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link text-white " href="notifications.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">Notifications</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="profile.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="sign-in.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="sign-up.html">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li>--}}
        </ul>
    </div>
</aside>
