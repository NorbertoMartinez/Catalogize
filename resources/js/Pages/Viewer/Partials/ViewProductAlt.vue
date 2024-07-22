<template>
    <v-card
        :loading="loading"
        class="mx-auto my-12"
        max-width="374"
    >
        <template v-slot:loader="{ isActive }">
            <v-progress-linear
                :active="isActive"
                color="deep-purple"
                height="4"
                indeterminate
            ></v-progress-linear>
        </template>

        <v-img
            cover
            height="250"
            :src="item.img"
        ></v-img>

        <v-card-item>
            <v-card-title>{{ item.name }}</v-card-title>

            <v-card-subtitle>
                <v-chip size="x-small">{{ item.type.name }}</v-chip>

                <v-icon
                    color="error"
                    icon="mdi-fire-circle"
                    size="small"
                ></v-icon>
            </v-card-subtitle>
        </v-card-item>

        <v-card-text>
            <v-row
                align="center"
                class="mx-0"
            >
                <v-rating
                    :model-value="4.5"
                    color="amber"
                    density="compact"
                    half-increments
                    readonly
                    size="small"
                ></v-rating>

                <div class="text-grey ms-4">
                    4.5 (413)
                </div>
            </v-row>

            <div class="my-4 text-subtitle-1">
                $ {{ item.price }} MXN •                 <v-chip color="success" size="x-small">{{item.availability.name}}</v-chip>
            </div>

            <div>{{ item.description }}</div>
<!--            <div>Small plates, salads & sandwiches - an intimate setting with 12 indoor seats plus patio seating.</div>-->
        </v-card-text>

        <v-divider class="mx-4 mb-1"></v-divider>

        <v-card-title>Variantes</v-card-title>

        <div class="px-4">
            <v-chip-group v-model="selection">
                <v-chip>Grande</v-chip>

                <v-chip>Mediano</v-chip>

                <v-chip>Chico</v-chip>

                <v-chip>E. Grande</v-chip>
            </v-chip-group>
        </div>
        <div class="px-4">
            <Features
                :data="item.features"></Features>
        </div>

        <v-card-actions>
            <v-btn
                color="deep-purple-lighten-2"
                variant="text"
                @click="reserve"
            >
                Pedir a barra
            </v-btn>
        </v-card-actions>
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

            loading: false,
            selection: 1,
            controls:{
                show_gallery: false,
                show_features: false,
            }
        }
    }

}
</script>
