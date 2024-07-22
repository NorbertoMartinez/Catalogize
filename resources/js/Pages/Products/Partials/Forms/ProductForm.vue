<template>
    <v-card>

        <v-form ref="form">

            <v-row>



                <v-col cols="12">

                    <v-card
                        height="100%"
                        color="deep-purple-lighten-1"
                        variant="tonal"
                        flat
                        class="rounded-lg"
                        density="compact">

                        <v-card-text>
                            Este es un producto heredado de: #####
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn
                                variant="elevated"
                                color="success">
                                Heredar datos
                            </v-btn>
                            <v-btn
                                variant="elevated"
                                color="info">
                                Ver datos
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>

                <v-col sm="12" xs="12" md="4" lg="4" xxl="4">

                    <v-card
                        height="100%"
                        color="deep-purple-lighten-1"
                        variant="outlined"
                        class="rounded-lg"
                        density="compact">

                        <ImageForm></ImageForm>


                    </v-card>
                </v-col>

                <v-col sm="12" xs="12" md="8" lg="8" xxl="8">

                    <v-card
                        color="deep-purple-lighten-1"
                        variant="outlined"
                        class="rounded-lg"
                        density="compact">


                        <v-card-title>
                            <small>Datos del producto</small>
                            <v-icon
                                size="small"
                                color="deep-purple-lighten-1"
                                @click="show_help=!show_help">mdi-help-box</v-icon>
                        </v-card-title>



                        <v-card-text>

                            <v-alert
                                v-show="show_help"
                                density="compact"
                                border="start"
                                border-color="deep-purple accent-4"
                                elevation="2"
                                class="mb-5"
                            >
                                Ahora ingresa los detalles iniciales de tu producto,
                                aquí puedes configurar lo primordial de tu producto
                            </v-alert>


                            <v-row>


                                <v-col cols="6">
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                label="Tag *"
                                                prepend-icon="mdi-tag-heart-outline"
                                                hint="Etiqueta con la que se muestra en el producto origen"
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
                                                label="Nombre *"
                                                prepend-icon="mdi-rename"
                                                hint="Cual es el nombre de tu producto?"
                                                persistent-hint
                                                required
                                                :rules="Rules.text30"
                                                counter="30"
                                                class=" ma-0 pa-0"
                                                density="compact"
                                                v-model="product.name"
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

                                        <v-col cols="12">

                                            <v-alert
                                                v-show="show_help"
                                                density="compact"
                                                border="start"
                                                border-color="deep-purple accent-4"
                                                elevation="2"
                                                class="mb-4"
                                            >
                                                Los productos PADRE, son productos que se relacionan directamente con otros productos, heredando parte de su contenido.
                                                Para comenzar elige un producto de la lista y si deseas cargar
                                                los datos presiona el botón "Cargar datos de producto padre"
                                            </v-alert>



                                            <v-select
                                                label="Producto Padre"
                                                prepend-icon="mdi-format-list-group-plus"
                                                hint="Si el producto HEREDA de otro, eligelo aquí"
                                                density="compact"
                                                persistent-hint
                                                v-model="product.parent_product_id"
                                                :items="list_products"
                                                item-title="name"
                                                item-value="id">
                                            </v-select>
                                        </v-col>
                                    </v-row>
                                </v-col>
                                <v-col cols="6">
                                    <v-row>

                                        <v-col cols="12">
                                            <v-select
                                                label="Tipo de producto *"
                                                prepend-icon="mdi-car-select"
                                                hint="Que tipo de producto ofreces?"
                                                density="compact"
                                                persistent-hint
                                                :rules="Rules.SelectorRules"
                                                required
                                                class=" ma-0 pa-0"
                                                v-model="product.product_type_id"
                                                :items="list_product_types"
                                                item-title="type.name"
                                                :item-value="item => item.product_type_id"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select
                                                label="Disponibilidad *"
                                                hint="Elige si hay disponibilidad del producto"
                                                density="compact"
                                                persistent-hint
                                                prepend-icon="mdi-list-status"
                                                :rules="Rules.SelectorRules"
                                                required
                                                item-title="name"
                                                :item-value="item => item.id"
                                                :items="Cats.availabilities"
                                                v-model="product.availability_id"
                                            ></v-select>
                                        </v-col>

                                        <v-col cols="12">

                                            <v-alert
                                                v-show="show_help"
                                                density="compact"
                                                border="start"
                                                border-color="deep-purple accent-4"
                                                elevation="2"
                                                class="mb-4"
                                            >
                                                Las secciones es dónde será visible el producto, puede seleccionar una o distintas
                                                secciones dónde el producto será listado en su contenido
                                            </v-alert>
                                            <v-select
                                                prepend-icon="mdi-magnify"
                                                label="Busca tus secciones"
                                                hint="Secciones dónde aparece el producto"
                                                density="compact"
                                                persistent-hint
                                                item-title="section.title"
                                                :item-value="item => item.section.id"
                                                return-object="false"
                                                :items="list_sections"
                                                chips
                                                multiple
                                                v-model="product_sections.sections"
                                            ></v-select>
                                        </v-col>

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
                                    </v-row>
                                </v-col>

                            </v-row>

                        </v-card-text>




                    </v-card>

                </v-col>

            </v-row>
            <v-row>

                <v-col sm="12" xs="12" md="4" lg="4" xxl="4">

                    <v-card
                        color="deep-purple-lighten-1"
                        variant="outlined"
                        class="rounded-lg"
                        density="compact">


                        <v-card-title>
                            <small>Galeria  <v-icon
                                size="small"
                                color="deep-purple-lighten-1"
                                @click="show_help=!show_help">mdi-help-box</v-icon></small>
                        </v-card-title>

                        <v-card-text>
                            <FormGallery
                                :product="product"
                                :product_id="product.id"
                            ></FormGallery>
                        </v-card-text>
                    </v-card>
                </v-col>

                <v-col sm="12" xs="12" md="8" lg="8" xxl="8">
                    <v-card
                        color="deep-purple-lighten-1"
                        variant="outlined"
                        class="rounded-lg"
                        density="compact">

                        <v-card-title>
                            <small>Carácteristicas del producto:  <v-icon
                                size="small"
                                color="deep-purple-lighten-1"
                                @click="show_help=!show_help">mdi-help-box</v-icon></small>                        </v-card-title>

                        <v-card-text>

                            <FormFeature
                                :product="product"
                                :product_id="product.id"
                            ></FormFeature>

                        </v-card-text>
                    </v-card>

                    <v-card
                        color="deep-purple-lighten-1"
                        variant="outlined"
                        class="rounded-lg mt-4"
                        density="compact">

                        <v-card-title>
                            <small>Enlaces Externos:  <v-icon
                                size="small"
                                color="deep-purple-lighten-1"
                                @click="show_help=!show_help">mdi-help-box</v-icon>
                            </small>
                        </v-card-title>



                        <v-card-text>
                            <FormLink
                                :product="product"
                                :product_id="product.id"
                            ></FormLink>
                        </v-card-text>
                    </v-card>
                </v-col>

            </v-row>
        </v-form>
    </v-card>
</template>

<script>


import createNumberMask from 'text-mask-addons/dist/createNumberMask';
import Rules from "../../../../Resources/Variables/Rules.vue";
import ImageForm from "./ImageForm.vue";
import FormFeature from "../FormFeature.vue";
import FormLink from "../FormLink.vue";
import FormGallery from "../FormGallery.vue";

const currencyMask = createNumberMask({
    integerLimit: 8,
    prefix: '',
    allowDecimal: true,
    includeThousandsSeparator: false,
    allowNegative: false,
});

export default {

    name:"forms-product",


    components:{
        ImageForm,
        FormLink,
        FormGallery,
        FormFeature
    },

    props: {
        catalog_type: null,
        catalog: null,
        section: null,
        isUpdate: false,
        resource: null
    },

    data(){
        return {
            Rules, currencyMask,

            show_help: false,
            details: false,

            product: {},
            product_sections: {},

            input_file: null,
            image: null,

            list_products: [],
            list_sections: [],
            list_product_types: [],


            errors: {},

        }
    },

    mounted() {
        if(!this.isUpdate)
        {
            this.__fetch_sections()
            this.__fetch_product_types()
            this.__fetch_products()
        }
    },

    methods: {


        /**
         *
         * GETTERS
         *
         * */

        __fetch_product_types: function () {

            if (this.catalog_type != null) {
                var self = this;
                axios.get("/resources/catalog-type-product-type/" + this.catalog_type)
                    .then(function (result) {
                        self.list_product_types = result.data.data;
                    });
            }

        },

        __fetch_sections: function () {
            var self = this;
            axios.get("/op/catalog-sections/" + this.catalog)
                .then((result) => {
                    self.list_sections = result.data.data;
                })
        },

        __fetch_products: function () {
            var self=this;
            if (!this.search_b2b_products) {
                // axios.get("/op/b2b-products/" + this.b2b_id)
                //     .then((result) => {
                //         self.list_products = result.data.data;
                //     })
            } else {
                // axios.get("/op/catalog-products/" + this.b2b_id + "/" + this.catalog)
                //     .then((result) => {
                //         // this.step = 10;
                //         self.list_products = result.data.data;
                //     })
            }
        },


        __upload_picture: async function (product){

            if(this.input_file){
                let PictureForm = new FormData();
                PictureForm.append("image", this.input_file[0]);

                return  await axios.post("/op/product-image/"+product.id,
                    PictureForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
            }

        },

        __save_sections: async function () {

            try{
                let response = await axios.post("/op/sections-product", this.record);
                this.savedSections = response.data.data;
            }catch(error) {
                this.savedSections = false;

            };

            return this.savedSections;

        },

        __update: async function(){
            let product = await this.__action_product(true);

            if(product){
                this.product = product;

                let picture = await this.__upload_picture(product);
                let sections = await this.__save_sections();


                if(sections && picture)
                {
                    this.$emit("notify", "Producto actualizado correctamente")
                } else {
                    this.$emit("notify", "Ocurrio un error")
                }


            } else {

                let messages = this.errors.length + " Error/es - " ;
                for(var item in this.errors){
                    messages += this.errors[item].errorMessages + ", ";
                }
                this.$emit("notify", messages);
            }
        },

        __save: async function(){

            let product = await this.__action_product(false);

            if(product){
                this.product = product;

                let sections = await this.__save_sections();
                let picture = await this.__upload_picture(product);


                if(sections && picture)
                {
                    this.$emit("notify", "Producto creado correctamente, ya puede ingresar atributos")
                } else {
                    this.$emit("notify", "Ocurrio un error")
                }


            } else {
                let messages = this.errors.length + " Error/es - " ;
                for(var item in this.errors){
                    messages += this.errors[item].errorMessages + ", ";
                }
                this.$emit("notify", messages);
            }
        },

    }
}
</script>


<style>
.v-select .v-field .v-field__input > input{
    opacity: 0 !important;
}
</style>
