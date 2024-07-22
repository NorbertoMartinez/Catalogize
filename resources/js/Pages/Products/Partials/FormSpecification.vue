<template>

    <v-card elevation="2">




        <v-card-text>

            <v-text-field
                v-model="record.specification.name"
                label="Nombre"></v-text-field>

            <v-textarea
                label="Nombre"></v-textarea>



        </v-card-text>

        <v-card-actions>

            <v-btn block>Guardar y crear nuevo</v-btn>
        </v-card-actions>
    </v-card>

</template>


<script>

export default {
    name: "form-specification",

    props: {
        product: {}
    },
    components: {
    },

    data(){
        return {
            record:{
                specification: {}
            }

        }
    },



    methods: {
        __fetch_specification_types: function(){},
        __store_specification: function(){},
    }

}
</script>
