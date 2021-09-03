@include('admin.brief.fields.name')

<div id="brief-form-app">

    <div class="d-flex justify-content-between align-middle mt-5">
        <h4>Preguntas</h4>
        <button type="button" class="btn btn-sm btn-success" title="Agregar Pregunta" @@click="addQuestion">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>
    </div>

    <hr>

    <div v-for="(question, index) in brief.questions" :key="index" class="card my-4">

        <input v-if="question.id" type="hidden" :name="`questions[${index}][id]`" :value="question.id">

        <div class="card-header">
            <div class="card-title">
                <span class="font-weight-bold">Pregunta #@{{index + 1}}</span>
            </div>
            <div class="card-tools">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-warning" title="Bajar posición" @@click="move(index, false)">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" title="Subir posición" @@click="move(index, true)">
                        <i class="fa fa-arrow-up" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" title="Borrar pregunta" @@click="removeQuestion(index)">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body p-2">

            <div class="row">
                <div class="col-12" :class="{'col-sm-6' : (question.type == 'seleccion_multiple' || question.type == 'seleccion_unica')}">

                    {{-- Descripción de la pregunta --}}
                    <div class="form-group">
                        <label :for="`questions[${index}][question]`" class="form-label">*Descripción</label>
                        <input
                            :id="`questions[${index}][question]`"
                            :name="`questions[${index}][question]`"
                            v-model="question.question"
                            class="form-control" type="text" maxlength="250" required>
                    </div>

                    {{-- Tipo de pregunta --}}
                    <div class="form-group">
                        <label :for="`questions[${index}][type]`">*Tipo</label>
                        <select
                            class="form-control"
                            :id="`questions[${index}][type]`"
                            :name="`questions[${index}][type]`"
                            v-model="question.type">
                            <option v-for="(type, jndex) in types" :key="jndex" :value="type.id">
                                @{{ type.name }}
                            </option>
                        </select>
                    </div>

                </div>
                <div class="col-12 col-sm-6">

                    {{-- Opciones de pregunta de selección --}}
                    <div class="form-group" v-if="question.type == 'seleccion_multiple' || question.type == 'seleccion_unica'">
                        <div class="d-flex justify-content-between align-middle">
                            <label>*Opciones</label>
                            <button type="button" class="btn btn-sm btn-success" title="Agregar opción" @@click="addOption(index)">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div v-for="(option, kndex) in question.options" :key="kndex" class="d-flex justify-content-between my-1">
                            <input
                                :id="`questions[${index}][options][${kndex}]`"
                                :name="`questions[${index}][options][${kndex}]`"
                                v-model="question.options[kndex]"
                                class="form-control" type="text" maxlength="250" required>
                            <button type="button" class="btn btn-sm btn-dark ml-1" title="Borrar opción" @@click="removeOption(index, kndex)">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    {{-- Acciones --}}

    <div class="row">
        <div class="col-md-12 my-5">
            <a class="btn btn-dark" href="{{ route('brief.index') }}">Volver</a>
            <button class="btn btn-primary" type="submit" :disabled="!canSave">
                Guardar
            </button>
        </div>
    </div>

</div>
