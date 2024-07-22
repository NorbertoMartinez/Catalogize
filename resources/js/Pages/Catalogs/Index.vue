<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ListCatalogs from '@/Pages/Catalogs/Partials/ListCatalogs.vue'

defineProps({
    catalogs: Object,
    b2bs: Object,
})
</script>

<template>
    <AuthenticatedLayout title="Lista Catalogo">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2
                    class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
                >
                    Catálogos
                </h2>

                <hr>

                <v-alert
                    density="compact"
                    border="start"
                    border-color="deep-purple accent-4"
                    elevation="2"
                >
                    Todos tus catálogos tienen una sorpresa el primer mes de tu contrato

                    Tus visitantes podran encontrarlo no solamente en QR
                </v-alert>
            </div>

        </template>

        <div class="space-y-6">


            <ListCatalogs
                :b2bs="b2bs"

            ></ListCatalogs>

        </div>
    </AuthenticatedLayout>
</template>
