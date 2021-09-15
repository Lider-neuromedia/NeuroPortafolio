@extends('layouts.dashboard')

@section('title', 'Brief Asignados')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Brief Asignados</li>
@endsection

@section('content')

    @hasrole('admin')
        @include('admin.brief-assign.partials.assign-form')
    @endhasrole

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                @include('admin.partials.table-search', ['search_route' => route('brief-assign.index')])
            </div>
        </div>
        <div class="card-body table-responsive p-0">

            <table class="table table-hover">
                <thead>
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
                                <a class="btn btn-outline-primary btn-xs" href="{{ route("brief-assign.show", $cb->id) }}">Ver</a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $client_briefs->appends(['s' => $search])->links() }}
        </div>
    </div>

@endsection
