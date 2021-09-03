<form method="get" action="{{ url('admin/brief-assign') }}">
    <div class="input-group input-group-sm" style="width: 200px;">
        <input class="form-control float-right" placeholder="Buscar" type="search" name="s" value="{{$search}}">
        <div class="input-group-append">
            <button class="btn btn-default" type="submit" title="Ejecutar Búsqueda">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>