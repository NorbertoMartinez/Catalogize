<template>

    <v-card flat>

        <v-img
            height="250"
            src="/ar_bg.jpg"
            cover
            class="text-white"
        >
        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>Control de Realidad Aumentada </v-toolbar-title>
            <v-spacer></v-spacer>


            <v-btn icon @click="__show_new">
                <v-icon>mdi-shape-polygon-plus</v-icon>
            </v-btn>


            <v-btn icon @click="__show_new">
                <v-icon>mdi-image-plus-outline</v-icon>
            </v-btn>

            <!--Reload-->
            <v-btn icon @click="__fetch_items">
                <v-icon>mdi-reload</v-icon>
            </v-btn>

<!--            <div >-->
            <template  v-slot:extension>
                <v-tabs
                    v-model="tab"
                    align-tabs="title"
                >
                    <v-tab
                        v-for="item in tabs"
                        :key="item"
                        :value="item"
                    >
                        {{item}}
                    </v-tab>
                </v-tabs>
            </template>

<!--            </div>-->
        </v-toolbar>

        </v-img>

        <!--        <v-card-title>-->

        <!--            <v-toolbar>-->
        <!--                <v-toolbar-title>Folletos AR </v-toolbar-title>-->
        <!--                <v-spacer></v-spacer>-->

        <!--                <v-btn icon @click="__show_new">-->
        <!--                    <v-icon>mdi-plus</v-icon>-->
        <!--                </v-btn>-->
        <!--                <v-btn icon @click="__fetch_items">-->
        <!--                    <v-icon>mdi-reload</v-icon>-->
        <!--                </v-btn>-->
        <!--            </v-toolbar>-->

        <!--        </v-card-title>-->


        <v-window v-model="tab" >

            <v-window-item

                v-for="item in tabs"
                :key="item"
                :value="item"
            >

                <ListBrochures v-if="item==='Folletos'"></ListBrochures>

                <ListSeries v-if="item==='Series'"></ListSeries>

                <v-card-text>
                    <Options v-if="item==='Inicio'"></Options>
                </v-card-text>


            </v-window-item>

        </v-window>

        <v-card-text>

            <v-dialog
                v-model="dialog"
                width="700"
                persistent>
                <FormBrochure
                    :isUpdate="isUpdate"
                    :resource="resource"
                    @update="__fetch_items"
                    @notify="this.Toast($event)"
                    @dialog="dialog = $event">
                </FormBrochure>
            </v-dialog>

            <v-dialog
                v-model="dialog_video"
                width="700"
                persistent>

                <FormResource
                    :id="resource_obj.id"
                    :type="resource_obj.brochure_type_id"
                    :src="resource_obj.resource"
                    @dialog="dialog_video = $event"
                    @update="__fetch_items"
                    @notify="this.Toast($event)"
                >
                </FormResource>

            </v-dialog>


            <v-dialog
                v-model="dialog_pattern"
                width="700"
            >
                <span v-show="!pattern_show">No hay Patrón seleccionado</span>
                <v-img cover controls v-show="pattern_show" :src="pattern_show" ></v-img>
            </v-dialog>




        </v-card-text>


    </v-card>

</template>


<script>
import ListSeries from "@/Pages/Brochures/Partials/ListSeries.vue"
import ListBrochures from "@/Pages/Brochures/Partials/ListBrochures.vue"
import FormBrochure from "@/Pages/Brochures/Partials/WizardBrochure.vue"
import FormResource from "@/Pages/Brochures/Partials/FormResource.vue"
import PreviewResource from "./PreviewResource.vue";
import ShortCuts from "../../Dashboard/Partials/ShortCuts.vue";
import Options from "./Options.vue";


export default {
    name: "home-ar",

    components: {
        Options,
        ShortCuts,
        PreviewResource,
        ListSeries,
        ListBrochures,
        FormBrochure,
        FormResource
    },

    data(){
        return {
            tab: null,
            tabs: ['Inicio', 'Folletos','Series'],

            dialog_pattern: false,
            dialog_video: false,
            dialog: false,
            isUpdate: false,

            resource: {},
            records: [],

            resource_obj: {},
            pattern_show: null,

            itemsPerPage: 10,
            headers: [
                { title: '#', sortable: true, align: 'start', width:"10", key: 'id' },
                { title: 'Publicado', align: 'start', width:"122", key: 'publish' },
                { title: 'Nombre', align: 'start', sortable: true, key: 'name',},
                { title: 'Fuente', align: 'start', key: 'pattern' },
                { title: 'Link', align: 'end', key: 'link' },
                { title: '--', align: 'end', sortable: false, key: 'actions' },
            ],


        }
    },

    mounted() {
        this.__fetch_items()
    },

    methods: {


        __show_new: function(){
            this.isUpdate = false;
            this.resource = {};
            this.dialog = true
        },

        __preview: function (item){
            this.resource_obj = item;
            this.dialog_video = true;
        },

        __preview_pattern: function (resource){
            this.pattern_show = resource;
            this.dialog_pattern = true;
        },


        __delete_item(item){

            var self=this;
            this.confirm('Eliminar registro', 'Esta es una acción que no puede revertirse, ' +
                'se perderán todos los cambios.').then(function (result){

                if(result.isConfirmed){
                    axios.delete("/op/brochures/"+item.id).then(function (result)
                    {
                        self.__fetch_items();
                        self.Toast("Registro modificado")
                    })
                } else {
                    self.Toast("El registro no ha sido modificado")
                }


            })
        },


        __fetch(item){

            var self=this;

            axios.get("/op/resource/brochure/"+item.id).then(function (result)
            {
                self.dialog = true;
                self.isUpdate = true;
                self.resource = result.data.data;

            })

        },

        __fetch_items: function ()
        {

            this.dialog = false

            axios.get("/op/resource/brochures")
                .then((result) => {
                    this.records = result.data.data;
                });
        },

        /**
         *
         * @param item
         * @private
         */
        __update_publish: function (item){
            var self=this;
            axios.post("/op/brochure-publisher/"+item.id, item).then(function (result){
                self.Toast("Registro modificado");
            });
        },

    }
}
</script>
