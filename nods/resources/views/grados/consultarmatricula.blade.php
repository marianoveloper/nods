@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Consultar Estudiantes</h1>
@stop

@section('content')
@if(session('info'))
<div class="alert alert-success">
    {{ session('info') }}   
</div> 
@endif  

<div class="container">
    <form action="{{route('grado.matricular',$grado->id)}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="">Elegir Estudiantes</label>
           <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $user){
               <option value={{$user->id}}>{{$user->name}}</option>
            }
             @endforeach
           </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Matricular</button>
            <a href="{{ route('periodos.index') }}" class="btn btn-info">Regresar</a>
        </div>
       
    </form>
</div>    

    <div class="container">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nombre de los Estudiantes</th>
          
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-white">
            @foreach($grado->users as $estudiantes)
            <tr>
                <td>{{$estudiantes->name}}</td>
                <td>{{$grado->users->count()}}</td>
              
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
