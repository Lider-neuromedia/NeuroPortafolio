@extends('layouts.dashboard')

@section('title', 'Editar Cliente')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
    <li class="breadcrumb-item active">Editar Cliente</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                {{-- Formulario de editar --}}

                <form action="{{ route('clients.update', $client) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$client->id}}">
                    @include('admin.clients.form')
                </form>

                {{-- Formulario de borrar --}}

                @if ($client->briefs()->notCompleted()->count() > 0)

                    <div class="alert alert-warning text-center">
                        Este cliente no puede ser eliminado hasta que no haya terminando de llenar los briefs que tiene asignados.
                    </div>

                @else

                    @include('admin.partials.delete', [
                        'id_form' => 'delete-client-form',
                        'label' => 'Borrar Cliente',
                        'route' => route('clients.destroy', $client->id)
                    ])

                @endif


            </div>
        </div>

    </div>
@endsection
