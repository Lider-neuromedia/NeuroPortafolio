@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <h1>Brief</h1>
        <hr>

        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th class="text-center">Preguntas</th>
                                <th class="text-center">Clientes Asignados</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($briefs as $brief)

                                <tr>
                                    <td>{{$brief->name}}</td>
                                    <td class="text-center">{{$brief->questions()->count()}}</td>
                                    <td class="text-center">{{$brief->clientsAssigned()->count()}}</td>
                                    <td class="text-right">
                                        <a class="btn btn-warning" href="{{ route('brief.duplicate', $brief->id) }}"
                                            onclick="event.preventDefault(); document.getElementById('duplicate-form-{{$brief->id}}').submit();">
                                            Duplicar
                                        </a>

                                        <form id="duplicate-form-{{$brief->id}}" action="{{ route('brief.duplicate', $brief->id) }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                        <a class="btn btn-success" href="{{ route("brief.edit", $brief->id) }}">Editar</a>
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

                {{ $briefs->appends([])->links() }}

            </div>
        </div>

    </div>
@endsection
