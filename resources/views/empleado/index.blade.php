@extends('layouts.app')
@section('content')
@if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <div class="container">
        <br>
        <a class="btn btn-succes" href="{{ url('empleado/create') }}">Registrar nuevo empleado </a>
        <br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td><img class="img-thumbnail img-fluid" src="{{ asset('storage/' . $empleado->Foto) }}"
                                alt="Foto de {{ $empleado->Nombre }}" width="30"></td>
                        <td>{{ $empleado->Nombre }}</td>
                        <td>{{ $empleado->ApellidoPaterno }}</td>
                        <td>{{ $empleado->ApellidoMaterno }}</td>
                        <td>{{ $empleado->Correo }}</td>
                        <td>
                            <a class="btn btn-warning" href ="{{ url('/empleado/' . $empleado->id . '/edit') }}">
                                Editar
                            </a> |
                            <form class="d-inline" method="post" action="{{ url('/empleado/' . $empleado->id) }}">
                                @csrf
                                {{ method_field('DELETE') }}
                                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar?')"
                                    value="Borrar">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!!$empleados->links()!!}
        
    </div>
@endsection
