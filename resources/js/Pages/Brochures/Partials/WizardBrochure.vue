<template>

    <v-card flat>


        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="$emit('dialog', false)">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-toolbar>

        <v-window v-model="step">


            <v-form ref="form">



                <!--Brochure Form-->
                <v-window-item :value="1">
                    <v-card-text>

                        <v-col cols="12">

                            <v-alert
                                density="compact"
                                border="start"
                                border-color="deep-purple accent-4"
                                elevation="2"
                                class="mb-4"
                                closable
                            >
                                Ahora ingresa los detalles de tu Folleto, Asi es como se mostrará a tus clientes.
                            </v-alert>
                        </v-col>

                        <v-row>

                            <v-col cols="12">

                                <v-text-field
                                    label="Nombre del folleto *"
                                    v-model="record.brochure.name"
                                    :rules="Rules.InputTextRules"
                                    hint="Nombre que aparece en la pantalla principal del visor"
                                    required
                                    variant="outlined"
                                    counter="50"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="6">
                                <v-select
                                    label="Empresa *"
                                    hint="Seleccione una empresa de su lista"
                                    :rules="Rules.SelectorRules"
                                    required
                                    variant="outlined"
                                    v-model="record.brochure.b2b_id"
                                    :items="b2bs"
                                    :item-title="item => item.name"
                                    :item-value="item => item.id"
                                ></v-select>
                            </v-col>
                            <v-col cols="6">
                                <v-select
                                    label="Estado del catálogo *"
                                    hint="Si desea publicar el folleto, seleccione ACTIVO"
                                    v-model="record.brochure.status_id"
                                    :rules="Rules.SelectorRules"
                                    required
                                    variant="outlined"
                                    :items="Cats.statuses"
                                    item-title="name"
                                    :item-value="item => item.id"
                                ></v-select>
                            </v-col>

                            <v-col cols="12">
                                <v-textarea
                                    label="Descripción del folleto"
                                    v-model="record.brochure.description"
                                    v-show="showDetail"
                                    required
                                    variant="outlined"
                                    counter="200"
                                ></v-textarea>
                            </v-col>
                        </v-row>


                        <v-btn
                            block
                            variant="text"
                            @click="showDetail = !showDetail"
                        >
                            + Mostrar / Ocultar Detalles
                        </v-btn>


                    </v-card-text>
                </v-window-item>


                <!--Select Type Brochure -->
                <v-window-item :value="2">
                    <v-card-text lazy>


                        <v-col cols="12">

                            <v-alert
                                density="compact"
                                border="start"
                                border-color="deep-purple accent-4"
                                elevation="2"
                                class="mb-4"
                                closable
                            >
                                Ahora ingresa los detalles de tu Folleto, Asi es como se mostrará a tus clientes.
                            </v-alert>
                        </v-col>


                        <v-row>
                            <v-col cols="12">


                                <v-row v-if="record.attach_resource != null">
                                    <v-col offset="3" cols="6" class="mb-10">

<!--                                        <video-->
<!--                                            :aspect-ratio="1"-->
<!--                                            :src="record.attach_resource"-->
<!--                                            controls></video>-->

                                        <PreviewResource
                                            @update="$refs.resource.click()"
                                            :src="record.attach_resource"
                                            :type="record.brochure.brochure_type_id">

                                        </PreviewResource>
                                    </v-col>
                                </v-row>


                            </v-col>


                            <v-col cols="6">
                                <v-select
                                    label="Tipo de Folleto *"
                                    :rules="Rules.SelectorRules"
                                    required
                                    variant="outlined"
                                    v-model="record.brochure.brochure_type_id"
                                    :items="brochures_types"
                                    :item-disabled="item => (item.status_id == 1)?false:true"
                                    item-title="name"
                                    item-value="id"
                                ></v-select>
                            </v-col>

                            <v-col cols="6">
                                <v-file-input
                                    label="Recurso a mostrar"
                                    :accept="mimes"
                                    required
                                    variant="outlined"
                                    :rules="Rules.image_long"
                                    v-model="record.attached_resource"
                                    :disabled="!record.brochure.brochure_type_id"
                                    v-show="!isExternalResource"
                                    ref="resource"
                                    @update:modelValue="__preview_resource"
                                ></v-file-input>

<!--                                <v-text-field-->
<!--                                    label="Enlace del recurso"-->
<!--                                    v-show="isExternalResource"-->
<!--                                    append-icon="mdi-swap-horizontal"-->
<!--                                    @click:append="isExternalResource = !isExternalResource"-->
<!--                                    :disabled="!record.brochure.brochure_type_id"-->
<!--                                    :rules="Rules.InputTextRules"-->
<!--                                    variant="outlined"-->
<!--                                    v-model="record.brochure.resource"-->
<!--                                ></v-text-field>-->
                            </v-col>

                            <v-col cols="12" v-show="showDetail">
                                <v-text-field
                                    label="Enlace al que dirige"
                                    variant="outlined"
                                    v-model="record.brochure.link"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" v-show="showDetail">
                                <v-text-field
                                    label="Escala"
                                    v-mask="'##'"
                                    variant="outlined"
                                    v-model="record.brochure.scale"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6" v-show="showDetail">
                                <v-text-field
                                    label="Rotación (Radianes)"
                                    v-mask="'###'"
                                    variant="outlined"
                                    v-model="record.brochure.radials"
                                ></v-text-field>
                            </v-col>


                            <v-col cols="12">

                                <v-btn
                                    block
                                    variant="text"
                                    @click="showDetail = !showDetail"
                                >
                                    + Mostrar / Ocultar Detalles
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-window-item>



                <v-window-item :value="3">
                    <v-card-text>


                        <v-row>

                            <v-col cols="12">
                                <v-alert
                                    density="compact"
                                    border="start"
                                    border-color="deep-purple accent-4"
                                    elevation="2"
                                    class="mb-4"
                                    closable
                                >
                                    El patron activador es la imagen que ejecutara la realidad aumentada
                                </v-alert>
                            </v-col>

                            <v-col cols="12">
                                <v-img
                                    :src="record.attach"
                                    v-show="record.attach!=null"
                                    :aspect-ratio="1"
                                    max-height="300"
                                    @click="$refs.patt.click()"
                                ></v-img>
                            </v-col>

                            <v-col cols="12">
                                <v-select
                                    label="Diseño de patrón *"
                                    :rules="Rules.SelectorRules"
                                    required
                                    variant="outlined"
                                    v-model="record.brochure.pattern_id"
                                    :items="patterns"
                                    :item-title="item => item.name"
                                    :item-value="item => item.id"
                                    @update:modelValue="item => __preview_pattern(item)"
                                ></v-select>

<!--                                <v-file-input-->
<!--                                    label="Patrón (*.patt)"-->
<!--                                    ref="patt"-->
<!--                                    v-model="record.attached"-->
<!--                                    :rules="Rules.image_long"-->
<!--                                    v-show="!isExternalPattern"-->
<!--                                    append-icon="mdi-swap-horizontal"-->
<!--                                    @update:modelValue="__preview_pattern"-->
<!--                                    @click:append="isExternalPattern = !isExternalPattern"-->

<!--                                ></v-file-input>-->
<!--                                -->

                            </v-col>
                        </v-row>


                    </v-card-text>
                </v-window-item>
            </v-form>






            <!--Ends Creates-->
            <v-window-item :value="4">
                <div class="pa-4 text-center">

                    <h3 class="text-h6 font-weight-light mb-2">
                        Felicidades, tu Folleto ha sido creado con éxito
                    </h3>

                    <v-col>
                        <v-btn
                            block
                            size="small"
                            color="deep-purple-lighten-1"
                            prepend-icon="mdi-eye">
                            Vista previa
                        </v-btn>
                    </v-col>

                    <span class="text-caption">Ya puedes descargar tu código, termina de configurarlo y compartelo con tus clientes</span>
                </div>
            </v-window-item>




            <!--Error Window-->
            <v-window-item :value="100">
                <div class="pa-4 text-center">
                    <h3 class="text-h6 font-weight-light mb-2">
                        Ocurrio un error
                    </h3>
                    <span class="text-caption">Ha ocurrido un error al crear el folleto AR</span>
                </div>
            </v-window-item>



        </v-window>

        <v-divider></v-divider>

        <v-card-actions>
            <v-btn

                v-if="step > 1 && step <= 3"
                variant="text"
                @click="step--"
            >
                Retroceder
            </v-btn>
            <v-spacer></v-spacer>

            <v-btn
                v-show="step == 4"
                color="deep-purple-lighten-1"
                variant="flat"
                @click="$emit('update', 1)"
            >
                Cerrar
            </v-btn>


            <v-btn
                v-if=" step <= 2 "
                color="deep-purple-lighten-1"
                variant="flat"
                type="submit"
                @click="step++"
            >
                Siguiente
            </v-btn>

<!--            <v-btn-->
<!--                v-if="step == 2"-->
<!--                color="deep-purple-lighten-1"-->
<!--                variant="flat"-->
<!--                :loading="loading"-->
<!--                @click="next"-->
<!--            >-->
<!--                Guardar y Continuar-->
<!--            </v-btn>-->

            <v-btn
                v-show="!isUpdate"
                v-if="step == 3"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__save"
            >
                Guardar y finalizar
            </v-btn>
            <v-btn
                v-show="isUpdate"
                v-if="step == 3"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__update"
            >
                Actualizar
            </v-btn>
        </v-card-actions>
    </v-card>

</template>


<script>

import Rules from "../../../Resources/Variables/Rules.vue";
import Cats from "../../../Resources/Variables/Catalogs.vue";
import PreviewResource from "./PreviewResource.vue";

export default {
    name: "wizard-brochure",

    props: {

        isUpdate: false,
        resource: {},

    },

    components: {
        PreviewResource
    },

    computed: {
        currentTitle () {

            /* Show Stepper title */
            switch (this.step) {
                case 1: return 'Elige un tipo de Folleto'
                case 2: return 'Detalles'
                case 3: return 'Activador'
                case 4: return 'Listo! '
                case 100: return 'Error al crear el catálogo'
            }
        },
        mimes: function (){
            switch (this.record.brochure.brochure_type_id){
                case 1:
                    return "video/mp4, video/webm";
                case 2:
                    return "image/bmp, image/jpeg, image/x-png; image/png";
                default: return "image/bmp, image/jpeg, image/x-png; image/png";
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

            /* Record to create */
            record: {
                attach_resource: null,
                attached_resource: null,
                attach: null,
                attached: null,
                brochure: {
                },
            },

            /* retrieve catalogs */
            b2bs: [],
            brochures_types: [],
            patterns: [],

            /* Show Details in Section fields  */
            details: false,


            isExternalResource: false,
            isExternalPattern: false,
            showDetail: false,


        }
    },

    mounted(){
        // this.Toast("1 asdasd asd");

        if(this.isUpdate){
            this.record.brochure = this.resource;
        }

        this.__fetch_brochures_types();
        this.__fetch_patterns();
        this.__fetch_b2bs();

    },

    methods: {

        next: function (){
            this.step++;
        },
        back: function (){
            this.step--;
        },

        complement_record(){
            // var self=this;
            // this.$refs.form.validate().then(function (v){
            //     if(v.valid){
                    self.step++;
                // }
            // })
        },

        /**
         *
         * @param bussiness_type
         * @private
         */
        __fetch_brochures_types: function ()
        {
            var self=this;
            // this.records.catalog.bussiness_type_id = bussiness_type.id;
            axios.get("/resources/brochures-types")
                .then((result) => {

                    self.brochures_types = result.data.data;
                })
        },

        /**
         *
         * @param bussiness_type
         * @private
         */
        __fetch_patterns: function ()
        {
            var self=this;
            // this.records.catalog.bussiness_type_id = bussiness_type.id;
            axios.get("/resources/patterns")
                .then((result) => {
                    self.patterns = result.data.data;
                })
        },


        /**
         *
         * @private
         */
        __fetch_b2bs(){
            var self=this;
            axios.get("/x/b2b-list").then(function (result){
                self.b2bs = result.data.data;
            });
        },


        __preview_resource: function () {


            const resources = this.$refs.resource
            const files = resources.files;
            if (files && files[0]) {


                const reader = new FileReader
                reader.onload = e => {
                    this.record.attach_resource = reader.result;
                }

                reader.readAsDataURL(files[0])
            }
        },

        __upload_resource: async function (item){
            if(this.record.attached_resource){

                let resourceForm = new FormData();
                    resourceForm.append("resource", this.record.attached_resource[0]);

                return await axios.post("/op/resource/brochure-resource/"+item.id,
                    resourceForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
            } else {
                return null;
            }

        },


        __preview_pattern: function (item) {
            var self = this;
            axios.get("/resources/pattern/"+item).then(function (result){
                self.record.attach = result.data.data.img;
            })
        },

        // __upload_pattern: function (){
        //     var self = this;
        //     if(this.record.attached){
        //
        //         let PatternForm = new FormData();
        //             PatternForm.append("pattern", this.record.attached[0]);
        //
        //         axios.post("/op/resource/brochure-pattern/"+this.record.brochure.id,
        //             PatternForm,
        //             {
        //                 headers: {
        //                     'Content-Type': 'multipart/form-data'
        //                 }
        //             }).then(function (result){
        //
        //             if(result.data.status=="success"){
        //                 self.$emit("refresh", 1);
        //                 self.next();
        //             }
        //
        //             self.$emit("notify", result.data)
        //             //
        //         });
        //     }
        // },

        /**
         *
         * @private
         */
        __save: function (){

            var self=this;
            this.$refs.form.validate().then(function (v) {

                if (v.valid) {

                    self.loading=true;
                    axios.post("/op/brochures", self.record).then(result => {
                        if(result.data.status === "success"){
                            self.record.brochure = result.data.data;

                            self.__upload_resource(result.data.data).then(function (res){
                                if(res){
                                    console.log(res)
                                    if(res.data.status=="success"){
                                        self.$emit("notify", "Creado con éxito")
                                    } else {
                                        self.$emit("notify", "No se subio el recurso, puede subirlo después")
                                    }
                                } else {self.$emit("notify", "No se subio el recurso, puede subirlo después")}

                                self.next();
                                self.loading=false;

                            })
                        } else {
                            self.$emit("notify", "Error al crear folleto")
                            self.loading=false;
                        }
                    })

                } else {
                    self.loading=false;
                    self.$emit("notify", "Verifique que la información está completa")
                    self.step=1;

                    console.log(v.errors)
                }
            });

        },

        /**
         *
         * @private
         */
        __update: function (){

            var self=this;
            this.$refs.form.validate().then(function (v) {

                if (v.valid) {

                    self.loading=true;
                    axios.put("/op/brochures/"+self.record.brochure.id, self.record).then(result => {

                        if(result.data.status === "success"){
                            self.record.brochure = result.data.data;

                            self.__upload_resource(result.data.data).then(function (res){
                                if(res){
                                    console.log(res)
                                    if(res.data.status=="success"){
                                        self.$emit("notify", "Creado con éxito")
                                    } else {
                                        self.$emit("notify", "No se subio el recurso, puede subirlo después")
                                    }
                                } else {self.$emit("notify", "No se subio el recurso, puede subirlo después")}

                                self.next();
                                self.loading=false;

                            })

                        } else {
                            self.$emit("notify", "Error al crear folleto")
                            self.loading=false;
                        }
                    })

                } else {
                    self.loading=false;
                    self.$emit("notify", "Verifique que la información está completa")
                    self.step=1;

                    console.log(v.errors)
                }
            });

        },



    }


}
</script>
