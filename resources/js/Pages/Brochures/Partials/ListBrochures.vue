<template>

    <v-card>

        <v-toolbar
            flat color="deep-purple-lighten-1">
            <v-toolbar-title>Control de Realidad Aumentada </v-toolbar-title>
            <v-spacer></v-spacer>



            <v-btn icon @click="__show_new">
                <v-icon>mdi-image-plus-outline</v-icon>
            </v-btn>

            <!--Reload-->
            <v-btn icon @click="__fetch_items">
                <v-icon>mdi-reload</v-icon>
            </v-btn>


        </v-toolbar>

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

<!--            <v-dialog-->
<!--                v-model="dialog_video"-->
<!--                width="700"-->
<!--                >-->
<!--                <v-card v-show="!video_show">-->
<!--                    <v-card-text>-->
<!--                        <span>No hay video seleccionado</span>-->
<!--                    </v-card-text>-->
<!--                </v-card>-->
<!--                <video controls v-show="video_show" :src="video_show" ></video>-->

<!--            </v-dialog>-->
            <v-dialog
                v-model="dialog_pattern"
                width="700"
                >
                <span v-show="!pattern_show">No hay Patrón seleccionado</span>
                <v-img cover controls v-show="pattern_show" :src="pattern_show" ></v-img>
            </v-dialog>



            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="records"
                class="elevation-0"
                density="compact"
                show-expand
                no-data-text="Sin datos registrados"

            >



                <!--Published-->
                <template v-slot:no-data>
                    <tr>
                        <td colspan="6">
                            <Options></Options>
                        </td>
                    </tr>
                </template>
                <template v-slot:item.publish="{item}">
                    <v-switch color="deep-purple-lighten-1"
                              class="mt-5"
                              @update:modelValue="__update_publish(item.props.title)"
                              v-model="item.props.title.published"
                              density="compact">
                    </v-switch>
                </template>
                <template v-slot:item.name="{item}">

                    <span>{{item.props.title.name }}</span>
                    <v-btn variant="text" color="deep-purple-lighten-1"
                           :href="item.props.title.url" target="_blank" icon="mdi-eye"></v-btn>

                </template>
                <template v-slot:item.link="{item}">

                    <v-btn variant="plain" size="small" color="deep-purple-lighten-1" v-show="item.props.title.link" :href="item.props.title.link" target="_blank">
                        {{item.props.title.link }}
                    </v-btn>

                    <v-chip v-show="!item.props.title.link">
                        Sin especificar
                    </v-chip>
                </template>
                <template v-slot:item.pattern="{item}">

                    <v-avatar icon="mdi-vuetify" size="small" v-if="item.props.title.pattern_id"
                              @click="__preview_pattern(item.props.title.pattern.img)"
                              :image="item.props.title.pattern.img"
                    ></v-avatar>
                </template>

                <template v-slot:item.logo="{item}">

                    <v-avatar color="surface-variant"></v-avatar>
                    <!--                    <v-avatar>-->
                    <!--                        <v-img-->
                    <!--                            :src="item.logo"-->
                    <!--                            :alt="item.name"-->
                    <!--                        ></v-img>-->
                    <!--                    </v-avatar>-->
                </template>
                <template v-slot:item.actions="{item}">
                    <v-btn
                        flat
                        icon="mdi-pencil"
                        size="x-small"
                        @click="__fetch(item.props.title)"
                    >
                    </v-btn>

                    <v-btn
                        flat
                        icon="mdi-delete"
                        size="x-small"
                        @click="__delete_item(item.props.title)"
                    >
                    </v-btn>

                </template>

                <template v-slot:expanded-row="{ columns, item }">
                    <tr>
                        <td :colspan="columns.length">


                            <v-card flat>
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="2">
                                            <v-img
                                                class="mb-4"
                                                contain
                                                @click="__preview_pattern(item.props.title.pattern.img)"
                                                :src="item.props.title.pattern_id != null ? item.props.title.pattern.img : ''"
                                            ></v-img>
                                            <v-btn block size="small" color="deep-purple-lighten-1" prepend-icon="mdi-download">Descargar</v-btn>
                                        </v-col>

                                        <v-col>
                                            <v-col cols="12">

                                                <v-card flat>
                                                    <v-card-title>
                                                        Generales
                                                    </v-card-title>
                                                    <v-card-text>

                                                        <v-row>
                                                            <v-col cols="2">
                                                                <PreviewResource
                                                                :src="item.props.title.resource"
                                                                :type="item.props.title.brochure_type_id"></PreviewResource>
                                                            </v-col>
                                                            <v-col cols="10">
                                                                <p><b>Nombre: </b> {{item.props.title.name ?? 'Sin datos'}}</p>
                                                                <p><b>Description: </b> {{item.props.title.description ?? 'Sin datos'}}</p>
                                                                <p><b>Enlace al que dirige el recurso: </b> {{ item.props.title.link ?? 'Sin datos'}}</p>
                                                                <!--                                                        <p><b>Sección más visitada: </b> ????????</p>-->
                                                                <!--                                                        <p><b>Ultima modificación: </b> {{ item.props.title.updated_at }}</p>-->
                                                            </v-col>
                                                        </v-row>
                                                    </v-card-text>
                                                </v-card>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-card flat>
                                                    <v-card-title>
                                                        Detalles
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <p><b>Escala: </b> {{item.props.title.scale ?? 'Default'}}</p>
                                                        <p><b>Rotación (Radiales): </b> {{item.props.title.radials ?? 'Default'}}</p>
                                                    </v-card-text>
                                                </v-card>
                                            </v-col>
                                        </v-col>
                                    </v-row>
                                </v-card-text>

                                <v-card-actions>
<!--                                    <v-spacer></v-spacer>-->
<!--                                    <v-btn color="deep-purple-lighten-1">Ver secciones</v-btn>-->
                                </v-card-actions>

                            </v-card>
                        </td>

                    </tr>
                </template>

            </v-data-table>
        </v-card-text>

        <v-card-actions>

        </v-card-actions>
    </v-card>

</template>


<script>
import FormBrochure from "@/Pages/Brochures/Partials/WizardBrochure.vue"
import FormResource from "@/Pages/Brochures/Partials/FormResource.vue"
import PreviewResource from "./PreviewResource.vue";
import ShortCuts from "../../Dashboard/Partials/ShortCuts.vue";
import Options from "./Options.vue";


export default {
    name: "list-brochures",

    components: {
        Options,
        ShortCuts,
        PreviewResource,
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
