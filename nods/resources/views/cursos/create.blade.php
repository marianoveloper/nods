@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear curso</h1>
@stop

@section('content')
    <div class="container">
        <form action="{{route('cursos.store2',$plantilla->id)}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="">Nombre del Curso</label>
                <input id="name" name="name" type="text" class="form-control">
            </div>


            <button type="submit" class="btn btn-primary">Crear Curso</button>
            <a href="{{ route('plantilla.index') }}" class="btn btn-info">Regresar</a>

        </form>

        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Nombre del Curso</th>
                  
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($plantilla->cursos as $curso)
                    <tr>
                        <td>{{$curso->name}}</td>
                     
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
