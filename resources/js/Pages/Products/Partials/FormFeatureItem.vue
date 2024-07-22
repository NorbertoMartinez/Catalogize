<template>
    <v-form ref="feature">

    <v-row>


        <v-col sm="6" xs="12" md="4" lg="4" xxl="4">

            <v-select
                label="Caracteristica"
                :prepend-icon="(!edit) ? 'mdi-select-place' : 'mdi-arrow-right-circle-outline'"
                required
                hint="Selecciona un tipo de caracteristica"
                density="compact"
                persistent-hint
                :disabled="!type"
                :rules="Rules.SelectorRules"
                v-model="feature.feature_id"
                :items="list_features"
                item-title="feature.name"
                item-value="feature.id"
            >

            </v-select>
        </v-col>
        <v-col sm="6" xs="12" md="7" lg="7" xxl="7">

            <v-text-field
                label="Valor o contenido de la especificación"
                prepend-icon="mdi-star-circle-outline"
                hint="Agrega valores a tu caracteristica"
                density="compact"
                :disabled="!type"
                persistent-hint
                required
                :rules="Rules.text200"
                counter="200"
                v-model="feature.value"
            >


            </v-text-field>
        </v-col>
        <v-col sm="12" xs="12" md="1" lg="1" xxl="1">

            <v-btn
                class="mt-3"
                icon="mdi-plus"
                size="x-small"
                v-show="!edit"
                :disabled="!type"
                density="comfortable"
                :loading="loading"
                color="deep-purple-lighten-1"
                @click="__add_feature"
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
import {Rule} from "postcss";

export default {
    name: "form-feature-item",

    props:{
        product: {},
        edit: false,
        item: null,
    },


    computed:{

        type: function (){
            if(this.product.product_type_id){
                return this.product.product_type_id;
            } else {
                return null;
            }
        }
    },

    watch: {
      type: function (nv, ov){

          if (nv != ov) {
              var self=this;

              this.__reset()
              this.__fetch_features().then(function (result){
                  self.list_features = result.data.data;
              });
          }
      }
    },

    data(){
        return {
            Rules,



            /* Buttons*/
            loading: false,

            /*Events*/
            deletable: false,

            /* Object new record */

            feature: {},

            /* Catalog of Types*/
            list_features: [],

        }
    },

    mounted() {


        var self=this;
        if(this.edit){
            this.__fetch_features().then(function (result){
                self.list_features = result.data.data;
                self.feature = self.item;
            });

        } else {
            if(this.product.id){
                this.__fetch_features().then(function (result){
                    self.list_features = result.data.data;
                });

                this.feature.product_id = this.product.id;
                // this.product = this.product;
            }
        }

    },
    methods: {
        __reset(){
            this.feature = {};
        },


        __add_feature(){

            var self = this;
            this.$refs.feature.validate().then(
                function (v){
                    if (v.valid) {

                        self.$emit("push", self.feature);
                        self.__reset();
                    }
                }
            )
        },

        __fetch_features: async function (){
            return await axios.get("/resources/product-type-features/"+this.type)
        },

    }
}
</script>
