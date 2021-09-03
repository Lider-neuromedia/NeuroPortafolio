@extends('layouts.dashboard')

@section('title', 'Categorías')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Categorías</li>
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
                        <th class="text-center">Proyectos</th>
                        <th class="text-right">
                            <a class="btn btn-xs btn-primary" href="{{ route('categories.create') }}">
                                Crear Categoría
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categories as $category)

                        <tr>
                            <td>{{$category->name}}</td>
                            <td class="text-center">{{$category->projects()->count()}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-success" href="{{ route("categories.edit", $category->id) }}">Editar</a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $categories->appends([])->links() }}
        </div>
    </div>

@endsection
