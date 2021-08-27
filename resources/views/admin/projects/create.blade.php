@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-10">

                <h1>Crear Proyecto</h1>
                <hr>

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
        @if (old('videos'))
            window.videos = @json(old('videos'));
            window.videos = window.videos.map(function(video) {
                return {"path": video};
            });
        @endif
    </script>
@endsection