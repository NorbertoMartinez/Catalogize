<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import { GithubIcon } from '@/Components/Icons/brands'

import DashboardIndex from "@/Pages/Dashboard/Partials/Index";
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Dashboard
                </h2>
                <hr>
                <v-alert
                    density="compact"
                    border="start"
                    border-color="deep-purple accent-4"
                    elevation="2"
                >
                    Bienvenido a este sitio oficial para dar de alta tus catálogos <br>

                    Aqui encontraras todas las herramientas necesarias para llegar a tus clientes a otro nivel
                </v-alert>

            </div>
        </template>

        <DashboardIndex></DashboardIndex>

    </AuthenticatedLayout>
</template>
