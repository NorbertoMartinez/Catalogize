<template>

    <div>
        <v-file-input
            label="Cargar"
            ref="pattern"
            prepend-icon="mdi-image-area-close"
            hint="image/png, image/jpeg, image/bmp"
            density="compact"
            persistent-hint
            accept="image/png, image/jpeg, image/bmp"
            :rules="Rules.image_long"
            v-model="pattern"
            :disabled="disable"
            @update:modelValue="preview"
        ></v-file-input>
    </div>

</template>


<script>

import Rules from "../../../Resources/Variables/Rules.vue";
export default {


    props: {
        reset: false,
        disable: false,
    },

    data(){

        return {
            Rules,
            pattern: null,

            preview_pattern: null,
            marker: null,
            pattFile: null,

            ratio: '0.70',
            size: '500',
            color: 'black',
        }
    },

    watch: {
        reset: function (nv, ov){
            if(nv === true){

                this.pattern = null;
                this.preview_pattern = null;
                this.marker = null;
                this.pattFile = null;
                this.$emit("reseted", 1)

            }
        },
    },

    methods: {


        preview: function (){

            const input = this.$refs.pattern
            const files = input.files
            if (files && files[0]) {
                const reader = new FileReader
                reader.onload = e => {
                    this.preview_pattern = e.target.result
                    this.generatePattern();
                }

                reader.readAsDataURL(files[0])
            }
        },

        generatePattern: function (){

            var self = this;
            self.$emit("previewer", this.preview_pattern);

            THREEx.ArPatternFile.buildFullMarker(this.preview_pattern, this.ratio, this.size, this.color,
                function onComplete(markerUrl)
                {
                    self.$emit("marker", markerUrl);

                    THREEx.ArPatternFile.encodeImageURL(self.preview_pattern,
                        function onComplete(patternFileString){
                            self.pattFile = new Blob([patternFileString], {type: 'text/plain'})

                            self.$emit("file", self.pattFile)
                        })

                })
        },

        download: function(){

        }
    }
}
</script>
