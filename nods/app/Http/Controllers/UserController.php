<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $token='27a3a54d2f1a458588a5c431381dd9e0';
    private $domainname='https://pre-virtual.uccuyo.edu.ar/webservice/rest/server.php?';

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
            'email' => 'required',
            'dni' => 'required',

        ]);

        //crear usuario moodle

        $functionname= 'core_user_create_users';
        $serverurl= $this->domainname . 'wstoken=' . $this->token . '&wsfunction='.$functionname
        . '&moodlewsrestformat=json&users[0][username]='.$request->input('dni').'&users[0][password]='.$request->input('dni').'&users[0][firstname]='.$request->input('name').'&users[0][lastname]='.$request->input('lastname').'&users[0][email]='.$request->input('email').'&users[0][auth]='.'manual'.'&users[0][idnumber]='.$request->input('dni');
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
}
