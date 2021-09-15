<div class="form-group">
    <label class="form-label d-flex justify-content-between align-middle">
        <span>Videos <small>(url de youtube)</small></span>
        <button type="button" class="btn btn-primary btn-sm" title="Agregar Video" @@click="addVideo">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </label>

    <div v-for="(video, index) in videos" :key="index" class="d-flex justify-content-between my-1 @error('videos.*') is-invalid @enderror">
        <input
            class="form-control" type="text"
            :name="`videos[${index}]`"
            :id="`videos[${index}]`"
            v-model="video.path"
            required>
        <button type="button" class="btn btn-sm btn-dark ml-1" title="Borrar video" @@click="removeVideo(index)">
            <i class="fa fa-minus" aria-hidden="true"></i>
        </button>
    </div>

    @error('videos.*')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror

    <div class="card" v-if="videos.length == 0">
        <div class="card-body text-center">
            Sin Videos
        </div>
    </div>

</div>