<form method="POST" action="{{ route('addQuote.article', $article) }}" hx-post="{{ route('addQuote.article', $article) }}" hx-target=".el-article .el-content #el-content-{{$article->id}}">
    @csrf
    <div class="el-row">
        <div class="el-col">
            <select id="color_id" name="color_id[]" multiple>
                @foreach($article->colors as $color)
                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="el-row">
        <div class="el-col">
            <input type="number" min="0" name="quantity" />
        </div>
    </div>
    <p class="el-disponibility">{{ $article->availability->name }}</p>
    <button type="submit" class="el-btn">Enregistrer</button>
</form>
