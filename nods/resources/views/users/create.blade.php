@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Alumno</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{route('users.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">Nombre del Alumno</label>
                <input id="name" name="name" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Apellido del Alumno</label>
                <input id="ap_paterno" name="ap_paterno" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input id="email" name="email" type="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">DNI</label>
                <input id="dni" name="dni" type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('users.index') }}" class="btn btn-info">Regresar</a>

        </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
