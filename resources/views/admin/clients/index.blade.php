@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12">

                <h1>Clientes</h1>
                <hr>

            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($clients as $client)

                                <tr>
                                    <td>{{$client->name}}</td>
                                    <td class="text-right">
                                        <a class="btn btn-success" href="{{ route("clients.edit", $client->id) }}">Editar</a>
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

                {{ $clients->appends([])->links() }}

            </div>
        </div>

    </div>
@endsection
