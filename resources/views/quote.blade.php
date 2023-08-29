@extends('base')

@php
    $user = session()->has('user')
    ? \App\Models\User::find(session('user'))
    : new \App\Models\User();
@endphp

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
                <li><span>Devis</span></li>
            </ul>
        </div>
    </section>
    <section id="el-favoris" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grid-favoris">
                <a href="" class="el-btn">Retour à la boutique</a>
                <div class="el-container-table">
                    <table id="table_id">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Quantité</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->quotes as $quote)
                                <tr>
                                    <td><img src="{{ asset($quote->article->first_image) }}" alt=""></td>
                                    <td>
                                        <h4><a href="{{ route('article.show', $quote->article) }}">{{ $quote->article->name }}</a></h4>
                                        <ul>
                                            @foreach($quote->colors as $color)
                                                <li>{{ $color->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @include('layouts.quote.quantity', ['quote' => $quote])
                                    </td>
                                    <td class="el-controls">
                                        <a href="javascript:;" onclick="document.getElementById('el-form-delete-{{ $quote->id }}').submit()" class="el-btn el-danger el-center-box">
                                            <form id="el-form-delete-{{ $quote->id }}" action="{{ route('quote.destroy', $quote) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($user->exists && $user->quotes->count())
                    <div class="el-list-controls">
                        <a href="javascript:;" class="el-btn" onclick="document.getElementById('el-form-clear-quote-list').submit()">
                            <form id="el-form-clear-quote-list" method="POST" action="{{ route('destroyAllQuoteOfThisUser.quote', $user) }}">
                                @csrf
                                @method('DELETE')
                            </form>
                            Nettoyer la liste
                        </a>
                        <a href="" class="el-btn">Retour à la boutique</a>
                    </div>
                    <form action="{{ route('sendDevis.quote', $user) }}" method="POST">
                        @csrf
                        <div class="el-row">
                            <div class="el-col">
                                <input type="text" value="{{ $user->lastname }}" id="lastname" name="lastname" required>
                                <label for="lastname">Prénom*</label>
                            </div>
                            <div class="el-col">
                                <input type="text" value="{{ $user->firstname }}" id="firstname" name="firstname" required>
                                <label for="firstname">Nom*</label>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col el-one">
                                <input type="email" value="{{ $user->email }}" id="email" name="email" required>
                                <label for="email">E-mail*</label>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <input type="text" value="{{ $user->company }}" id="company" name="company">
                                <label for="company">Société</label>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <textarea name="content" id="content" required></textarea>
                                <label for="content">Message*</label>
                            </div>
                        </div>
                        <button type="submit" class="el-btn">Envoyez votre demande</button>
                    </form>
                @endif
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
