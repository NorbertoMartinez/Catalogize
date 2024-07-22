<template>

    <v-card flat>


        <v-toolbar>
            <v-toolbar-title>Especificaciones del producto</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="dialog=!dialog">
                <v-icon>mdi-plus</v-icon>
            </v-btn>
        </v-toolbar>


        <v-card-text>

            <v-dialog v-model="dialog" width="500">
                <FormSpecification></FormSpecification>
            </v-dialog>


        </v-card-text>

        <v-card-actions>

        </v-card-actions>
    </v-card>

</template>


<script>

import FormSpecification from "@/Pages/Products/Partials/FormSpecification.vue"
export default {
    name: "list-specifications",

    components: {
        FormSpecification
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
