<template>
    <v-form ref="link">

        <v-row>


            <v-col sm="12" xs="12" md="4" lg="4" xxl="4">

                <v-select
                    label="Tipo de enlace"
                    prepend-icon="mdi-select-place"
                    required
                    hint="Selecciona un tipo de enlace"
                    density="compact"
                    persistent-hint
                    :rules="Rules.SelectorRules"
                    v-model="link.link_type_id"
                    :items="link_types"
                    item-title="name"
                    :item-value="item=>item.id"
                >

                </v-select>
            </v-col>
            <v-col sm="12" xs="12" md="7" lg="7" xxl="7">

                <v-text-field
                    label="URL/Enlace"
                    prepend-icon="mdi-link-plus"
                    hint="Agrega valores a tu caracteristica"
                    density="compact"
                    persistent-hint
                    required
                    :rules="Rules.url"
                    counter="120"
                    v-model="link.value"
                >


                </v-text-field>
            </v-col>
            <v-col sm="12" xs="12" md="1" lg="1" xxl="1">
                <v-btn
                    class="mt-3"
                    icon="mdi-plus"
                    size="small"
                    v-show="!edit"
                    density="comfortable"
                    :loading="loading"
                    color="deep-purple-lighten-1"
                    @click="__add"
                ></v-btn>

                <v-btn
                    color="error"
                    class="mt-3"
                    icon="mdi-close"
                    size="x-small"
                    v-show="edit"
                    density="comfortable"
                    :loading="loading"
                    @click="$emit('delete', item)"
                ></v-btn>
            </v-col>

        </v-row>

    </v-form>
</template>


<script>
import Rules from "../../../Resources/Variables/Rules.vue";

export default {
    name: "form-link-item",

    props:{

        product: {},
        edit: false,
        item: null,
    },



    data(){
        return {
            Rules,

            /* Buttons*/
            loading: false,

            /*Events*/
            deletable: false,

            /* Object new record */
            link: {},

            /* Catalog of Types*/
            link_types: [],

        }
    },

    mounted() {

        var self=this;
        if(this.edit){
            this.__fetch_link_types().then(function (result){
                self.link_types = result.data.data;
                self.link = self.item;
            });

        } else {
            this.__fetch_link_types().then(function (result){
                self.link_types = result.data.data;
            });
        }
        // if(this.product.id){
        //     this.__fetch_link_types();
        //     this.record.link.product_id = this.product.id;
        //     this.record.product = this.product;
        // }

    },
    methods: {

        __reset(){
            this.link = {};
        },
        __add(){

            var self = this;
            this.$refs.link.validate().then(
                function (v){
                    if (v.valid) {

                        self.$emit("push", self.link);
                        self.__reset();
                    }
                }
            )
        },

        __save_link: async function (){

            try{
                let validator = await this.$refs.feature.validate();
                if(validator.valid){
                    let response =  await axios.post("/op/product-links", this.record);

                    this.$emit("add", 1);
                    this.$emit("push", response.data.data);

                    this.deletable = true;
                    this.savedLink = response.data.data;
                } else {
                    this.savedLink = false;
                }
            }catch(error) {
                this.savedLink = false;
                console.log(error);
            };

            return this.savedLink;

        },



        __fetch_link_types: async function ()
        {

            return await axios.get("/resources/link-types")

        },


        /**
         * OPERATION METHOD:
         * @param item
         * @private
         */
        __delete_link: function (item)
        {

            var self=this;
            axios.delete("/op/product-links/"+item).then(function (result){
                // self.link_types = result.data.data;
                self.__fetch_product_links();
            });

        },

    }
}
</script>
