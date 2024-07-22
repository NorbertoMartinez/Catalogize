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

            <v-window-item :value="1">
                    <FormSerie
                        ref="form_serie"
                        @stored="serie = $event"
                        @updated="next"
                    ></FormSerie>
            </v-window-item>

            <v-window-item :value="2">

                <div
                    v-for="n in (serie_items.length+1)"
                    :key="n">
                    <WizardSerieItem
                        v-if="(n == serie_items.length+1)?true:false"
                        ref="wizard_item"
                        :serie="serie"
                        @push="push($event)"
                        @action="action($event)"
                    ></WizardSerieItem>

                </div>
            </v-window-item>

            <!--Ends Creates-->
            <v-window-item :value="3">
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


    </v-card>

</template>


<script>

import Rules from "../../../Resources/Variables/Rules.vue";
import Cats from "../../../Resources/Variables/Catalogs.vue";
import PreviewResource from "./PreviewResource.vue";
import WizardSerieItem from "./WizardSerieItem.vue";
import FormSerie from "./FormSerie.vue";
import FormBrochureItem from "./FormBrochureItem.vue";
import PatternMaker from "./PatternMaker.vue";

export default {
    name: "wizard-brochure",

    props: {

        isUpdate: false,
        resource: {},

    },

    components: {
        PatternMaker,
        FormBrochureItem,
        WizardSerieItem,
        FormSerie,
        PreviewResource
    },

    computed: {
        currentTitle () {

            /* Show Stepper title */
            switch (this.step) {
                case 1: return 'Detalle de la serie'
                case 2: return 'Recursos Registrados'
                case 3: return 'Crea el primer registro'
                case 4: return 'Recurso'
                case 5: return 'Activador'
                case 6: return 'Verifica tu información'
                case 7: return 'Haz finalizado!'
                case 8: return 'banner'
                case 100: return 'Error al crear el catálogo'
            }
        },
    },

    data(){
        return {

            Rules,Cats,

            /*Loading Buttons */
            loading: false,

            /* Stepper */
            step: 1,


            serie: {},
            serie_items: [],

            create_new: false

        }
    },

    mounted(){
        // this.Toast("1 asdasd asd");

        if(this.isUpdate){
            this.record.brochure = this.resource;
        }



    },

    methods: {

        next: function (){
            this.step++;
        },

        back: function (){
            this.step--;
        },

        action: function(action){
            switch (action){
                case 1:
                    this.step=2;
                    return;
                case 2:
                    this.next();
                    return;
            }
        },

        push: function(element){
            this.serie_items.push(element)
        },


        __preview_pattern: function (item) {
            var self = this;
            axios.get("/resources/pattern/"+item).then(function (result){
                self.record.attach = result.data.data.img;
            })
        },



    }


}
</script>

<style>
.v-select .v-field .v-field__input > input{
    opacity: 0 !important;
}
</style>
