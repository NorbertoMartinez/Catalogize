<template>

    <v-card v-if="data.length>0">
        <v-tabs
            v-model="tab"
            bg-color="primary"
            show-arrows
            center-active
        >
            <v-tab
                v-for="tab_item in data"

                :key="tab_item.id"
                :value="tab_item.id"
            >
                {{tab_item.name}}
            </v-tab>
        </v-tabs>

        <v-card-text>
            <v-window v-model="tab">


                <v-window-item
                    v-for="gallery in data"
                    :key="gallery.id"
                    :value="gallery.id">

                    <v-carousel
                        cycle
                        height="400"
                        hide-delimiter-background
                        show-arrows="hover"
                    >
                        <v-carousel-item
                            v-for="item in gallery.items"
                            :key="item.id"
                        >
                            <v-sheet
                                height="100%"
                            >
                                <v-img
                                    cover
                                    :src="item.resource"
                                >

                                </v-img>
                            </v-sheet>
                        </v-carousel-item>

                    </v-carousel>
                </v-window-item>
            </v-window>
        </v-card-text>





    </v-card>


</template>


<script>
export default {
    name: "view-galleries",

    props: {
        data: {},
    },

    data(){
        return {


            tab: null,
        }
    }



}
</script>
