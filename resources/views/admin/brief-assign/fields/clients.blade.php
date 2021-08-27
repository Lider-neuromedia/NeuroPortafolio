<div class="form-group @error('client_id') has-error has-feedback @enderror">
    <label for="client_id">*Cliente</label>

    <select
        required
        class="form-control @error('client_id') is-invalid @enderror"
        id="client_id"
        name="client_id">

        @foreach ($clients as $client)
            <option value="{{ $client->id }}"
                @if(old('client_id') && old('client_id') == $client->id)
                    selected
                @endif>
                {{$client->name}}
            </option>
        @endforeach
    </select>

    @error('client_id')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>