<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import FormCatalog from '@/Pages/Catalogs/Partials/FormCatalog.vue'

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
})
</script>

<template>
    <AuthenticatedLayout title="Profile">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Crear nuevo catálogo
            </h2>
        </template>

        <div class="space-y-6">

            <FormCatalog></FormCatalog>

        </div>
    </AuthenticatedLayout>
</template>
