
<template>

    <v-card :loading="loading">
        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>Catálogos</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="dialog=!dialog">
                <v-icon>mdi-plus</v-icon>
            </v-btn>

            <!--Reload-->
            <v-btn icon @click="__fetch_items">
                <v-icon>mdi-reload</v-icon>
            </v-btn>
        </v-toolbar>

        <v-card-text>

            <!--Dialog WizardCatalog-->
            <v-dialog
                v-model="dialog"
                width="700"
                persistent
                scrollable
            >
                <WizardCatalog
                    @notify="__notify($event)"
                    @update="__fetch_items"
                    @dialog="dialog = $event"
                    :b2bs="b2bs">
                </WizardCatalog>
            </v-dialog>

            <!--Data Table-->
            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="resources"
                class="elevation-0"
                density="compact"
                show-expand
            >


                <!--Searcher-->
                <template v-slot:top>

                    <v-row>
                        <v-col cols="6">
                            <v-text-field
                                density="compact"
                                variant="outlined"
                                append-icon="mdi-magnify"
                                label="Escribe aquí para buscar ... "
                                single-line
                                v-model="search">
                            </v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                density="compact"
                                variant="outlined"
                                append-icon="mdi-filter-variant"
                                label="Filtrar por empresa "
                                single-line
                                v-model="search">
                            </v-text-field>
                        </v-col>
                    </v-row>

                </template>



                <!--Publish-->
                <template v-slot:item.publish="{item}">
                    <v-switch color="deep-purple-lighten-1"
                              class="mt-5"
                              @update:modelValue="__update_publish(item.props.title)"
                              v-model="item.props.title.published"
                              density="compact">
                    </v-switch>
                </template>



                <!--Name-->
                <template v-slot:item.name="{item}">
                    <v-row>

                        <v-btn
                            :href="'/op/catalogs/'+item.props.title.id"
                            color="deep-purple-lighten-1"
                            variant="text"
                        >
                            {{item.props.title.name}}
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                               color="info"
                               :href="item.props.title.url"
                               target="_blank"
                               variant="text">

                            <v-icon>mdi-eye</v-icon>
                            <v-tooltip
                                activator="parent"
                                location="top"
                            >
                                Abrir vista previa
                            </v-tooltip>
                        </v-btn>
                    </v-row>
                </template>



                <!--Catalog Type-->
                <template v-slot:item.type="{item}">
                  <v-chip>{{item.props.title.type.name}}</v-chip>
                </template>



                <!--Total Sections-->
                <template v-slot:item.sections="{item}">
                  <span>
                        <v-tooltip
                            activator="parent"
                            location="top"
                        >
                        Secciones registradas
                    </v-tooltip>
                  {{item.props.title.sections.length}}
                  </span>
                </template>



                <!--B2b Actions-->
                <template v-slot:item.b2b="{item}">

                    <v-chip>{{item.props.title.b2b.name}}</v-chip>

                </template>



                <!--Actions-->
                <template v-slot:item.actions="{item}">

                    <v-btn
                        flat
                        size="x-small"
                        :href="'/op/catalogs/'+item.props.title.id"
                    >
                        <v-icon>mdi-pencil</v-icon>
                        <v-tooltip
                            activator="parent"
                            location="top"
                        >
                            Editar registro
                        </v-tooltip>
                    </v-btn>

                    <v-btn
                        @click="__clone_item(item.props.title)"
                        flat
                        size="x-small"
                    >
                        <v-icon>mdi-content-copy</v-icon>
                        <v-tooltip
                            activator="parent"
                            location="top"
                        >
                            Clonar registro
                        </v-tooltip>
                    </v-btn>

                    <v-btn
                        @click="__delete_item(item.props.title)"
                        flat
                        size="x-small"
                    >
                        <v-icon>mdi-delete</v-icon>
                        <v-tooltip
                            activator="parent"
                            location="top"
                        >
                            Eliminación permanente
                        </v-tooltip>
                    </v-btn>
                </template>



                <!--Expanded-->
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
                                               height="128"
                                               :src="'data:image/png;base64, '+item.props.title.qr_code"
                                           ></v-img>
                                           <v-btn block size="small" color="deep-purple-lighten-1" prepend-icon="mdi-download">Descargar</v-btn>
                                       </v-col>

                                        <v-col>
                                            <v-col cols="12">
                                                <v-card v-show="item.props.title.description">
                                                    <v-card-title>
                                                        Descripción
                                                    </v-card-title>
                                                    <v-card-text>
                                                        {{item.props.title.description}}
                                                    </v-card-text>
                                                </v-card>

                                            </v-col>
                                            <v-col cols="12">

                                                <v-card>
                                                    <v-card-title>
                                                        Detalles
                                                    </v-card-title>
                                                    <v-card-text>
                                                        <p><b>Cantidad de secciones inactivas: </b> {{item.props.title.sections.length}}</p>
                                                        <p><b>Sección más visitada: </b> ????????</p>
                                                        <p><b>Ultima modificación: </b> {{ item.props.title.updated_at }}</p>
                                                    </v-card-text>

                                                    <v-card-footer>
                                                        <v-col><b>Vista previa: </b>
                                                            <a class="text-primary" :href="item.props.title.url">
                                                                {{ item.props.title.url }}
                                                            </a>
                                                        </v-col>
                                                    </v-card-footer>
                                                </v-card>

                                            </v-col>


                                        </v-col>
                                    </v-row>
                                </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="deep-purple-lighten-1">Ver secciones</v-btn>
                                </v-card-actions>

                            </v-card>
                        </td>

                    </tr>
                </template>

            </v-data-table>
        </v-card-text>



    </v-card>

</template>


<script>

import Banner from "@/Pages/Components/Banner";
import WizardCatalog from "@/Pages/Catalogs/Partials/WizardCatalog";
export default {
    name: "list-catalogs",

    props: {
        b2bs: {},
    },
    components: {
        WizardCatalog,
        Banner,
    },
    data(){
        return {
            search: "",
            dialog: false,
            publish: [],
            itemsPerPage: 10,
            loading: false,
            headers: [
                { title: '#', sortable: false, align: 'start', width:"10", key: 'id' },
                { title: 'Publicado', sortable: false, align: 'start', width:"122", key: 'publish' },
                { title: 'Catálogo', align: 'start', key: 'name'},
                { title: 'Secciones Reg.', align: 'end', key: 'sections' },
                { title: 'Tipo de catálogo', sortable: false, align: 'end', key: 'type' },
                { title: 'Empresa/s', align: 'end', key: 'b2b' },
                { title: '--', sortable: false, align: 'end', key: 'actions' },
            ],

            resources: [],

        }
    },

    created() {
      this.__fetch_items();
    },

    methods: {


        __fetch_items: function(){
            var self=this;
            axios.get("/op/catalogs-resource")
                .then(function (result){
                self.resources = result.data.data;
            });
        },

        __update_publish: function (item){
            var self=this;
            axios.post("/op/catalog-publisher/"+item.id, item).then(function (result){
                self.Toast("Registro modificado")
            });
        },

        __delete_item(item){

            var self=this;
            this.confirm('Eliminar registro', 'Esta es una acción que no puede revertirse, se perderán todos las secciones y productos relacionados.').then(function (result){

                if(result.isConfirmed){
                    axios.delete("/op/catalogs/"+item.id).then(function (result)
                    {
                        self.__fetch_items();
                        self.Toast("Registro modificado")
                    })
                } else {
                    self.Toast("El registro no ha sido modificado")
                }


            })
        },


        __notify: function(result){

            if(result.status == "success"){

            } else {
                let msg = "";
                for(var data in result.data){
                    console.log(result.data[data][0])
                    msg += result.data[data][0] +"\n"
                }

                this.Toast(msg)
            }

        },

        __clone_item: function(item){
            this.loading=true;

            var self=this;
            this.confirm('Clonar registro',
                'Se clonará el catalogo y las secciones de manera independiente, los productos podrán asignarse/agregarse al editar el catálogo')
                .then(function (result){

                    if(result.isConfirmed){
                        axios.post("/op/catalog-cloner/"+item.id)
                            .then(result => {
                                if(result.data.status === "success"){
                                    self.loading=false;
                                    self.__fetch_items();

                                } else {
                                    self.$parent.Toast(result.data.data)
                                }
                            })
                    } else {
                        self.Toast("El registro no ha sido modificado")
                    }


                    self.loading=false;

                })
        }
    }
}
</script>
