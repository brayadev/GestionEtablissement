<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $classes = Classe::all();
        return view('classe',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addClasse');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $classe = new Classe();
        $classe->nom= $request->input('nom');
        $classe->niveau= $request->input('niveau');
        $classe->capacite= $request->input('capacite');
        $classe->save();
        return redirect()->route('listClasse');
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
        $classe =Classe::find($id);
        $classe->delete();
        return redirect()->route('listClasse');
    }
}
