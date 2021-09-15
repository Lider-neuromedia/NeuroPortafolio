<div class="card border-primary mb-3">
    <div class="card-body text-primary text-center">

        <div class="progress">
            <div
                class="progress-bar bg-primary"
                role="progressbar"
                style="width: {{$percentage}}%;"
                aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100">
                {{$percentage}}%
            </div>
        </div>

        @if ($percentage == 100)

            <form class="mt-3" action="{{ route('brief.complete', $content->slug) }}" method="POST">
                @csrf
                <input class="btn btn-primary" type="submit" value="Completar y Cerrar">
            </form>

        @endif

    </div>
</div>

<hr>