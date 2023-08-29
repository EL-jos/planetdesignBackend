@extends('admin.form')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $type->exists ? "Modifier le type" : "Ajouter un type" }} </h6>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <form method="post" action="{{ $type->exists ? route('type.update', $type) : route('type.store', $type) }}">
                        @csrf
                        @method($type->exists ? 'put' : 'post')
                        <div class="mb-3 input-group input-group-outline">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="name" value="{{ $type->name }}" />
                        </div>

                        {{--<div class="mb-3 input-group input-group-outline">
                            <select class="form-select" aria-label="Default select example" name="rubric_id">
                                <option selected disabled>Open this select menu</option>
                                @foreach($rubrics as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>--}}

                        {{--<div class="mb-3 input-group input-group-outline">
                            <label>Description</label>
                            <textarea class="ckeditor form-control" id="description" name="description"></textarea>
                        </div>--}}

                        <button type="submit" class="btn btn-primary">
                            @if($type->exists)
                                Modifier
                            @else
                                Ajouter
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
    @parent
@endsection
