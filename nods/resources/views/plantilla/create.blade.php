    <!-- <div class="container">
            <a href="{{route('users.create')}}" class="btn btn-primary">Crear Usuario</a>
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
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning">Editar</a>
                            <form action="{{route('users.destroy', $user->id)}}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </div>-->
