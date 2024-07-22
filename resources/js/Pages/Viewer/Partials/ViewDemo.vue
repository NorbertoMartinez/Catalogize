<template>
    <v-container fluid class="fill-height d-flex">


        <v-row>

            <v-parallax
                max-height="400"
                :src="resource.background"
            >
                <div class="bgde kaushan d-flex flex-column fill-height justify-center align-center text-white">
                <span class="text-h4 mb-4 text-white kaushan">
                    {{ resource.name.toUpperCase() }}
                </span>
                    <h4 class="subheading text-white">
                        {{ resource.subtitle }}
                    </h4>
                </div>
            </v-parallax>

            <v-col md="12" sm="12" xs="12" lg="12">
                <v-window
                    show-arrows="hover"
                >
                    <v-window-item

                    >
                        <v-card
                            elevation="0"
                            height="200"
                            class="d-flex align-center justify-center ma-2"
                        >
                    <span

                    >
                        {{ resource.description }}
                    </span>
                        </v-card>
                    </v-window-item>
                </v-window>
            </v-col>

            <!--        </v-row>-->



            <!--            <pre>-->
            <!--                {{resource.sections}}-->
            <!--            </pre>-->
            <v-row >

                <v-col cols="12" v-for="rsection in resource.sections">
                    <v-card flat>
                        <v-parallax
                            height="300"
                            :src="rsection.section.background"
                        >
                            <div class="bgde kaushan d-flex flex-column fill-height justify-center align-center text-white">
                                <span class="text-h2 mb-4 text-white kaushan">
                                    {{rsection.section.title}}
                                </span>
                                <h4 class="subheading text-white">
                                    {{rsection.section.description}}
                                </h4>
                            </div>
                        </v-parallax>

<!--                        <v-row>-->
<!--                            <v-col xs="12" sm="12" md="12" lg="12" xl="12" xxl="12" >-->

                                <v-row dense>
                                    <v-col cols="3"
                                           v-for="item in rsection.section.products"
                                           :key="item.product.id">

                                        <product-view :item="item.product"></product-view>

                                    </v-col>
                                    <v-col cols="3"
                                           v-for="item in rsection.section.products"
                                           :key="item.product.id">

                                        <product-view :item="item.product"></product-view>

                                    </v-col>
                                    <v-col cols="3"
                                           v-for="item in rsection.section.products"
                                           :key="item.product.id">

                                        <product-view :item="item.product"></product-view>

                                    </v-col>
                                    <v-col cols="3"
                                           v-for="item in rsection.section.products"
                                           :key="item.product.id">

                                        <product-view :item="item.product"></product-view>

                                    </v-col>

                                </v-row>
<!--                            </v-col>-->
<!--                        </v-row>-->
                    </v-card>
                </v-col>





            </v-row>



        </v-row>

    </v-container>
</template>

<script>

import Features from "@/Pages/Viewer/Partials/Features";
import productView from "./ViewProductAlt.vue";


export default {

    name: "viewer",

    components: {
        Features,

        productView
    },

    props: {
        resource: {},
        section_selected: null,
        status: null,

        metadata: {
            visitor: {},
            hotzone: {},
        },

        show_gallery: 0,
        show_feature: 0,
    },

    methods: {

        __metadata(){

        }

    }

}

</script>

<style>

.kaushan{
    font-family: 'Kaushan Script', cursive !important;
}

.bgde{
    background-image: url("/bg-dark-60.png") !important;
    background-repeat: repeat;
}
</style>
