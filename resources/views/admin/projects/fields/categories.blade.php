<div class="form-group @error('categories') has-error has-feedback @enderror">
    <label for="categories[]">*Categorías</label>

    <select
        required
        class="form-control @error('categories.*') is-invalid @enderror"
        id="categories[]"
        name="categories[]"
        multiple
        size="8">
        @php
            $selected_categories = $project->categories()->get()->map(function($x) { return $x->id; })->toArray();
            $selected_categories = old('categories') ?: $selected_categories;
        @endphp

        @foreach ($categories as $category)
            <option @if(in_array($category->id, $selected_categories)) selected @endif value="{{ $category->id }}">
                {{$category->name}}
            </option>
        @endforeach
    </select>

    @error('categories.*')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>