@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>Editar Brief</h1>
                <hr>

                {{-- Formulario de editar --}}

                <form action="{{ route('brief.update', $brief) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{$brief->id}}">
                    @include('admin.brief.form')
                </form>


                {{-- Formulario de duplicar --}}

                <div class="card border-secondary mb-3">
                    <div class="card-header">Duplicar Brief</div>
                    <div class="card-body text-secondary text-right">

                        <a class="btn btn-warning border-secondary" href="{{ route('brief.duplicate', $brief->id) }}"
                            onclick="event.preventDefault(); document.getElementById('duplicate-form-{{$brief->id}}').submit();">
                            Duplicar
                        </a>

                        <form id="duplicate-form-{{$brief->id}}" action="{{ route('brief.duplicate', $brief->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>


                {{-- Formulario de borrar --}}

                <div class="card border-danger mb-3">
                    <div class="card-header">Borrar Brief</div>
                    <div class="card-body text-danger text-right">

                        @php
                            $count = $brief->clientsAssigned()->notCompleted()->count();
                        @endphp

                        @if ($brief->clientsAssigned()->notCompleted()->count() > 0)

                            <div class="alert alert-warning border-warning text-center">
                                Este brief está asignado a {{$count}} clientes que aún no han terminado de llenar el formulario.
                            </div>

                        @else

                            <form action="{{ route('brief.destroy', $brief->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>

                        @endif

                    </div>
                </div>

            </div>
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