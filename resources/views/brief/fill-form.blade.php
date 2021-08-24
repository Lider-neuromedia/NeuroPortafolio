<form action="{{ route('brief.save', $content->slug) }}" method="POST">
    @csrf

    @foreach ($questions as $question)

        @if ($question->isOpen)

            {{-- Texto Simple --}}

            <div class="form-group">
                <label class="form-label font-weight-bold" for="{{$question->tag_id}}">{{$question->question}}</label>
                <input
                    maxlength="250"
                    class="form-control @error($question->tag_id) is-invalid @enderror"
                    value="{{ old($question->tag_id) ?: $question->answer[0] }}"
                    name="{{$question->tag_id}}"
                    id="{{$question->tag_id}}"
                    type="text">

                @error($question->tag_id)
                    <span class="invalid-feedback" role="alert">
                        {{$message}}
                    </span>
                @enderror
            </div>

        @elseif ($question->isMultipleSelection)

            {{-- Selección multiple --}}

            <div class="form-group">
                <label class="form-label font-weight-bold" for="{{$question->tag_id}}">{{$question->question}}</label>

                @foreach ($question->options as $key => $option)
                    <div class="form-check @error($question->tag_id) is-invalid @enderror">
                        <label class="form-check-label">
                            <input
                                @if (in_array($option, $question->answer)) checked @endif
                                name="{{ $question->tag_id }}[]"
                                value="{{$option}}"
                                class="form-check-input"
                                type="checkbox">
                            {{$option}}
                        </label>
                    </div>
                @endforeach

                @error($question->tag_id)
                    <span class="invalid-feedback" role="alert">
                        {{$message}}
                    </span>
                @enderror
            </div>

        @elseif ($question->isUniqueSelection)

            {{-- Selección unica --}}

            <div class="form-group">
                <label class="form-label font-weight-bold" for="{{$question->tag_id}}">{{$question->question}}</label>

                @foreach ($question->options as $key => $option)
                    <div class="form-check @error($question->tag_id) is-invalid @enderror">
                        <label class="form-check-label">
                            <input
                                @if (in_array($option, $question->answer)) checked @endif
                                name="{{ $question->tag_id }}[]"
                                value="{{$option}}"
                                class="form-check-input"
                                type="radio">
                            {{$option}}
                        </label>
                    </div>
                @endforeach

                @error($question->tag_id)
                    <span class="invalid-feedback" role="alert">
                        {{$message}}
                    </span>
                @enderror
            </div>

        @endif

    @endforeach

    <hr>

    {{-- Acciones --}}

    <div class="row">
        <div class="col-md-12 mb-5 text-right">
            <button class="btn btn-primary" type="submit">
                Guardar
            </button>
        </div>
    </div>
</form>