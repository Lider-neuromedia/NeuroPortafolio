@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

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
                                <td class="text-center">{{ $link->projects()->count() }}</td>
                                <td class="text-center">

                                    <form action="{{ route('links.destroy', $link->id) }}" method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <input class="btn btn-danger btn-sm" type="submit" value="Borrar">
                                    </form>

                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>

        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-auto text-center">

                {{ $links->appends([])->links() }}

            </div>
        </div>

    </div>
@endsection
