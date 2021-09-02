@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid" id="events-app">

        <div class="row mt-2 mb-5">
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
                    <i class="bi bi-plus"></i>
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
                            <div class="rounded-0 m-0 p-2 d-flex flex-row justify-content-between align-items-center alert alert-success border-dark">
                                <button class="btn btn-sm btn-dark rounded-circle" type="button" @@click="changeYear(false)">
                                    <i class="bi bi-caret-left-fill"></i>
                                </button>

                                <h4 class="px-4 m-0">@{{ currentYear }}</h4>

                                <button class="btn btn-sm btn-dark rounded-circle" type="button" @@click="changeYear(true)">
                                    <i class="bi bi-caret-right-fill"></i>
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
                                        class="alert alert-success rounded-0 m-0 mt-1 p-1 text-center" role="alert"
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

    </div>
@endsection
