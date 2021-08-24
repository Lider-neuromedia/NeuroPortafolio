@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12">

                <h1>Categorías</h1>
                <hr>

            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th class="text-center">Proyectos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)

                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td class="text-center">{{$category->projects()->count()}}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" href="{{ url("showcase/{$category->slug}") }}" target="_blank">Ver</a>
                                        <a class="btn btn-success" href="{{ route("categories.edit", $category->id) }}">Editar</a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-auto text-center">

                {{ $categories->appends([])->links() }}

            </div>
        </div>

    </div>
@endsection
