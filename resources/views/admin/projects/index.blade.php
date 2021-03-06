@extends('layouts.dashboard')

@section('title', 'Portafolio')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Portafolio</li>
@endsection

@section('content')

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-sm-8">
            <form class="d-flex mb-1" method="get" action="{{ url('admin/projects') }}">
                @if ($create_link == 1)
                    <input type="hidden" name="create-link" value="{{$create_link}}">
                @endif

                <select class="form-control" name="c" id="c">
                    <option value="">Todo</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @if ($category == $cat->id) selected @endif>
                            {{ $cat->name }} ({{ $cat->count_projects }})
                        </option>
                    @endforeach
                </select>

                <input class="flex-grow-1 form-control mx-2" type="search" name="s" value="{{$search}}" placeholder="Buscar proyectos" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <div class="col-12 col-sm-4 text-right">
            @hasrole('admin')
                <a class="btn btn-primary" href="{{ route('projects.create') }}">
                    Crear Proyecto
                </a>
            @endhasrole
        </div>
    </div>

    @if ($create_link == 1)

        @include('admin.projects.partials.create-link')

    @endif

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

                    @hasrole('admin')
                        <div class="card-body">

                            @if ($create_link == 1)

                                <div class="d-flex justify-content-center" style="gap: 1rem;">
                                    <form action="{{ route('link-creation.add', $project) }}" method="post">
                                        @csrf
                                        <input class="btn btn-primary" type="submit" value="Seleccionar">
                                    </form>
                                </div>

                            @else

                                <div class="text-center">
                                    <a
                                        href="{{ route('project.show', $project->slug) }}"
                                        class="btn btn-outline-primary"
                                        role="button"
                                        target="_blank">
                                        Ver</a>
                                    <a
                                        href="{{ route('projects.edit', $project) }}"
                                        class="btn btn-outline-primary"
                                        role="button">
                                        Editar</a>
                                </div>

                            @endif

                        </div>
                    @endhasrole
                </div>
            </div>

        @endforeach

    </div>

    <div class="row mt-3 mb-5">
        <div class="col-12">

            @php
                $appends = [ 's' => $search, 'c' => $category ];

                if ($create_link == 1) {

                    $appends['create-link'] = $create_link;

                }
            @endphp

            <div class="table-responsive d-flex justify-content-end">
                {{ $projects->appends($appends)->links() }}
                @include('layouts.partials.pagination-steps')
            </div>

        </div>
    </div>

@endsection
