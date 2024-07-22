<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import FormSection from '@/Pages/Sections/Partials/FormSection.vue'

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
                Crear sección
            </h2>
        </template>

        <div class="space-y-6">

            <FormSection></FormSection>

        </div>
    </AuthenticatedLayout>
</template>
