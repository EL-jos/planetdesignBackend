<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('admin.material.index', [
            'materials' => Material::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.material.form', [
            'material' => new Material()
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
            'name' => 'required|min:3|unique:materials',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $material = Material::create($request->all());

        if ($material){

            return redirect()->route('material.index')->with('success', "Matière ajoutée avec succès");
        }else{
            return  back()->with('error', "Impossible d'ajouter cette matière")->withInput();
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
     * @param  Material $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('admin.material.form', [
            'material' => $material
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Material $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $material->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('material.index')->with('success', "Mise à jour réussit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Material $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        if($material->delete()){
            return redirect()->route('material.index')->with('success', "Matière supprimée avec succès");
        }

        return back()->with('error', "Impossible de supprimer cette matière");
    }

    public function deleted(){
        //dd(Category::onlyTrashed());
        return view('admin.material.index', [
            'materials' => Material::onlyTrashed()->get()
        ]);
    }

    public function restore(int $id){

        $material = Material::withTrashed()->find($id);
        if($material->restore()){
            return view('admin.material.index', [
                'materials' => Material::all()
            ])->with('success', 'Réstauration réussit');
        }
        return back()->with('error', 'Echec de réstauration');
    }

    public function remove(int $id){

        $material = Material::withTrashed()->find($id);
        if($material->forceDelete()){
            return redirect()->route('material.index', [
                'materials' => Material::all()
            ])->with('success', 'Suppression définitive réussit');
        }
        return back()->with('error', 'Echec lors de la suppression définitive');
    }
}
