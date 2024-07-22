<template>


    <v-card
        color="deep-purple-lighten-1"
        variant="text"
        class="rounded-lg"
        density="compact">


        <v-card-text>

            <v-alert
                v-show="show_help"
                density="compact"
                border="start"
                border-color="deep-purple accent-4"
                elevation="2"
                class="mb-4"
            >
                Las variantes de productos, son productos que se relacionan directamente con otros productos, heredando parte de su contenido.
                Para comenzar elige un producto de la lista y si deseas cargar
                los datos presiona el botón "Cargar datos de producto padre"

            </v-alert>


            <FormLinkItem
                v-for="(item, index) in record.links" :key="index"
                @delete="__delete($event)"
                :product="product"
                :item="item"
                edit="true"
            ></FormLinkItem>

            <div>
                <FormLinkItem
                    @push="__push($event)"
                    :product="product"
                ></FormLinkItem>
            </div>

        </v-card-text>


    </v-card>

</template>



<script>

import FormLinkItem from "./FormLinkItem.vue";

export default {
    name: "form-link",

    props:{
        product_id: null,
        product: {},
    },

    components: {
        FormLinkItem
    },

    data(){
        return {
            items: 1,

            /* Loading Buttons*/
            loading: false,
            show_help: false,

            /* Object new record */
            record: {
                link: {},
                links: []
            },


            /* Product Items */
            product_links: {},

            /* Catalog of Types*/
            link_types: [],
        }
    },


    methods:{

        __push(element){
            this.record.links.push(element);
        },

        __delete(element){


            this.record.links.splice(
                this.record.links.indexOf(element), 1
            )


        },


        /**
         * OPERATION METHOD:
         * @private
         */
        __fetch_product_links: function ()
        {
            var self=this;
            axios.get("/op/product-link/"+this.product_id).then(function (result){
                self.product_links = result.data.data;
            });

        },




    }
}
</script>
