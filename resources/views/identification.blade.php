@extends('base')

@section('title', "Identification")

@section('main-content')
    <section id="el-path" class="el-center-box">
        <div class="el-content-area">
            <ul>
                <li><a href="">Accueil</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li><span>Nos Catalogue</span></li>
            </ul>
        </div>
    </section>
    <section id="el-identification" class="el-center-box">
        <div class="el-content-area">
            <div class="el-grids-identification">
                <article>
                    <form action="{{ route('login.user') }}" method="POST">
                        @csrf
                        <legend>Se connecter</legend>
                        <div class="el-row">
                            <div class="el-col">
                                <input type="text" id="email" name="email" required>
                                <label for="email">E-mail *</label>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col el-one">
                                <input type="password" id="password" name="password" required>
                                <label for="password">Password*</label>
                            </div>
                        </div>
                        <button type="submit" class="el-btn">Se connecter</button>
                    </form>
                </article>
                <article>
                    <form action="{{ route('register.user') }}" method="POST">
                        @csrf
                        <legend>S'enregistrer</legend>
                        <div class="el-row">
                            <div class="el-col">
                                <input type="text" id="lastname" name="lastname" required>
                                <label for="lastname">Prénom*</label>
                            </div>
                            <div class="el-col">
                                <input type="text" id="firstname" name="firstname" required>
                                <label for="firstname">Nom*</label>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <input type="email" id="email" name="email" required>
                                <label for="email">E-mail*</label>
                            </div>
                            <div class="el-col">
                                <input type="text" id="company" name="company">
                                <label for="company">Société</label>
                            </div>
                        </div>
                        <div class="el-row">
                            <div class="el-col">
                                <input type="password" id="mdp" name="mdp" required>
                                <label for="mdp">Mot de passe</label>
                            </div>
                            <div class="el-col">
                                <input type="password" id="mdp_confirmation" name="mdp_confirmation" required>
                                <label for="mdp_confirmation">Confirmez le mot de passe</label>
                            </div>
                        </div>
                        <button type="submit" class="el-btn">S'enregistrer</button>
                    </form>
                </article>
            </div>
        </div>
    </section>
@endsection

