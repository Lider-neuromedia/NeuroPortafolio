@extends('layouts.dashboard')

@section('title', 'Enlaces')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Enlaces</li>
@endsection

@section('scripts')

    <style>

        .detail-hidden {
            display: none;
        }

    </style>

@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                @include('admin.partials.table-search', ['search_route' => route('links.index')])
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Enlace Público</th>
                        <th class="text-center">Proyectos</th>
                        <th></th>
                        @hasrole('admin')
                            <th class="text-right">
                                <a class="btn btn-primary btn-xs" href="{{ route('projects.index') }}?create-link=1">
                                    Crear Enlace
                                </a>
                            </th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody>

                    @foreach ($links as $link)

                        <tr>
                            <td>
                                <a href="{{ url("showcase/{$link->slug}") }}" target="_blank">
                                    {{ url("showcase/{$link->slug}") }}
                                </a>
                            </td>
                            <td class="text-center">
                                {{ $link->projects()->count() }}
                            </td>
                            <td>
                                <button
                                    type="button"
                                    title="Listado de proyectos"
                                    data-detail="link-detail-{{ $link->id }}"
                                    class="toggle-link-detail-btn btn btn-outline-primary btn-xs">
                                    Proyectos
                                </button>
                            </td>
                            @hasrole('admin')
                                <td class="text-right">
                                    <form action="{{ route('links.destroy', $link->id) }}" method="POST">
                                        @method("DELETE")
                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-xs" title="Borrar Enlace">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            @endhasrole
                        </tr>

                        <tr class="detail-hidden" id="link-detail-{{ $link->id }}">
                            <td colspan="{{auth()->user()->hasrole('admin') ? 4 : 3}}">
                                <ul class="list-group">
                                    @foreach ($link->projects as $project)
                                        <a href="{{ route('project.show', $project->slug) }}"
                                            class="list-group-item list-group-item-action"
                                            aria-current="true">
                                            {{$project->title}}
                                        </a>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $links->appends(['s' => $search])->links() }}
            @include('layouts.partials.pagination-steps')
        </div>
    </div>

@endsection
