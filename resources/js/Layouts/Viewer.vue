<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import Sidebar from '@/Components/Sidebar/Sidebar.vue'
import Navbar from '@/Components/Navbar.vue'
import PageFooter from '@/Components/PageFooter.vue'
import { sidebarState } from '@/Composables'

defineProps({
    title: String
})
</script>

<template>
    <Head :title="title">


    </Head>

    <slot />


    <PageFooter />

</template>
