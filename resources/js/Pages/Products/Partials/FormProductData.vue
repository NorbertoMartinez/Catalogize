<template>


    <v-card flat density="compact">


        <v-window v-show="step==1">
            <v-card-text>

                <v-form ref="form_data">
                    <v-row>
                        <v-col sm="12" md="6">

                            <v-row>


                                <v-col cols="12">
                                    <v-text-field
                                        label="Variable *"
                                        prepend-icon="mdi-tag-heart-outline"
                                        hint="Ej. Grande, Mediano, Chico"
                                        persistent-hint
                                        required
                                        :rules="Rules.text30"
                                        counter="30"
                                        class=" ma-0 pa-0"
                                        density="compact"
                                        v-model="product.tag"
                                        cols="2"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field
                                        label="SKU"
                                        prepend-icon="mdi-alphabet-latin"
                                        hint="Tu producto tiene un código?"
                                        density="compact"
                                        persistent-hint
                                        counter="30"
                                        v-model="product.sku"
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-textarea
                                        label="Descripcion"
                                        hint="Agrega la mejor descripción de tu producto"
                                        density="compact"
                                        persistent-hint
                                        prepend-icon="mdi-text-long"
                                        counter="200"
                                        v-model="product.description"
                                    ></v-textarea>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col sm="12" md="6">

                            <v-row>
                                <v-col cols="12">
                                    <v-switch
                                        label="Tiene un precio?"
                                        hint="Tu producto tiene un precio?"
                                        density="compact"
                                        persistent-hint
                                        inset
                                        model-value="true"
                                        color="deep-purple-lighten-1"
                                        v-model="product.isGlobalPrice"></v-switch>

                                    <v-text-field
                                        label="Precio"
                                        hint="Agrega cuanto cuesta tu producto"
                                        density="compact"
                                        persistent-hint
                                        prepend-icon="mdi-currency-usd"
                                        counter="8"
                                        v-mask="currencyMask"
                                        v-model="product.price"
                                        v-if="product.isGlobalPrice"
                                        @click:append="dialog_price = !dialog_price">
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12">

                                    <v-switch
                                        label="Tiene stock?"
                                        hint="Agrega cuanto cuesta tu producto"
                                        density="compact"
                                        persistent-hint
                                        inset
                                        color="deep-purple-lighten-1"
                                        v-model="product.isStockeable"></v-switch>

                                    <v-text-field
                                        label="Stock Disponible"
                                        hint="Ingresa cuantas unidades tienes del producto"
                                        density="compact"
                                        persistent-hint
                                        prepend-icon="mdi-counter"
                                        counter="4"
                                        v-mask="'####'"
                                        flat
                                        suffix="Pzas."
                                        v-model="product.stock"
                                        v-if="product.isStockeable"
                                        dense></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-select
                                        label="Disponibilidad *"
                                        v-model="product.availability_id"
                                        hint="Elige si hay disponibilidad del producto"
                                        density="compact"
                                        persistent-hint
                                        class=" ma-0 pa-0"
                                        prepend-icon="mdi-list-status"
                                        :rules="Rules.SelectorRules"
                                        required
                                        :items="Cats.availabilities"
                                        item-title="name"
                                        :item-value="item => item.id"
                                    ></v-select>
                                </v-col>
                                <v-col cols="12">
                                    <v-select
                                        label="Publicado? *"
                                        v-model="product.status_id"
                                        hint="Puedes ponerlo Activo para que sea público"
                                        density="compact"
                                        persistent-hint
                                        class=" ma-0 pa-0"
                                        prepend-icon="mdi-list-status"
                                        :rules="Rules.SelectorRules"
                                        required
                                        :items="Cats.statuses"
                                        item-title="name"
                                        :item-value="item => item.id"
                                    ></v-select>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-form>

            </v-card-text>

            <v-card-actions>


                <v-spacer></v-spacer>


                <v-btn
                    v-if="step <= 3 "
                    color="deep-purple-lighten-1"
                    variant="flat"
                    type="submit"
                    @click="push(1)"

                >
                    Agregar otra variante
                </v-btn>
                <v-btn
                    v-if="step <= 3 "
                    color="deep-purple-lighten-1"
                    variant="flat"
                    type="submit"
                    @click="push(2)"

                >
                    Continuar con el producto
                </v-btn>

            </v-card-actions>
        </v-window>

    </v-card>
</template>


<script>

import Rules from "../../../Resources/Variables/Rules.vue";
import Cats from "../../../Resources/Variables/Catalogs.vue";
import createNumberMask from 'text-mask-addons/dist/createNumberMask';

const currencyMask = createNumberMask({
    integerLimit: 8,
    prefix: '',
    allowDecimal: true,
    includeThousandsSeparator: false,
    allowNegative: false,
});

export default {

    name:"product-data",
    props: {
        parent: {}
    },
    data(){
        return {

            Rules, Cats, currencyMask,

            /*Loading Buttons */
            loading: false,
            dialog_price: false,

            /* Stepper */
            step: 1,

            product: {},
        }
    },

    methods:{
        push: function (type){
            var self = this;


            this.$refs.form_data.validate().then(function (v){
                if (v.valid) {
                    // self.__save().then(function (response){
                    self.$emit("push", self.product);
                    // })
                    self.$emit("action", type);
                }
            })



        },
    }
}

</script>
