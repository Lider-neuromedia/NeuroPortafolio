<div class="form-group @error('roles.*') has-error has-feedback @enderror">
    <label for="roles[]">Rol</label>

    @php
        $selected_roles = old('roles') ?: $user->roles;
    @endphp

    @foreach ($roles as $role_id => $role_name)
        <div class="form-check @error('roles') is-invalid @enderror @error('roles.*') is-invalid @enderror">
            <input
                @if(in_array($role_id, $selected_roles)) checked @endif
                type="checkbox"
                class="form-check-input"
                value="{{$role_id}}"
                id="roles_{{$role_id}}"
                name="roles[]">
            <label class="form-check-label" for="roles_{{$role_id}}">
                {{$role_name}}
            </label>
        </div>
    @endforeach

    @error('roles')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror

    @error('roles.*')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>