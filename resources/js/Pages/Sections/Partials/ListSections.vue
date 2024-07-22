<template>

    <v-card>


        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>Secciones registradas</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="__show_new">
                <v-icon>mdi-plus</v-icon>
            </v-btn>

            <!--Reload-->
            <v-btn icon @click="__fetch_items">
                <v-icon>mdi-reload</v-icon>
            </v-btn>
        </v-toolbar>

        <v-card-text>

            <!--Dialog Product Wizard-->
            <v-dialog v-model="dialogAttach" width="700">
                <ProductAssigner
                    :catalog_id="catalog.id"
                    :b2b_id="catalog.b2b_id"
                    :section_selected="section_selected"
                    @success="dialog=$event"
                    @update="$emit('update', true)"
                    @back="dialogAttach=false"
                ></ProductAssigner>
            </v-dialog>



            <!--Dialog Section-->
            <v-dialog v-model="dialog" width="700">
                <FormSection
                    :catalog_type_id="catalog.type.id"
                    :catalog_id="catalog.id"
                    :b2b_id="catalog.b2b_id"
                    :section="section"
                    :isUpdate="editor"
                    @fetch="__fetch_items"
                    @dialog="dialog=$event">

                </FormSection>
            </v-dialog>


            <v-dialog
                width="500"
                v-model="dialog_background"
                persistent
            >

                <ChangeBackground
                    @notify="__notify($event)"
                    @refresh="__fetch_items"
                    @dialog="dialog_background = $event"
                    :record="section_selected">

                </ChangeBackground>

            </v-dialog>




            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="records"
                class="elevation-0"
                density="compact"
                show-expand
                no-data-text="Sin datos registrados"
            >





                <!--Publish-->
                <template v-slot:item.background="{item}">


                    <v-avatar @click="__change_background(item.props.title.section)" size="x-large" v-show="item.props.title.section.background != null "
                              :image="item.props.title.section.background"
                    ></v-avatar>
                    <v-avatar @click="__change_background(item.props.title.section)" size="x-large" v-show="item.props.title.section.background == null "
                              image="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y"
                    ></v-avatar>


                </template>

                <!--Subtitle-->
                <template v-slot:item.subtitle="{item}">
                    {{ (item.props.title.section.subtitle)?item.props.title.section.subtitle:"Sin datos" }}
                </template>


                <!--From Catalog (Name)-->
                <template v-slot:item.catalog_name="{item}">
                    {{ (item.props.title.catalog.name)?item.props.title.catalog.name:"Sin datos" }}
                </template>


                <!--Products (Cant)-->
                <template v-slot:item.products="{item}">
                    {{ item.props.title.section.products.length }}
                </template>


                <!--Status -->
                <template v-slot:item.status="{item}">
                    {{ item.props.title.section.status.name }}
                </template>


                <!--Published-->
                <template v-slot:item.publish="{item}">
                    <v-switch color="deep-purple-lighten-1"
                              class="mt-5"
                              @update:modelValue="__update_publish(item.props.title.section)"
                              v-model="item.props.title.section.published"
                              density="compact">
                    </v-switch>
                </template>


                <!--Actions-->
                <template v-slot:item.actions="{item}">

                    <v-btn
                        flat
                        icon="mdi-camera"
                        size="x-small"
                        @click.prevent="__change_background(item.props.title.section)"
                    >
                    </v-btn>

                    <v-btn
                        flat
                        icon="mdi-pencil"
                        size="x-small"
                        @click.prevent="__show_edit(item.props.title.section)"
                    >
                    </v-btn>

                    <v-btn
                        flat
                        icon="mdi-delete"
                        size="x-small"
                        @click.prevent="__delete_item(item.props.title.section)"
                    >
                    </v-btn>

                    <v-btn
                        flat
                        icon="mdi-plus"
                        size="x-small"
                        @click.prevent="__select_section(item.props.title.section)"
                    >
                    </v-btn>
                </template>


                <!--Expanded-->
                <template v-slot:expanded-row="{ columns, item }">
                    <tr>
                        <td :colspan="columns.length">


                            <v-card flat>
                                <v-card-text>

                                    <v-row>
                                        <v-col cols="3">
                                            <span>
                                                QR de acceso a la sección
                                            </span>
                                            <v-img
                                                class="mb-4"
                                                contain
                                                height="128"
                                                src="/qr_demo.png"
                                            ></v-img>

                                            <v-btn block size="small" color="deep-purple-lighten-1" prepend-icon="mdi-download">Descargar</v-btn>
                                        </v-col>
                                        <v-col>

                                            <TableProducts
                                                :resources="item.props.title.section.products"></TableProducts>
                                        </v-col>
                                    </v-row>
                                </v-card-text>



                            </v-card>
                        </td>

                    </tr>
                </template>

            </v-data-table>



        </v-card-text>
    </v-card>
</template>

<script>

import FormSection from "@/Pages/Sections/Partials/FormSection";
import ChangeBackground from "@/Pages/Sections/Partials/ChangeBackground";
import TableProducts from "@/Pages/Products/Partials/TableProducts";
import ProductAssigner from "@/Pages/Sections/Partials/AddProduct";


export default {
    name: "list-sections",

    props: {
        catalog: {}
    },

    components: {
        ChangeBackground,
        TableProducts,
        ProductAssigner,
        FormSection
    },

    mounted(){
        this.__fetch_items();
    },

    data(){
        return {
            /* CRUD */
            section: {},
            editor: false,

            /* Dialogs*/
            dialog: false,
            dialogAttach: false,
            dialog_background: false,

            section_selected: null,


            /*Datatable*/

            records: [], // Items to iterate
            itemsPerPage: 15,
            headers: [
                { title: '#', sortable: false, align: 'start', width:"10", key: 'section.id' },
                { title: 'Fondo', align: 'start', width:"122", key: 'background' },
                { title: 'Publicado', align: 'start', width:"122", key: 'publish' },
                { title: 'Titulo', align: 'start', sortable: false, key: 'section.title',},
                { title: 'Subtitulo', align: 'start', key: 'subtitle' },
                { title: 'Catálogo', align: 'end', key: 'catalog_name' },
                { title: 'Productos', align: 'end', key: 'products' },
                { title: 'Estado', align: 'end', key: 'status' },
                { title: '--', align: 'end', key: 'actions' },
            ],
        }
    },

    methods: {

        __show_new: function(){
            this.editor = false;
            this.section = {};
            this.dialog = true
        },
        __show_edit: function(item){
            this.editor = true;
            this.section = item;
            this.dialog = true
        },

        __change_background: function(item){
            this.dialog_background = true;
            this.section_selected = item;

        },

        /**
         *
         * @param item
         * @private
         */
        __select_section(item){
            this.section_selected = item;
            this.dialogAttach=true;
        },

        /**
         *
         * @private
         */
        __fetch_items : function (){
            axios.get("/op/catalog-sections/"+this.catalog.id)
                .then((result) => {
                    this.records = result.data.data;
                })
        },

        /**
         *
         * @param item
         * @private
         */
        __update_publish: function (item){
            axios.post("/op/section-publisher/"+item.id, item).then(function (result){});
        },


        __delete_item(item){

            var self=this;
            this.confirm('Eliminar registro', 'Esta es una acción que no puede revertirse, se perderán todas las relaciones con los productos.').then(function (result){

                if(result.isConfirmed){
                    axios.delete("/op/sections/"+item.id).then(function (result)
                    {
                        self.__fetch_items();
                        self.Toast("Registro modificado")
                    })
                } else {
                    self.Toast("El registro no ha sido modificado")
                }


            })
        },

        __notify: function(result){

            if(result.status == "success"){

            } else {
                let msg = "";
                for(var data in result.data){
                    console.log(result.data[data][0])
                    msg += result.data[data][0] +"\n"
                }

                this.Toast(msg)
            }

        }

    }
}

</script>
