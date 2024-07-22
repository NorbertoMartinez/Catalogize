<template>

    <v-card>


        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="$emit('dialog', false)">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-toolbar>


        <v-window v-model="step">
            <v-window-item :value="1">
                <v-card-text>

                    <v-form ref="create_product">


                        <v-row>

                            <v-col md="7" sm="12">

                                <v-alert
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
                                    v-model="sections"
                                ></v-select>
                            </v-col>

                            <v-col md="5" sm="12">

                                <ImageForm
                                    @image="picture = $event"
                                ></ImageForm>

                            </v-col>

                            <v-col md="7" sm="12">

                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Nombre *"
                                            prepend-icon="mdi-rename"
                                            hint="Ej. Juego de Mesa, Jugo de Naranja..."
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

                            <v-col md="5" sm="12">
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
                                            label="Estado del producto *"
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
                        class="text-end"
                        color="deep-purple-lighten-1"
                        variant="flat"
                        @click="__save"
                    >
                        Crear y continuar
                    </v-btn>
                </v-card-actions>

            </v-window-item>
            <v-window-item :value="2">


                <v-alert
                    density="compact"
                    border="start"
                    border-color="deep-purple accent-4"
                    elevation="2"
                    class="mb-4"
                >
                    Las secciones es dónde será visible el producto, puede seleccionar una o distintas
                    secciones dónde el producto será listado en su contenido
                </v-alert>
                <div
                    v-for="n in (product_variables.length+1)"
                    :key="n"
                >
                    <FormProductData
                        v-if="(n == product_variables.length+1)?true:false"
                        ref="wizard_product_data"
                        :parent="product"
                        @push="push($event)"
                        @action="action($event)"
                    ></FormProductData>
                </div>
            </v-window-item>

            <v-window-item :value="3">
                <v-card-text>
                    <v-data-table
                        :items="product_variables"
                        :headers="headers"
                    >

                    </v-data-table>
                </v-card-text>

                <v-card-actions>

                    <v-spacer></v-spacer>
                    <v-btn
                        class="text-end"
                        color="deep-purple-lighten-1"
                        variant="flat"
                        @click="step++"
                    >
                        Confirmar y continuar
                    </v-btn>
                </v-card-actions>

            </v-window-item>
            <v-window-item :value="4">

                <FormFeature
                    :product="product"
                    :product_id="product.id"
                ></FormFeature>

                <v-card-actions>

                    <v-spacer></v-spacer>
                    <v-btn
                        class="text-end"
                        color="deep-purple-lighten-1"
                        variant="flat"
                        @click="step++"
                    >
                        Continuar
                    </v-btn>
                </v-card-actions>

            </v-window-item>
            <v-window-item :value="5">

                <FormLink
                    :product="product"
                    :product_id="product.id"
                ></FormLink>

                <v-card-actions>


                    <v-btn
                        class="text-end"
                        color="deep-purple-lighten-1"
                        variant="flat"
                        @click="step--"
                    >
                        Regresar
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        class="text-end"
                        color="deep-purple-lighten-1"
                        variant="flat"
                        @click="step++"
                    >
                        Continuar
                    </v-btn>
                </v-card-actions>

            </v-window-item>

            <v-window-item :value="6">

                <FormGallery
                    :product="product"
                    :product_id="product.id"
                ></FormGallery>

                <v-card-actions>

                    <v-btn
                        class="text-end"
                        color="deep-purple-lighten-1"
                        variant="flat"
                        @click="step--"
                    >
                        Regresar
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        class="text-end"
                        color="deep-purple-lighten-1"
                        variant="flat"
                        @click="step++"
                    >
                        Finalizar
                    </v-btn>
                </v-card-actions>

            </v-window-item>
        </v-window>
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
import Cats from "../../../Resources/Variables/Catalogs.vue";
import FormProductData from "./FormProductData.vue";
import WizardSerieItem from "../../Brochures/Partials/WizardSerieItem.vue";
import ImageForm from "./Forms/ImageForm.vue";


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
        ImageForm,
        WizardSerieItem,
        FormProductData,
        FormFeature,
        FormGallery,
        FormLink,
        FormProduct,
    },


    data() {
        return {


            Rules, Cats,
            step: 1,

            /**
             * RECOLECTORS
             * */
            sections: null,
            product: {},
            product_variables: [],
            picture: null,

            headers: [
                {title: '#', sortable: true, align: 'start', width: "10", key: 'id'},
                {title: 'Tag', align: 'start', width: "122", key: 'tag'},
                {title: 'Disponibilidad', align: 'start', sortable: true, key: 'availability_id',},
                {title: 'Estado', align: 'start', key: 'status_id'},
                {title: '--', align: 'end', sortable: false, key: 'actions'},
            ],


            /**
             *
             * PRODUCT FORM
             * */

            show_help: false,
            loading: false,


            list_sections: [],
            list_product_types: [],

            errors: {},

        }
    },

    mounted() {
        this.__boot();

    },
    computed: {
        currentTitle() {

            /* Show Stepper title */
            switch (this.step) {
                case 1:
                    return 'Nuevo Producto'
                case 2:
                    return 'Variantes - ' + "(" + this.product_variables.length + ")"
                case 3:
                    return 'Confirmar Variantes'
                case 4:
                    return 'Enlaces'
                case 5:
                    return 'Galeria'
                case 6:
                    return 'Verifica tu información'
                case 7:
                    return 'Haz finalizado!'
                case 8:
                    return 'banner'
                case 100:
                    return 'Error al crear el catálogo'
            }
        },
    },

    methods: {


        __boot: function () {

            this.__fetch_sections();
            this.__fetch_product_types();
        },

        show_errors: function(){
            // let messages = this.errors.length + " Error/es - ";
            // for (var item in this.errors) {
            //     messages += this.errors[item].errorMessages + ", ";
            // }
            // this.$emit("notify", messages);
        },

        /**
         *
         * ACTIONS TABS
         *
         * */

        next: function () {
            this.step++;
        },

        back: function () {
            this.step--;
        },

        action: function (action) {

            switch (action) {
                case 1:
                    return;
                case 2:
                    this.next();
                    return;
            }
        },


        /**
         *
         * ACTIONS
         *
         * */


        push: function (element) {
            this.product_variables.push(element)
        },

        __update: async function () {
            let product = await this.__action_product(true);

            if (product) {
                this.product = product;

                let picture = await this.__upload_picture(product);
                let sections = await this.__save_sections();


                if (sections && picture) {
                    this.$emit("notify", "Producto actualizado correctamente")
                } else {
                    this.$emit("notify", "Ocurrio un error")
                }


            } else {

                this.show_errors();
            }
        },

        __save: async function () {

            let product = await this.__save_product(false);

            if (product) {
                this.product = product;

                let sections = await this.__save_sections(product);
                let picture = await this.__save_picture(product);


                if (sections && picture) {
                    this.$emit("notify", "Producto creado correctamente, ya puede ingresar atributos")
                } else {
                    this.$emit("notify", "Ocurrio un error")
                }


            } else {
               this.show_errors();
            }
        },


        /**
         *
         * SAVERS
         *
         * */

        __save_product: async function (isUpdate) {
            try {

                let validator = await this.$refs.create_product.validate();
                if (validator.valid) {

                    if (isUpdate) {
                        let response = await axios.put("/op/products/" + this.product.id, this.record);
                        this.savedProduct = response.data.data;

                    } else {
                        this.product.b2b_id = this.b2b_id;
                        let response = await axios.post("/op/products", this.product);
                        this.savedProduct = response.data.data;
                    }
                } else {
                    alert('validator')

                    this.errors = validator.errors;
                    this.savedProduct = false;
                }

            } catch (error) {

                alert('catched')
                this.savedProduct = false;
                console.log(error);
            }


            return this.savedProduct;
        },

        __save_sections: async function (product) {

            try {
                let response = await axios.post("/op/sections-product", {
                    sections: this.sections,
                    product: product,
                    catalog_id: this.catalog_id,
                });
                this.savedSections = response.data.data;
            } catch (error) {
                this.savedSections = false;
            }


            return this.savedSections;

        },

        __save_picture: async function (product) {

            if (this.picture) {
                let PictureForm = new FormData();
                PictureForm.append("image", this.picture);

                return await axios.post("/op/product-image/" + product.id,
                    PictureForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
            }

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
                        self.list_product_types = result.data.data;
                    });
            }

        },

        __fetch_sections: function () {
            var self = this;
            axios.get("/op/catalog-sections/" + this.catalog_id)
                .then((result) => {
                    self.list_sections = result.data.data;
                })
        },


    }
}
</script>
