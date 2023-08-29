<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('admin.color.index', [
            'colors' => Color::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.form', [
            'color' => new Color()
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
            'name' => 'required|min:3|unique:colors',
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        $color = Color::create($request->all());

        if ($color){

            return redirect()->route('color.index')->with('success', "Couleur ajoutée avec succès");
        }else{
            return  back()->with('error', "Impossible d'ajouter cette couleur")->withInput();
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
     * @param  Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.color.form', [
            'color' => $color
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Color $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $color->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('color.index')->with('success', "Mise à jour réussit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Color $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        if($color->delete()){
            return redirect()->route('color.index')->with('success', "Couleur supprimée avec succès");
        }

        return back()->with('error', "Impossible de supprimer cette couleur");
    }

    public function deleted(){
        //dd(Category::onlyTrashed());
        return view('admin.color.index', [
            'colors' => Color::onlyTrashed()->get()
        ]);
    }

    public function restore(int $id){

        $color = Color::withTrashed()->find($id);
        if($color->restore()){
            return view('admin.color.index', [
                'colors' => Color::all()
            ])->with('success', 'Réstauration réussit');
        }
        return back()->with('error', 'Echec de réstauration');
    }

    public function remove(int $id){

        $color = Color::withTrashed()->find($id);
        if($color->forceDelete()){
            return redirect()->route('color.index', [
                'colors' => Color::all()
            ])->with('success', 'Suppression définitive réussit');
        }
        return back()->with('error', 'Echec lors de la suppression définitive');
    }
}
