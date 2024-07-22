<template>

    <v-card  :loading="loading">
        <v-toolbar
             color="deep-purple-lighten-1">
            <v-toolbar-title>Empresas</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="dialog=!dialog">
                <v-icon>mdi-plus</v-icon>
            </v-btn>
            <v-btn icon @click="__fetch_items">
                <v-icon>mdi-reload</v-icon>
            </v-btn>
        </v-toolbar>
        <v-card-text>

            <v-dialog
                v-model="dialog"
                width="700"
                scrollable
                persistent>
                <FormB2b
                    @update="__fetch_items"
                    @notify="this.Toast($event)"
                    @dialog="dialog = $event">
                </FormB2b>
            </v-dialog>

            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="records"
                :search="search"
                class="elevation-0"
                density="compact"
                no-data-text="Sin datos registrados"

            >


                <template v-slot:top>

                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                density="compact"
                                variant="outlined"
                                append-icon="mdi-magnify"
                                label="Escribe aquí para buscar ... "
                                single-line
                                v-model="search">
                            </v-text-field>
                        </v-col>
                    </v-row>

                </template>
                <!--Published-->
                <template v-slot:item.publish="{item}">
                    <v-switch color="deep-purple-lighten-1"
                              class="mt-5"
                              @update:modelValue="__update_publish(item.props.title)"
                              v-model="item.props.title.published"
                              density="compact">
                    </v-switch>
                </template>

                <template v-slot:item.img="{item}">
                    <v-avatar>
                        <v-img
                            :src="item.props.title.img"
                            :alt="item.props.title.name"
                        ></v-img>
                    </v-avatar>
                </template>

                <template v-slot:item.actions="{item}">
                    <v-btn
                        flat
                        icon="mdi-pencil"
                        size="x-small"
                        :href="'/x/b2bs/'+item.props.title.id"
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


            </v-data-table>
        </v-card-text>

        <v-card-actions>

        </v-card-actions>
    </v-card>

</template>


<script>
import FormB2b from "@/Pages/B2bs/Partials/FormB2b.vue"


export default {
    name: "list-b2bs",

    components: {
        FormB2b
    },

    data(){
        return {

            dialog: false,

            records: [],
            itemsPerPage: 10,
            search: "",
            headers: [
                { title: '#', sortable: false, align: 'start', width:"10", key: 'id' },
                { title: 'Publicado', align: 'start', width:"122", key: 'publish' },
                { title: 'Logo', align: 'start', key: 'img' },
                { title: 'Nombre', align: 'start', sortable: false, key: 'name',},

                { title: 'RFC', align: 'end', key: 'fiscal_code' },
                { title: 'Razón Social', align: 'end', key: 'social_reason' },
                { title: 'Slogan', align: 'end', key: 'slogan' },
                { title: '--', align: 'end', key: 'actions' },
            ],
        }
    },

    mounted() {
        this.__fetch_items()
    },

    methods: {



        __delete_item(item){

            var self=this;
            this.confirm('Eliminar registro', 'Esta es una acción que no puede revertirse, ' +
                'se perderán todos los catálogos, secciones y productos relacionados.').then(function (result){

                if(result.isConfirmed){
                    axios.delete("/x/b2bs/"+item.id).then(function (result)
                    {
                        self.__fetch_items();
                        self.Toast("Registro modificado")
                    })
                } else {
                    self.Toast("El registro no ha sido modificado")
                }


            })
        },

        __fetch_items: function ()
        {

            this.dialog = false

            axios.get("/x/b2b-list")
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
            axios.post("/x/b2b-publisher/"+item.id, item).then(function (result){
                self.Toast("Registro modificado");
            });
        },

    }
}
</script>
