@extends('base')

@section('title', "Bonnes Affaires")

@section('main-content')
    <section id="el-path" class="el-center-box">
        <div class="el-content-area">
            <ul>
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span>Bonnes affaires</span></li>
            </ul>
        </div>
    </section>
    <section id="el-catalogs" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid-catalogs">
                @foreach($deals as $deal)
                    <a target="_blank" href="{{ route('article.show', $deal->article) }}" class="el-catalog">
                        <img src="{{ asset($deal->image ? $deal->image->path : '') }}" alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
