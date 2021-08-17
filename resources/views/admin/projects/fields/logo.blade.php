<div class="form-group @error('logo') has-error has-feedback @enderror">
    <label class="form-label" for="logo">*Logo</label>

    <div class="custom-file @error('logo') is-invalid @enderror">
        <input
            class="custom-file-input @error('logo') is-invalid @enderror"
            @if($project->id == null) required @endif
            type="file"
            name="logo"
            id="logo"
            lang="es">
        <label class="custom-file-label" for="logo">Seleccionar archivo</label>
    </div>

    @error('logo')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror

    @if ($project->logo)
        <div class="my-2">
            <img class="img-thumbnail" width="200px" height="auto" src="{{ $project->logo->url }}" title="Imagen actual">
        </div>
    @endif
</div>
