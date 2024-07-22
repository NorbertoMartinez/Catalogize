<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import DetailCatalog from '@/Pages/Catalogs/Partials/DetailCatalog.vue'

defineProps({
    catalog: Object,
    products: Object,
    b2bs: Array,
})
</script>


<template>
    <AuthenticatedLayout title="Detalle catalogo">
        <template #header>
            <h2
                class="font-semibold text-xl leading-tight"
                color="deep-purple-lighten-1"
            >
                {{ catalog.name.toUpperCase() }}
                <v-chip color="deep-purple-lighten-1">{{ catalog.type.name }}</v-chip>
            </h2>


        </template>

        <div class="space-y-6">

            <DetailCatalog
            :resource="catalog"
            :products="products"
            ></DetailCatalog>

        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    mounted(){
        // Echo.private(`catalog.${this.catalog.id}`)
        //     .listen('CatalogCreated', (e) => {
        //         alert(e.order);
        //     });
    }
}
</script>
