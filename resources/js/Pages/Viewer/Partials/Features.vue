<template>



            <v-list lines="one">
                <v-list-item
                    size="x-small"
                    v-for="item in data"
                    :key="item.title"
                    :title="item.feature.name"
                    :subtitle="item.value"
                ></v-list-item>
            </v-list>
<!--    <v-card>-->
<!--        -->
<!--        -->
<!--        <v-table density="compact">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th class="text-left">-->
<!--                    Tipo-->
<!--                </th>-->
<!--                <th class="text-left">-->
<!--                    Valor-->
<!--                </th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr-->
<!--                v-for="item in resources"-->
<!--                :key="item.id"-->
<!--            >-->
<!--                <td>{{ item.feature.name }}</td>-->
<!--                <td>{{ item.value }}</td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </v-table>-->
<!--    </v-card>-->


</template>


<script>
export default {
    name: "view-features",

    props: {
        data: {},
    }



}
</script>
