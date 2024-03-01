@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo cursos</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{route('grado.store2',$periodo->id)}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">Nombre del Curso</label>
                <input id="name" name="name" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Elegir Categoria</label>
              <select name="plantilla_id" id="plantilla_id" class="form-control">
               @foreach($plantillas as $plantilla){
                  <option value={{$plantilla->id}}>{{$plantilla->name}}</option>
               }
                @endforeach
            </select>
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
