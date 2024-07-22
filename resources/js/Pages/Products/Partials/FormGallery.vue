<template>


    <v-card
        color="deep-purple-lighten-1"
        variant="text"
        class="rounded-lg"
        density="compact"
        :loading="loading">



<!--        <v-col cols="12">-->
<!--                <span-->
<!--                    v-if="gallery_selected"-->
<!--                    class="text-caption text-grey-darken-1">-->
<!--                Carga imagenes a tu producto creando una galleria-->
<!--              </span>-->
<!--                <span-->
<!--                    v-else-->
<!--                    class="text-caption text-grey-darken-1">-->
<!--                Selecciona una galeria en el icono: <v-icon>mdi-dots-vertical</v-icon>-->
<!--              </span>-->
<!--        </v-col>-->


        <v-row>
            <v-col cols="12">
                <v-text-field
                    label="Nombre de galeria"
                    prepend-icon="mdi-rename"
                    v-show="show_gallery_form"
                    hint="Edita el titulo de la galería"
                    density="compact"
                    persistent-hint
                    v-model="record.gallery.name"
                ></v-text-field>

            </v-col>
<!--            <v-col cols="2">-->
<!--                <v-btn-->
<!--                    class="mt-3"-->
<!--                    icon="mdi-content-save-outline"-->
<!--                    size="small"-->
<!--                    v-show="show_gallery_form"-->
<!--                    color="deep-purple-lighten-1"-->
<!--                    density="comfortable"-->
<!--                    @click="__add_gallery">-->
<!--                </v-btn>-->
<!--            </v-col>-->
        </v-row>


<!--        <v-textarea-->
<!--            v-show="show_gallery_form"-->
<!--            density="compact"-->
<!--            v-model="record.gallery.description"-->
<!--            variant="outlined"-->
<!--            label="Describe tu galleria"-->
<!--        ></v-textarea>-->






        <v-card-text>
<!--            <v-card flat>-->
<!--                <template v-slot:title>-->
<!--                    {{ (gallery_selected) ? gallery_selected.name : ""}}-->
<!--                </template>-->

<!--                <template v-slot:subtitle>-->
<!--                    {{ (gallery_selected) ? gallery_selected.description : ""}}-->
<!--                </template>-->
<!--            </v-card>-->

<!--            <v-item-group mandatory v-for="gallery in product_galleries">-->
            <v-item-group mandatory >
                <v-container>
                    <v-row>
                        <v-col
                            v-for="n in images "
                            :key="n"
                            sm="12"
                            md="4"
                        >
                            <v-item v-slot="{ isSelected, toggle }">
                                <v-card
                                    :color="isSelected ? 'primary' : ''"
                                    class="d-flex align-center"
                                    dark
                                    min-height="100"
                                    @click="toggle"
                                >
                                    <v-scroll-y-transition>
                                        <div
                                            class="flex-grow-1 text-center"
                                        >


                                            <v-img :src="n" cover>

                                            </v-img>
                                            <v-icon
                                                @click="__delete_item(n)"
                                                icon="mdi-delete" v-show="isSelected">
                                            </v-icon>
                                        </div>
                                    </v-scroll-y-transition>
                                </v-card>
                            </v-item>
                        </v-col>
                        <v-col
                            sm="12"
                            md="4"
                        >
                            <v-item v-slot="{ isSelected, toggle }">
                                <v-card
                                    :color="isSelected ? 'deep-purple-accent-1' : 'deep-purple-accent-1'"

                                    class="d-flex align-center rounded-xl"
                                    dark
                                    width="100%"
                                    max-height="300"
                                    min-height="100"
                                    @click="$refs.gallery_file.click()"
                                >
                                    <v-scroll-y-transition>
                                        <div
                                            class="flex-grow-1 text-center"
                                        >
                                            <v-icon  icon="mdi-plus"></v-icon>
                                            <v-file-input
                                                label="Archivo de la galeria del producto"
                                                v-model="file_to_upload"
                                                @update:modelValue="preview_images"
                                                ref="gallery_file"
                                                style="display: none"
                                            ></v-file-input>

                                        </div>
                                    </v-scroll-y-transition>
                                </v-card>
                            </v-item>
                        </v-col>
                    </v-row>
                </v-container>
            </v-item-group>





<!--            <v- label="Rasgo especificacion"></v->-->


        </v-card-text>

<!--        <v-card-actions>-->

<!--            <v-btn block>Guardar y crear nuevo</v-btn>-->
<!--        </v-card-actions>-->
    </v-card>

</template>


<script>

export default {
    name: "form-gallery",

    props:{
        product_type_id: null,
        product_id: null,
        product: {},
        b2b_id: null,
    },

    data(){
        return {
            loading: false,
            active: false,
            record: {
                gallery:{}
            },

            images: [],

            show_gallery_form: true,

            product_galleries: {},
            gallery_items: {},
            gallery_selected: null,
            file_to_upload:null,

        }
    },

    mounted() {
        this.__fetch_product_galleries();
    },

    methods: {

        // __select_gallery(item){
        //     this.gallery_selected=item;
        //     this.__fetch_product_gallery_items();
        // },

        __add_gallery: function (){
            var self=this;
            this.loading=true;

            this.record.gallery.product_type_id = this.product_type_id;
            this.record.gallery.product_id = this.product_id;

            axios.post("/op/product-gallery", this.record).then(function (result){
                if(result.data.status === "success") {
                    self.loading=false;

                    self.__fetch_product_galleries()
                }
            });
        },

        preview_images: function(){
            const input = this.$refs.gallery_file
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader

                reader.onload = e => {
                    this.images.push( e.target.result )
                }

                reader.readAsDataURL(files[0])

            }
        },

        __upload_image: function (file){
            var self=this;
            this.loading=true;


            console.log(file);

            var formData = new FormData();
                formData.append("image", file[0]);
                formData.append("gallery", this.gallery_selected.id);



            axios.post("/op/product-gallery-item", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function (result){
                if(result.data.status === "success") {
                    self.loading=false;
                    // self.record.feature.value = null;
                    // self.record.feature.feature_id = null;

                    self.__fetch_product_gallery_items()
                }
            });
        },



        __fetch_product_galleries: function (){
            var self=this;
            axios.get("/op/product-galleries/"+this.product_id).then(function (result){
                self.product_galleries = result.data.data;


                if(self.product_galleries.length > 0)
                {
                    self.show_gallery_form = false;
                } else {
                    self.show_gallery_form = true;
                }
            });

        },

        __fetch_product_gallery_items: function (){
            var self=this;
            axios.get("/op/product-gallery-items/"+this.gallery_selected.id)
                .then(function (result){
                self.gallery_items = result.data.data;
            });

        },



        __delete_item: function (item){

            var self=this;
            axios.delete("/op/product-gallery-item/"+item.id).then(function (result){
                // self.features = result.data.data;
                self.__fetch_product_gallery_items();
            });

        }


    }
}
</script>
