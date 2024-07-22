<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ListMessages from '@/Pages/MessageCenter/Partials/ListMessages.vue'

defineProps({

})
</script>

<template>
    <AuthenticatedLayout title="Lista Catalogo">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    Centro de mensajes
                </h2>

            </div>

        </template>

        <div class="space-y-6">
            <ListMessages></ListMessages>

        </div>
    </AuthenticatedLayout>
</template>
