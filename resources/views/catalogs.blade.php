@extends('base')

@section('title', "Nos Catalogues")

@section('main-content')
    <section id="el-path" class="el-center-box">
        <div class="el-content-area">
            <ul>
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span>Nos Catalogues</span></li>
            </ul>
        </div>
    </section>
    <section id="el-catalogs" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid-catalogs">
                @foreach($banners as $banner)
                    <a target="_blank" href="{{ $banner->url }}" class="el-catalog"><img src="{{ asset($banner->image->path) }}" alt=""></a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
