<div class="form-group @error('brief_id') has-error has-feedback @enderror">
    <label for="brief_id">*Brief</label>

    <select
        required
        class="form-control @error('brief_id') is-invalid @enderror"
        id="brief_id"
        name="brief_id">

        @foreach ($briefs as $brief)
            <option value="{{ $brief->id }}"
                @if(old('brief_id') && old('brief_id') == $brief->id)
                    selected
                @endif>
                {{$brief->name}}
            </option>
        @endforeach
    </select>

    @error('brief_id')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>