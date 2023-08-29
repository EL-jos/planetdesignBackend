@extends('admin.rubrique')

@section('main-content')
    {{--<form method="post" action="{{ route('article.create') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 input-group input-group-outline">
            <select class="form-control" name="categorie_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 input-group input-group-outline">
            <select class="form-control" name="city_id">
                @foreach($cities as $citie)
                    <option value="{{ $citie->id }}">{{ $citie->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 input-group input-group-outline">
            <label class="form-label">Prix</label>
            <input type="number" class="form-control" name="price" />
        </div>
        <div class="mb-3 input-group input-group-outline">
            <label class="form-label">Adresse</label>
            <input type="text" class="form-control" name="address" />
        </div>
        <div class="mb-3 input-group input-group-outline">
            <label class="form-label">Résumé</label>
            <input type="text" class="form-control" name="resume" />
        </div>
        <div class="mb-3 input-group input-group-outline">
            <input class="form-control" type="file" id="picture" name="picture[]" multiple>
        </div>
        <div class="mb-3 input-group input-group-outline">
            <label>Description</label>
            <textarea class="ckeditor form-control" id="description" name="description"></textarea>
        </div>
        @include('shared.control', ['type' => 'number', 'name' => 'test', 'value' => 5000, 'label' => 'test'])
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>--}}
    @yield('main')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
    @parent

    {{--<script>
        new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
    </script>--}}
@endsection
