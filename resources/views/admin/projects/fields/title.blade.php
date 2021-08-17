<div class="form-group">
    <label class="form-label" for="title">*Título</label>
    <input
        class="form-control @error('title') is-invalid @enderror"
        type="text"
        name="title"
        id="title"
        value="{{ old('title') ?: $project->title }}" required>

    @error('title')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>