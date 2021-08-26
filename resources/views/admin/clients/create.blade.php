@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8">

                <h1>Crear Cliente</h1>
                <hr>

                <form action="{{ route('clients.store', $client) }}" method="post">
                    @csrf
                    @include('admin.clients.form')
                </form>

            </div>
        </div>

    </div>
@endsection
