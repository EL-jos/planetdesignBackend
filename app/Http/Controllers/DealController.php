<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Deal;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.deal.index', [
            'deals' => Deal::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.deal.form', [
            'deal' => new Deal(),
            'articles' => Article::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validators = Validator::make($request->all(), [
            'article_id' => 'required|unique:deals,article_id|exists:articles,id',
            'picture' => 'required|image'
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $deal = Deal::create($request->only('article_id'));
        //$banner = Banner::find(1);
        //dd($banner);
        if ($deal){

            $image = new Image();
            $image->id = (string) Str::uuid();
            $image->path = $this->moveImage($request->picture); // Enregistre la nouvelle image
            $deal->image()->save($image);

            return redirect()->route('deal.index')->with('success', "Affaire ajoutée avec succès");
        }else{
            return  back()->with('error', "Impossible d'ajouter cette affaire")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Deal $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        return view('admin.deal.form', [
            'deal' => $deal,
            'articles' => Article::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Deal $deal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        $validators = Validator::make($request->all(), [
            'article_id' => 'required|unique:deals,article_id|exists:articles,id',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        if ($deal->update(['article_id' => $request->input('article_id')])){

            return redirect()->route('deal.index')->with('success', "Mise à jour réussit");
        }
        return back()->with('error', "Impossible de mettre à jour le catalogue")->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadPhoto(Request $request, Deal $deal){
//
        if ($request->picture->isValid()) {

            if (!$deal) {
                return response()->json(['message' => 'Impossible de trouver l\'affaire correspondant', 'code' => 1]);
            }

            // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
            $image = $deal->image;

            if ($image) {
                // Si l'image existe déjà, mettez à jour le champ "url"
                $this->deleteImage($image->url); // Supprime l'ancienne image si nécessaire
                $image->path = $this->moveImage($request->picture); // Met à jour le champ "url"
                $image->save();
            }else {
                // Si l'image n'existe pas, créez un nouvel enregistrement dans la table "images"
                $image = new Image();
                $image->id = (string) Str::uuid();
                $image->path = $this->moveImage($request->picture); // Enregistre la nouvelle image
                $deal->image()->save($image);
            }


            return response()->json(['message' => 'Votre Image a bien été mis à jour', 'code' => 0]);
        }
        return response()->json(['message' => 'Aucune image trouvée.', 'code' => 1]);
    }

    // Méthode pour déplacer l'image et retourner l'URL de l'image déplacée
    private function moveImage($file)
    {
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('Ymd_His');

        $path_file = $formattedDateTime . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/deals/'), $path_file);

        return "assets/deals/" . $path_file;
    }

    // Méthode pour supprimer une image
    private function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
