<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    private $token='27a3a54d2f1a458588a5c431381dd9e0';
    private $domainname='https://pre-virtual.uccuyo.edu.ar';

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
        .'&users[0][password]='.$request->input('dni')
        .'&users[0][firstname]='.$request->input('name')
        .'&users[0][lastname]='.$request->input('ap_paterno')
        .'&users[0][email]='.$request->input('email');

        $usuario=Http::get($serverurl);


        foreach(json_decode($usuario) as $nm_use2){

        }

        //crear el usuario en la base de datos
        $n_use=new User();
        $n_use->name=$request->input('name');
        $n_use->ap_paterno=$request->input('ap_paterno');

        $n_use->email=$request->input('email');
        $n_use->dni=$request->input('dni');
        //$n_use->id_user_moodle=$nm_use2->id;
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

        return view('users.index', compact('usuario'));
    }
}
