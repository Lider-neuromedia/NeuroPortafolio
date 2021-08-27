@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12">

                <h1>Editar Proyecto</h1>
                <hr>

                {{-- Formulario de editar --}}

                <form action="{{ route('projects.update', $project) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$project->id}}">
                    @include('admin.projects.form')
                </form>

                {{-- Formulario de borrar --}}

                <div class="card border-danger mb-3">
                    <div class="card-header">Borrar Proyecto</div>
                    <div class="card-body text-danger text-right">
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Borrar">
                        </form>
                    </div>
                </div>

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