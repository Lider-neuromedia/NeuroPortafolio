@extends('layouts.dashboard')

@section('scripts')

    <style>

        .detail-hidden {
            display: none;
        }

    </style>

@endsection

@section('content')
    <div class="container">

        <h1>Enlaces</h1>
        <hr>

        <div class="row justify-content-center mb-5">
            <div class="col-12">
                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Enlace</th>
                                <th class="text-center">Proyectos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($links as $link)

                                <tr>
                                    <td>
                                        <a href="{{ url("showcase/{$link->slug}") }}" target="_blank">
                                            {{ url("showcase/{$link->slug}") }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{ $link->projects()->count() }}
                                    </td>
                                    <td class="text-center d-flex justify-content-between" style="gap: 1rem;">

                                        <button
                                            type="button"
                                            data-detail="link-detail-{{ $link->id }}"
                                            class="toggle-link-detail-btn btn btn-sm btn-outline-primary" title="Listado de proyectos">
                                            <i class="bi bi-arrow-down-circle-fill" data-detail="link-detail-{{ $link->id }}"></i>
                                        </button>

                                        <form action="{{ route('links.destroy', $link->id) }}" method="POST">
                                            @method("DELETE")
                                            @csrf
                                            <input class="btn btn-danger btn-sm" type="submit" value="Borrar">
                                        </form>

                                    </td>
                                </tr>

                                <tr class="detail-hidden" id="link-detail-{{ $link->id }}">
                                    <td colspan="3">
                                        <ul class="list-group">
                                            @foreach ($link->projects as $project)
                                                <li class="list-group-item">{{$project->title}}</li>
                                            @endforeach
                                        </ul>
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

                {{ $links->appends([])->links() }}

            </div>
        </div>

    </div>
@endsection
