<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { DashboardIcon } from '@/Components/Icons/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'
import { TemplateIcon } from '@heroicons/vue/outline'
</script>

<template>
    <PerfectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >




        <SidebarLink
            title="Dashboard"
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <template #icon>
               <v-icon icon="mdi-view-dashboard"></v-icon>
            </template>
        </SidebarLink>







        <SidebarLink
            title="Subscribete"
            :href="route('plans')"
            :active="route().current('plans')"
        >
            <template #icon>
                <v-icon icon="mdi-check"></v-icon>
            </template>
        </SidebarLink>





        <SidebarCollapsible
            title="Mis Empresas"
            :href="route('b2bs.index')"
            :active="route().current('b2bs.index')"
        >
            <template #icon>
                <v-icon icon="mdi-account-group"></v-icon>
            </template>



            <SidebarCollapsibleItem
                title="Empresas"
                :href="route('b2bs.index')"
                :active="route().current('b2bs.index')"
            />


            <SidebarCollapsibleItem
                title="Monitor de visitas"
                :href="route('x.customers')"
                :active="route().current('x.customers')"
            />

<!--            <SidebarCollapsibleItem-->
<!--                title="Gestionar campañas"-->
<!--                :href="route('x.marketing')"-->
<!--                :active="route().current('x.marketing')"-->
<!--            />-->

<!--            <SidebarCollapsibleItem-->
<!--                title="Centro de mensajes"-->
<!--                :href="route('x.center')"-->
<!--                :active="route().current('x.center')"-->
<!--            />-->


        </SidebarCollapsible>




        <SidebarCollapsible
            title="Catálogos"
            :href="route('catalogs.index')"
            :active="route().current('catalogs.index')"
        >
            <template #icon>
                <v-icon icon="mdi-qrcode"></v-icon>
            </template>
            <SidebarCollapsibleItem
                title="Mis Catálogos"
                :href="route('catalogs.index')"
                :active="route().current('catalogs.index')"
            />


            <SidebarCollapsibleItem
                title="Productos"
                :href="route('products')"
                :active="route().current('products')"
            />
        </SidebarCollapsible>




        <SidebarCollapsible
            title="A.R."
            :href="route('brochures.index')"
            :active="route().current('brochures.*')"
        >

            <template #icon>
                <v-icon icon="mdi-palette"></v-icon>
            </template>



            <SidebarCollapsibleItem
                title="Folletos (AR)"
                :href="route('brochures.index')"
                :active="route().current('brochures.index')"
            />

        </SidebarCollapsible>




<!--        <SidebarCollapsible-->
<!--            title="Comandize"-->
<!--            :active="route().current('components.*')"-->
<!--        >-->
<!--            <template #icon>-->
<!--                <v-icon icon="mdi-view-list"></v-icon>-->
<!--            </template>-->
<!--            <SidebarCollapsibleItem-->
<!--                title="Administración"-->
<!--                :href="route('catalogs.index')"-->
<!--                :active="route().current('catalogs.index')"-->
<!--            />-->

<!--            <SidebarCollapsibleItem-->
<!--                title="Pedidos"-->
<!--                :href="route('sections')"-->
<!--                :active="route().current('sections')"-->
<!--            />-->

<!--            <SidebarCollapsibleItem-->
<!--                title="Mesas"-->
<!--                :href="route('products')"-->
<!--                :active="route().current('products')"-->
<!--            />-->

<!--            <SidebarCollapsibleItem-->
<!--                title="Mesa de trabajo"-->
<!--                :href="route('products')"-->
<!--                :active="route().current('products')"-->
<!--            />-->


<!--            <SidebarCollapsibleItem-->
<!--                title="Administración"-->
<!--                :href="route('catalogs.index')"-->
<!--                :active="route().current('catalogs.index')"-->
<!--            />-->

<!--        </SidebarCollapsible>-->




        <SidebarCollapsible
            title="Mi Subscripción"
            :active="route().current('components.*')"
        >
            <template #icon>
                <v-icon icon="mdi-account-credit-card"></v-icon>
            </template>

            <SidebarCollapsibleItem
                title="Portal de pagos"
                href="/billing-portal"
                target="_blank"

            />
<!--            <SidebarCollapsibleItem-->
<!--                title="Historial de pagos y órdenes"-->
<!--                :href="route('admin.orders')"-->
<!--                :active="route().current('admin.orders')"-->
<!--            />-->
        </SidebarCollapsible>

        <SidebarCollapsible
            title="Configuración"
            :active="route().current('config.*')"
        >
            <template #icon>
                <v-icon icon="mdi-cog"></v-icon>
            </template>


            <SidebarCollapsibleItem
                title="AMI (apikey)"
                :href="route('config.account')"
                :active="route().current('config.account')"
            />

            <SidebarCollapsibleItem
                title="Notificaciones"
                :href="route('config.account')"
                :active="route().current('config.account')"
            />

            <SidebarCollapsibleItem
                title="Sistema"
                :href="route('config.account')"
                :active="route().current('config.account')"
            />

            <SidebarCollapsibleItem
                title="Seguridad"
                :href="route('config.account')"
                :active="route().current('config.account')"
            />


        </SidebarCollapsible>





<!--        => Collapsible examples-->
<!--        <SidebarCollapsible title="Users" :active="$page.url.startsWith('/users')">-->
<!--            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="$page.url === '/users/index'" />-->
<!--            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="$page.url === '/users/create'" />-->
<!--        </SidebarCollapsible>-->

<!--        <SidebarCollapsible title="Users" :active="usePage().url.value.startsWith('/users')">-->
<!--            <template #icon>-->
<!--                <UserIcon-->
<!--                    class="flex-shrink-0 w-6 h-6"-->
<!--                    aria-hidden="true"-->
<!--                />-->
<!--            </template>-->

<!--            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="route().current('users.index')" />-->
<!--            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="route().current('users.create')" />-->
<!--        </SidebarCollapsible>-->
    </PerfectScrollbar>
</template>
