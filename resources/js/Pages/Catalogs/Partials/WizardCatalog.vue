<template>

    <v-card>

        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="$emit('dialog', false)">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-toolbar>

        <v-window v-model="step">
            <v-form ref="form">
                <!--Select Type Catalog, B2b -->
                <v-window-item :value="1">
                    <v-card-text>

                        <v-card variant="text"  color="deep-purple-lighten-1" class="pa-3">

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
                                        Los tipos de catálogos definen la estructura en la que se mostrará tu catálogo, para conocer más presiona el siguiente enlace: #enlace#
                                    </v-alert>
                                </v-col>
                                <v-col cols="6">
                                    <v-select
                                    label="Empresa *"
                                    hint="Selecciona una empresa"
                                    :rules="Rules.SelectorRules"
                                    required
                                    variant="outlined"
                                    v-model="record.catalog.b2b_id"
                                    :items="records"
                                    item-title="name"
                                    item-value="id"
                                    @update:modelValue="__fetch_bussiness_types"
                                ></v-select>
                                </v-col>
                                <v-col cols="6">
                                    <v-select
                                    label="Tipo de negocio *"
                                    hint="Sobre que tipo de negocio creas el catálogo"
                                    :rules="Rules.SelectorRules"
                                    required
                                    variant="outlined"
                                    v-model="record.catalog.bussiness_type_id"
                                    :items="b2b_bussiness_types"
                                    item-title="type.name"
                                    :item-value="item => item.bussiness_type_id"
                                    @update:modelValue="__fetch_catalogs_types"
                                ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-select
                                    label="Tipo de catálogo *"
                                    hint="Especifica el tipo de catálogo"
                                    :rules="Rules.SelectorRules"
                                    required
                                    variant="outlined"
                                    v-model="record.catalog.catalog_type_id"
                                    :items="catalog_types"
                                    item-title="catalog.name"
                                    :item-value="item => item.catalog_type_id"
                                ></v-select>
                                </v-col>
                            </v-row>




                        </v-card>

                    </v-card-text>
                </v-window-item>

                <!--Catalog Form-->
                <v-window-item :value="2">
                    <v-card-text>
                        <v-card variant="text"  color="deep-purple-lighten-1" class="pa-3">
                            <v-row density="compact">
                                <v-col cols="12">
                                    <span class="text-caption text-grey-darken-1">
                                    Ahora ingresa los detalles de tu catálogo, esta sección es importante ya que es el primer paso
                                  </span>
                                </v-col>
                                <v-col cols="8">
                                    <v-text-field
                                        label="Nombre del catálogo *"
                                        hint="Elige un titulo increible"
                                        :rules="Rules.InputTextRules"
                                        required
                                        variant="outlined"
                                        v-model="record.catalog.name"
                                        counter="50"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="4">
                                    <v-select
                                        label="Estado del catálogo *"
                                        hint="Puedes ponerlo Activo para que sea público"
                                        :rules="Rules.SelectorRules"
                                        required
                                        variant="outlined"
                                        v-model="record.catalog.status_id"
                                        :items="Cats.statuses"
                                        item-title="name"
                                        :item-value="item => item.id"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        label="Subtitulo de tu catálogo"
                                        hint="En pocas palabras algo único!"
                                        counter="100"
                                        variant="outlined"
                                        v-model="record.catalog.subtitle"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-textarea
                                        label="Descripción de tu catálogo"
                                        hint="Describe más acerca de tu catálogo"
                                        counter="200"
                                        variant="outlined"
                                        v-model="record.catalog.description"
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                        </v-card>


                    </v-card-text>
                </v-window-item>

            </v-form>




            <!--Background-->
            <v-window-item :value="3">
                <v-card-text>

                    <v-card variant="text"  color="deep-purple-lighten-1" class="pa-3">

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
                                Elige un fondo adecuado para la cabecera de tu Catálogo, no te preocupes, puedes modificarlo en el detalle de tu catálogo posteriormente.
                            </v-alert>
                        </v-col>


                        <v-col cols="12">

                            <v-file-input
                                label="File input"
                                v-model="record.attached"
                                @update:modelValue="__preview_picture"
                                ref="picture"
                                variant="outlined"
                                accept="image/png, image/jpeg, image/bmp"
                                style="display: none"
                            ></v-file-input>

                            <v-img

                                :src="record.attach"
                                v-if="record.attach!=null"
                                cover
                                max-height="500"
                                @click="$refs.picture.click()"
                            ></v-img>

                            <v-card
                                v-else
                                class="d-flex align-center"
                                dark
                                min-height="150"
                                @click="$refs.picture.click()"
                            >
                                <v-scroll-y-transition>
                                    <div class="flex-grow-1 text-center">
                                        <v-icon  icon="mdi-plus"></v-icon>
                                    </div>
                                </v-scroll-y-transition>
                            </v-card>

                        </v-col>

                    </v-row>

                    </v-card>

                </v-card-text>
            </v-window-item>



            <v-form ref="form_section">

            <!--Optional Section create-->
            <v-window-item :value="4">
                <v-card-text>

                    <v-card variant="text"  color="deep-purple-lighten-1" class="pa-3">


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
                                    Agrega tu PRIMERA sección a tu catálogo: Ej. Entradas, Bebidas, Servicios, puedes modificarla y agregar más posteriormente en el detálle de tu catálogo
                                </v-alert>
                            </v-col>


                            <v-col cols="6">
                                <v-text-field
                                    label="Titular de la sección"
                                    hint="Elige el mejor titulo!"
                                    :rules="Rules.InputTextRules"
                                    required
                                    counter="50"
                                    variant="outlined"
                                    v-model="record.section.title"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-select
                                    label="Estado de sección"
                                    hint="Deseas publicarlo?"
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
                                    hint="Elige algo llamativo de tu sección"
                                    counter="100"
                                    variant="outlined"
                                    v-show="details_section"
                                    v-model="record.section.subtitle"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-textarea
                                    label="Descripción"
                                    hint="Haz conocer más acerca de esta sección"
                                    variant="outlined"
                                    counter="200"
                                    v-model="record.section.description"
                                    v-show="details_section">
                                </v-textarea>
                            </v-col>
                        </v-row>

                        <v-btn variant="plain" @click="details_section = !details_section">
                            + Mostrar/Ocultar detalles
                        </v-btn>

                    </v-card>
                </v-card-text>
            </v-window-item>

            </v-form>



            <!--Ends Creates-->
            <v-window-item :value="5">
                <div class="pa-4 text-center">

                  <v-col>
                      <v-img
                          class="mb-4"
                          contain
                          height="128"
                          :src="'data:image/png;base64, ' + record.catalog.qr_code"
                      ></v-img>

                      <v-btn block size="small" color="deep-purple-lighten-1" prepend-icon="mdi-download">Descargar</v-btn>
                  </v-col>

                    <h3 class="text-h6 font-weight-light mb-2">
                        Listo!, Felicidades, Haz creado tu Catálogo con éxito.
                    </h3>
                    <span class="text-caption">Pero aún puedes seguir agregando más elementos a tu catálogo, secciones, productos, todo desde el detalle, presionar terminar y vamos allá!</span>
                </div>
            </v-window-item>

            <!--Error Window-->
            <v-window-item :value="6">
                <div class="pa-4 text-center">
                    <h3 class="text-h6 font-weight-light mb-2">
                        Ocurrio un error
                    </h3>
                    <span class="text-caption">Ha ocurrido un error al crear el catálogo</span>
                </div>
            </v-window-item>

        </v-window>

        <v-divider></v-divider>

        <v-card-actions>
            <v-btn

                v-if="step > 1 && step < 3"
                variant="text"
                @click="step--"
            >
                Retroceder
            </v-btn>
            <v-spacer></v-spacer>

            <v-btn
                v-show="step == 5"
                color="deep-purple-lighten-1"
                variant="flat"
                :href="'/op/catalogs/'+record.catalog.id"
            >
                Terminar y configurar
            </v-btn>
            <v-btn
                v-if="step == 2"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__save_catalog"
            >
                Guardar y continuar
            </v-btn>
            <v-btn
                v-show="step == 3"
                variant="outlined"
                color="deep-purple-lighten-1"

                :loading="loading"
                @click="next"
            >
                Omitir
            </v-btn>
            <v-btn
                v-show="step == 4"
                variant="outlined"
                color="deep-purple-lighten-1"

                :loading="loading"
                @click="next"
            >
                Omitir
            </v-btn>
            <v-btn
                v-if="step == 4"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__save_section"
            >
                Guardar
            </v-btn>
            <v-btn
                v-if="step == 3"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__upload_picture"
            >
                Guardar
            </v-btn>
            <v-btn
                v-if=" step == 1"
                color="deep-purple-lighten-1"
                variant="flat"
                type="submit"
                @click="complement_record"
            >
                Siguiente
            </v-btn>
        </v-card-actions>
    </v-card>

</template>


<script>

import Rules from "../../../Resources/Variables/Rules.vue";
export default {
    name: "wizard-catalog",

    props: {
        b2bs: {}, /* Authenticated user b2b's */
    },

    computed: {
        currentTitle () {

            /* Show Stepper title */
            switch (this.step) {
                case 1: return 'Elige un tipo'
                case 2: return 'Detalles'
                case 3: return 'Configura el diseño'
                case 4: return 'Agrega secciones'
                case 5: return 'Detalles de tu nuevo catálogo'
                case 6: return 'Error al crear el catálogo'
                default: return 'Ahora a agregar productos'
            }
        },
    },

    data(){
        return {

            Rules,

            /*Loading Buttons */
            loading: false,

            /* Stepper */
            step: 1,

            /* Record to create */
            record: {
                attached: null,
                attach: null,

                b2b_id: null,
                catalog: {
                },
                section: {},
            },

            /* retrieve catalogs */
            records: [],
            catalog_types: [],
            b2b_bussiness_types: [],

            /* Show Details in Section fields  */
            details_section: false,

            /* Validations */
            rules: [
                value => {
                    if (value) return true

                    return 'You must enter a first name.'
                },
            ],
        }
    },

    mounted(){
        // this.Toast("1 asdasd asd");

        this.__fetch_b2bs();
    },

    methods: {

        next: function(){
           this.step++;
        },
        complement_record(){
            var self=this;
            this.$refs.form.validate().then(function (v){
                if(v.valid){
                    self.step++;
                }
            })
        },

        /**
         *
         * @private
         */
        __fetch_b2bs(){
            var self=this;
            axios.get("/x/b2b-list").then(function (result){
                self.records = result.data.data;
            });
        },


        /**
         *
         * @param b2b
         * @private
         */
        __fetch_bussiness_types: function (b2b){
            var self = this;

            self.record.b2b_id = b2b;
            self.record.catalog.catalog_type_id = null;
            self.record.catalog.bussiness_type_id = null;

            axios.get("/op/b2b-bussiness-types-detail/"+b2b)
                .then((result) => {



                    self.b2b_bussiness_types = result.data.data;
            })
        },

        /**
         *
         * @param bussiness_type
         * @private
         */
        __fetch_catalogs_types: function (bussiness_type)
        {
            var self=this;
            // this.records.catalog.bussiness_type_id = bussiness_type.id;
            axios.get("/resources/bussiness-type-catalogs-types/"+bussiness_type)
                .then((result) => {

                    self.catalog_types = result.data.data;
            })
        },

        /**
         *
         * @private
         */
        __save_catalog: function (){

            var self=this;
            this.$refs.form.validate().then(function (v) {

                if (v.valid) {

                    self.loading=true;
                    axios.post("/op/catalogs", self.record).then(result => {
                        if(result.data.status === "success"){

                            self.record.catalog = result.data.data
                            self.next();
                            self.loading=false;
                            self.$emit("update", 1);

                        } else {
                            self.loading=false;
                            self.$parent.Toast(result.data.data)
                        }
                    })

                } else {
                    self.loading=false;
                }
            });

        },

        /**
         *
         * @private
         */
        __save_section: function (){
            var self=this;
            this.$refs.form_section.validate().then(function (v) {

                if (v.valid) {
                    self.loading=true;

                    axios.post("/op/sections", self.record).then(result => {
                        if(result.data.status === "success"){
                            self.next();
                            self.loading=false;
                        } else {
                            self.loading=false;
                        }
                    })

                }else{
                    self.loading=false
                }

            });

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

        __upload_picture: function (    ){

            var self = this;
            if(this.record.attached){
                let PictureForm = new FormData();
                PictureForm.append("background", this.record.attached[0]);

                axios.post("/op/catalog-background/"+this.record.catalog.id,
                    PictureForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(function (result){

                    if(result.data.status=="success"){

                        self.$emit("update", 1);

                        self.next();
                    }

                    self.$emit("notify", result.data)

                });
            }

        },
    }


}
</script>
