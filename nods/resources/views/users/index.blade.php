@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Alumnos</h1>
@stop

@section('content')
   @if(session('info'))
       <div class="alert alert-success">
           <strong>{{session('info')}}</strong>
       </div>
    @endif

<!-- Boton para crear un nuevo usuario -->
<div class="container">
    <a href="{{route('users.create')}}" class="btn btn-primary">Crear Alumno</a>
</div>
<div class="container mt-3">
<table class="table">
    <thead class="table table-dark">
        <tr>
            <th>Nombre y Apellido </th>
            <th>Email</th>
            <th>Dni</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>

                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->dni}}</td>

                <td>
                    <a href="#" class="btn btn-warning">Editar</a>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</div>




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
