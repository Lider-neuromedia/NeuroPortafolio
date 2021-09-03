@extends('layouts.dashboard')

@section('title', 'Crear Proyecto')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('projects.index')}}">Portafolio</a></li>
    <li class="breadcrumb-item active">Crear Proyecto</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-10">

                <form action="{{ route('projects.store', $project) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.projects.form')
                </form>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        window.videos = @json($videos);
        window.images = @json($project->images);

        @if (old('videos'))
            window.videos = @json(old('videos'));
            window.videos = window.videos.map(function(video) {
                return {"path": video};
            });
        @endif
    </script>
@endsection