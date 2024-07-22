<template>

    <v-card flat>
        <v-card-title>
            <v-toolbar flat dark density="compact">
                <v-toolbar-title>Gráfica Default</v-toolbar-title>
            </v-toolbar>
        </v-card-title>
        <v-card-text>
            <apexchart width="100%" type="line" :options="options" :series="series"></apexchart>
        </v-card-text>
    </v-card>
</template>

<script>

export default {
    name: "chart-catalog-default",

    data(){
        return {

            options: {
                chart: {
                    id: 'vuechart-example'
                },
                xaxis: {
                    categories: [1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            series: [{
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            }],
        }
    }
}
</script>
