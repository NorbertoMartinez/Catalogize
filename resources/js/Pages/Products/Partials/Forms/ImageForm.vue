<template>



<!--    <v-card-text>-->
        <v-file-input
            label="File input"
            v-model="input_file"
            @update:modelValue="__preview_picture"
            ref="picture"
            accept="image/png, image/jpeg, image/bmp"
            style="display: none"
        ></v-file-input>

        <v-img
            :src="image"
            v-if="image!=null"
            class="d-flex align-center rounded-xl"
            cover
            width="100%"
            height="100%"
            @click="$refs.picture.click()"
        ></v-img>

        <v-card
            v-else
            color="deep-purple-accent-1"
            class="d-flex align-center rounded-xl"
            dark
            width="100%"
            height="150"
            @click="$refs.picture.click()"
        >
            <v-scroll-y-transition>
                <div class="flex-grow-1 text-center">
                    <v-icon  icon="mdi-plus"></v-icon>
                </div>
            </v-scroll-y-transition>
        </v-card>


<!--    </v-card-text>-->

<!--    <v-card-actions class="pa-5">-->

<!--        <v-spacer></v-spacer>-->
<!--        <v-btn-->
<!--            variant="outlined"-->
<!--            size="small"-->
<!--            color="success"-->
<!--            density="comfortable"-->
<!--            @click="$refs.picture.click()"-->
<!--        >Editar-->
<!--        </v-btn>-->

<!--        <v-btn-->
<!--            variant="tonal"-->
<!--            color="error"-->
<!--            @click=""-->
<!--            density="comfortable"-->
<!--            size="small"-->
<!--        >Eliminar</v-btn>-->
<!--    </v-card-actions>-->

</template>

<script>

export default {
   data(){
       return {
           image: null,
           input_file: null,
       }
   },
    methods: {
        __preview_picture: function () {
            const input = this.$refs.picture
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.image = e.target.result
                    this.$emit("image", this.input_file)
                }

                reader.readAsDataURL(files[0])

            }
        },
    }
}

</script>
