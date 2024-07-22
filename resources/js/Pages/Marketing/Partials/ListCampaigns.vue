<template>

    <v-card flat>
        <v-card-title>

            <v-toolbar>
                <v-toolbar-title>
                    Campañas
                </v-toolbar-title>
                <v-spacer></v-spacer>

                <v-btn icon @click="dialog=!dialog">
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
                <v-btn icon @click="__fetch_items">
                    <v-icon>mdi-reload</v-icon>
                </v-btn>
            </v-toolbar>

        </v-card-title>

        <v-card-text>

            <v-dialog
                v-model="dialog"
                width="700"
                persistent>
                <FormB2b
                    @update="__fetch_items"
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



                <template v-slot:item.actions="{item}">
                    <v-btn
                        flat
                        icon="mdi-pencil"
                        size="x-small"
                        :href="'/x/b2bs/'+item.props.title.b2b.id"
                    >
                    </v-btn>

                    <v-btn
                        flat
                        icon="mdi-delete"
                        size="x-small"
                        @click="__delete_item(item.props.title.b2b)"
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
                'se perderán todos los registros asociados a este elemento').then(function (result){

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
