<template>


    <v-card >

        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>Editar tema</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="$emit('dialog', false)">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-toolbar>

        <v-card-text >

            <v-card variant="text"  color="deep-purple-lighten-1">

                <v-row>

                    <v-col cols="12">

                        <v-alert
                            density="compact"
                            border="start"
                            border-color="deep-purple accent-4"
                            elevation="2"
                            class="mb-4"
                            closable
                        >
                            Modificar la apariencia del catálogo, elige un tema y modifica la imagen que se mostrará
                            de fondo en tu catálogo
                        </v-alert>
                    </v-col>

                    <v-col>

                        <v-select
                            color="deep-purple-accent-1"
                            label="Estilo del catálogo"
                            required
                            variant="outlined"
                            :items="[]"

                            @update:modelValue=""
                        ></v-select>

                    </v-col>

                    <v-col cols="12">
                        <v-file-input
                            label="File input"
                            v-model="record.attached"
                            @update:modelValue="__preview_picture"
                            ref="picture"
                            accept="image/png, image/jpeg, image/bmp"
                            style="display: none"
                        ></v-file-input>


                        <v-img

                            :src="record.attach"
                            v-if="record.attach!=null"
                            cover
                            max-height="500"
                            @click="$refs.picture.click()"
                        ></v-img>

                        <v-card
                            color="deep-purple-accent-1"
                            v-else
                            class="d-flex align-center"
                            dark
                            min-height="150"
                            @click="$refs.picture.click()"
                        >
                            <v-scroll-y-transition>
                                <div class="flex-grow-1 text-center">
                                    <v-icon  icon="mdi-plus"></v-icon>
                                </div>
                            </v-scroll-y-transition>
                        </v-card>

                    </v-col>

                </v-row>

            </v-card>


        </v-card-text>

        <v-card-actions>

            <v-spacer></v-spacer>
            <v-btn
                color="deep-purple-accent-1"
                variant="flat"
                :loading="loading"
                @click="__upload_picture"
            >
                Actualizar
            </v-btn>
        </v-card-actions>
    </v-card>

</template>
<script>

export default {
    name: "catalog-change-background",

    props: {
        record: {},
    },

    data(){
        return {
            loading: false,

        }
    },

    mounted() {
        this.__fetch_themes();
    },

    methods: {


        __fetch_themes: function(){
            // axios.get()
        },


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

        __upload_picture: function (){
            var self = this;
            if(this.record.attached){

                let PictureForm = new FormData();
                PictureForm.append("background", this.record.attached[0]);

                axios.post("/op/catalog-background/"+this.record.id,
                    PictureForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(function (result){

                        if(result.data.status=="success"){
                            self.$emit("refresh", 1);
                        }

                        self.$emit("notify", result.data)
                        //
                });
            }

        },
    }
}

</script>
