@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Usuarios</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                @include('admin.partials.table-search', ['search_route' => route('users.index')])
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Roles</th>
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
                            <td>{{$user->roles_description}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-outline-primary" href="{{ route("users.edit", $user->id) }}">Editar</a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $users->appends(['s' => $search])->links() }}
        </div>
    </div>

@endsection
