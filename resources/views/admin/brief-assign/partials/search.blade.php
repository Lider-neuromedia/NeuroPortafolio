<div class="row justify-content-center mt-5 mb-2">
    <div class="col-12">

        <form class="d-flex" method="get" action="{{ url('admin/brief-assign') }}">
            <input class="flex-grow-1 form-control mr-2" placeholder="Buscar por cliente o brief" aria-label="Search" type="search" name="s" value="{{$search}}">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>

    </div>
</div>