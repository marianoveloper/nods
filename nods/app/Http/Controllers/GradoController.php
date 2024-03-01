<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\grado;
use App\Models\Periodo;
use App\Models\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GradoController extends Controller
{

    private $token='37192c673d94f5d041a2ce9619202686';
    private $domainname='https://pre-virtual.uccuyo.edu.ar';
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
    public function crearGrado(Periodo $periodo)
    {
        $plantillas=Plantilla::all();

        return view('grados.create', compact('periodo','plantillas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function store2(Request $request,Periodo $periodo)
    {

        $request->validate([
            'name' => 'required',
            'plantilla_id'=>'required',

        ]);

        $plantilla=Plantilla::find($request->input('plantilla_id'));


//crear usuario moodle

$functionname= 'core_course_create_categories';

$serverurl= $this->domainname . '/webservice/rest/server.php'
. '?wstoken='. $this->token
. '&wsfunction='.$functionname
.'&moodlewsrestformat=json'
.'&categories[0][name]='.$request->input('name')
.'&categories[0][parent]='. $periodo->id_category_moodle
.'&categories[0][descriptionformat]=0';

$categorias=Http::get($serverurl);

foreach(json_decode($categorias) as $cat){

}
        $grado = new grado();
        $grado->name = $request->input('name');
        $grado->periodo_id=$periodo->id;
        $grado->id_category_moodle=$cat->id;
        $grado->save();

        $functionname3= 'core_course_create_courses';
        //crear curso en moodle
        foreach($plantilla->cursos as $curso){


            $serverurl3= $this->domainname . '/webservice/rest/server.php'
            . '?wstoken='. $this->token
            . '&wsfunction='.$functionname3
            .'&moodlewsrestformat=json'
            .'&courses[0][fullname]='.$curso->name
            .'&courses[0][shortname]='.$curso->name
            .'&courses[0][categoryid]='.$cat->id
            .'&courses[0][idnumber]='.$curso->idnumber;

            $curso_moodle=Http::get($serverurl3);
            foreach(json_decode($curso_moodle) as $cur){
            }

            //crear area en la base de datos y relacionarla con el curso de moodle
            $area=new Area();
            $area->name=$curso->name;
            $area->shortname=$curso->name;
            $area->id_curso_moodle=$cur->id;
            $area->grado_id=$grado->id;
            $area->save();

        }


      return redirect()->route('periodos.index')
            ->with('info', 'Grado creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(grado $grado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(grado $grado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, grado $grado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(grado $grado)
    {
        //
    }

    public function consultarmatricula(Grado $grado){
        //consultar usuarios que no estan matriculados en el curso
        $users=User::WhereNotExists(function ($query) use($grado){
            $query->select()
            ->from('grado_user')
            ->whereColumn('grado_user.user_id','user_id')
            ->where('grado_user.grado_id',$grado->id);
        })->get();
       return view('grados.consultarmatricula',compact('grado','users'));
    }

    public function matricular(Request $request, Grado $grado){

        $user=User::find($request->input('user_id'));

        //matricular en el sistema
        $grado->users()->attach($user->id);
        $functionname2= 'enrol_manual_enrol_users';

        foreach($grado->areas as $area){

            $consulta= $this->domainname . '/webservice/rest/server.php'
            . '?wstoken='. $this->token
            . '&wsfunction='.$functionname2
            .'&moodlewsrestformat=json'
            .'&enrolments[0][roleid]=5'
            .'&enrolments[0][userid]='.$user->id_user_moodle
            .'&enrolments[0][courseid]='.$area->id_curso_moodle
            . '&enrolments[0][timestart]='.time()+86400
            . '&enrolments[0][timeend]='.time()+86400*365;
            $usuario=Http::get($consulta);
            if($usuario->status()!=200){
                return redirect()->route('grado.consultarmatricula',$grado->id)->with('error', 'Error al matricular usuario en el curso');
            }else{
                $usuario=Http::get($consulta);
                return redirect()->route('grado.consultarmatricula',$grado->id)->with('info', 'Usuario matriculado exitosamente');
            }
        }





    }

    public function desmatricular(Grado $grado, User $user){
        $user->grados()->detach($grado->id);
        $functionname= 'enrol_manual_unenrol_users';
        $serverurl= $this->domainname . '/webservice/rest/server.php'
        . '?wstoken='. $this->token
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&enrolments[0][roleid]=5&enrolments[0][userid]='.$user->id
        .'&enrolments[0][courseid]='.$grado->id_curso;
        $usuario=Http::get($serverurl);

        return redirect()->route('grado.consultarmatricula',$grado->id)->with('success', 'Usuario desmatriculado exitosamente');
    }
}
