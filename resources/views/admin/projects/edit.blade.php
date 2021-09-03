@extends('layouts.dashboard')

@section('title', 'Editar Proyecto')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('projects.index')}}">Portafolio</a></li>
    <li class="breadcrumb-item active">Editar Proyecto</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12">

                {{-- Formulario de editar --}}

                <form action="{{ route('projects.update', $project) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$project->id}}">
                    @include('admin.projects.form')
                </form>

                {{-- Formulario de borrar --}}

                @include('admin.partials.delete', [
                    'id_form' => 'delete-project-form',
                    'label' => 'Borrar Proyecto',
                    'route' => route('projects.destroy', $project->id)
                ])

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