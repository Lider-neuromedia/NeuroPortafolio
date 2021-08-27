@include('admin.projects.fields.title')
@include('admin.projects.fields.categories')
@include('admin.projects.fields.description')

<hr>

<div id="project-form-app">

    <div class="row">
        <div class="col-12 col-lg-6">
            @include('admin.projects.fields.logo')
        </div>
        <div class="col-12 col-lg-6">
            @include('admin.projects.fields.videos')
        </div>
    </div>

    <hr>

    @include('admin.projects.fields.images')

    <hr>

    <div class="row">
        <div class="col-md-12 my-5">
            <a class="btn btn-dark" href="{{ route('projects.index') }}">Volver</a>
            <button class="btn btn-primary" type="submit" :disabled="!canSave">
                Guardar
            </button>
        </div>
    </div>

</div>