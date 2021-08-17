@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <form class="d-flex">
                    <select class="form-control" name="c" id="c">
                        <option value="">Todo</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @if ($category == $cat->id) selected @endif>
                                {{ $cat->name }} ({{ $cat->count_projects }})
                            </option>
                        @endforeach
                    </select>
                    <input class="flex-grow-1 form-control mx-2" type="search" name="s" value="{{$search}}" placeholder="Buscar proyectos" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

            </div>
        </div>

        <div class="row">
            @foreach ($projects as $project)

                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="card">
                        @if ($project->images->first())
                            <img
                                class="card-img-top"
                                src="{{ $project->images->first()->url }}"
                                alt="{{ $project->title }}">
                        @endif

                        <div class="card-header text-center">{{ $project->title }}</div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center" style="gap: 1rem;">
                                <a class="btn btn-outline-primary" href="{{ url('project/' . $project->id) }}" role="button">Ver</a>
                                <a class="btn btn-outline-success" href="{{ route('projects.edit', $project) }}" role="button">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-auto text-center">
                {{ $projects->appends([ 's' => $search, 'c' => $category ])->links() }}
            </div>
        </div>

    </div>
@endsection
