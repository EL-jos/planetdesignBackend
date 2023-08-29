<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Favorite;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FavoriteController extends Controller
{
    /**
     * @param User $user
     * @param Article $article
     *
     */
    public function toggle(User $user, Article $article){
        //dd($user, $article, );
        switch ($user->toggleFavorite($article->id)){
            case 'added':
                return view('layouts.favorite.favorite', [
                    'article' => $article,
                    'user' => $user,
                ]);
                break;
            case 'removed':
                return view('layouts.favorite.favorite', [
                    'article' => $article,
                    'user' => $user,
                ]);
                break;
        }
    }

    /**
     * @param Favorite $favorite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Favorite $favorite){
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }

        if($favorite->delete()){
            return back()->with('success', "Favoris supprimer avec succès");
        }
        return back()->with('error', "Impossible de supprimer cet favoris");
    }

    /**
     * @param User $user
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToQuote(User $user, Article $article){

        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warnin', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }
        //dd($user, $article);

        $quote = Quote::create([
            'id' => (string) Str::uuid(),
            'article_id' => $article->id,
            'user_id' => $user->id,
            'quantity' => 1
        ]);

        if($quote){
            Favorite::where([
                'user_id' => $user->id,
                'article_id' =>$article->id,
            ])->delete();
            return redirect()->route('quote.page', [
                'user' => $user
            ])->with('success', "Favoris ajouté au devis avec success");
        }else{
            return back()->with('error', "Impossible d'ajouter cet favoris au devis");
        }
    }
}
