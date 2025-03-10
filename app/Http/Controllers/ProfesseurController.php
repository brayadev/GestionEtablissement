<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Professeur;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeurs = Professeur::all();
        return view('professeur', compact('professeurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addProfesseur');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prof = new Professeur();
        $prof->nom= $request->input('nom');
        $prof->prenom= $request->input('prenom');
        $prof->email= $request->input('email');
        $prof->telephone= $request->input('telephone');
        $prof->matiere= $request->input('matiere');
        $prof->save();
        return redirect()->route('listProf');
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

        $prof =Professeur::find($id);
        $prof->delete();
        return redirect()->route('listProf');
    }
}
