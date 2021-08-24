@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <h1>Usuarios</h1>
        <hr>

        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)

                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-right">
                                        <a class="btn btn-success" href="{{ route("users.edit", $user->id) }}">Editar</a>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-auto text-center">

                {{ $users->appends([])->links() }}

            </div>
        </div>

    </div>
@endsection
