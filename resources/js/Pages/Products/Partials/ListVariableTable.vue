<template>

    <v-card flat>

        <v-card-text>

            <v-table>
                <thead>
                <tr>
                    <th class="text-left">
                        Name
                    </th>
                    <th class="text-left">
                        Calories
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="item in desserts"
                    :key="item.name"
                >
                    <td>{{ item.desc }}</td>
                    <td>{{ item.price }}</td>
                </tr>
                </tbody>
            </v-table>

        </v-card-text>

        <v-card-actions>

        </v-card-actions>
    </v-card>

</template>


<script>

import FormProductVariable from "@/Pages/Products/Partials/FormVariableProduct.vue"
export default {
    name: "list-products",

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
