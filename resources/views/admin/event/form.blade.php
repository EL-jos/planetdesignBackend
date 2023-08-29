@extends('admin.form')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $event->exists ? "Modifier l'événement" : "Ajouter un événement" }} </h6>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <form method="post" action="{{ $event->exists ? route('event.update', $event) : route('event.store', $event) }}" enctype="multipart/form-data">
                        @csrf
                        @method($event->exists ? 'put' : 'post')
                        @if($event->exists)
                            <input type="hidden" name="event_id" value="{{ $event->id }}" />
                        @endif
                        <div class="mb-3 input-group input-group-outline">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $event->title }}" />
                        </div>
                        <div class="d-flex gap-2">
                            <div class="mb-3 input-group input-group-outline">
                                <label class="form-label">Prix Standard</label>
                                <input type="number" class="form-control" name="price_standard" value="{{ $event->prices()->where('type_id', '=', 1)->first() ? $event->prices()->where('type_id', '=', 1)->first()->amount : null }}" />
                            </div>
                            <div class="mb-3 input-group input-group-outline">
                                <label class="form-label">Prix V.I.P</label>
                                <input type="number" class="form-control" name="price_vip" value="{{ $event->prices()->where('type_id', '=', 2)->first() ? $event->prices()->where('type_id', '=', 2)->first()->amount : null }}" />
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="is-focused mb-3 input-group input-group-outline">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" value="{{ $event->date }}" />
                            </div>
                            <div class="is-focused mb-3 input-group input-group-outline">
                                <label class="form-label">Heure</label>
                                <input type="time" class="form-control" name="time" value="{{ $event->time }}" />
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="mb-3 input-group input-group-outline">
                                <label class="form-label">Durée</label>
                                <input type="number" class="form-control" name="duration" value="{{ $event->duration }}" />
                            </div>
                            <div class="mb-3 input-group input-group-outline">
                                <label class="form-label">Lieu</label>
                                <input type="text" class="form-control" name="location" value="{{ $event->location }}" />
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="is-focused mb-3 input-group input-group-outline">
                                <label class="form-label">Categorie</label>
                                <select class="form-select form-control" aria-label="Default select example" name="category_id[]" multiple>
                                    @foreach($categories as $category)
                                        @if(isset($event->categories) && $event->categories->contains($category->id))
                                            <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="is-focused mb-3 input-group input-group-outline">
                                <label class="form-label">Organisateur</label>
                                <select class="form-select form-control" aria-label="Default select example" name="organiser_id">
                                    <option selected value=""></option>
                                    @foreach($organisers as $organiser)
                                        @if(isset($event->organiser) && $event->organiser->id == $organiser->id)
                                            <option selected value="{{ $organiser->id }}">{{ $organiser->name }}</option>
                                        @else
                                            <option value="{{ $organiser->id }}">{{ $organiser->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <div class="is-focused mb-3 input-group input-group-outline">
                                <label class="form-label">Miniature (300 x 180)</label>
                                <input type="file" class="form-control" name="path_miniature" />
                            </div>
                            <div class="is-focused mb-3 input-group input-group-outline">
                                <label class="form-label">Grande image</label>
                                <input type="file" class="form-control" name="path_large" />
                            </div>
                        </div>

                        <div class="mb-3 input-group input-group-outline">
                            <label>Description</label>
                            <textarea class="ckeditor form-control" id="description" name="description"> {{ $event->description }} </textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if($event->exists)
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
