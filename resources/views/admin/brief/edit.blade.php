@extends('layouts.dashboard')

@section('title', 'Editar Brief')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('brief.index')}}">Briefs</a></li>
    <li class="breadcrumb-item active">Editar Brief</li>
@endsection

@section('content')

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-8">

            {{-- Formulario de editar --}}

            <form action="{{ route('brief.update', $brief) }}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{$brief->id}}">
                @include('admin.brief.form')
            </form>


            {{-- Formulario de duplicar --}}

            <div class="card mb-3">
                <div class="card-header">
                    <div class="card-title">Duplicar Brief</div>
                    <div class="card-tools">
                        <a class="btn btn-sm btn-primary" href="{{ route('brief.duplicate', $brief->id) }}"
                            onclick="event.preventDefault(); document.getElementById('duplicate-form-{{$brief->id}}').submit();">
                            Duplicar
                        </a>
                    </div>
                </div>
            </div>
            <form id="duplicate-form-{{$brief->id}}" action="{{ route('brief.duplicate', $brief->id) }}" method="POST" style="display: none;">
                @csrf
            </form>


            {{-- Formulario de borrar --}}

            @php
                $count = $brief->clientsAssigned()->notCompleted()->count();
            @endphp

            @if ($brief->clientsAssigned()->notCompleted()->count() > 0)

                <div class="alert alert-warning text-center">
                    No puede borrar este brief porque está asignado a <strong>{{$count}}</strong> clientes que aún no han terminado de llenar el formulario.
                </div>

            @else

                @include('admin.partials.delete', [
                    'id_form' => 'delete-brief-form',
                    'label' => 'Borrar Brief',
                    'route' => route('brief.destroy', $brief->id)
                ])

            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        window.brief = @json($brief);
        window.types = @json($types);

        @if (old('questions'))
            window.brief.questions = @json(old('questions'));

            for (let i = 0; i < window.brief.questions.length; i++) {
                const element = window.brief.questions[i];
                if (element.type == 'abierta') {
                    window.brief.questions[i].options = null;
                }
            }
        @endif
    </script>
@endsection