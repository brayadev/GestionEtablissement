<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Cours;
use Illuminate\Http\Request;

class ClasseCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::with('cours')->get();
        return view('classeCours', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $classe = Classe::findorfail($id);
        $cours = Cours::all(); // Récupérer tous les cours
        return view('addClasseCours', compact('classe', 'cours'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classe = Classe::findOrFail($id);
        $classe->cours()->attach($request->input('cours', [])); // Met à jour les cours liés à la classe
        return redirect()->route('listClasseCours')->with('success', 'Cours mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
