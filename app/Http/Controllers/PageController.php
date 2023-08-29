<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Availability;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Color;
use App\Models\Deal;
use App\Models\Favorite;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;
use Jorenvh\Share\Share;

class PageController extends Controller
{
    public function home(){
        //dd(Category::with('subcategories')->get());
        return view('home', [
            'categories' => Category::with('subcategories')->get(),
        ]);
    }

    public function category(Category $category){

        return view('category');
    }

    public function article(){
        return view('article');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function catalog(User $user){
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }
        $share = new Share();
        $socialNetworks = $share->page(route('catalog.page', $user), "Catalogue de " .$user->lastname .' '. $user->firstname)
            ->facebook()
            ->twitter()
            ->pinterest()
            ->linkedin()
            ->whatsapp();

        return view('catalog', [
            'user' => $user,
            'socialNetworks' => $socialNetworks
        ]);
    }

    /**
     * @param User $user
     */
    public function favorites(User $user){
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }

        $share = new Share();
        $socialNetworks = $share->page(route('favorites.page', $user), "Catalogue de " .$user->lastname .' '. $user->firstname)
            ->facebook()
            ->twitter()
            ->pinterest()
            ->linkedin()
            ->whatsapp();

        return view('favorites', [
            'user' => $user,
            'socialNetworks' => $socialNetworks
        ]);
    }

    /**
     *
     * @param User $user
     */

    public function quote(User $user){
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }

        return view('quote', [
            'user' => $user
        ]);
    }

    public function arrival(){
        $articles = Article::where('availability_id', '=', 1)->get();
        return view('arrival', [
            'title' => 'Nouvel arrivage',
            'description' => "Voici notre sélection de notre nouvel arrivage",
            'colors' => Color::all(),
            'materials' => Material::all(),
            'articles' => $articles
        ]);
    }

    public function destocking(){
        $articles = Article::where('availability_id', '=', 5)->get();
        return view('arrival', [
            'title' => 'Déstockage',
            'description' => 'Des prix exceptionnels sur une sélection d’articles',
            'colors' => Color::all(),
            'materials' => Material::all(),
            'articles' => $articles
        ]);
    }

    public function business(){
        return view('business', [
            'deals' => Deal::all()
        ]);
    }

    public function catalogs(){
        return view('catalogs', [
            'banners' => Banner::all()
        ]);
    }

    public function identification(){
        return view('identification');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function addQuote(Request $request, Article $article){

        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }
        if($request->attributes->has('htmx')){
            return view('layouts.article.form', ['article' => $article]);
        }
        return response()->json(['article' => $article]);
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function addCatalog(Request $request, Article $article){

        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }
        if($request->attributes->has('htmx')){
            return view('layouts.article.form-catalog', ['article' => $article]);
        }
        return response()->json(['article' => $article]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request){
        //dd($request->all());
        $keyword = '%' . htmlentities($request->input('Keyword')) . '%';
        $articles = Article::where('reference', 'LIKE', $keyword)
            ->orWhere('description', 'LIKE', $keyword)
            ->get();
        //dd($keyword, $articles);
        return view('search', [
            'Keyword' => $request->input('Keyword'),
            'articles' => $articles
        ]);
    }
}
