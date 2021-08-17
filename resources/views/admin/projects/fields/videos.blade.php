@for ($i = 0; $i < $videos_count; $i++)

    @php
        $current_video = isset($project->videos[$i]) ? $project->videos[$i]->path : "";
        $old_video = isset(old('videos')[$i]) ? old('videos')[$i] : $current_video;
        $class_validation = "";
        $message_validation = "";

        foreach ($errors->get('videos.*') as $key => $message) {
            if ($key === "videos." . $i) {
                $class_validation = "is-invalid";
                $message_validation = $message[0];
            }
        }
    @endphp

    <div class="form-group @error('videos.*') is-invalid @enderror">
        <label class="form-label" for="videos[{{$i}}]">
            Video {{$i + 1}} <small>(url de youtube)</small>
        </label>

        <input
            class="form-control {{$class_validation}}"
            type="text"
            name="videos[{{$i}}]"
            id="videos[{{$i}}]"
            value="{{$old_video}}">

        @if ($message_validation)
            <span class="invalid-feedback" role="alert">
                {{$message_validation}}
            </span>
        @endif
    </div>

@endfor