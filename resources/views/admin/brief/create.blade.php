@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>Crear Brief</h1>
                <hr>

                <form action="{{ route('brief.store', $brief) }}" method="post">
                    @csrf
                    @include('admin.brief.form')
                </form>

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