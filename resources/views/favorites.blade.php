@extends('base')

@section('title', "Mes Devis")

@section('head')
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
    <!-- TOM SELECT -->
    <link href="{{ asset('css/tom-select.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    @parent
@endsection

@section('main-content')
    <section id="el-path" class="el-center-box">
        <div class="el-content-area">
            <ul>
                <li><a href="{{ route('home.page') }}">Accueil</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span>Favoris</span></li>
            </ul>
        </div>
    </section>
    <section id="el-favoris" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid-favoris">
                <div class="el-container-table">
                    <table id="table_id">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Ajouter</th>
                            <th>Disponibilite</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($user->favorites as $favorite)
                                <tr>
                                    <td><img src="{{ asset($favorite->article->first_image) }}" alt=""></td>
                                    <td>
                                        <h4><a href="{{ route('article.show', $favorite->article) }}">{{ $favorite->article->name }}</a></h4>
                                    </td>
                                    <td><p>{{ \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $favorite->article->created_at)->format('d/m/Y') }}</p></td>
                                    <td><p>{{ $favorite->article->availability->name }}</p></td>
                                    <td class="el-controls">
                                        <a href="{{ route('favorite.quote', ['user' => $user, 'article' => $favorite->article]) }}" class="el-btn el-info el-center-box"><i class="far fa-file-alt"></i></a>
                                        <a href="javascript:;" onclick="document.getElementById('el-delete-favorite-{{ $favorite->id }}').submit()" class="el-btn el-danger el-center-box">
                                            <form action="{{ route("favorite.destroy", $favorite) }}" method="POST" id="el-delete-favorite-{{ $favorite->id }}">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="el-container-back-and-share">
                    <a href="" class="el-back">Continuer le Shopping</a>
                    <div class="el-container-share">
                        <p>Partager sur:</p>
                        {!! $socialNetworks !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/af-2.4.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                paging: false,
                searching: false,
                select: true,
                scrollY: 370,
                /* language: {
                    info: "Horaire de prière pour le mois en cours",
                }, */
                responsive: true
            });
        } );
    </script>
    <script>
        const selectsMultiple = document.querySelectorAll("select[multiple]");
        selectsMultiple.forEach(select => {
            new TomSelect(select, {plugins: {remove_button: {title: 'Supprimer'}}})
        });
    </script>
@endsection
