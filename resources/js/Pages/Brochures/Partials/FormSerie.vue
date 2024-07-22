<template>

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

        <v-window>
            <v-card-text>
            <v-form ref="form">
                <v-row>

                    <v-col sm="12" xs="12" md="12">

                        <v-row>

                            <v-col cols="12">
                                <v-text-field
                                    label="Titulo de la serie *"
                                    prepend-icon="mdi-alphabet-latin"
                                    hint="Como quieres nombrar la serie?"
                                    density="compact"
                                    persistent-hint
                                    v-model="serie.name"
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
                                    v-model="serie.b2b_id"
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
                                    persistent-hint
                                    v-model="serie.status_id"
                                    :rules="Rules.SelectorRules"
                                    :items="Cats.statuses"
                                    item-title="name"
                                    :item-value="item => item.id"
                                ></v-select>
                            </v-col>

                            <v-col cols="12">
                                <v-textarea
                                    label="Describe aquí tu serie"
                                    prepend-icon="mdi-alphabet-latin"
                                    hint="Describe de que trata tu serie"
                                    density="compact"
                                    persistent-hint
                                    v-model="serie.description"
                                    counter="200"
                                ></v-textarea>
                            </v-col>


                        </v-row>

                    </v-col>

                </v-row>
            </v-form>

        </v-card-text>
        </v-window>

        <v-card-actions>

            <v-spacer></v-spacer>
            <v-btn
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="save"
            >
                Guardar y crear primer registro
            </v-btn>

        </v-card-actions>
    </v-card>

</template>
<script >

import Rules from "../../../Resources/Variables/Rules.vue";
import Cats from "../../../Resources/Variables/Catalogs.vue";


export default {

    name: "form-serie",

    props: {
        submit: null,
    },

    data(){
        return {

            Rules,
            Cats,

            /*Loading Buttons */
            loading: false,


            serie: {},

            /* retrieve catalogs */
            b2bs: [],
        }
    },


    mounted(){
        this.__fetch_b2bs();
    },

    methods: {

        save: function (){

            var self = this;

            this.$refs.form.validate()
                .then(function (v){

                    if (v.valid) {


                        axios.post("/op/brochures-series", self.serie).then(
                            function (r){
                                if(r.data.status=="success")
                                {
                                    self.$emit("stored", r.data.data)
                                    self.$emit("updated", 1)

                                } else {
                                    self.$emit("errors", r.data.data)
                                }
                            });

                    } else {
                        self.$emit("errors", v.errors)

                        console.log(v.errors);
                    }

                });

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


    }
}
</script>
