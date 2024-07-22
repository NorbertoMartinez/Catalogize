<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Configuration from '@/Pages/Configuration/Partials/Container.vue'

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
                    Configuración
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


            <Configuration

            ></Configuration>

        </div>
    </AuthenticatedLayout>
</template>
