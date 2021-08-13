@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <form class="d-flex">
                    <input class="flex-grow-1 form-control mr-sm-2" type="search" placeholder="Buscar proyectos" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>

            </div>
        </div>

        <div class="row">
            @foreach ($projects as $project)

                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $project->images->first()->url }}" alt="{{ $project->title }}">
                        <div class="card-header text-center">{{ $project->title }}</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center" style="gap: 1rem;">
                                <a class="btn btn-outline-primary" href="{{ url('project/' . $project->id) }}" role="button">Ver</a>
                                <a class="btn btn-outline-success" href="#" role="button">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
@endsection
