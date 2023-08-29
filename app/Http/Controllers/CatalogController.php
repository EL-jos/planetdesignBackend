<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * @param Catalog $catalog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Catalog $catalog){
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }
        //dd($catalog);
        if($catalog->delete()){
            return back()->with('success', "Article supprimé de votre catalogue avec succès");
        }
        return back()->with('error', "Impossible de supprimer cet article de votre catalogue");
    }

    /**
     * @param User $user
     */
    public function generateCatalogPdf(User $user){
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }

        $articles = collect([]);
        foreach ($user->catalogs as $catalog){
            $articles->push($catalog->article);
        }
        //dd($articles->first()->first_image);
        return Pdf::loadView('generate-pdf-catalog', [
            'articles' => $articles
        ])->stream('mon_catalogue.pdf');
//        return view('generate-pdf-catalog', [
//            'articles' => $articles
//        ]);
    }
}
