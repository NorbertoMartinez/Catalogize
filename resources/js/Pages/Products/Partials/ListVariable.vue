<template>

    <v-card flat>


        <v-toolbar>
            <v-toolbar-title>Variantes del producto</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="dialog=!dialog">
                <v-icon>mdi-plus</v-icon>
            </v-btn>
        </v-toolbar>


        <v-card-text>

            <v-dialog v-model="dialog" width="500">
                <FormProductVariable></FormProductVariable>
            </v-dialog>

            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="desserts"
                class="elevation-0"
                density="compact"
            >
                <template v-slot:item.actions="{item}">
                    <v-btn
                        flat
                        icon="mdi-pencil"
                        size="x-small"
                    >
                    </v-btn>

                    <v-btn
                        flat
                        icon="mdi-delete"
                        size="x-small"
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

import FormProductVariable from "@/Pages/Products/Partials/FormVariableProduct.vue"
export default {
    name: "list-variables",

    components: {
        FormProductVariable
    },

    data(){
        return {
            dialog: false,

            itemsPerPage: 5,
            headers: [
                {
                    title: 'Tipo',
                    align: 'start',
                    sortable: false,
                    key: 'name',
                },
                { title: 'Descripcion', align: 'end', key: 'desc' },
                { title: 'Precio', align: 'end', key: 'price' },
                { title: 'Disponibilidad', align: 'end', key: 'availability' },
                { title: '--', align: 'end', key: 'actions' },
            ],
            desserts: [
                {
                    name: 'Plato',
                    desc: 'plato chico',
                    price: '$99.00',
                    variants: 6,
                    sku: 'ent-121',
                    availability: 'Disponible',
                },
                {
                    name: 'Plato',
                    desc: 'plato mediano',
                    price: '$100.00',
                    variants: 3,
                    sku: 'ec-121',
                    availability: 'Disponible',
                },
                {
                    name: 'Plato',
                    desc: 'plato grande',
                    price: '$33.00',
                    variants: 4,
                    sku: 'asa-121',
                    availability: 'Disponible',
                },
                {
                    name: 'Plato',
                    desc: 'plato pozolero',
                    price: '$33.00',
                    variants: 9,
                    sku: 'qesa-121',
                    availability: 'Disponible',
                },
            ],
        }
    }
}
</script>
