<template>


    <v-form ref="form">

        <v-card>
            <v-toolbar color="deep-purple-lighten-1">
                <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn icon @click="$emit('dialog', false)">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>



            <v-window v-model="step" >
                    <!--Select Type Catalog, B2b -->
                    <v-window-item :value="1">

                        <v-card-text>

                            <v-card lazy variant="text"  color="deep-purple-lighten-1">
                                <v-row class="ma-3">

                                    <v-col cols="12">
                                        <v-alert
                                            density="compact"
                                            border="start"
                                            border-color="deep-purple accent-4"
                                            elevation="2"
                                            class="mb-4"
                                            closable
                                        >
                                            Dale sentido a tu sección eligiendo el nombre por ejemplo: Entradas, Bebidas, Servicios,
                                            puedes modificarla y agregar más información posteriormente en el detálle de tu catálogo.
                                            Entre más complementes tu registro será más facil llegar a tus clientes.
                                        </v-alert>
                                    </v-col>

                                    <v-col cols="6">
                                        <v-text-field
                                            label="Titular de la sección *"
                                            :rules="Rules.InputTextRules"
                                            required
                                            counter="50"
                                            variant="outlined"
                                            v-model="record.section.title"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-select
                                            label="Estado de sección *"
                                            :rules="Rules.SelectorRules"
                                            required
                                            variant="outlined"
                                            v-model="record.section.status_id"
                                            :items="Cats.statuses"
                                            item-title="name"
                                            :item-value="item => item.id"
                                        ></v-select>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Subtitulo de la sección"
                                            counter="100"
                                            variant="outlined"
                                            v-show="details_section"
                                            v-model="record.section.subtitle"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-textarea
                                            label="Descripción"
                                            counter="200"
                                            variant="outlined"
                                            v-model="record.section.description"
                                            v-show="details_section">
                                        </v-textarea>
                                    </v-col>

                                    <v-btn variant="plain" @click="details_section = !details_section">
                                        + Mostrar/Ocultar detalles
                                    </v-btn>
                                </v-row>
                            </v-card>

                        </v-card-text>

                    </v-window-item>

                    <!-- Background -->
                    <v-window-item :value="2">

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
                                    Elige un fondo adecuado para la sección de tu Catálogo,
                                    no te preocupes, puedes modificarlo posteriormente Dando click en la imágen del registro o bien desde
                                    el ícono de cámara

                                </v-alert>

                                <v-file-input v-model="record.attached"
                                              :rules="Rules.image_medium"
                                              @update:modelValue="__preview_picture"
                                              ref="picture"
                                              accept="image/png, image/jpeg, image/bmp"
                                              style="display: none"
                                              label="File input">

                                </v-file-input>
                                <!--                                        {{ imageData }}-->
                                <v-img :src="record.attach"
                                       v-if="record.attach!=null"
                                       max-height="500"
                                       cover
                                       @click="$refs.picture.click()">

                                </v-img>
                                <v-card
                                    v-else
                                    color="deep-purple-accent-1"
                                    class="d-flex align-center"
                                    dark
                                    min-height="150"
                                    @click="$refs.picture.click()"
                                >
                                    <v-scroll-y-transition>
                                        <div
                                            class="flex-grow-1 text-center"
                                        >
                                            <v-icon  icon="mdi-plus"></v-icon>


                                        </div>
                                    </v-scroll-y-transition>
                                </v-card>

                            </v-col>

                        </v-card-text>

                    </v-window-item>


            </v-window>


        <v-card-actions>


            <v-spacer></v-spacer>

            <v-btn
                v-if="step==1 && !isUpdate"
                color="deep-purple-lighten-1"
                variant="flat"
                @click="__save_section"
            >
                Guardar y continuar
            </v-btn>
            <v-btn
                v-if="step==2 && !isUpdate"
                color="deep-purple-lighten-1"
                variant="outlined"
                @click="$emit('dialog', false)"
            >
                Omitir
            </v-btn>
            <v-btn
                v-if="step==2 && !isUpdate"
                color="deep-purple-lighten-1"
                variant="flat"
                @click="__upload_picture"
            >
                Guardar y Terminar
            </v-btn>

            <v-btn
                v-show="isUpdate"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__update_section"
            >
                Actualizar
            </v-btn>
        </v-card-actions>
    </v-card>

    </v-form>
</template>


<script>

import Rules from "../../../Resources/Variables/Rules.vue";

export default {
    name: "form-section",

    props: {
        /* catalog */
        catalog_type_id: null,
        catalog_id: null,
        b2b_id: null,


        /* To update*/
        section: [],
        isUpdate: false,
    },

    computed: {
        currentTitle () {

            /* Show Stepper title */
            switch (this.step) {
                case 1: return 'Detalles'
                case 2: return 'Fondo'
                case 6: return 'Error al crear el catálogo'
            }
        },
    },

    data(){
        return {

            /**
             * Rules
             */
            Rules,


            /* Show details in form */
            details_section: false,

            /* Loading button SAVE */
            loading: false,

            /* Local object to created or update */
            record: {
                attached: null,
                attach: null,
                section: {
                    status_id: '' || 1
                },
                catalog: {},
            },

            step: 1,
        }
    },

    mounted() {
        this.record.catalog.id = this.catalog_id;
        this.record.section = this.section;



        this.__fetch_section();

    },

    methods: {
        //
        //
        // async validate (forms) {
        //     const { valid } = await this.$refs.form.validate()
        //     return valid;
        // },

        __fetch_section(){



            if(this.section != null){
                // axios.get("/op/section/", this.section.id).then(result => {
                //     if(result.data.status === "success"){
                //         // this.record.section = result.data.data;
                //     } else {
                //
                //     }
                // })
            }

        },

        /**
         *
         * @private
         */
        __save_section: function (){

            var self=this;
            this.$refs.form.validate().then(function (v){
                if(v.valid){
                    self.loading=true;

                    axios.post("/op/sections", self.record)
                        .then(result => {

                        if(result.data.status === "success"){
                            self.record.section = result.data.data;
                            self.loading=false;
                            self.step++;
                            self.$emit("fetch", true);
                        }

                    })
                } else {

                    self.loading=false;
                }
            })

        },

        /**
         *
         * @private
         */
        __update_section: function (){

            var self=this;
            this.$refs.form.validate().then(function (v){
                if(v.valid){
                    self.loading=true;

                    axios.put("/op/sections/"+self.record.section.id,
                        self.record).then(result => {
                            if(result.data.status === "success"){
                                self.loading=false;
                                self.$emit("dialog", false);
                                self.$emit("fetch", true);
                            }
                    });

                }else{
                    self.loading=false;

                }
            })
        },

        __preview_picture: function () {
            const input = this.$refs.picture
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.record.attach = e.target.result
                }

                reader.readAsDataURL(files[0])

            }
        },

        __upload_picture: function (){

            var self=this;
            if(this.record.attached){
                let PictureForm = new FormData();
                PictureForm.append("background", this.record.attached[0]);

                axios.post("/op/section-background/"+this.record.section.id,
                    PictureForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(function (result){

                    if(result.data.status=="success"){
                        self.$emit("fetch", true);
                        self.$emit("dialog", false);
                    }

                    self.$emit("notify", result.data)
                    //
                });
            }

        },

    }
}
</script>
