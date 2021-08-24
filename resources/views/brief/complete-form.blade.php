<div class="card border-success mb-3">
    <div class="card-body text-success text-center">

        <div class="progress">
            <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width: {{$percentage}}%;"
                aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">
                {{$percentage}}%
            </div>
        </div>

        @if ($percentage == 100)

            <form class="mt-3" action="{{ route('brief.complete', $content->slug) }}" method="POST">
                @csrf
                <input class="btn btn-success" type="submit" value="Completar">
            </form>

        @endif

    </div>
</div>

<hr>