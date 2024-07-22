<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ListSections from '@/Pages/Sections/Partials/ListSections.vue'

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
                Secciones
            </h2>
        </template>

        <div class="space-y-6">

            <ListSections></ListSections>

        </div>
    </AuthenticatedLayout>
</template>
