<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Image $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //dd($image);
        if($image->imageable_type === 'App\Models\Article'){
            $image->delete();
        }else{

            if($image->delete()){
                return view('admin.layouts.picture')->render();
            }else{
                return response()->json(['message' => "Impossible de supprimer l'image", 'code' => 1]);
            }
        }

    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function updateImageOrder(Request $request){
        //dd($request->all());
        $imageIds = json_decode($request->input('imageIds'));
        $articleId = $request->input('article_id');

        // Récupérez l'article associé
        $article = Article::findOrFail($articleId);

        // Récupérez les images liées à l'article dans l'ordre actuel
        $images = $article->images;

        // Mettez à jour l'ordre des images en fonction des identifiants triés
        foreach ($imageIds as $index => $imageId) {
            $image = $images->where('id', $imageId)->first();
            if ($image) {
                $image->update(['priority' => $index + 1]);
            }
        }
        // Retournez une réponse appropriée (par exemple, un message de succès)
        return response()->json(['message' => 'L\'ordre des images a été mis à jour avec succès.', 'code' => 0]);
    }
}
