@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>Editar Categoría</h1>
                <hr>

                {{-- Formulario de editar --}}

                <form action="{{ route('categories.update', $category) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$category->id}}">
                    @include('admin.categories.form')
                </form>

                {{-- Formulario de borrar --}}

                <div class="card border-danger mb-3">
                    <div class="card-header">Borrar Categoría</div>
                    <div class="card-body text-danger text-right">

                        @if ($category->projects()->count() > 0)

                            <div class="alert alert-warning border-warning text-center">
                                Esta categoría no puede ser eliminada hasta que no tenga proyectos asignados.
                            </div>

                        @else

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>

                        @endif

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
