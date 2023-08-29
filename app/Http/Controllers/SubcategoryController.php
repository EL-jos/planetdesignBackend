<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Material;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategory.index', [
            'subcategories' => Subcategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategory.form', [
            'categories' => Category::all(),
            'subcategory' => new Subcategory()
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
            'name' => 'required|min:3|unique:subcategories',
            'category_id' => 'required|min:1|max:12',
            'description' => 'required|min:3',
            //'email' => 'required|email:rfc,dns|unique:users',
            //'phone' => 'required|regex:/^\+243[ _-]?([0-9]{3}[ _-]?){3}$/',
            //'address' => 'required|min:10',
            //'sex_id' => 'required|numeric|min:1|max:2',
            //'city_id' => 'required|numeric|min:1|max:69',
            //'mdp' => 'required|min:6|required_with:mdp_confirmation|confirmed',
            //'mdp_confirmation' => 'required|min:6|same:mdp_confirmation',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $subcategory = Subcategory::create($request->except(['picture']));
        //$subcategory = Subcategory::find(1);
        if ($subcategory){

            $image = new Image();
            $image->id = (string) Str::uuid();
            $image->path = $this->moveImage($request->picture); // Enregistre la nouvelle image
            $subcategory->image()->save($image);

            return redirect()->route('subcategory.index')->with('success', "Sous categorie ajoutée avec succès");
        }else{
            return  back()->with('error', "Impossible d'ajouter cette sous categorie")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        // Vérifie si la page provient directement d'une catégorie
        $referer = request()->server('HTTP_REFERER');
        $isFromCategoryPage = strpos($referer, route('category.show', $subcategory->category)) !== false;

        // Incrémente le nombre de vues de la catégorie si la page ne provient pas de la catégorie
        if (!$isFromCategoryPage) {
            $subcategory->category->increment('view');
        }
        return view('subcategory', [
            'subcategory' => $subcategory,
            'colors' => Color::all(),
            'materials' => Material::all(),
            'availabilities' => Availability::all(),
            'articles' => $subcategory->articles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategory.form', [
            'subcategory' => $subcategory,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //dd($category, $request->all(), $request->file('picture'));
        $subcategory->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description')
        ]);

        // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
        /*$image = $subcategory->image;

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
            $subcategory->image()->save($image);
        }*/

        return redirect()->route('subcategory.index')->with('success', "Mise à jour réussit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        if($subcategory->delete()){
            return redirect()->route('subcategory.index', [
                'subcategories' => Subcategory::all()
            ])->with('success', 'Suppression réussit');
        }

        return back()->with('error', 'Impossible de supprimer cette sous catégorie');
    }

    public function deleted(){
        //dd(Category::onlyTrashed());
        return view('admin.subcategory.index', [
            'subcategories' => Subcategory::onlyTrashed()->get()
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function restore(int $id){

        $subcategory = Subcategory::withTrashed()->find($id);
        if($subcategory->restore()){
            return view('admin.subcategory.index', [
                'subcategories' => Subcategory::all()
            ])->with('success', 'Réstauration réussit');
        }
        return back()->with('error', 'Echec de réstauration');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function remove(int $id){

        $subcategory = Subcategory::withTrashed()->find($id);
        if($subcategory->forceDelete()){
            return redirect()->route('subcategory.index', [
                'subcategories' => Subcategory::all()
            ])->with('success', 'Suppression définitive réussit');
        }
        return back()->with('error', 'Echec lors de la suppression définitive');
    }

    // Méthode pour déplacer l'image et retourner l'URL de l'image déplacée
    private function moveImage($file)
    {
        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('Ymd_His');

        $path_file = $formattedDateTime . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/subcategories/'), $path_file);

        return "assets/subcategories/" . $path_file;
    }

    // Méthode pour supprimer une image
    private function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }


    public function uploadPhoto(Request $request, Subcategory $subcategory){
//
        if ($request->picture->isValid()) {

            if (!$subcategory) {
                return response()->json(['message' => 'Impossible de trouver la catégorie correspondante', 'code' => 1]);
            }

            // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
            $image = $subcategory->image;

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
                $subcategory->image()->save($image);
            }


            return response()->json(['message' => 'Votre Image a bien été mis à jour', 'code' => 0]);
        }
        return response()->json(['message' => 'Aucune image trouvée.', 'code' => 1]);
    }
}
