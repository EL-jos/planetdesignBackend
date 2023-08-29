<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Availability;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Material;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.form',[
            'category' => new Category()
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
            'name' => 'required|min:3|unique:categories',
            //'lastname' => 'required|min:3',
            //'name' => 'required|min:3',
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

        $category = Category::create($request->except(['picture']));

        if ($category){

            $image = new Image();
            $image->id = (string) Str::uuid();
            $image->path = $this->moveImage($request->picture); // Enregistre la nouvelle image
            $category->image()->save($image);

            return redirect()->route('category.index')->with('success', "Categorie ajoutée avec succès");
        }else{
            return  back()->with('error', "Impossible d'ajouter cette categorie")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        $category->increment('view');

        $articles = $category->subcategories->flatMap(function ($subcategory) {
            return $subcategory->articles;
        });

        //dd($articles);
        return view('category', [
            'category' => $category,
            'colors' => Color::all(),
            'materials' => Material::all(),
            'availabilities' => Availability::all(),
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.form', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //dd($category, $request->all(), $request->file('picture'));
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
        $image = $category->image;

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
            $category->image()->save($image);
        }

        return redirect()->route('category.index')->with('success', "Mise à jour réussit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        //dd($category);
        if($category->delete()){
            return redirect()->route('category.index', [
                'categories' => Category::all()
            ])->with('success', 'Suppression réussit');
        }

        return back()->with('error', 'Impossible de supprimer cette catégorie');
    }

    public function deleted(){
        //dd(Category::onlyTrashed());
        return view('admin.category.index', [
            'categories' => Category::onlyTrashed()->get()
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function restore(int $id){

        $category = Category::withTrashed()->find($id);
        if($category->restore()){
            return view('admin.category.index', [
                'categories' => Category::all()
            ])->with('success', 'Réstauration réussit');
        }
        return back()->with('error', 'Echec de réstauration');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function remove(int $id){

        $category = Category::withTrashed()->find($id);
        if($category->forceDelete()){
            return redirect()->route('category.index', [
                'categories' => Category::all()
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
        $file->move(public_path('assets/categories/'), $path_file);

        return "assets/categories/" . $path_file;
    }

    // Méthode pour supprimer une image
    private function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    public function uploadPhoto(Request $request, Category $category){
//
        if ($request->picture->isValid()) {

        if (!$category) {
        return response()->json(['message' => 'Impossible de trouver la catégorie correspondante', 'code' => 1]);
        }

        // Vérifiez si l'ID de l'entreprise existe déjà dans la table "images"
        $image = $category->image;

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
            $category->image()->save($image);
        }


        return response()->json(['message' => 'Votre Image a bien été mis à jour', 'code' => 0]);
        }
        return response()->json(['message' => 'Aucune image trouvée.', 'code' => 1]);
    }

//    public function filterArticles(Request $request)
//    {
//
//        //dd($request->all());
//        //$subcategory = Subcategory::findOrFail($request->subcategory_id);
//        //$articles = $subcategory->articles;
//
//        if(session()->has('user')){
//            $user = User::find(session()->get('user'));
//        }else{
//            $user = new User();
//        }
//
//        // Récupérez les données du filtre
//        $colorIds = $request->input('color_ids', []);
//        $materialIds = $request->input('material_ids', []);
//        $availabilityIds = $request->input('availability_ids', []);
//        $categoryId = $request->input('category_id', null);
//        $subcategoryId = $request->input('subcategory_id', null);
//
//        // Commencez par récupérer tous les articles associés à la sous-catégorie actuelle
//        $articlesQuery = Article::query();
//
//        if ($categoryId) {
//            // Filtrer les articles en fonction de l'ID de la catégorie
//            $subcategoryIds = Subcategory::where('category_id', $categoryId)->pluck('id');
//            $articlesQuery->whereIn('subcategory_id', $subcategoryIds);
//        } elseif ($subcategoryId) {
//            // Filtrer les articles en fonction de l'ID de la sous-catégorie
//            $articlesQuery->where('subcategory_id', $subcategoryId);
//        }
//
//        // Appliquez les filtres si des identifiants sont sélectionnés
//        if (!empty($colorIds)) {
//            $articlesQuery->whereHas('colors', function ($query) use ($colorIds) {
//                $query->whereIn('color_id', $colorIds);
//            });
//        }
//
//        if (!empty($materialIds)) {
//            $articlesQuery->whereHas('materials', function ($query) use ($materialIds) {
//                $query->whereIn('material_id', $materialIds);
//            });
//        }
//
//        if (!empty($availabilityIds)) {
//            $articlesQuery->whereIn('availability_id', $availabilityIds);
//        }
//
//        // Récupérez les articles filtrés
//        $filteredArticles = $articlesQuery->get();
//
//        //dd($request->all(), $filteredArticles);
//
//        return view('layouts.article.component', ['articles' => $filteredArticles, 'user' => $user])->render();
//    }
}
