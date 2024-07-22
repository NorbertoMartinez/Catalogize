<template>
        <v-card lazy>

        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>
                Empresa
            </v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn v-show="!isUpdate" icon @click="$emit('dialog', false)">
                <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-btn
                v-show="isUpdate"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__save_item"
            >
                Actualizar registro
            </v-btn>
        </v-toolbar>

        <v-card-text>
            <v-form ref="form">


            <v-row>

            </v-row>

                <v-card variant="text"
                        color="deep-purple-lighten-1" class="mt-5 pa-3">
                    <v-row>

                        <v-col cols="7">

                            <v-alert
                                density="compact"
                                border="start"
                                border-color="deep-purple accent-4"
                                elevation="2"
                                class="mb-4"
                                closable
                                size="small"
                            >
                                Ingresa la información de tu empresa, es primordial conocer
                                más acerca de tu negocio, desde un logotipo, nombre hasta el tipo
                                de negocio, así te daremos las opciones ideales
                            </v-alert>

                        </v-col>

                        <v-col cols="5">

                            <v-img
                                v-if="record.attach!=null"
                                :src="record.attach"
                                cover
                                @click="$refs.picture.click()">
                            </v-img>

                            <v-card
                                v-else
                                color="deep-purple-accent-1"
                                class="d-flex align-center"
                                dark
                                min-height="150"
                                @click="$refs.picture.click()"
                            >
                                <v-scroll-y-transition>
                                    <div
                                        class="flex-grow-1 text-center"
                                    >
                                        <v-icon  icon="mdi-plus"></v-icon>
                                    </div>
                                </v-scroll-y-transition>
                            </v-card>


                            <v-file-input
                                v-model="record.attached"
                                :rules="Rules.image_medium"
                                @update:modelValue="__preview_picture"
                                ref="picture"
                                style="display: none"
                                accept="image/png, image/jpeg, image/bmp"
                                label="File input">
                            </v-file-input>
                        </v-col>

                    <v-col cols="12">
                        <v-select
                            label="Tipo de empresa"
                            :rules="Rules.SelectorRules"
                            required
                            prepend-icon="mdi-list-status"
                            variant="outlined"
                            v-model="record.bussiness_types"
                            multiple
                            item-title="name"
                            item-value="id"
                            :items="Cats.bussiness_types"
                        ></v-select>

                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            label="Nombre comercial *"
                            :rules="Rules.InputTextRules"
                            required
                            prepend-icon="mdi-text"
                            counter="75"
                            variant="outlined"
                            v-model="record.b2b.name"
                            flat></v-text-field>
                    </v-col>
                    <v-col cols="12"
                           v-if="details"
                    >
                        <v-text-field
                            label="Slogan"
                            prepend-icon="mdi-text"
                            counter="100"
                            variant="outlined"
                            v-model="record.b2b.slogan"
                            dense></v-text-field>
                    </v-col>
                    <v-col cols="12"
                           v-if="details">
                        <v-text-field
                            label="Razón Social"
                            prepend-icon="mdi-text"
                            counter="100"
                            variant="outlined"
                            v-model="record.b2b.social_reason"
                            flat></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            label="Dirección *"
                            :rules="Rules.InputTextRules"
                            required
                            prepend-icon="mdi-map-marker"
                            counter="200"
                            variant="outlined"
                            v-model="record.b2b.address"
                            dense></v-textarea>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            label="Teléfono *"
                            :rules="Rules.Phone"
                            required
                            prepend-icon="mdi-phone"
                            v-mask="'###-###-####'"
                            variant="outlined"
                            v-model="record.b2b.telecom"
                            dense></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            label="Código Fiscal (RFC) *"
                            :rules="Rules.RFC"
                            required
                            prepend-icon="mdi-text"
                            counter="20"
                            variant="outlined"
                            v-model="record.b2b.fiscal_code"
                            dense></v-text-field>
                    </v-col>


                        <v-btn variant="plain" color="deep-purple-lighten-1" @click="details = !details">
                            + Mostrar/Ocultar detalles
                        </v-btn>

                    </v-row>
                </v-card>

<!--                <v-col cols="12">-->
<!--                    <v-textarea-->
<!--                        v-model="record.b2b.aaaaaa"-->
<!--                        dense-->
<!--                        label="Breve descripción de la empresa"></v-textarea>-->
<!--                </v-col>-->

            </v-form>

        </v-card-text>

        <v-card-actions>

            <v-spacer></v-spacer>

            <v-btn
                v-show="!isUpdate"
                color="deep-purple-lighten-1"
                variant="flat"
                :loading="loading"
                @click="__save_item"
            >
                Guardar
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>

import Rules from "../../../Resources/Variables/Rules.vue";
export default {

    name: "form-b2b",


    props: {
        resource: {},
        isUpdate: false,
    },

    data(){
        return {
            Rules,


            details: false,
            loading: false,
            users: [],
            record: {
                attach: null,
                attached: null,
                bussiness_types: null,
                b2b: {
                    status_id: 1
                },
            }
        }
    },


    mounted(){
        if(this.isUpdate){
            this.record = {
                bussiness_types: [1,2,3],
                b2b: this.resource
            }
        }
    },

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

        __save_item(){

            var self=this;
            this.$refs.form.validate().then(function (v){
                if(v.valid){
                    self.loading=true;

                    axios.post("/x/b2bs", self.record).then(result => {
                        if(result.data.status === "success"){

                            self.record.b2b = result.data.data;

                            self.__upload_picture(self.record.b2b).then(
                                function (result){
                                    if (result) {
                                        self.$emit("update", 1);

                                        self.$emit("notify", "Se subió la imagen correctamente");
                                    } else {
                                        self.$emit("notify", "No se ha subido la imagen");
                                    }
                                }
                            )
                            self.loading=false;
                            self.$emit("update", 1);
                            self.$emit("notify", "Creado con éxito");




                        } else {
                            self.loading=false;
                            self.$parent.Toast(result.data.data)
                        }
                    })

                } else {
                    self.loading=false;
                }
            });

        },
    }
}
</script>
