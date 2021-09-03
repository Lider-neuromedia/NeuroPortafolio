@extends('layouts.dashboard')

@section('title', 'Briefs')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Briefs</li>
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
                        <th class="text-center">Preguntas</th>
                        <th class="text-center">Clientes Asignados</th>
                        <th class="text-right">
                            <a class="btn btn-xs btn-primary" href="{{ route('brief.create') }}">
                                Crear Brief
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($briefs as $brief)

                        <tr>
                            <td>{{$brief->name}}</td>
                            <td class="text-center">{{$brief->questions()->count()}}</td>
                            <td class="text-center">{{$brief->clientsAssigned()->count()}}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a class="btn btn-warning btn-xs" href="{{ route('brief.duplicate', $brief->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('duplicate-form-{{$brief->id}}').submit();">
                                        Duplicar Brief
                                    </a>
                                    <a class="btn btn-success btn-xs" href="{{ route("brief.edit", $brief->id) }}">Editar</a>
                                </div>

                                <form id="duplicate-form-{{$brief->id}}" action="{{ route('brief.duplicate', $brief->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $briefs->appends([])->links() }}
        </div>
    </div>

@endsection
