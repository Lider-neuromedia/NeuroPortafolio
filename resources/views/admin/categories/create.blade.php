@extends('layouts.dashboard')

@section('title', 'Crear Categoría')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categorías</a></li>
    <li class="breadcrumb-item active">Crear Categoría</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <form action="{{ route('categories.store', $category) }}" method="post">
                    @csrf
                    @include('admin.categories.form')
                </form>

            </div>
        </div>

    </div>
@endsection
