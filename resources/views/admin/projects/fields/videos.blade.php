<div class="form-group">
    <label class="form-label d-flex justify-content-between align-middle">
        <span>Videos <small>(url de youtube)</small></span>
        <button type="button" class="btn btn-success btn-sm" title="Agregar Video" @@click="addVideo">
            <i class="bi bi-plus-circle"></i>
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
            <i class="bi bi-x-circle"></i>
        </button>
    </div>

    @error('videos.*')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror

    <div class="alert alert-secondary" v-if="videos.length == 0">
        Sin Videos
    </div>

</div>