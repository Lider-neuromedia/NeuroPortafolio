@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Usuarios</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default" title="Ejecutar Búsqueda">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th class="text-right">
                            <a class="btn btn-xs btn-primary" href="{{ route('users.create') }}">
                                Crear Usuario
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)

                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-success" href="{{ route("users.edit", $user->id) }}">Editar</a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $users->appends([])->links() }}
        </div>
    </div>

@endsection
