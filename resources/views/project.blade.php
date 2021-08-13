@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-10">

                <div class="card mb-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-4">
                            <img width="100%" height="auto" src="{{ $project->logo->url }}" alt="{{ $project->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title mb-2 font-weight-bold">{{ $project->title }}</h1>
                                <p class="card-text">{{ $project->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($project->images as $key => $image)
                            <li
                                data-target="#carouselExampleIndicators"
                                data-slide-to="{{ $key }}"
                                @if($key == 0) class="active" @endif>
                            </li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach ($project->images as $key => $image)
                            <div class="carousel-item @if($key == 0) active @endif">
                                <img src="{{ $image->url }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                @foreach ($project->videos as $video)
                    <div class="my-5 text-center video-responsive">
                        <iframe
                            src="{{ $video->url }}"
                            width="560" height="315"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
