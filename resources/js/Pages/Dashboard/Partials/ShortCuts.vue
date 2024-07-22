<template>
    <v-item-group mandatory>
        <v-container>
            <v-row>
                <v-col
                    v-for="item in items"
                    :key="item"
                    cols="12"
                    md="4"
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
                                    <v-icon>
                                        {{item.icon}}
                                    </v-icon>
                                    {{ item. name }}
                                    <br>
                                    <small class="text-subtitle-2">{{ item. subtitle }}</small>
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
                    name: "Empresas",
                    subtitle: "Administra tus empresas registradas",
                    action: "/x/b2bs",
                    icon: "mdi-account-group",
                    btn_text: "Vamos a configurarlo!",
                },
                {
                    name: "Catálogos",
                    subtitle: "Administra tus catálogos disponibles",
                    action: "/op/catalogs",
                    icon: "mdi-qrcode",
                    btn_text: "Estoy listo para crearlos",
                },
                {
                    name: "A.R.",
                    subtitle: "Realidad Aumentada a tu alcance",
                    action: "/op/brochures",
                    icon: "mdi-palette",
                    btn_text: "Quiero conocerlo!",
                },
            ],
        }
    }
}

</script>
