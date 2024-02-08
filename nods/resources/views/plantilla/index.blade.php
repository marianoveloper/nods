@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="card-body">
    <form action="{{route('users.consulta')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">Nombre del Alumno</label>
            <input id="name" name="username" type="text" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Consultar</button>

    </div>
    @isset($usuario)
    {{$usuario}}


    @endisset
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
