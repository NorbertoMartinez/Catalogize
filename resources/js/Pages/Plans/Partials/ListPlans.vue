<template>
    <v-row>
        <v-col
            cols="12"
            sm="4"
        >

            <PlanDetail></PlanDetail>
        </v-col>

        <v-col
            cols="12"
            sm="4"
        >
            <PlanDetail></PlanDetail>

        </v-col>

        <v-col
            cols="12"
            sm="4"
        >
            <PlanDetail ></PlanDetail>

        </v-col>
    </v-row>
</template>
<script setup>
import PlanDetail from "./PlanDetail.vue";
</script>
