<template>

    <v-card>


        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>

                Productos

            </v-toolbar-title>



            <v-spacer></v-spacer>

            <!--Add New Item-->
            <v-btn icon @click="dialog=!dialog">
                <v-icon>mdi-plus</v-icon>
            </v-btn>

            <!--Reload-->
            <v-btn icon @click="__fetch_products">
                <v-icon>mdi-reload</v-icon>
            </v-btn>
        </v-toolbar>

        <v-card-text>

            <v-dialog
                v-model="dialog"
                persistent
                scrollable
                width="800"
                scroll-strategy="reposition"
                :scrim="false"
                transition="dialog-bottom-transition">

                <WizardProduct
                    @notify="this.Toast($event)"
                    @update="__fetch_products"
                    @dialog="dialog=$event"
                    :catalog_type_id="catalog_type_id"
                    :catalog_id="catalog_id"
                    :b2b_id="b2b_id"
                    :sections="sections"
                ></WizardProduct>
            </v-dialog>



            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="products"
                class="elevation-0"
                density="compact"
                :search="search"
                show-expand
            >

                <!--Filters-->
                <template v-slot:top>


                    <v-row class="mt-6">
                        <v-col cols="4">
                            <v-text-field
                                label="Buscar un producto"
                                density="compact"
                                variant="outlined"
                                append-icon="mdi-magnify"
                                single-line
                                v-model="search">
                            </v-text-field>
                        </v-col>
                        <v-col cols="4">

                            <v-select
                                label="Elegir modalidad"
                                density="compact"
                                variant="outlined"
                                v-model="filter"
                                :items="filters"
                                item-title="label"
                                item-value="filter"
                                @update:modelValue="__fetch_products"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="4">

                            <v-select
                                label="Filtrar por sección"
                                density="compact"
                                variant="outlined"
                                v-model="filter"
                                :items="filters"
                                item-title="label"
                                item-value="filter"
                                @update:modelValue="__fetch_products"
                            >
                            </v-select>
                        </v-col>
                    </v-row>

                </template>


                <!--Publish-->
                <template v-slot:item.img="{item}">


                    <v-avatar icon="mdi-vuetify" size="small"
                              :image="item.props.title.img"
                    ></v-avatar>

                </template>

                <!--Publish-->
                <template v-slot:item.publish="{item}">
                    <v-switch color="deep-purple-lighten-1"

                              @update:modelValue="__update_publish(item.props.title)"
                              v-model="item.props.title.published"
                              density="compact">
                    </v-switch>
                </template>


                <!--Price-->
                <template v-slot:item.price="{item}">
                    <div v-if="item.props.title.isGlobalPrice == true">
<!--                        <v-text-field-->
<!--                            disabled-->

<!--                            model-value="item.props.title.price"-->
<!--                        >-->
<!--                        </v-text-field>-->

<!--                        {{ item.props.title }}-->
                    </div>
                    <v-chip v-else>
                        Sin especificar
                    </v-chip>
                </template>


                <!--Stock-->
                <template v-slot:item.name="{item}">

                    <span class="text-start">{{ item.props.title.name }} </span>
                    <small class="text-medium-emphasis text-end text-small" v-show="item.props.title.sku">
                        ( Código/SKU:  {{ item.props.title.sku }} )
                    </small>
                    <v-divider></v-divider>
                    <v-chip size="x-small" color="deep-purple-lighten-1" v-show="item.props.title.isStockeable">
                        Stock Disponible: {{item.props.title.stock}}
                    </v-chip>

                </template>


                <!--Availability-->
                <template v-slot:item.availability_id="{item}">
                    {{ item.props.title.availability.name }}
                </template>


                <!--Features-->
                <template v-slot:item.features="{item}">
                    <pre>
                        {{ item.props.title.features.length }}
                    </pre>
                </template>


                <!--Galleries-->
                <template v-slot:item.galleries="{item}">
                    <pre>
                        {{ item.props.title.galleries.length }}
                    </pre>
                </template>


                <!--Links-->
                <template v-slot:item.links="{item}">
                    <pre>
                        {{ item.props.title.links.length }}
                    </pre>
                </template>


                <!--Actions-->
                <template v-slot:item.actions="{item}">
                    <v-btn
                        flat
                        icon="mdi-pencil"
                        size="x-small"
                        :href="'/op/products/'+item.props.title.id"
                    >
                    </v-btn>

                    <v-btn
                        flat
                        icon="mdi-delete"
                        size="x-small"
                        @click="__delete_item(item.props.title)"
                    >
                    </v-btn>

                </template>


                <!--Expanded-->
                <template v-slot:expanded-row="{ columns, item }">
                    <tr>
                        <td :colspan="columns.length">
                            {{item.props.title.links}}
                            <ListVariables
                            @links="item.props.title.links"
                            ></ListVariables>
                        </td>

                    </tr>
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
    name: "list-products",


    props: {
        resources: {},
        sections: {},
        types: {},
        catalog_type_id: null,
        catalog_id: null,
        b2b_id: null,
        isFilterable: false
    },

    components: {
        WizardProduct,
        ListVariables
    },

    data(){
        return {
            search_b2b_products: false,
            dialog: false,
            products: [],

            filter: 2,
            filters: [
                {
                    filter: 1,
                    label: "Productos de la empresa",
                } ,
                {
                    filter: 2,
                    label: "Productos de catálogo",
                } ,
            ],

            search: "",
            itemsPerPage: 15,
            headers: [
                { title: '#', sortable: false, align: 'start', key: 'id' },
                { title: 'Fotografía', sortable: false, align: 'start', key: 'img' },
                { title: 'Publicado', align: 'start', key: 'publish' },
                {
                    title: 'Nombre',
                    align: 'start',
                    sortable: true,
                    key: 'name',
                },
                { title: 'Precio', align: '', key: 'price' },

                // { title: 'Rasgos', align: 'end', key: 'features' },
                // { title: 'Galerias', align: 'end', key: 'galleries' },
                // { title: 'Links', align: 'end', key: 'links' },
                { title: '--', align: 'end', width:"250", key: 'actions' },
            ],

        }
    },

    mounted() {
        this.__fetch_products();
    },

    methods: {

        __notify: function(msg){

            this.Toast(msg);
        },

        __fetch_products : function (){

            if(this.filter === 1)
            {
                axios.get("/op/b2b-products/"+this.b2b_id)
                    .then((result) => {
                        this.step = 10;

                        this.products = result.data.data;
                    })
            }else{
                axios.get("/op/catalog-products/"+this.b2b_id+"/"+this.catalog_id)
                    .then((result) => {
                        this.step = 10;
                        this.products = result.data.data;
                    })
            }
        },

        __update_publish: function __update_publish(item) {
            var self = this;
            axios.post("/op/product-publisher/" + item.id, item).then(function (result) {
                self.Toast("Registro modificado");
            });
        },

        __delete_item(item){

            var self=this;
            this.confirm('Eliminar registro', 'Esta es una acción que no puede revertirse, ' +
                'se perderán todos los cambios realizados en el registro').then(function (result){

                if(result.isConfirmed){
                    axios.delete("/op/products/"+item.id).then(function (result)
                    {
                        self.__fetch_items();
                        self.Toast("Registro modificado")
                    })
                } else {
                    self.Toast("El registro no ha sido modificado")
                }


            })
        },
    }
}
</script>
