<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    private $token='27a3a54d2f1a458588a5c431381dd9e0';
    private $domainname='https://pre-virtual.uccuyo.edu.ar';
    private $pass='Passwor*123';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $users = User::all();
         return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ap_paterno' => 'required',
         'email' => 'required',
            'dni' => 'required',

        ]);

        //crear usuario moodle

        $functionname= 'core_user_create_users';

        $serverurl= $this->domainname . '/webservice/rest/server.php'
        . '?wstoken='. $this->token
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&users[0][username]='.$request->input('dni')
        .'&users[0][password]='. $this->pass
        .'&users[0][firstname]='.$request->input('name')
        .'&users[0][lastname]='.$request->input('ap_paterno')
        .'&users[0][email]='.$request->input('email')
        .'&users[0][idnumber]='.$request->input('dni')
        .'&users[0][auth]='.'manual'
        .'&users[0][lang]='.'es';
        $usuario=Http::get($serverurl);
//dd($usuario);
        foreach(json_decode($usuario) as $usu){

        }
dd($usu);
        //crear el usuario en la base de datos
        $n_use=new User();
        $n_use->name=$request->input('name');
        $n_use->ap_paterno=$request->input('ap_paterno');
        $n_use->email=$request->input('email');
        $n_use->dni=$request->input('dni');
        $n_use->id_user_moodle=$usu->id;
        $n_use->password=bcrypt($request->input('input'));
        $n_use->save();

        //retornar a la vista
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function consulta(Request $request){
        $username=$request->input('username');
        $functionname= 'core_user_get_users';
        $serverurl= $this->domainname . '/webservice/rest/server.php'
        . '?wstoken='. $this->token
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&criteria[0][key]=username&criteria[0][value]='.$username;
        $usuario=Http::get($serverurl);
//dd($usuario);
        return view('plantilla.index', compact('usuario'));
    }

    public function consultarmatricula(Grado $grado){
        //consultar usuarios que no estan matriculados en el curso
        $users=User::WhereNotExists(function ($query) use($grado){
            $query->select()
            ->from('grado_user')
            ->whereColumn('grado_user.user_id','users_id')
            ->where('grado_user.grado_id',$grado->id);
        })->get();
       return view('grado.consultarmatricula',compact('grado','users'));
    }

    public function matricular(Request $request, Grado $grado){

        $user=User::find($request->input('user_id'));

        //matricular en el sistema
        $grado->users()->attach($user->id);
        $functionname= 'enrol_manual_enrol_users';
        foreach($grado->areas as $area){

            $serverurl= $this->domainname . '/webservice/rest/server.php'
            . '?wstoken='. $this->token
            . '&wsfunction='.$functionname
            .'&moodlewsrestformat=json&enrolments[0][roleid]=5&enrolments[0][userid]='.$user->id_user_moodle
            .'&enrolments[0][courseid]='.$area->id_course_moodle;
            $usuario=Http::get($serverurl);
        }




        return redirect()->route('users.index')->with('success', 'Usuario matriculado exitosamente');
    }

    public function desmatricular(Grado $grado, User $user){

        $functionname= 'enrol_manual_unenrol_users';
        $serverurl= $this->domainname . '/webservice/rest/server.php'
        . '?wstoken='. $this->token
        . '&wsfunction='.$functionname
        .'&moodlewsrestformat=json&enrolments[0][roleid]=5&enrolments[0][userid]='.$user->id
        .'&enrolments[0][courseid]='.$grado->id_curso;
        $usuario=Http::get($serverurl);

        return redirect()->route('users.index')->with('success', 'Usuario desmatriculado exitosamente');
    }
}
