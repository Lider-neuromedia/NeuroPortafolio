@extends('layouts.dashboard')

@section('title', 'Clientes')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Clientes</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                @include('admin.partials.table-search', ['search_route' => route('clients.index')])
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        @hasrole('admin')
                            <th class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('clients.create') }}">
                                    Crear Cliente
                                </a>
                            </th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>

                    @foreach ($clients as $client)

                        <tr>
                            <td>{{$client->name}}</td>
                            @hasrole('admin')
                                <td class="text-right">
                                    <a class="btn btn-xs btn-outline-primary" href="{{ route("clients.edit", $client->id) }}">Editar</a>
                                </td>
                            @endhasrole
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $clients->appends(['s' => $search])->links() }}
            @include('layouts.partials.pagination-steps')
        </div>
    </div>

@endsection
