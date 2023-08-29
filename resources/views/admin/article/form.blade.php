@extends('admin.form')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $article->exists ? "Modifier l'article" : "Ajouter un article" }} </h6>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <form method="post" action="{{ $article->exists ? route('article.update', $article) : route('article.store', $article) }}" enctype="multipart/form-data">
                        @csrf
                        @method($article->exists ? 'put' : 'post')

                        <div class="d-flex gap-2">
                            <div class="mb-3 input-group input-group-outline">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control" name="name" value="{{ $article->name }}" />
                            </div>
                            <div class="mb-3 input-group input-group-outline">
                                <label class="form-label">Référence</label>
                                <input type="text" class="form-control" name="reference" value="{{ $article->reference }}" />
                            </div>
                        </div>

                        <div class="mb-3 input-group input-group-outline">
                            <select id="subcategory_id" class="form-control" name="subcategory_id">
                                @foreach($subcategories as $subcategory)
                                    <option @if($article->exists && $article->subcategory !== null && $article->subcategory->id === $subcategory->id) selected @endif value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <div class="mb-3">
                                <select id="color_id" multiple class="form-control" name="color_id[]">
                                    @foreach($colors as $color)
                                        @if($article->exists && $article->colors->contains($color->id))
                                            <option selected value="{{ $color->id }}">{{ $color->name }}</option>
                                        @else
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <select id="material_id" class="form-control" multiple name="material_id[]">
                                    @foreach($materials as $material)
                                        @if($article->exists && $article->materials->contains($material->id))
                                            <option selected value="{{ $material->id }}">{{ $material->name }}</option>
                                        @else
                                            <option value="{{ $material->id }}">{{ $material->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <select id="availability_id" class="form-control el-select" name="availability_id">
                                @foreach($availabilities as $availability)
                                    @if($article->exists && $article->availability->id === $availability->id)
                                        <option selected value="{{ $availability->id }}">{{ $availability->name }}</option>
                                    @else
                                        <option value="{{ $availability->id }}">{{ $availability->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        @if($article->exists)
                            @if($article->images->count())
                                <div class="mb-3 d-flex flex-column gap-2">
                                    <div id="sortable-images" style="display: grid; grid-template-columns: repeat(auto-fit, 100px); grid-gap: 1rem;">
                                        @foreach($article->images as $image)
                                            <div id="el-block-{{ $loop->index }}" class="mb-3 el-container" data-image-id="{{ $image->id }}">
                                                <img src="{{ asset($image->path) }}" alt="..." class="img-thumbnail">
                                                <button class="el-remove"
                                                        hx-delete="{{ route('image.destroy', $image) }}"
                                                        hx-target="#el-block-{{ $loop->index }}"
                                                        hx-trigger="click">
                                                    X
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mb-3">
                                        <input class="picture" type="file" name="picture[]" multiple>
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <input class="picture" type="file" name="picture[]" multiple>
                                </div>
                            @endif

                        @else
                            <div class="mb-3 input-group input-group-outline">
                                <input class="form-control" type="file" multiple name="picture[]">
                            </div>
                        @endif

                        <div class="mb-3 input-group input-group-outline">
                            <label>Description</label>
                            <textarea class="ckeditor form-control" id="description" name="description"> {{ $article->description }} </textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if($article->exists)
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
    @parent
    <!-- HTMLX -->
    <script src="https://unpkg.com/htmx.org@1.9.4" crossorigin="anonymous"></script>
    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
    <!-- SELECT2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @if($article->exists)
        <!-- FILEPOND -->
        <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@4.26.0/dist/filepond.js"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginImageEdit);
            document.addEventListener('DOMContentLoaded', function () {
                // Sélectionnez l'élément de téléchargement par sa classe
                const inputElement = document.querySelector('.picture');

                // Initialisation de FilePond dans le formulaire
                const pond = FilePond.create(inputElement, {
                    labelFileProcessingComplete: 'Votre Photo a bien été mise à jour, Veillez actualiser la page',
                    labelFileProcessingError: 'Impossible de mettre à jour votre Photo',
                    labelIdle: 'Glisser-déposer votre image ou <span class="filepond--label-action"> Parcourir </span>',
                    server: {
                        process: {
                            url: '{{ route("uploadPhoto.article", $article) }}', // Remplacez par l'URL de votre action Laravel pour l'upload
                            method: 'POST',
                            withCredentials: false,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ajoutez le jeton CSRF dans les headers de la requête
                            }
                        },
                    }
                });
                // Charger l'aperçu de l'image actuelle
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var sortable = new Sortable(document.getElementById('sortable-images'), {
                    animation: 150, // Animation lors du déplacement
                    swap: true,
                    onEnd: function (event) {
                        // Code à exécuter lorsque le glisser-déposer est terminé
                        // event.oldIndex : index précédent de l'élément
                        // event.newIndex : nouvel index de l'élément
                        // event.item : élément déplacé
                        // Vous pouvez utiliser ces informations pour mettre à jour l'ordre des images dans votre base de données
                        //console.log(event)
                        var imageIds = Array.from(sortable.el.children).map(function (element) {
                            return element.getAttribute('data-image-id');
                        });
                        var formData = new FormData();
                        formData.append('imageIds', JSON.stringify(imageIds));
                        formData.append('article_id', {{ $article->id }});

                        axiosInstance = axios.create();
                        axiosInstance.defaults.onUploadProgress = function (progressEvent) {
                            var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);

                            // Afficher la progression dans un SweetAlert2
                            Swal.fire({
                                title: 'Envoi en cours...',
                                text: 'Progression : ' + percentCompleted + '%',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                                showConfirmButton: false,
                                showCancelButton: false,
                                showCloseButton: false,
                                html: '<div class="progress"><div class="progress-bar" role="progressbar" style="width: ' + percentCompleted + '%;"></div></div>'
                            });
                        };

                        axiosInstance.post('{{ route('updateImageOrder.image') }}', formData, {
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ajoutez le jeton CSRF dans les headers de la requête
                            }
                        })
                            .then(function (response) {
                                // Fermer le SweetAlert2
                                Swal.close();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Valide',
                                    text: `${response.message}`
                                });
                                console.log('Ordre des images mis à jour avec succès !');
                            })
                            .catch(function (error) {
                                Swal.close();
                                console.error('Erreur lors de la mise à jour de l\'ordre des images :', error);
                            });
                    }
                });
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            //$('select').select2();
            $('select#subcategory_id').select2({
                placeholder: 'Sous catégorie'
            });

            $('select#availability_id').select2({
                placeholder: 'Disponibilité'
            });
        });

        new TomSelect('select#material_id', {
            placeholder: "Matière(s)",
            plugins: {remove_button: {title: 'Supprimer'}}
        })
        new TomSelect('select#color_id', {
            placeholder: "Couleur(s)",
            plugins: {remove_button: {title: 'Supprimer'}}
        })
    </script>
@endsection
