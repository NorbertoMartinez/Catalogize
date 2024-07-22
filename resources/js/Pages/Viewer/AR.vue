<script setup>
import ViewerLayout from '@/Layouts/Viewer.vue'
import ArRender from "@/Pages/Viewer/Partials/ARScene";

defineProps({
    builder: Array
})
</script>

<template>
    <ViewerLayout title="Visor AR">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Visor AR
            </h2>
        </template>

        <div class="">


            <ArRender

            ></ArRender>


        </div>
    </ViewerLayout>
</template>
