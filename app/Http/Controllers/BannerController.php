<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banner.index', [
            'banners' => Banner::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.form', [
            'banner' => new Banner()
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
            'url' => 'required|url|unique:banners',
            'picture' => 'required|image'
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $banner = Banner::create($request->only('url'));
        //$banner = Banner::find(1);
        //dd($banner);
        if ($banner){

            $image = new Image();
            $image->id = (string) Str::uuid();
            $image->path = $this->moveImage($request->picture); // Enregistre la nouvelle image
            $banner->image()->save($image);

            return redirect()->route('banner.index')->with('success', "Catalogue ajouté avec succès");
        }else{
            return  back()->with('error', "Impossible d'ajouter cet catalogue")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.form', [
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $validators = Validator::make($request->all(), [
            'url' => 'required|url'
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        if( $banner->update(['url' => $request->input('url')]) ){
            return redirect()->route('banner.index')->with('success', "Mise à jour réussit");
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


    public function uploadPhoto(Request $request, Banner $banner){
//
        if ($request->picture->isValid()) {

            if (!$banner) {
                return response()->json(['message' => 'Impossible de trouver le catalogue correspondant', 'code' => 1]);
            }

            // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
            $image = $banner->image;

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
                $banner->image()->save($image);
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
        $file->move(public_path('assets/catalogs/'), $path_file);

        return "assets/catalogs/" . $path_file;
    }

    // Méthode pour supprimer une image
    private function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
