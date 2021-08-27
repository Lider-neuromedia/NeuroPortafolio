<div class="card border-primary my-3">
    <div class="card-header border-primary">Asignar brief a cliente</div>
    <div class="card-body">

        <form action="{{ route('brief-assign.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-12 col-sm-6">
                    @include('admin.brief-assign.fields.briefs')
                </div>
                <div class="col-12 col-sm-6">
                    @include('admin.brief-assign.fields.clients')
                </div>
            </div>

            <div class="text-right">
                <input class="btn btn-primary" type="submit" value="Asignar">
            </div>
        </form>

    </div>
</div>
