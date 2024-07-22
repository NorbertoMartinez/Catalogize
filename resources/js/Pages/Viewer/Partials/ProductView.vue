<template>
    <v-card flat>

        <v-card-text>
            <v-card
                class="mt-0"
                elevation="10">

                <v-card-text>



<!--                    <pre>status {{item.status.name}}</pre>-->
<!--                    <pre>availability {{item.availability.name}}</pre>-->
<!--                    <pre>unit {{item.unit.name}}</pre>-->
<!--                    <pre>type {{item.type.name}}</pre>-->
<!--                    <pre>features {{item.features.length}}</pre>-->
<!--                    <pre>galleries {{item.galleries.length}}</pre>-->
<!--                    <pre>links {{item.links.length}}</pre>-->
<!--                    <pre>{{item}}</pre>-->
                    <v-row>


                        <v-col  xs="12" sm="12" md="12" lg="2" xl="2" xxl="2">

                            <v-img :src="item.img">

                            </v-img>

                            <v-btn size="x-small"
                                   v-if="item.galleries.length > 0"
                                   color="primary"
                                   variant="plain"
                                   @click="controls.show_gallery = !controls.show_gallery"
                            >
                                Galeria/s
                            </v-btn>

                            <v-btn size="x-small"
                                   v-if="item.features.length > 0"
                                   color="primary"
                                   variant="plain"
                                   @click="controls.show_features = !controls.show_features"
                            >
                                + Detalles
                            </v-btn>


<!--                            <v-chip color="info" size="x-small">Galerias: {{item.galleries.length}}</v-chip>-->
<!--                            <v-chip color="info" size="x-small">Caracteristicas: {{item.features.length}}</v-chip>-->

                        </v-col>
                        <v-col  xs="12" sm="12" md="12" lg="7" xl="7" xxl="7">
                            <span class="text-h6">
                                {{ item.name }}
                            </span>
                            <br>

                            <v-chip size="x-small">{{ item.type.name }}</v-chip>
                            <v-chip color="success" size="x-small">{{item.availability.name}}</v-chip>
                            <br>
                            <hr>

                            <small>{{ item.description }}</small>

                            <small
                                v-show="item.sku"
                                color="gray">SKU: {{ item.sku }}</small>
                            <br>
                            <small
                                v-show="item.stock"
                                color="gray">Disponibles: {{ item.stock }}</small>


                        </v-col>


                        <v-col xs="6" sm="6" md="6" lg="2" xl="3" xxl="3" class="text-end">


                            <v-row flat>
                                <v-col cols="12">
                                    <span class="text-h6" v-if="item.price" >
                                        $ {{ item.price }} MXN
                                    </span>
                                    <span class="text-caption" v-else >
                                        Sin precio
                                    </span>
                                </v-col>

                                <v-col>
                                </v-col>
                            </v-row>



                        </v-col>
                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" xxl="12"
                               v-if="item.features.length > 0">
                            <Features
                                v-show="controls.show_features"
                                :data="item.features"></Features>
                        </v-col>

                        <v-col xs="12" sm="12" md="12" lg="12" xl="12" xxl="12"
                               v-if="item.galleries.length > 0">
                            <Gallery
                                v-show="controls.show_gallery"
                                :data="item.galleries"></Gallery>
                        </v-col>

                    </v-row>
                </v-card-text>

                <v-card-actions>
                    <span>Enlaces: </span>
                    <v-spacer></v-spacer>
                    <Links :data="item.links"></Links>
                </v-card-actions>
            </v-card>
        </v-card-text>


    </v-card>
</template>


<script>

import Links from "@/Pages/Viewer/Partials/Links";
import Gallery from "@/Pages/Viewer/Partials/Gallery";
import Features from "@/Pages/Viewer/Partials/Features";
export default {

    props: {
        item: {}
    },

    components: {
        Links,
        Features,
        Gallery
    },

    data(){
        return {

            controls:{
                show_gallery: false,
                show_features: false,
            }
        }
    }

}
</script>
