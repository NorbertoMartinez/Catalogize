<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import FormProduct from '@/Pages/Products/Partials/FormProduct.vue'

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
                Nuevo Producto
            </h2>
        </template>

        <div class="space-y-6">

            <FormProduct></FormProduct>

        </div>
    </AuthenticatedLayout>
</template>
