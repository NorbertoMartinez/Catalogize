<template>

    <v-card v-if="data.length>0" flat>

        <v-card-text>
            <v-row>
                <v-col v-for="link in data">
                    <v-btn
                        size="x-small"
                        icon="mdi-facebook"
                        class="rounded-circle d-inline-block pa-3"
                        :href="link.value" target="_blank">
                    </v-btn>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>


</template>


<script>
export default {
    name: "view-features",

    props: {
        data: {},
    }



}
</script>
