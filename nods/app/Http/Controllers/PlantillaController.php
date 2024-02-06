<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use Illuminate\Http\Request;

class PlantillaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('plantilla.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plantilla.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);

        //Guardar en la BD

        $n_plantilla= new Plantilla();
        $n_plantilla->nombre = $request->nombre;
        $n_plantilla->save();

        return redirect()->route('plantilla.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plantilla $plantilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plantilla $plantilla)
    {
        return view('plantilla.edit', compact('plantilla'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plantilla $plantilla)
    {
       $request->validate([
            'name' => 'required',

        ]);

        //Guardar en la BD

        $plantilla->nombre = $request->nombre;
        $plantilla->save();

        return redirect()->route('plantilla.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plantilla $plantilla)
    {
        //
    }
}
