@extends('layouts.dashboard')

@section('title', 'Gráficas 1')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Gráficas 1</li>
@endsection

@section('content')

    <div class="row mt-2 mb-5" id="events-app">
        <div class="col-12 col-sm-4">

            <div class="form-group" for="month">
                <label for="month">Mes</label>
                <select id="month" class="form-control" v-model="newEvent.month">
                    <option v-for="month in months" :value="month">@{{ month }}</option>
                </select>
            </div>

            <div class="form-group" for="description">
                <label for="description">Título</label>
                <input type="text" class="form-control" id="description" v-model="newEvent.description">
            </div>

            <button class="btn btn-dark" @@click="createEvent" type="button">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Crear Evento
            </button>

            <hr>

            <div class="alert alert-warning rounded-0 my-1" role="alert">
                Haga click en un evento para eliminarlo
            </div>

        </div>
        <div class="col-12 col-sm-8">
            <div class="container-fluid">
                <div class="row no-gutters">

                    <div class="col-12">
                        <div class="rounded-0 m-0 p-2 d-flex flex-row justify-content-between align-items-center alert alert-primary border-dark">
                            <button class="btn btn-sm btn-dark" type="button" @@click="changeYear(false)">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                            </button>

                            <h4 class="px-4 m-0">@{{ currentYear }}</h4>

                            <button class="btn btn-sm btn-dark" type="button" @@click="changeYear(true)">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 border-bottom border-left border-dark"
                        :class="{ 'border-right' : (index + 1) % 3 == 0}"
                        v-for="(month, index) in months" :key="index">
                        <div class="m-2" style="min-height: 185px;">
                            <div class="month-title p-0 text-center">@{{ month }}</div>

                            <div class="month-events">
                                <div
                                    v-for="(event, jndex) in filteredEvents(month, currentYear)" :key="jndex"
                                    class="alert alert-primary rounded-0 m-0 mt-1 p-1 text-center" role="alert"
                                    style="cursor: pointer;"
                                    @@click="deleteEvent(event)">
                                    @{{ event.description }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
