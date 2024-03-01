@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Subcategoria</h1>
@stop

@section('content')
   @if(session('info'))
       <div class="alert alert-success">
           <strong>{{session('info')}}</strong>
       </div>
    @endif

<!-- Boton para crear un nuevo usuario -->
<div class="container">
    <a href="{{route('periodos.create')}}" class="btn btn-primary">Crear Subcateria</a>
</div>
<div class="container mt-3">
<table class="table">
    <thead class="table table-dark">
        <tr>
            <th>Nombre Subcategoria</th>
            <th>Cursos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($periodos as $periodo)
            <tr>

                <td>{{$periodo->name}}</td>
                <td>
                    <a href="{{route('periodo.consultargrados',$periodo->id)}}" class="btn btn-success"> Matricular Aula
                    </a>
                </td>


                <td>

                    <form action="{{route('periodos.destroy', $periodo->id)}}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <a href="{{route('grado.creargrado', $periodo->id)}}" class="btn btn-info">Crear Aula</a>
                        <!--<a href="{{route('periodos.edit', $periodo->id)}}" class="btn btn-warning">Editar</a>-->
                      <!--  <button class="btn btn-danger" type="submit">Eliminar</button>-->
                    </form>
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
