@extends('layouts.dashboard')

@section('title', 'Briefs')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Briefs</li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                @include('admin.partials.table-search', ['search_route' => route('brief.index')])
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th class="text-center">Preguntas</th>
                        <th class="text-center">Clientes Asignados</th>
                        @hasrole('admin')
                            <th class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('brief.create') }}">
                                    Crear Brief
                                </a>
                            </th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>

                    @foreach ($briefs as $brief)

                        <tr>
                            <td>{{$brief->name}}</td>
                            <td class="text-center">{{$brief->questions()->count()}}</td>
                            <td class="text-center">{{$brief->clientsAssigned()->count()}}</td>
                            @hasrole('admin')
                                <td class="text-right">
                                    <a class="btn btn-outline-primary btn-xs" href="{{ route('brief.duplicate', $brief->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('duplicate-form-{{$brief->id}}').submit();">
                                        Duplicar Brief
                                    </a>
                                    <a class="btn btn-outline-primary btn-xs" href="{{ route("brief.edit", $brief->id) }}">Editar</a>

                                    <form id="duplicate-form-{{$brief->id}}" action="{{ route('brief.duplicate', $brief->id) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            @endhasrole
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $briefs->appends(['s' => $search])->links() }}
            @include('layouts.partials.pagination-steps')
        </div>
    </div>

@endsection
