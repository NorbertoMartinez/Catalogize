<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ListB2bs from '@/Pages/B2bs/Partials/ListB2bs.vue'

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
                Empresas registradas
            </h2>
        </template>

        <div class="space-y-6">

            <ListB2bs :records="b2bs"></ListB2bs>

        </div>
    </AuthenticatedLayout>
</template>
