@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>Editar Usuario</h1>
                <hr>

                {{-- Formulario de editar --}}

                <form action="{{ route('users.update', $user) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$user->id}}">
                    @include('admin.users.form')
                </form>

                {{-- Formulario de borrar --}}

                <div class="card border-danger mb-3">
                    <div class="card-header">Borrar Usuario</div>
                    <div class="card-body text-danger text-right">

                        @if (\Auth::user()->id == $user->id)

                            <div class="alert alert-warning border-warning text-center">
                                No se puede borrar así mismo
                            </div>

                        @else

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
