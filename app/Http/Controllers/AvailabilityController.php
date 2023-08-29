<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('admin.availability.index', [
            'availabilities' => Availability::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.availability.form', [
            'availability' => new Availability()
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

        $availability = Availability::create($request->all());

        if ($availability){

            return redirect()->route('availability.index')->with('success', "Disponibilité ajoutée avec succès");
        }else{
            return  back()->with('error', "Impossible d'ajouter cette disponibilité")->withInput();
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
     * @param  Availability $availability
     * @return \Illuminate\Http\Response
     */
    public function edit(Availability $availability)
    {
        return view('admin.availability.form', [
            'availability' => $availability
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Availability $availability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Availability $availability)
    {
        $availability->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('availability.index')->with('success', "Mise à jour réussit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Availability $availability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Availability $availability)
    {
        if($availability->delete()){
            return redirect()->route('availability.index')->with('success', "Matière supprimée avec succès");
        }

        return back()->with('error', "Impossible de supprimer cette matière");
    }
}
