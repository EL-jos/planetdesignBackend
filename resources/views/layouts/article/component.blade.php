@foreach($articles as $article)
    <article class="el-article">
        <div class="el-boxImg">
            <a href="{{ route('article.show', $article) }}">
                <img src="{{ asset($article->images->first()->path) }}" alt="">
            </a>
            <a href="javascript:;"
               hx-get="{{ route('favorite', ['user' => $user, 'article' => $article]) }}"
               hx-trigger="click"
               class="el-favorite">
                @include('layouts.favorite.favorite', ['user' => $user, 'article' => $article])
            </a>
        </div>
        <div class="el-content">
            <a href="{{ route('article.show', $article) }}"><h2 class="el-name-article">{{ $article->name }}</h2></a>
            <div id="el-content-{{$article->id}}">
                @include('layouts.article.content', ['article' => $article, 'user' => $user])
            </div>
        </div>
    </article>
@endforeach