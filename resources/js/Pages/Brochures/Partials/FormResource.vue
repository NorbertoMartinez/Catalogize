<template>



    <v-card>

        <v-toolbar color="deep-purple-lighten-1">
            <v-toolbar-title>Actualizar Recurso</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-btn icon @click="$emit('dialog', false)">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-toolbar>

        <v-card-text>

            <v-row v-if="src != null">

                <v-col offset="1" cols="10" class="mb-10" min-height=12  color="deep-purple-lighten-1">

                    <PreviewResource v-show="!isUpdated"
                        :src="src"
                        :type="type">
                    </PreviewResource>

                    <PreviewResource v-show="isUpdated"
                        @update="$refs.resource.click()"
                        :src="record.attach"
                        :type="record.brochure_type_id">
                    </PreviewResource>

                </v-col>

                <v-col cols="6" v-show="isUpdated">
                    <v-select
                        label="Tipo de Folleto *"
                        :rules="Rules.SelectorRules"
                        required
                        variant="outlined"
                        v-model="record.brochure_type_id"
                        :items="brochures_types"
                        :item-disabled="item => (item.status_id == 1)?false:true"
                        item-title="name"
                        item-value="id"
                        @update:modelValue="__reset"
                    ></v-select>
                </v-col>
                <v-col cols="6"  v-show="isUpdated">
                    <v-file-input
                        label="Recurso a mostrar"
                        :accept="mimes"
                        required
                        variant="outlined"
                        :rules="Rules.image_long"
                        v-model="record.attached_resource"
                        :disabled="!record.brochure_type_id"
                        ref="resource"
                        @update:modelValue="__preview_resource"
                    ></v-file-input>
                </v-col>
            </v-row>





        </v-card-text>

        <v-card-actions>

            <v-btn
                v-show="isUpdated"
                color="deep-purple-lighten-1"
                variant="outlined"
                @click="$emit('dialog', false)"
            >
                Cancelar
            </v-btn>

            <v-btn
                v-show="!isUpdated"
                variant="outlined"
                color="deep-purple-lighten-1"
                @click="isUpdated=!isUpdated">
                Reemplazar
            </v-btn>


            <v-spacer></v-spacer>

            <v-btn
                color="deep-purple-lighten-1"
                variant="flat"
                :disabled="!isUpdated"
                @click="__upload_resource"
            >
                Actualizar
            </v-btn>


        </v-card-actions>
    </v-card>

</template>

<script>
import Rules from "../../../Resources/Variables/Rules.vue";
import PreviewResource from "./PreviewResource.vue";

export default {

    name: "form-resource",

    props: {
        id: null,
        type: null,
        src: null,
    },

    components: {
        PreviewResource,
    },
    data(){
        return {
            Rules,
            isUpdated: false,
            record: {},
            brochures_types: [],
        }
    },

    computed: {
        mimes: function (){
            switch (this.record.brochure_type_id){
                case 1:
                    return "video/mp4, video/webm";
                case 2:
                    return "image/bmp, image/jpeg, image/x-png; image/png";
                default: return "image/bmp, image/jpeg, image/x-png; image/png";
            }
        }
    },

    watch: {
        mimes: function (nv, ov){
            this.record.attach = null
            this.$refs.resource.reset();
        }
    },

    mounted() {


        this.__fetch_brochures_types();
    },

    methods: {

        /**
         *
         * @param bussiness_type
         * @private
         */
        __fetch_brochures_types: function ()
        {
            var self=this;
            // this.records.catalog.bussiness_type_id = bussiness_type.id;
            axios.get("/resources/brochures-types")
                .then((result) => {

                    self.brochures_types = result.data.data;
                })
        },

        __preview_resource: function () {


            const resources = this.$refs.resource
            const files = resources.files;
            if (files && files[0]) {


                const reader = new FileReader
                reader.onload = e => {
                    this.record.attach = e.target.result;
                }

                reader.readAsDataURL(files[0])
            }
        },

        __upload_resource: function (){
            var self=this;
            if(this.record.attached_resource){

                let resourceForm = new FormData();
                resourceForm.append("resource", this.record.attached_resource[0]);
                resourceForm.append("brochure_type_id", this.record.brochure_type_id);

                axios.post("/op/resource/brochure-resource/"+this.id,
                    resourceForm,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }). then(function(result){

                    if(result.data.status=="success"){

                        self.$emit("notify", "Actualizado con éxito")
                        self.$emit("dialog", false)

                    } else {
                        self.$emit("notify", "Error al actualizar");
                    }
                    self.$emit("update", 1)
                    self.loading=false;
                });
            } else {
                return null;
            }

        },
    }
}
</script>
