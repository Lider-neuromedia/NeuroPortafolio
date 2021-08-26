@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>Editar Cliente</h1>
                <hr>

                {{-- Formulario de editar --}}

                <form action="{{ route('clients.update', $client) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$client->id}}">
                    @include('admin.clients.form')
                </form>

                {{-- Formulario de borrar --}}

                <div class="card border-danger mb-3">
                    <div class="card-header">Borrar Cliente</div>
                    <div class="card-body text-danger text-right">

                        @if ($client->briefs()->notCompleted()->count() > 0)

                            <div class="alert alert-warning border-warning text-center">
                                Este cliente no puede ser eliminado hasta que no haya terminando de llenar los briefs que tiene asignados.
                            </div>

                        @else

                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
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
