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
                        <th>Enlace Público</th>
                        <th class="text-center">Proyectos</th>
                        <th></th>
                        <th class="text-right">
                            <a class="btn btn-primary btn-xs" href="{{ route('projects.index') }}?create-link=1">Crear Enlace</a>
                        </th>
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
                                    data-detail="link-detail-{{ $link->id }}"
                                    class="toggle-link-detail-btn btn btn-outline-primary btn-xs" title="Listado de proyectos">
                                    <i class="fa fa-list" aria-hidden="true" data-detail="link-detail-{{ $link->id }}"></i>
                                </button>
                            </td>
                            <td class="text-right">
                                <form action="{{ route('links.destroy', $link->id) }}" method="POST">
                                    @method("DELETE")
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-xs" title="Borrar Enlace">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <tr class="detail-hidden" id="link-detail-{{ $link->id }}">
                            <td colspan="3">
                                <ul class="list-group">
                                    @foreach ($link->projects as $project)
                                        <li class="list-group-item">{{$project->title}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $links->appends([])->links() }}
        </div>
    </div>

    <div class="row justify-content-center mt-3 mb-5">
        <div class="col-auto text-center">


        </div>
    </div>

@endsection
