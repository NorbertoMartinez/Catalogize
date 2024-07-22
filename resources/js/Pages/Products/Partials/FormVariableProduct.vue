<template>

    <v-card flat>
        <v-toolbar>
            <v-toolbar-title>
                Nueva variable
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn class="success">
                <v-icon>mdi-content-save</v-icon>
                Guardar
            </v-btn>
        </v-toolbar>

        <v-card-text>

            <v-text-field label="Fotografia"></v-text-field>
            <v-text-field label="Nombre"></v-text-field>
            <v-text-field label="Descripción"></v-text-field>
            <v-text-field label="Precio"></v-text-field>
            <v-text-field label="Disponibilidad"></v-text-field>

            <v-combobox
                label="Tipo"
                v-model="record.availability"
                :items="['Plato', 'Bebida', 'Pieza', 'Otro']"
            ></v-combobox>
        </v-card-text>

        <v-card-actions>

            <v-spacer></v-spacer>
            <v-btn>Guardar</v-btn>
        </v-card-actions>
    </v-card>

</template>

<script>

export default {
    name: "form-product-variable",

    data(){
        return {
            record: {},
        }
    }
}
</script>
