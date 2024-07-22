<template>
    <v-item-group mandatory>
        <v-container>
            <v-row>
                <v-col
                    v-for="item in items"
                    :key="item"
                    cols="12"
                    md="6"
                >
                    <v-item v-slot="{ isSelected, toggle }">
                        <v-card
                            :color="isSelected ? 'deep-purple-lighten-1' : ''"
                            class="d-flex align-center"
                            dark
                            height="200"
                            @click="toggle"
                        >
                            <v-scroll-y-transition>
                                <div
                                    class="text-h5 flex-grow-1 text-center"
                                >
                                    <!--                                    {{ isSelected ? 'Selected' : 'Click Me!' }}-->
                                    <v-icon color="deep-purple-lighten-1">
                                        {{item.icon}}
                                    </v-icon>
                                    {{ item. name }}
                                    <br>
                                    <small class="text-subtitle-2 px-12 ">{{ item. subtitle }}</small>
                                    <br><br>
                                    <v-btn size="small" :href="item.action" v-show="isSelected">
                                        {{ item.btn_text }}
                                    </v-btn>
                                </div>
                            </v-scroll-y-transition>
                        </v-card>
                    </v-item>
                </v-col>
            </v-row>
        </v-container>
    </v-item-group>
</template>

<script>
export default {
    data(){
        return {
            items: [
                {
                    name: "Crear una Serie",
                    subtitle: "Crea una serie de entradas de Realidad aumentada, Optimo para Exposiciones, Presentaciones y demás",
                    action: "/x/b2bs",
                    icon: "mdi-lightbulb-group",
                    btn_text: "Vamos a configurarlo!",
                },
                {
                    name: "Crear un folleto",
                    subtitle: "Crea un solo recurso con Realidad Aumentada, Óptimo para cualquier impresion o medio digital",
                    action: "/op/catalogs",
                    icon: "mdi-cube-scan",
                    btn_text: "Estoy listo para crearlo",
                },

            ],
        }
    }
}

</script>
