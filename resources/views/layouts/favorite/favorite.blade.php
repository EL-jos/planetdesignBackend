@php
    $isFavorite = \App\Models\Favorite::where(['user_id' => $user->id, 'article_id' => $article->id])->exists();
@endphp
<i class="{{ $isFavorite ? 'fas' : 'far' }} fa-heart"></i>

@if(request()->attributes->has('htmx'))
    <script>
        document.getElementById('el-nb-favorite').textContent = '{{ $user->favorites->count() }}'
    </script>
@endif