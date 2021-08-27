@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @foreach ($result->projects as $project)

                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $project->images->first()->url }}" alt="{{ $project->title }}">
                        <div class="card-header text-center">{{ $project->title }}</div>
                        <div class="card-body text-center">
                            <a
                                href="{{ url("showcase/{$result->slug}/{$project->slug}") }}"
                                class="btn btn-outline-primary"
                                role="button">Ver</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>
@endsection
