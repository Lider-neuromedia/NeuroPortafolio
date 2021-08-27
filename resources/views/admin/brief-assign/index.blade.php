@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Brief Asignados</h1>
                <hr>
            </div>
        </div>

        @include('admin.brief-assign.partials.assign-form')


        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Cliente</th>
                                <th>Brief</th>
                                <th>Estado</th>
                                <th>URL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($client_briefs as $cb)

                                <tr>
                                    <td>{{$cb->client->name}}</td>
                                    <td>{{$cb->brief ? $cb->brief->name : "Brief Borrado"}}</td>
                                    <td>{{$cb->status_format }}</td>
                                    <td>
                                        <a href="{{$cb->url}}" title="{{$cb->url}}" target="_blank">
                                            Enlace Público
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-success" href="{{ route("brief-assign.show", $cb->id) }}">Ver</a>
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

                {{ $client_briefs->appends([])->links() }}

            </div>
        </div>

    </div>
@endsection
