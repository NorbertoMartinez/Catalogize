<template>

    <v-card>
        <v-toolbar
            color="deep-purple-lighten-1">
            <v-toolbar-title>Aquí comienza una nueva historia....</v-toolbar-title>
        </v-toolbar>

        <v-card-text>



            <ShortCuts></ShortCuts>

            <v-row>
                <v-col cols="8">
                    <v-card flat>


                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items="desserts"
                            class="elevation-0"
                            density="compact"
                        >
                            <template v-slot:top>
                                <v-toolbar flat dark density="compact">
                                    <v-toolbar-title>
                                        Rendimiento <v-chip density="compact">Ult. mes</v-chip>
                                    </v-toolbar-title>
                                </v-toolbar>
                            </template>

                            <template v-slot:item.actions="{item}">

                                <v-btn
                                    flat
                                    icon="mdi-pencil"
                                    size="x-small"
                                >
                                </v-btn>

                                <v-btn
                                    flat
                                    icon="mdi-delete"
                                    size="x-small"
                                >
                                </v-btn>
                            </template>


                        </v-data-table>
                    </v-card>
                </v-col>

                <v-col cols="4">

                    <v-row>
                        <v-col>
                            <Chart></Chart>
                        </v-col>
                        <v-col>
                            <Chart></Chart>
                        </v-col>
                    </v-row>

                </v-col>
            </v-row>
        </v-card-text>

    </v-card>

</template>

<script>
import Banner from "@/Pages/Components/Banner";
import Chart from "@/Pages/Catalogs/Partials/Chart";
import ShortCuts from "./ShortCuts.vue";
export default {
    name: "index-dashboard",

    components: {
        Chart,
        Banner,
        ShortCuts,
    },

    data() {
        return {
            headers: [
                {
                    title: 'Catálogo',
                    align: 'start',
                    sortable: false,
                    key: 'name',
                },
                { title: 'Tipo', align: 'start', key: 'type' },
                { title: 'Vistas', align: 'start', key: 'views' },
                { title: 'Secciones', align: 'start', key: 'sections' },
                { title: 'Productos', align: 'start', key: 'products' },
                { title: 'Escaneos', align: 'start', key: 'scanned' },
                { title: 'Reproducciones', align: 'start', key: 'plays' },
                { title: '--', align: 'end', key: 'actions' },
            ],
            desserts: [
                {
                    name: 'Menú de Desayunos',
                    type: 'Alimentos',
                    views: 33,
                    sections: 12,
                    products: 129,
                    scanned: 3233,
                    plays: 989,
                },
                {
                    name: 'Menú de Comidas',
                    type: 'Alimentos',
                    views: 33,
                    sections: 325,
                    products: 121,
                    scanned: 54126,
                    plays: 9871,
                },
                {
                    name: 'Menú de Bebidas (Diciembre)',
                    type: 'Alimentos',
                    views: 33,
                    sections: 325,
                    products: 121,
                    scanned: 54126,
                    plays: 9871,
                },
                {
                    name: 'Servicios Estetica',
                    type: 'Servicios',
                    views: 33,
                    sections: 325,
                    products: 121,
                    scanned: 54126,
                    plays: 9871,
                },
                {
                    name: 'Catálogo Cuatrimotos 2023',
                    type: 'Productos',
                    views: 33,
                    sections: 325,
                    products: 121,
                    scanned: 54126,
                    plays: 9871,
                },

            ],
        }
    }
}
</script>
