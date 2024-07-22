<template>

    <v-card flat>

        <v-card-text>

            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="resources"
                class="elevation-0"
                density="compact"
            >
                <template v-slot:item.price="{item}">

                    <span v-show="item.props.title.product.price">{{ item.props.title.product.price }}</span>
                    <span v-show="!item.props.title.product.price">No definido</span>
                </template>
                <template v-slot:item.stock="{item}">

                    <span v-show="item.props.title.product.isStockeable">{{ item.props.title.product.stock }}</span>
                    <span v-show="!item.props.title.product.isStockeable">--</span>

                </template>
                <template v-slot:item.sku="{item}">
                    <span v-show="item.props.title.product.sku">{{ item.props.title.product.sku }}</span>
                    <span v-show="!item.props.title.product.sku">No definido</span>
                </template>

                <template v-slot:no-data>
                    <div cols="12" class="text-center pa-4">
                        <p>No hay registros actualmente registrados</p>
                    </div>
                </template>

            </v-data-table>
        </v-card-text>

        <v-card-actions>

        </v-card-actions>
    </v-card>

</template>


<script>

import WizardProduct from "@/Pages/Products/Partials/WizardProduct.vue"
import ListVariables from "@/Pages/Products/Partials/ListVariableTable.vue"
export default {
    name: "table-products",


    props: {
        resources: {},
    },

    components: {
        WizardProduct,
       ListVariables
    },

    data(){
        return {
            search_b2b_products: false,
            products: [],
            itemsPerPage: 50,
            headers: [
                {
                    title: 'Nombre',
                    align: 'start',
                    sortable: false,
                    key: 'product.name',
                },
                { title: 'Precio', align: 'end', key: 'price' },
                { title: 'Stock', align: 'end', key: 'stock' },
                { title: 'SKU', align: 'end', key: 'sku' },
            ],

        }
    },

    mounted() {
    },

    methods: {

    }
}
</script>
