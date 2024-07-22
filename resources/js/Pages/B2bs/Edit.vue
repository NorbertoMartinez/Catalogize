<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import FormB2b from '@/Pages/B2bs/Partials/FormB2b.vue'

defineProps({
    item: Object,
})
</script>

<template>
    <AuthenticatedLayout title="Profile">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                <v-btn variant="text" density="compact" href="/x/b2bs">
                    <v-icon size="small">mdi-arrow-left</v-icon>
                </v-btn>

                Edición de empresa
            </h2>
        </template>

        <div class="space-y-6">


            <FormB2b :resource="item" isUpdate="true"></FormB2b>

        </div>
    </AuthenticatedLayout>
</template>
