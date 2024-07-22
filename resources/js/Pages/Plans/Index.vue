<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ListPlans from '@/Pages/Plans/Partials/ListPlans.vue'

defineProps({
})
</script>

<template>
    <AuthenticatedLayout title="Profile">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Subscribete ahora!
            </h2>
            <span>No pierdas esta oportunidad de hacer crecer tu negocio</span>
        </template>

        <div class="space-y-6">

            <ListPlans></ListPlans>

        </div>
    </AuthenticatedLayout>
</template>
