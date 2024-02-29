<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PeriodoController extends Controller
{
    private $token='37192c673d94f5d041a2ce9619202686';
    private $domainname='https://pre-virtual.uccuyo.edu.ar';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodos=Periodo::all();
        return view('periodos.index', compact('periodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periodos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $functionname= 'core_course_create_categories';

        $serverurl= $this->domainname . '/webservice/rest/server.php'
        . '?wstoken='. $this->token
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json'
        .'&categories[0][name]='.$request->input('name')
        .'&categories[0][parent]=0'
        .'&categories[0][descriptionformat]=0';

        $categoria=Http::get($serverurl);

        foreach(json_decode($categoria) as $cat){

        }

        $periodo = new Periodo();
        $periodo->name = $request->input('name');
        $periodo->id_category_moodle=$cat->id;
        $periodo->save();

        return redirect()->route('periodos.index')
            ->with('success', 'Periodo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periodo $periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periodo $periodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periodo $periodo)
    {
        //
    }

    public function consultargrados(Periodo $periodo){

        return view('periodos.consultargrados',compact('periodo'));

    }
}
