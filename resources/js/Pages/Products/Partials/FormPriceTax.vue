<template>

    <v-card flat>




        <v-card-text>

            <v-text-field label="Nombre de galeria"></v-text-field>




            <!--            <v- label="Rasgo especificacion"></v->-->


        </v-card-text>

        <v-card-actions>

            <v-btn block>Guardar y crear nuevo</v-btn>
        </v-card-actions>
    </v-card>

</template>


<script>

export default {
    name: "form-feature",

    components: {
    },

    data(){
        return {

            record: {},
        }
    }
}
</script>
