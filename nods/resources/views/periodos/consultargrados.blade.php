@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Periodo</h1>
@stop

@section('content')
@if(session('info'))
<div class="alert alert-success">
    {{ session('info') }}   
</div> 
@endif  


    <div class="container">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nombre del Grado</th>
            <th scope="col">Estudiantes</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($periodo->grados as $grado)
            <tr>
                <td>{{$grado->name}}</td>
                <td>{{$grado->users->count()}}</td>
                <td><a href="{{route('grado.consultarmatricula',$grado->id)}}"class="btn btn-success">Matricular</a></td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
