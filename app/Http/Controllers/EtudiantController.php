<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Professeur;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classe_id = $request->query('classe_id'); // Récupérer l'ID de la classe sélectionnée
        $classes = Classe::all(); // Récupérer toutes les classes

        if ($classe_id) {
            $etudiants = Etudiant::where('classe_id', $classe_id)->get();
        } else {
            $etudiants = Etudiant::all();
        }

        return view('etudiant', compact('etudiants', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classe::all();
        return view('addEtudiant', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $etudiant = new Etudiant();
        $etudiant->nom= $request->input('nom');
        $etudiant->prenom= $request->input('prenom');
        $etudiant->email= $request->input('email');
        $etudiant->address= $request->input('address');
        $etudiant->classe_id= $request->input('classe_id');
        $etudiant->save();
        return redirect()->route('listEtudiant');
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
        $etudiant = Etudiant::find($id);
        $etudiant->delete();
        return redirect()->route('listEtudiant');
    }
}
