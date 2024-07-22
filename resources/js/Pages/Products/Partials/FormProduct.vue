<template>

    <v-card>

        <v-toolbar color="deep-purple-lighten-1">
            <v-btn
                icon
                dark
                @click="$emit('dialog', false)"
            >
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Nuevo producto</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn
                    v-show="!record.product.id"
                    variant="text"
                    @click="__save()"
                >
                    Guardar producto

                </v-btn>
                <v-btn
                    v-show="record.product.id"
                    variant="text"
                    @click="__update"
                >
                    Actualizar y Terminar
                </v-btn>
            </v-toolbar-items>

        </v-toolbar>


        <v-card-text>

            <FormProduct
                :catalog="catalog_id"
                :catalog_type="catalog_type_id"
            ></FormProduct>

        </v-card-text>
        <v-divider></v-divider>

    </v-card>

</template>


<script>

import FormLink from "@/Pages/Products/Partials/FormLink";
import FormFeature from "@/Pages/Products/Partials/FormFeature";
import FormGallery from "@/Pages/Products/Partials/FormGallery";
import FormProduct from "@/Pages/Products/Partials/Forms/ProductForm";

import createNumberMask from 'text-mask-addons/dist/createNumberMask';
import Rules from "../../../Resources/Variables/Rules.vue";


const currencyMask = createNumberMask({
    integerLimit: 8,
    prefix: '',
    allowDecimal: true,
    includeThousandsSeparator: false,
    allowNegative: false,
});

export default {
    name: "wizard-product",

    props: {
        types: {},
        section_selected: {},
        catalog_type_id: null,
        catalog_id: null,
        b2b_id: null,
    },

    components: {
        FormFeature,
        FormGallery,
        FormLink,
        FormProduct,
    },



    data() {
        return {
            tab: null,

            product: {

            },



            tabs: [
                {name: 'Producto', requiredProduct: false},
                {name: 'Rasgos', requiredProduct: true},
                {name: 'Enlaces', requiredProduct: true},
                {name: 'Galerias', requiredProduct: true},
            ],


            /**
             *
             * PRODUCT FORM
             * */


            Rules,
            currencyMask,

            load_parent_product: false,
            search_b2b_products: false,
            product_details: false,
            dialog_price: false, //TODO: Implements
            show_help: false,
            loading: false,


            record: {
                product: {},
                collector: {},
                attach: null,
                attached: null,
                section_products: {},
                herarchy: {},
                catalog_id: null,
            },


            products: {},
            catalog_types: {},
            sections: {},

            errors: {},

        }
    },

    mounted() {
        this.__boot();
    },


    methods: {

        __boot: function () {
            this.record.catalog_id = (this.catalog_id) ? this.catalog_id : null;

            this.__fetch_sections();
            this.__fetch_products();
            this.__fetch_product_types();
        },

        __preview_picture: function () {
            const input = this.$refs.picture[0]
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.record.attach = e.target.result
                }

                reader.readAsDataURL(files[0])

            }
        },

        __upload_picture: async function (product){

            if(this.record.attached){
                let PictureForm = new FormData();
                PictureForm.append("image", this.record.attached[0]);

                return  await axios.post("/op/product-image/"+product.id,
                    PictureForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
            }

        },

        __update: async function(){
            let product = await this.__action_product(true);

            if(product){
                this.record.product = product;

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
                this.record.product = product;

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



        __action_product: async function (isUpdate) {
            try{

                let validator = await this.$refs.form[0].validate();
                if(validator.valid){

                    if(isUpdate)
                    {
                        let response =  await axios.put("/op/products/"+this.record.product.id, this.record);
                        this.savedProduct = response.data.data;

                    } else {
                        this.record.product.b2b_id = this.b2b_id;
                        let response =  await axios.post("/op/products", this.record);
                        this.savedProduct = response.data.data;

                    }
                } else {
                    this.errors = validator.errors;
                    this.savedProduct = false;
                }

            }catch(error) {

                this.savedProduct = false;
                console.log(error);
            };

            return this.savedProduct;
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



        /**
         *
         * GETTERS
         *
         * */

        __fetch_product_types: function () {

            if (this.catalog_type_id != null) {
                var self = this;
                axios.get("/resources/catalog-type-product-type/" + this.catalog_type_id)
                    .then(function (result) {
                        self.catalog_types = result.data.data;
                    });
            }

        },

        __fetch_sections: function () {
            axios.get("/op/catalog-sections/" + this.catalog_id)
                .then((result) => {
                    this.sections = result.data.data;
                })
        },

        __fetch_parent_product: async function(){

            if(this.load_parent_product)
            {
                let response = await axios.get("/op/product-parent-resource/" + this.record.product.parent_product_id)
                    .then((result) => {
                        this.record.collector = this.record.product;

                        this.record.product = result.data.data;
                        this.record.product.parent_product_id = this.record.collector.parent_product_id;
                    });

                return response;
            } else {
                this.record.product = this.record.collector;
                return false;
            }
        },

        __fetch_products: function () {
            if (!this.search_b2b_products) {
                axios.get("/op/b2b-products/" + this.b2b_id)
                    .then((result) => {
                        // this.step = 10;

                        this.products = result.data.data;
                    })
            } else {
                axios.get("/op/catalog-products/" + this.b2b_id + "/" + this.catalog_id)
                    .then((result) => {
                        // this.step = 10;
                        this.products = result.data.data;
                    })
            }
        },

    }
}
</script>
