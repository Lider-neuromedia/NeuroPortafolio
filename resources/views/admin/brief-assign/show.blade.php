@extends('layouts.dashboard')

@php
    $title = ($brief_assign->brief ? $brief_assign->brief->name : "Brief") . " / " . $brief_assign->client->name;
@endphp

@section('title', $title)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('brief-assign.index')}}">Brief Asignados</a></li>
    <li class="breadcrumb-item active">Detalle</li>
@endsection

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <div class="card border-secondary">
                    <div class="card-body text-secondary text-center font-weight-bold">
                        <span>Estado: {{ $brief_assign->status_format }}</span>
                    </div>

                    @hasrole('admin')
                        @if ($brief_assign->brief)
                            <div class="card-footer text-right">
                                <form action="{{route('brief-assign.update', $brief_assign->id)}}" method="post">
                                    @csrf
                                    @method('PUT')

                                    @if ($brief_assign->is_completed)
                                        <input type="hidden" name="status" value="{{\App\ClientBrief::STATUS_PENDING}}">
                                        <button class="btn btn-sm btn-primary" type="submit">Abrir Formulario</button>
                                    @else
                                        <input type="hidden" name="status" value="{{\App\ClientBrief::STATUS_COMPLETED}}">
                                        <button class="btn btn-sm btn-dark" type="submit">Cerrar Formulario</button>
                                    @endif

                                    <a class="btn btn-primary btn-sm" href="{{$brief_assign->url}}" title="{{$brief_assign->url}}" target="_blank">
                                        Enlace Público
                                    </a>
                                </form>
                            </div>
                        @endif
                    @endhasrole
                </div>

                {{-- Generar PDF --}}

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="card-title">Generar PDF</div>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-primary" href="{{ route('brief-assign.pdf', $brief_assign->id) }}">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </a>
                        </div>
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


                {{-- Generar PDF --}}

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="card-title">Generar PDF</div>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-primary" href="{{ route('brief-assign.pdf', $brief_assign->id) }}">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>


                {{-- Formulario de borrar --}}

                @hasrole('admin')
                    @include('admin.partials.delete', [
                        'id_form' => 'delete-brief-assign-form',
                        'label' => 'Borrar Brief Asignado',
                        'route' => route('brief-assign.destroy', $brief_assign->id)
                    ])
                @endhasrole

            </div>
        </div>

    </div>
@endsection
