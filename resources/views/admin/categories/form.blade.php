@include('admin.categories.fields.name')

<div class="row">
    <div class="col-md-12 my-5">
        <a class="btn btn-dark" href="{{ route('categories.index') }}">Volver</a>
        <button class="btn btn-primary" type="submit">
            Guardar
        </button>
    </div>
</div>