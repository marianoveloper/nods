<?php

namespace App\Http\Controllers;

use App\Models\curso;
use App\Models\Plantilla;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function crearcurso(Plantilla $plantilla){
        return view('cursos.create', compact('plantilla'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function store2(Request $request,Plantilla $plantilla)
    {
        $request->validate([
            'name' => 'required',
           // 'plantilla_id'=>'required',

        ]);

       // $plantilla=Plantilla::find($request->input('plantilla_id'));

       $n_curso= new Curso();
         $n_curso->name = $request->input('name');
         $n_curso->plantilla_id = $plantilla->id;
            $n_curso->save();

        return redirect()->route('plantilla.index')->with('success','curso creado con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(curso $curso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, curso $curso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(curso $curso)
    {
        //
    }
}
