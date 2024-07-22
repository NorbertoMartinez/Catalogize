<template>
    <v-row>
        <v-col cols="2">
            <v-sheet rounded="lg">
                <v-list rounded="lg">
                    <v-list-item
                        v-for="n in options"
                        :key="n"
                        link
                    >
                        <v-list-item-title @click="showed=n.id">
                            {{ n.name }}
                        </v-list-item-title>
                    </v-list-item>

                    <v-divider class="my-2"></v-divider>

                </v-list>
            </v-sheet>
        </v-col>

        <v-col>
            <v-sheet
                min-height="70vh"
                rounded="lg"
            >
                <v-card

                    v-for="n in options"
                    v-show="showed == n.id">
                    {{n.name}}
                </v-card>
            </v-sheet>
        </v-col>
    </v-row>
</template>
<script >

import ConfigIntegration from "../../Integrations/Partials/ConfigIntegration.vue";

export default {
    name: "configuration",

    components:{
        ConfigIntegration,
    },
    data(){
        return {

            showed: 1,
            options: [
                { id: 1,name: "API Integrations", },
                { id: 2,name: "Notificaciones", },
                { id: 3,name: "Sistema", },
                { id: 4,name: "Seguridad", },
            ]
        }
    },

    methods: {


    }
}
</script>
