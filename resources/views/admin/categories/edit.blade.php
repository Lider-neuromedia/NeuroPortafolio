@extends('layouts.dashboard')

@section('title', 'Editar Categoría')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categorías</a></li>
    <li class="breadcrumb-item active">Editar Categoría</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                {{-- Formulario de editar --}}

                <form action="{{ route('categories.update', $category) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$category->id}}">
                    @include('admin.categories.form')
                </form>

                {{-- Formulario de borrar --}}

                @if ($category->projects()->count() > 0)

                    <div class="alert alert-warning text-center">
                        Esta categoría no puede ser eliminada hasta que no tenga proyectos asignados.
                    </div>

                @else

                    @include('admin.partials.delete', [
                        'id_form' => 'delete-category-form',
                        'label' => 'Borrar Categoría',
                        'route' => route('categories.destroy', $category->id)
                    ])

                @endif

            </div>
        </div>

    </div>
@endsection
