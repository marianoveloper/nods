
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Periodos</h1>
@stop

@section('content')
@if(session('info'))
<div class="alert alert-success">
    <strong>{{session('info')}}</strong>
</div>
@endif

<!-- Boton para crear un nuevo usuario -->
<div class="container">
<a href="{{route('plantilla.create')}}" class="btn btn-primary">Crear Plantilla</a>
</div>
<div class="container mt-3">
<table class="table">
<thead class="table table-dark">
 <tr>
     <th>Nombre Plantilla</th>
     <th>Curso</th>
     <th>Acciones</th>
 </tr>
</thead>
<tbody>
 @foreach ($plantillas as $plantilla)
     <tr>

         <td>{{$plantilla->name}}</td>

        <td>{{$plantilla->cursos->count()}}</td>

         <td>

            <form action="#" method="POST" class="d-inline">
                 @method('DELETE')
                 @csrf
                 <a href="{{route('cursos.crearcurso',$plantilla->id)}}" class="btn btn-success">Crear curso</a>
                 <!--<button class="btn btn-danger" type="submit">Eliminar</button>-->
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
