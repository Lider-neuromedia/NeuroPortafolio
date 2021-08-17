<div class="form-group @error('description') has-error has-feedback @enderror">
    <label class="form-label" for="description">Descripción</label>
    <textarea
        class="form-control @error('description') is-invalid @enderror"
        name="description"
        id="description"
        cols="30"
        rows="6">{{ old('description') ?: $project->description }}</textarea>

    @error('description')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>