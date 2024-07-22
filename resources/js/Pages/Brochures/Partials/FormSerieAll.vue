<template>

    <v-card elevation="0">

        <v-form>


            <v-row>
                <v-col cols="12">

                    <v-card
                        color="deep-purple-lighten-1"
                        variant="text"
                        flat
                        class="rounded-lg"
                        density="compact">

                        <v-card-title>
                            <small>Datos generales</small>
                            <v-icon
                                size="small"
                                color="deep-purple-lighten-1"
                                @click="show_help=!show_help">mdi-help-box</v-icon>
                        </v-card-title>

                        <v-card-text>

                            <v-row>

                                <v-col sm="12" xs="12" md="12">

                                    <v-row>

                                        <v-col cols="12">
                                            <v-text-field
                                                label="Nombre del folleto *"
                                                prepend-icon="mdi-alphabet-latin"
                                                hint="Como quieres nombrar la serie?"
                                                density="compact"
                                                persistent-hint
                                                v-model="record.brochure.name"
                                                :rules="Rules.text50"
                                                required
                                                counter="50"
                                            ></v-text-field>
                                        </v-col>


                                        <v-col sm="12" md="6">
                                            <v-select
                                                label="Empresa *"
                                                prepend-icon="mdi-alphabet-latin"
                                                hint="Selecciona una empresa"
                                                density="compact"
                                                persistent-hint
                                                :rules="Rules.SelectorRules"
                                                v-model="record.brochure.b2b_id"
                                                :items="b2bs"
                                                :item-title="item => item.name"
                                                :item-value="item => item.id"
                                            ></v-select>
                                        </v-col>
                                        <v-col sm="12" md="6">
                                            <v-select
                                                label="Estado *"

                                                prepend-icon="mdi-alphabet-latin"
                                                hint="Esta serie está actualmente activa?"
                                                density="compact"
                                                persistent-hint                                    v-model="record.brochure.status_id"
                                                :rules="Rules.SelectorRules"
                                                :items="Cats.statuses"
                                                item-title="name"
                                                :item-value="item => item.id"
                                            ></v-select>
                                        </v-col>

                                        <v-col cols="12">
                                            <v-textarea
                                                label="Descripción del folleto"

                                                prepend-icon="mdi-alphabet-latin"
                                                hint="Describe de que trata tu serie"
                                                density="compact"
                                                persistent-hint

                                                v-model="record.brochure.description"
                                                counter="200"
                                            ></v-textarea>
                                        </v-col>


                                    </v-row>

                                </v-col>

                            </v-row>

                        </v-card-text>
                    </v-card>

                </v-col>
            </v-row>



        </v-form>

    </v-card>

</template>
<script >

import Rules from "../../../Resources/Variables/Rules.vue";
import Cats from "../../../Resources/Variables/Catalogs.vue";
import FormBrochureItem from "./FormBrochureItem.vue";

export default {
    components: {FormBrochureItem},
    data(){
        return {

            serie_items: [],
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



        this.__fetch_brochures_types();
        this.__fetch_patterns();
        this.__fetch_b2bs();


    },

    methods: {

        __push: function (e){

            this.serie_items.push(e);
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
