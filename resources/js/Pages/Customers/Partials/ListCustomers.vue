<template>

    <v-card flat>
        <v-card-title>

            <v-toolbar>
                <v-toolbar-title>
                    Visitantes
                </v-toolbar-title>
                <v-spacer></v-spacer>

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



                <template v-slot:item.isGuest="{item}">

                    <span> {{ item.props.title.isGuest == 1 ? 'Si' : 'No'  }}</span>

                </template>

                <template v-slot:item.view_builder_id="{item}">

                    <span> {{ item.props.title.id }}</span>


                </template>


                <template v-slot:item.actions="{item}">

                    <v-btn
                        flat
                        icon="mdi-eye-remove-outline"
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
                { title: 'Ubicación', sortable: false, align: 'start', key: 'location' },
                { title: 'Referencia', sortable: false, align: 'start', key: 'referer' },
                { title: 'Tiempo activo', sortable: false, align: 'start', key: 'time_active' },
                { title: 'No. Clicks', sortable: false, align: 'start', key: 'clicks' },
                { title: 'Es usuario', sortable: false, align: 'start', key: 'isGuest' },
                { title: 'Visitado', sortable: false, align: 'start', key: 'view_builder_id' },
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

            axios.get("/viewer/visitors")
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
            // axios.post("/viewer/visitors/).then(function (result){
            //     self.Toast("Registro modificado");
            // });
        },

    }
}
</script>
