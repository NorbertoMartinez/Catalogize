<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import HomeAR from '@/Pages/Brochures/Partials/Home.vue'

defineProps({
    b2bs: Array,
})
</script>

<template>
    <AuthenticatedLayout title="Profile">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Administración AR
            </h2>
        </template>

        <div class="space-y-6">

            <HomeAR :records="b2bs"></HomeAR>

        </div>
    </AuthenticatedLayout>
</template>
