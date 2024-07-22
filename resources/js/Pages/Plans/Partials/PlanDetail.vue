<template>

    <v-sheet
        rounded="lg"

        class="pa-6 mx-auto"
        min-height="268"
    >
        <h4 class="text-h5 mb-4">Plan Básico</h4>

        <p class="mb-8">
            Obtiene todos los beneficios mensualmente

            <br>
            <br>

            Please read our <a href="#" class="text-red-accent-2">Privacy Policy</a> to learn about our privacy practices or click "Your Preferences" to exercise control over your data.
        </p>


        <v-list lines="three">
            <v-list-subheader>Carácteristicas</v-list-subheader>

            <v-list-item>
                <v-list-item-title>
                    <v-row>
                        <v-col cols="2">
                            <span class="text-h4">20</span>
                        </v-col>
                        <v-col class="text-h6">Empresas</v-col>
                        <v-col cols="2" >
                            <v-icon color="success">mdi-check</v-icon>
                        </v-col>
                    </v-row>
                </v-list-item-title>

                <v-list-item-subtitle>
                    Da de alta ## Empresas en tu cuenta sin restricciones
                </v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
                <v-list-item-title>
                    <v-row>
                        <v-col cols="2">
                            <span class="text-h4">20</span>
                        </v-col>
                        <v-col class="text-h6">Empresas</v-col>
                        <v-col cols="2" >
                            <v-icon color="success">mdi-check</v-icon>
                        </v-col>
                    </v-row>
                </v-list-item-title>

                <v-list-item-subtitle>
                    Da de alta ## Empresas en tu cuenta sin restricciones
                </v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
                <v-list-item-title>
                    <v-row>
                        <v-col cols="2">
                            <span class="text-h4">20</span>
                        </v-col>
                        <v-col class="text-h6">Empresas</v-col>
                        <v-col cols="2" >
                            <v-icon color="success">mdi-check</v-icon>
                        </v-col>
                    </v-row>
                </v-list-item-title>

                <v-list-item-subtitle>
                    Da de alta ## Empresas en tu cuenta sin restricciones
                </v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
                <v-list-item-title>
                    <v-row>
                        <v-col cols="2">
                            <span class="text-h4">20</span>
                        </v-col>
                        <v-col class="text-h6">Empresas</v-col>
                        <v-col cols="2" >
                            <v-icon color="success">mdi-check</v-icon>
                        </v-col>
                    </v-row>
                </v-list-item-title>

                <v-list-item-subtitle>
                    Da de alta ## Empresas en tu cuenta sin restricciones
                </v-list-item-subtitle>
            </v-list-item>


        </v-list>

        <v-btn
            block
            class="text-none text-black mb-4"
            color="deep-purple-lighten-1"
            size="x-large"
            variant="outlined"
            @click="subscribe"
        >
            Contratar
        </v-btn>
    </v-sheet>
</template>
<script>

export default {

    methods: {
        subscribe: async function (){
            await axios.post("/user/subscribe");
        }
    }
}
</script>
