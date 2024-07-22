<template>
    <v-banner
        v-show="text"
        lines="two"
        icon="mdi-weather-hurricane"
        color="error"
        class="my-4"
    >
        <v-banner-text>
            {{ text }}
        </v-banner-text>

        <template v-slot:actions>
            <v-btn>Action</v-btn>
        </template>
    </v-banner>
</template>

<script>
export default {
    name: "banner",

    props: ["text"]
}
</script>

