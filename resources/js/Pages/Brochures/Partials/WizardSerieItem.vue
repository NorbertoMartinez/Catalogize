<template>


    <v-card flat density="compact">


        <v-window v-show="step==1">
            <v-card-text>

                <v-form ref="form">

                    <v-card
                        color="deep-purple-lighten-1"
                        variant="text"
                        flat
                        class="rounded-lg"
                        density="compact">


                        <v-card-text>

                            <v-form ref="first_item">

                                <v-row>

                                    <v-col cols="12">
                                        <v-text-field
                                            label="Titulo *"
                                            v-model="brochure.title"
                                            prepend-icon="mdi-alphabet-latin"
                                            hint="Cual es el titulo de este registro?"
                                            density="compact"
                                            persistent-hint
                                            :rules="Rules.text50"
                                            required
                                            counter="50"
                                        ></v-text-field>
                                    </v-col>


                                    <v-col cols="12">
                                        <v-textarea
                                            label="Descripción"
                                            v-model="brochure.description"
                                            prepend-icon="mdi-alphabet-latin"
                                            hint="Quieres agregar una descripción?"
                                            density="compact"
                                            persistent-hint
                                            counter="200"
                                        ></v-textarea>
                                    </v-col>


                                    <v-col cols="12">

                                        <v-select
                                            label="Tipo de Recurso *"
                                            v-model="brochure.brochure_type_id"
                                            prepend-icon="mdi-alphabet-latin"
                                            hint="Que tipo de recurso subirás?"
                                            density="compact"
                                            persistent-hint
                                            :rules="Rules.SelectorRules"
                                            :items="Cats.brochures_types"
                                            :item-disabled="item => (item.status_id == 1)?false:true"
                                            item-title="name"
                                            item-value="id"
                                        ></v-select>

                                    </v-col>


                                </v-row>

                            </v-form>

                        </v-card-text>
                    </v-card>
                </v-form>

            </v-card-text>
        </v-window>


        <v-window v-show="step==2">
            <v-card-text>

                <v-form ref="resource_item">

                <v-row>

                    <v-col cols="12">

                        <PreviewResource
                            :src="attach_preview"
                            :type="brochure.brochure_type_id"
                        ></PreviewResource>

                        <v-card
                            v-if="attach_preview==null"
                            color="deep-purple-accent-1"
                            class="d-flex align-center rounded-xl"
                            dark
                            width="100%"
                            height="200"
                            @click="$refs.resource_ar.click()"
                        >
                            <v-scroll-y-transition>
                                <div class="flex-grow-1 text-center">
                                    <v-icon  icon="mdi-plus"></v-icon>
                                </div>
                            </v-scroll-y-transition>
                        </v-card>
                    </v-col>

                    <v-col cols="12">
                        <v-row>
                            <v-col cols="12">
                                <v-row>
                                    <v-col cols="4">
                                        <v-switch
                                            label="Recurso externo"
                                            v-model="brochure.isExternalPattern"
                                            density="compact"
                                            persistent-hint
                                            inset
                                            color="deep-purple-lighten-1"></v-switch>
                                    </v-col>
                                    <v-col cols="8">

                                        <v-file-input
                                            label="Cargar recurso"
                                            v-model="brochure.attached"
                                            ref="resource_ar"
                                            prepend-icon="mdi-alphabet-latin"
                                            :hint="'Archivos válidos: ' + mimes"
                                            density="compact"
                                            persistent-hint
                                            :accept="mimes"
                                            :rules="(!brochure.isExternalPattern)?Rules.image_long:[ v => v ]"
                                            v-show="!brochure.isExternalPattern"
                                            @update:modelValue="__preview_resource"
                                        ></v-file-input>

                                        <v-text-field
                                            label="URL del recurso"
                                            v-model="brochure.attached_link"
                                            v-show="brochure.isExternalPattern"
                                            :rules="(brochure.isExternalPattern)?Rules.url:[ v => v ]"
                                            prepend-icon="mdi-alphabet-latin"
                                            hint="Introduce aquí la URL del recurso"
                                            density="compact"
                                            persistent-hint
                                            @update:modelValue="__preview_resource"
                                        ></v-text-field>

                                    </v-col>
                                </v-row>
                            </v-col>

                            <v-col cols="12">

                                <v-row>
                                    <v-col cols="4">
                                        <v-switch
                                            label="Incluye enlace?"
                                            v-model="brochure.isLink"
                                            hint="Agrega cuanto cuesta tu producto"
                                            density="compact"
                                            model-value="true"
                                            persistent-hint
                                            inset
                                            color="deep-purple-lighten-1"></v-switch>
                                    </v-col>
                                    <v-col cols="8">
                                        <v-text-field
                                            label="Enlace al que dirige"
                                            v-model="brochure.link"
                                            :rules="(brochure.isLink)?Rules.url:[ ]"
                                            prepend-icon="mdi-alphabet-latin"
                                            hint="Que tipo de serie quieres crear?"
                                            density="compact"
                                            persistent-hint
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-col>

                            <v-col cols="12" v-show="enable_play_atts">

                                <v-row>
                                    <v-col cols="6">
                                        <v-switch
                                            label="Reproducir Automáticamente"
                                            v-model="brochure.isPlayable"
                                            hint="Agrega cuanto cuesta tu producto"
                                            density="compact"
                                            persistent-hint
                                            inset
                                            color="deep-purple-lighten-1"></v-switch>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-switch
                                            label="Reproducir Audio"
                                            v-model="brochure.isSoundable"
                                            hint="Agrega cuanto cuesta tu producto"
                                            density="compact"
                                            persistent-hint
                                            inset
                                            color="deep-purple-lighten-1"></v-switch>
                                    </v-col>
                                </v-row>
                            </v-col>

                        </v-row>
                    </v-col>

                </v-row>

                </v-form>

            </v-card-text>
        </v-window>


        <v-window v-show="step==3">

            <v-card-text>

                <v-form ref="pattern_form">

                    <v-row>
                        <v-col cols="6">

                            <v-img
                                @click="$refs.resource_ar.click()"
                                :src="pattern_preview"></v-img>

                            <v-card
                                color="deep-purple-accent-1"
                                class="d-flex align-center rounded-xl"
                                dark
                                width="100%"
                                height="200"
                                v-if="!pattern_preview"
                            >
                                <v-scroll-y-transition>
                                    <div class="flex-grow-1 text-center">
                                        <v-icon  icon="mdi-qr_code"></v-icon>
                                    </div>
                                </v-scroll-y-transition>
                            </v-card>
                        </v-col>

                        <v-col cols="6">

                            <v-row>
                                <v-col cols="12">
                                    <v-switch
                                        label="Activador automático (QR)"
                                        density="compact"
                                        persistent-hint
                                        inset
                                        color="deep-purple-lighten-1"
                                        v-model="brochure.isExternalPattern"
                                        @update:modelValue="generateQr"
                                    ></v-switch>

                                </v-col>
                                <v-col cols="12">

                                    <PatternMaker
                                        :reset="reset_marker"
                                        @reseted="reset_marker = false"
                                        @marker="pattern_preview  = $event"
                                        @previewer="resource_marker  = $event"
                                        @file="brochure.patt_file  = $event"
                                    ></PatternMaker>


                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-form>
            </v-card-text>

        </v-window>


        <v-window v-show="step==4">

            <v-card-text>
                <div class="pa-4 text-center">

                    <h3 class="text-h6 font-weight-light mb-2">
                        Tu serie ahora ya tiene un registro!
                    </h3>

                    <span class="text-caption">Puedes continuar agregando mas registros a tu serie o puedes terminar y agregarlos después</span>
                </div>
            </v-card-text>
        </v-window>


        <v-window v-show="step==100">
            <div class="pa-4 text-center">
                <h3 class="text-h6 font-weight-light mb-2">
                    Ocurrio un error
                </h3>
                <span class="text-caption">Ha ocurrido un error al crear el folleto AR</span>
            </div>
        </v-window>

    </v-card>



            <v-card-actions class="hidden">
                <v-btn

                    v-if="step > 1"
                    variant="text"
                    @click="step--"
                >
                    Retroceder
                </v-btn>
                <v-spacer></v-spacer>


                <v-btn
                    v-if="step <= 3 "
                    color="deep-purple-lighten-1"
                    variant="flat"
                    type="submit"
                    @click="validate_step"
                >
                    Siguiente
                </v-btn>


                <v-btn
                    v-if="step == 4"
                    color="deep-purple-lighten-1"
                    variant="flat"
                    :loading="loading"
                    @click="push(2)"
                >
                    Terminar
                </v-btn>
                <v-btn
                    v-if="step == 4"
                    color="deep-purple-lighten-1"
                    variant="flat"
                    :loading="loading"
                    @click="push(1)"
                >
                    Crear nuevo
                </v-btn>
                <v-btn
                    v-show="isUpdate"
                    v-if="step == 3"
                    color="deep-purple-lighten-1"
                    variant="flat"
                    :loading="loading"
                    @click="push(2)"
                >
                    Actualizar
                </v-btn>
            </v-card-actions>

</template>


<script>

import Rules from "../../../Resources/Variables/Rules.vue";
import Cats from "../../../Resources/Variables/Catalogs.vue";
import PreviewResource from "./PreviewResource.vue";
import PatternMaker from "./PatternMaker.vue";

export default {
    name: "wizard-item",

    props: {
        serie: {},
        iterator: 0,
        isUpdate: false,
        resource: {},
    },

    components: {
        PatternMaker,
        PreviewResource
    },

    computed: {


        mimes: function (){
            switch (this.brochure.brochure_type_id){
                case 1:
                    return "video/mp4, video/webm";
                case 2:
                    return "image/bmp, image/jpeg, image/x-png; image/png";
                default: return "image/bmp, image/jpeg, image/x-png; image/png";
            }
        },

        enable_play_atts: function (){
            switch (this.brochure.brochure_type_id){
                case 1:
                    return true;
                case 2:
                    return false;
                default: return false;
            }
        }
    },

    data(){
        return {

            Rules,Cats,

            /*Loading Buttons */
            loading: false,

            /* Stepper */
            step: 1,

            brochure: {
                attached: null,
            },

            attach_preview: null,
            pattern_preview: null,
            resource_marker: null,

            /* Show Details in Section fields  */
            details: false,

            reset_marker: false,

        }
    },

    methods: {

        __reset: function (){

            this.attach_preview = null
            this.resource_marker = null
            this.pattern_preview = null
            this.brochure = {
                attached: null,
            };
            this.$refs.first_item.reset()
            this.$refs.resource_item.reset()
            this.$refs.pattern_form.reset()
            this.$refs.pattern_form.reset()
            this.reset_marker = true;
            this.step=1

            this.$emit("reseted", 1)

        },




        __save: async function (){

            var formdata = new FormData();
                formdata.append("b2b_id", this.serie.b2b_id);
                formdata.append("serie_id", this.serie.id);

            Object.entries(this.brochure).forEach(([k, v]) => {
                if(k == "attached"){
                    formdata.append(k, v[0]);
                } else {
                    formdata.append(k, v);
                }
            })

            return await axios.post("/op/brochures-series-item", formdata,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
        },


        push: function (type){

            var self = this;

            this.__save().then(function (response){
                self.$emit("push", response.data.data);
            })
            this.$emit("action", type);
        },

        next: function (){
            this.step++;
        },

        back: function (){
            this.step--;
        },


        validate_step(){
            var self=this;
            switch (this.step){
                case 1:
                    this.$refs.first_item.validate().then(function (v){

                        if (v.valid) {
                            self.step = 2;
                        } else {
                            self.step = 1;
                        }
                    })

                    this.$emit("stepper", this.step)
                    return
                case 2:
                    this.$refs.resource_item.validate().then(function (v){

                        if (v.valid) {
                            self.step = 3;
                        } else {
                            self.step = 2;
                        }
                    })

                    this.$emit("stepper", this.step)
                    return
                case 3:
                    this.$refs.pattern_form.validate().then(function (v){

                        if (v.valid) {
                            self.step = 4;
                        } else {
                            self.step = 3;
                        }
                    })

                    this.$emit("stepper", this.step)
                    return
                default:

                    this.$emit("stepper", this.step)

                    return
            }
        },


        generateQr: function (){

        },


        __preview_resource: function () {

            if(this.brochure.isExternalPattern){
                this.attach_preview = "";
            } else {
                const resources = this.$refs.resource_ar
                const files = resources.files;
                if (files && files[0]) {


                    const reader = new FileReader
                    reader.onload = e => {
                        this.attach_preview = reader.result;
                    }

                    reader.readAsDataURL(files[0])
                }
            }
        },
    }
}
</script>

<style>
.v-select .v-field .v-field__input > input{
    opacity: 0 !important;
}
</style>
