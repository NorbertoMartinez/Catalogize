<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ListProducts from '@/Pages/Products/Partials/ListProducts.vue'

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
                List Products
            </h2>
        </template>

        <div class="space-y-6">

            <ListProducts></ListProducts>

        </div>
    </AuthenticatedLayout>
</template>
