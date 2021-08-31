@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>{{ $brief_assign->brief ? $brief_assign->brief->name : "Brief Borrado" }} / {{ $brief_assign->client->name }}</h1>

                <hr>

                <div class="card border-secondary">
                    <div class="card-body text-secondary text-center font-weight-bold">
                        <span>Estado: {{ $brief_assign->status_format }}</span>

                    </div>
                    <div class="card-footer text-right">
                        <form action="{{route('brief-assign.update', $brief_assign->id)}}" method="post">
                            @csrf
                            @method('PUT')

                            @if ($brief_assign->is_completed)
                                <input type="hidden" name="status" value="{{\App\ClientBrief::STATUS_PENDING}}">
                                <button class="btn btn-sm btn-success mr-3" type="submit">Abrir Formulario</button>
                            @else
                                <input type="hidden" name="status" value="{{\App\ClientBrief::STATUS_COMPLETED}}">
                                <button class="btn btn-sm btn-success mr-3" type="submit">Cerrar Formulario</button>
                            @endif

                            <a class="btn btn-primary btn-sm" href="{{$brief_assign->url}}" title="{{$brief_assign->url}}" target="_blank">
                                Enlace Público
                            </a>
                        </form>
                    </div>
                </div>

                @foreach ($brief_assign->answers as $answer)
                    <div class="card my-4">
                        <div class="card-header font-weight-bold">{{ $answer->question }}</div>
                        <div class="card-body">
                            @foreach ($answer->answer as $answer)
                                <div>{!!$answer!!}</div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-12 my-5">
                        <a class="btn btn-dark" href="{{ route('brief-assign.index') }}">Volver</a>
                    </div>
                </div>

                {{-- Formulario de borrar --}}

                <div class="card border-danger my-3">
                    <div class="card-header">Borrar brief asignado</div>
                    <div class="card-body text-danger text-right">

                        <form action="{{ route('brief-assign.destroy', $brief_assign->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Borrar">
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
