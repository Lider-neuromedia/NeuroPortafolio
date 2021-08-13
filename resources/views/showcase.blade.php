@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @foreach ($link->projects as $project)

                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $project->images->first()->url }}" alt="{{ $project->title }}">
                        <div class="card-header text-center">{{ $project->title }}</div>
                        <div class="card-body text-center">
                            <a class="btn btn-outline-primary" href="{{ url('project/' . $project->id) }}" role="button">Ver</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
@endsection
