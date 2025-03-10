<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Etudiant;
use App\Models\Professeur;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cours = Cours::with('professeur')->get();
        $professeurs = Professeur::all()->keyBy('id');;
        return view('cours', compact('cours', 'professeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professeurs = Professeur::all();
       return view('addCours', compact('professeurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cours = new Cours();
        $cours->nom=$request->input('nom');
        $cours->description=$request->input('description');
        $cours->professeur_id=$request->input('professeur_id');
        $cours->save();
        return redirect()->route('listCours');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cours = Cours::find($id);
        $cours->delete();
        return redirect()->route('listCours');
    }
}
