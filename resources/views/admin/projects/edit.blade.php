@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>Editar Proyecto</h1>
                <hr>

                <form action="{{ route('projects.update', $project) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$project->id}}">
                    @include('admin.projects.form')
                </form>

            </div>
        </div>

    </div>
@endsection
