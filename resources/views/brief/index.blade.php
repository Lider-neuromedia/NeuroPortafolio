@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>{{ $content->brief->name }}</h1>

                <hr>

                @if ($content->is_completed)

                    @include('brief.complete-message')

                @endif

                @if ($content->is_not_completed && $percentage > 0)

                    @include('brief.complete-form')

                @endif

                @if ($content->is_not_completed)

                    @include('brief.fill-form')

                @endif

            </div>
        </div>

    </div>
@endsection
