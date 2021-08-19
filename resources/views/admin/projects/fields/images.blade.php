<div class="row">
    @for ($j = 0; $j < $images_count; $j++)

        <div class="col-12 col-md-6">

            @php
                $is_required = $project->id == null && $j == 0;
                $current_image = isset($project->images[$j]) ? $project->images[$j]->url : "";
                $current_image_path = isset($project->images[$j]) ? $project->images[$j]->path : "";
                $old_video = isset(old('images')[$j]) ?: $current_image;
                $class_validation = "";
                $message_validation = "";

                foreach ($errors->get('images.*') as $key => $message) {
                    if ($key === "images." . $j) {
                        $class_validation = "is-invalid";
                        $message_validation = $message[0];
                    }
                }
            @endphp

            <input
                type="hidden"
                name="current_images[{{$j}}]"
                id="current_images[{{$j}}]"
                value="{{ $current_image_path }}">

            <div class="form-group @error('images') has-error has-feedback @enderror">
                <label class="form-label" for="images[{{$j}}]">
                    @if($is_required)*@endif
                    Imagen {{ $j + 1 }} <small>(400px x 400px mínimo)</small>
                </label>

                <div class="custom-file {{$class_validation}}">
                    <input
                        type="file"
                        class="custom-file-input {{$class_validation}}"
                        name="images[{{$j}}]"
                        id="images[{{$j}}]"
                        lang="es"
                        @if($is_required) required @endif>
                    <label class="custom-file-label" for="images[{{$j}}]">
                        Seleccionar archivo
                    </label>
                </div>

                @if ($message_validation)
                    <span class="invalid-feedback" role="alert">
                        {{$message_validation}}
                    </span>
                @endif

                @if ($current_image)
                    <div class="my-2">
                        <img
                            class="img-thumbnail"
                            width="200px"
                            height="auto"
                            src="{{ $current_image }}"
                            title="Imagen actual">
                    </div>
                @endif
            </div>

        </div>

    @endfor
</div>