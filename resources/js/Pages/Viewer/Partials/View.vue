<template>
    <v-row >
        <v-col cols="2" color="red-darken-4">
            <v-sheet rounded="lg" color="red-darken-4">
                <v-list rounded="lg" color="deep-purple-lighten-1">
                    <v-list-item
                        v-for="n in resource.sections"
                        :key="n"
                        link
                    >
                        <v-list-item-title>
                            <v-btn
                                variant="text"
                                color="deep-purple-lighten-1"
                                @click="section_selected = n.section.id">

                                {{n.section.title}}
                            </v-btn>
                        </v-list-item-title>
                    </v-list-item>

                    <v-divider class="my-2"></v-divider>

                    <v-list-item
                        link
                        color="grey-lighten-4"
                    >
                        <v-list-item-title>
                            Refresh
                        </v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-sheet>
        </v-col>

        <v-col cols="10">
            <v-sheet
                min-height=""
                rounded="lg"
                color="deep-purple-lighten-1"
            >

                <v-item-group mandatory>
                    <v-container>
                        <v-row>
                            <v-col
                                v-for="n in resource.sections"
                                :key="n.id"
                                cols="12"
                                md="4"
                            >

                                <v-item v-slot="{ isSelected, toggle }">
                                    <v-img
                                        :src="n.section.background"
                                        cover
                                        z-index="1"
                                        height="150"
                                        class="text-right pa-2"
                                        @click="section_selected = n.section.id"
                                    >
                                        <v-scroll-y-transition>
                                            <div
                                                class="bg-gray-100 text-gray-800 flex-grow-1 text-center mt-12"
                                            >
                                                {{ isSelected ? 'Selected' : n.section.title }}
                                            </div>
                                        </v-scroll-y-transition>
                                    </v-img>

<!--                                    <v-card-->
<!--                                        :color="isSelected ? 'primary' : ''"-->
<!--                                        class="d-flex align-center"-->
<!--                                        dark-->
<!--                                        height="200"-->
<!--                                        @click="section_selected = n.section.id"-->
<!--                                    >-->


<!--                                      -->
<!--                                        -->
<!--                                    </v-card>-->
                                </v-item>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-item-group>




                <v-card elevation="12" class="mt-12">
                    <v-row>
                        <v-col  cols="12">

                            <!--                        {{ n.section.products }}-->
                            <v-card flat
                                    v-for="n in resource.sections"
                                    v-show="section_selected == n.section.id">

                                <v-card-text>
                                    <v-card
                                        class="mt-6"
                                        color="deep-purple-lighten-1"
                                        elevation="12"
                                        v-for="item in n.section.products"
                                        :key="item.product.id">

                                        <v-card-text>
                                            <v-row>

                                                <v-col cols="1">

                                                    <v-img
                                                        cover
                                                        :src="'/op/storage/'+item.product.img">

                                                    </v-img>


                                                </v-col>
                                                <v-col cols="6">

                                                    {{ item.product.name }}
                                                    - <v-chip size="x-small">{{ item.product.type.name }}</v-chip>
                                                    <br>
                                                    <small>{{ item.product.description }}</small>
                                                    <hr>
                                                    <small
                                                        v-show="item.product.sku"
                                                        color="gray">SKU: {{ item.product.sku }}</small>
                                                    <br>
                                                    <small
                                                        v-show="item.product.stock"
                                                        color="gray">Disponibles: {{ item.product.stock }}</small>
                                                </v-col>
                                                <v-col>
                                                    <v-btn icon="mdi-plus" size="x-small"
                                                           v-show="show_feature!=item.product.id"
                                                           @click="show_feature=item.product.id"></v-btn>
                                                    <v-btn icon="mdi-minus" size="x-small"
                                                           v-show="show_feature==item.product.id"
                                                           @click="show_feature=0"></v-btn>

                                                    <v-btn icon="mdi-plus" size="x-small"
                                                           v-show="show_gallery!=item.product.id"
                                                           @click="show_gallery=item.product.id"></v-btn>
                                                    <v-btn icon="mdi-minus" size="x-small"
                                                           v-show="show_gallery==item.product.id"
                                                           @click="show_gallery=0"></v-btn>
                                                </v-col>
                                                <v-col cols="2" class="text-end">

                                                    <span class="text-h6"> $ {{ item.product.price }} MXN</span>

                                                    <v-spacer></v-spacer>
<!--                                                    <v-btn icon="mdi-plus" size="x-small"></v-btn>-->
<!--                                                    <v-btn icon="mdi-minus" size="x-small"></v-btn>-->
                                                </v-col>
                                                <v-col cols="6">
                                                    <Features v-show="show_feature==item.product.id" :resources="item.product.features"></Features>
                                                </v-col>

                                                <v-col cols="6" class="text-end">
                                                    <v-item-group >
                                                        <v-item v-for="link in item.product.links">
                                                            <v-btn
                                                                size="x-small"
                                                                icon="mdi-yin-yang"
                                                                class="rounded-circle d-inline-block pa-3"
                                                                :href="link.value" target="_blank">
                                                            </v-btn>
                                                            <!--                                                        {{ link.type.name }}-->
                                                            <!--                                                        {{ link.value }}-->
                                                        </v-item>
                                                    </v-item-group>
                                                </v-col>


                                                <v-col cols="12" v-show="show_gallery==item.product.id">
                                                    <v-carousel>
                                                        <v-carousel-item
                                                            src="/logo.png"
                                                            cover
                                                        ></v-carousel-item>

                                                        <v-carousel-item
                                                            src="/logo.png"
                                                            cover
                                                        ></v-carousel-item>

                                                        <v-carousel-item
                                                            src="/logo.png"
                                                            cover
                                                        ></v-carousel-item>

                                                        <v-carousel-item
                                                            src="/logo.png"
                                                            cover
                                                        ></v-carousel-item>
                                                    </v-carousel>
                                                </v-col>
                                            </v-row>
                                        </v-card-text>
                                    </v-card>
                                </v-card-text>


                            </v-card>
                        </v-col>
                    </v-row>
                </v-card>


                <!--  -->
            </v-sheet>
        </v-col>
    </v-row>

</template>

<script>

import Features from "@/Pages/Viewer/Partials/Features";
import Links from "@/Pages/Viewer/Partials/Links";
import Gallery from "@/Pages/Viewer/Partials/Gallery";
export default {

    name: "viewer",

    components: {
        Features,
        Gallery,
        Links
    },

    props: {
        resource: {},
        section_selected: null,
        status: null,

        visitor: {},

        metadata: {
            visitor: {},
            hotzone: {},
        },

        show_gallery: 0,
        show_feature: 0,
    },

    mounted() {
        this.__visit();
    },

    methods: {


        __visit: function (){
            var self = this;
            axios.post("/viewer/visitor", this.visitor).then(function(result){
                if(result.data.status == "success"){

                } else {
                    axios.post("/viewer/visitor", {error: "Error al conseguir información de visitante"});
                }
            });
        },

        __metadata(){



        }

    }

}

</script>
