<div class="row">
    <div class="col-12">

        <div class="card mb-5">
            <div class="card-body">

                <h3>Crear Enlace</h3>
                <hr>

                <div class="row">
                    <div class="col-12 col-md-6 mb-2">

                        <ul class="list-group">

                            @if (count($link_projects) == 0)
                                <div class="alert alert-warning">
                                    No ha seleccionado ningún proyecto.
                                </div>
                            @endif

                            @foreach ($link_projects as $lproject)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$lproject->title}}

                                    <form id="lrform" action="{{ route('link-creation.remove', $lproject) }}" method="post">
                                        @csrf
                                        <button class="btn btn-sm btn-danger btn-pill" type="submit">x</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="col-12 col-md-6">

                        <form id="lcform" action="{{ route('link-creation.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="slug">Código único</label>

                                <input
                                    class="form-control @error('slug') is-invalid @enderror"
                                    value="{{ old('slug') }}"
                                    type="text"
                                    name="slug"
                                    id="slug"
                                    required>

                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between" style="gap: 1rem;">
                                <a class="btn btn-danger" href="{{ route('link-creation.clean') }}">Cancelar</a>
                                <input
                                    type="submit"
                                    class="btn btn-success"
                                    value="Crear Enlace">
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>