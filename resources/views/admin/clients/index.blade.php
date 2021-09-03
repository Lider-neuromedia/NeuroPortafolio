@extends('layouts.dashboard')

@section('title', 'Clientes')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Clientes</li>
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
                        <th class="text-right">
                            <a class="btn btn-xs btn-primary" href="{{ route('clients.create') }}">
                                Crear Cliente
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($clients as $client)

                        <tr>
                            <td>{{$client->name}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-success" href="{{ route("clients.edit", $client->id) }}">Editar</a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $clients->appends([])->links() }}
        </div>
    </div>

@endsection
