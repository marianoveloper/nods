@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Periodo</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{route('periodos.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">Nombre del Periodo</label>
                <input id="name" name="name" type="text" class="form-control">
            </div>


            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('periodos.index') }}" class="btn btn-info">Regresar</a>

        </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
