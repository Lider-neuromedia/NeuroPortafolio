<div class="form-group">
    <label class="form-label" for="name">*Nombre</label>
    <input
        class="form-control @error('name') is-invalid @enderror"
        name="name"
        id="name"
        type="text"
        maxlength="250"
        value="{{ old('name') ?: $client->name }}" required>

    @error('name')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>