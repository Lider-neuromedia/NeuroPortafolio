@extends('layouts.dashboard')

@section('content')
    <div id="monthly-app" class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-4">

                <article class="container-fluid my-3">
                    <div class="row">
                        <div class="col-12 p-1 mb-3">
                            <button @@click="addMonthRow" type="button" class="btn btn-dark">
                                <i class="bi bi-plus"></i>
                                Agregar Fila
                            </button>
                        </div>
                    </div>

                    <div class="row align-items-center" v-for="(month, index) of months" :key="index">

                        <!-- Campo X -->
                        <div class="col-6 form-group mb-0 p-1" :for="`x${index}`">
                            <input type="text" class="form-control" :id="`x${index}`" v-model="month.x">
                        </div>

                        <!-- Campo Y -->
                        <div class="col-3 form-group mb-0 p-1" :for="`y${index}`">
                            <input type="number" min="0" step="1" class="form-control" :id="`y${index}`" v-model="month.y">
                        </div>

                        <!-- Botón Borrar -->
                        <div class="col-3">
                            <button @@click="removeMonthRow(index)" type="button" class="btn btn-sm btn-dark">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                    </div>
                </article>

            </div>
            <div class="col-12 col-sm-8 my-3">
                <graph :chart-data="graphData"></graph>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
@endsection