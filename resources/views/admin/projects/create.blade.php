@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

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
