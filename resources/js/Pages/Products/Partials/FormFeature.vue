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


            <FormFeatureItem
                v-for="(item, index) in record.features" :key="index"
                @delete="__delete($event)"
                :product="product"
                :item="item"
                edit="true"
            ></FormFeatureItem>

            <div>
                <FormFeatureItem
                    @push="__push($event)"
                    :product="product"
                ></FormFeatureItem>
            </div>





        </v-card-text>


    </v-card>

</template>


<script>

import FormFeatureItem from "./FormFeatureItem.vue";
export default {
    name: "form-feature",

    props:{
        product_id: null,
        product: {},
    },

    components: {
        FormFeatureItem
    },



    data(){
        return {

            items: 1,
            /* Loading Buttons*/
            loading: false,
            show_help: false,

            /* Object new record */
            record: {
                features: [],
                items: []
            },


            /* Product Items */
            product_features: {},

            /* Catalog of Types*/
            features: [],
        }
    },

    methods: {


        __push(element){
            this.record.features.push(element);
        },

        __delete(element){


            this.record.features.splice(
                this.record.features.indexOf(element), 1
            )


        },


        __fetch_product_features: function (){
            var self=this;
            axios.get("/op/product-feature/"+this.product_id).then(function (result){
                self.product_features = result.data.data;
            });

        },

        __save_feature: async function (){

            try{
                let validator = await this.$refs.feature.validate();
                if(validator.valid){
                    let response =  await axios.post("/op/product-features", this.record);

                    this.$emit("add", 1);
                    this.$emit("push", response.data.data);

                    this.deletable = true;
                    this.savedFeature = response.data.data;
                } else {
                    this.savedFeature = false;
                }
            }catch(error) {
                this.savedFeature = false;
                console.log(error);
            };

            return this.savedFeature;


        },




        __delete_feature: function (item){

            var self=this;
            axios.delete("/op/product-features/"+item).then(function (result){
                // self.features = result.data.data;
                self.__fetch_product_features();
            });
        }


    }
}
</script>
