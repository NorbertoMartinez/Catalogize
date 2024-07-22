<script setup>
defineProps({
    products: Object,
    resource: Object,
})
</script>
<template>


    <v-card>

        <v-img
            height="250"
            :src="resource.background"
            cover
            class="text-white"
        >
            <v-toolbar density="compact" color="deep-purple-lighten-1">

                <v-btn variant="text" size="x-small" href="/op/catalogs" >
                    <small>{{"<"}} Regresar a lista de catálogos</small>
                </v-btn>
                <template v-slot:extension>
                    <v-tabs
                        v-model="tab"
                        align-tabs="title"
                    >
                        <v-tab
                            v-for="item in items"
                            :key="item"
                            :value="item"
                        >
                            {{ item }}
                        </v-tab>
                    </v-tabs>
                </template>
            </v-toolbar>

            <v-card-title>

                <v-tooltip
                    text="Cambiar fondo"
                    location="right"
                >
                    <template v-slot:activator="{ props }">
                        <v-btn
                            icon
                            variant="text"
                            @click="dialog = !dialog"
                            v-bind="props">

                            <v-icon color="grey-lighten-1">
                                mdi-camera
                            </v-icon>

                        </v-btn>
                    </template>
                </v-tooltip>

                <v-divider></v-divider>

                <v-tooltip
                    text="Vista Previa"
                    location="right"
                >
                    <template v-slot:activator="{ props }">
                        <v-btn
                            icon
                            variant="text"
                            :href="resource.url"
                            target="_blank"
                            v-bind="props">

                            <v-icon color="grey-lighten-1">
                                mdi-eye
                            </v-icon>

                        </v-btn>
                    </template>
                </v-tooltip>

            </v-card-title>
        </v-img>

        <v-dialog
            width="500"
            v-model="dialog"
            persistent
        >

            <ChangeBackground
                @notify="__notify($event)"
                @refresh="__refresh"
                @dialog="dialog = $event"
                :record="resource">

            </ChangeBackground>

        </v-dialog>

        <v-window v-model="tab">
            <v-window-item
                v-for="item in items"
                :key="item"
                :value="item"
            >

                <!--Form Update Catalog-->
                <FormCatalog
                    @tab="tab = $event"
                    v-show="item==='Catálogo'"
                    :record="resource"></FormCatalog>

                <!--List Products -->
                <ListProducts
                    isFilterable="true"
                    :catalog_id="resource.id"
                    :catalog_type_id="resource.type.id"
                    :b2b_id="resource.b2b_id"
                    :types="resource.type.products"
                    v-show="item==='Productos'"></ListProducts>

                <!--List Catalog Sections -->
                <ListSections
                    :catalog="resource"
                    v-show="item==='Secciones'"></ListSections>

            </v-window-item>
        </v-window>

    </v-card>

</template>


<script>


import ListProducts from "@/Pages/Products/Partials/ListProducts";
import FormCatalog from "@/Pages/Catalogs/Partials/FormCatalog";
import ChangeBackground from "@/Pages/Catalogs/Partials/ChangeBackground";
import ListSections from "@/Pages/Sections/Partials/ListSections";

export default {
    name: "detail-catalog",

    components: {
        ChangeBackground,
        ListSections,
        ListProducts,
        FormCatalog,
    },

    data(){
        return {
            dialog: false,
            tab: null,
            items: [
                'Catálogo', 'Secciones', 'Productos'
            ],
        }
    },
    methods:{

        __refresh: function(){
            window.location.reload();
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
<style>


.v-select--selected .v-field .v-field__input {
    backface-visibility: unset !important;
}
</style>
