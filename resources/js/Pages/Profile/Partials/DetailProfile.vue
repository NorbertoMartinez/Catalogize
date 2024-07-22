<template>
    <v-card flat>



        <v-card-text>

            <v-row>
                <v-col cols="3">
                    <v-sheet
                        color="deep-purple-lighten-1"
                        class="pa-4 text-center"
                    >
                        <v-avatar
                            class="mb-4"
                            color="grey-darken-1"
                            size="100"
                            @click="$refs.picture.click()"
                        >

                            <v-img
                                v-if="record.attach!=null"
                                :src="record.attach"
                                cover
                                @click="$refs.picture.click()">
                            </v-img>

                            <v-tooltip
                                z-index="21"
                                text="Cambiar imagen de perfil"
                                location="right"
                            >
                                <template v-slot:activator="{ props }">
                                    <v-btn

                                        style="position: absolute"
                                        icon
                                        variant="text"
                                        v-bind="props">

                                        <v-icon color="grey-lighten-1">
                                            mdi-camera
                                        </v-icon>

                                    </v-btn>
                                </template>
                            </v-tooltip>

                        </v-avatar>
                        <br>
                        <v-btn
                            size="small"
                            variant="outlined"
                            class="ma-2"
                            v-if="record.attach!=null">
                            Guardar

                        </v-btn>
                        <hr>




                        <v-file-input
                            v-model="record.attached"
                            :rules="Rules.image_medium"
                            @update:modelValue="__preview_picture"
                            ref="picture"
                            style="display: none"
                            accept="image/png, image/jpeg, image/bmp"
                            label="File input">
                        </v-file-input>

                        <div>{{ account.name }}</div>
                        <div>{{ account.email }}</div>
                    </v-sheet>

                    <v-divider></v-divider>

                    <v-list>
                        <v-list-item
                            v-for="item in links"
                            :key="item.id"
                            link
                        >
                            <template v-slot:prepend>
                                <v-icon>{{ item.icon }}</v-icon>
                            </template>

                            <v-list-item-title @click="shower=item.id">{{ item.name }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                    <!--            </v-navigation-drawer>-->
                </v-col>
                <v-col>
                    <v-row
                        v-for="card in links"
                        :key="card"
                    >
                        <v-col
                            v-if="shower==card.id"
                            cols="12"
                        >
                            <v-card>
                                <v-list lines="two">
                                    <v-list-subheader>{{ card.name }}</v-list-subheader>
                                    <FormNotifications v-if="shower==1"></FormNotifications>
                                </v-list>
                            </v-card>
                        </v-col>
                    </v-row>

                </v-col>
            </v-row>


        </v-card-text>
    </v-card>
</template>

<script>
import Rules from "../../../Resources/Variables/Rules.vue";
import FormNotifications from "./FormNotifications.vue";
export default {
    props: {
        account: {}
    },

    components: {
        FormNotifications
    },

    data: () => ({
        Rules,
        cards: ['Today'],
        drawer: null,
        shower: 1,
        record:{

            attach: null,
            attached: null,
        },
        links: [
            {
                id:1,
                icon: 'mdi-inbox-arrow-down',
                name: 'Notificaciones'
            },
            {
                id:2,
                icon: 'mdi-send',
                name: 'Cambiar contraseña'
            },
            {
                id:3,
                icon: 'mdi-alert-octagon',
                name: 'Eliminar cuenta'
            },
        ],
    }),

    methods: {
        __preview_picture: function () {
            const input = this.$refs.picture
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.record.attach = e.target.result
                }

                reader.readAsDataURL(files[0])

            }
        },

        __upload_picture: async function (item){

            if(this.record.attached){
                let PictureForm = new FormData();
                PictureForm.append("image", this.record.attached[0]);

                return  await axios.post("/x/b2b-logo/"+item.id,
                    PictureForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
            } else {
                return false
            }

        },
    }
}
</script>
