<div class="row mb-3">

    <div class="col-12 col-md-6">
        <label class="form-label d-flex justify-content-between align-middle">
            <span>Imagenes <small>(400px x 400px mínimo)</small></span>

            <div class="">
                <button type="button" class="btn btn-dark btn-sm" title="Remover Imagen" @@click="removeImage" :disabled="newImages.length == 0">
                    <i class="bi bi-dash-circle"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" title="Agregar Imagen" @@click="addImage">
                    <i class="bi bi-plus-circle"></i>
                </button>
            </div>
        </label>

        <div v-for="(image, index) in newImages" :key="index" class="form-group @error('images.*') has-error has-feedback @enderror">
            <div class="custom-file">
                <input
                    :name="`images[${index}]`"
                    :id="`images[${index}]`"
                    @@change="changeFile"
                    type="file"
                    class="custom-file-input"
                    lang="es"
                    required>
                <label class="custom-file-label" :for="`images[${index}]`">
                    Seleccionar imagen @{{ index + 1 }}
                </label>
            </div>

            @error('images.*')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
            @enderror
        </div>
    </div>

    <div class="col-12 col-md-6 d-flex justify-content-start align-items-start" style="gap: 1rem;">
        <div v-for="(image, index) in images" :key="index" class="card" style="width: 170px;">
            <input type="hidden" :name="`current_images[${index}]`" :value="image.path">
            <img width="100%" height="auto" :src="image.url" class="card-img-top" alt="imagen">
            <div class="card-body text-center">
                <button type="button" class="btn btn-sm btn-danger" title="Borrar imagen" @@click="removeCurrentImage(index)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    </div>

</div>