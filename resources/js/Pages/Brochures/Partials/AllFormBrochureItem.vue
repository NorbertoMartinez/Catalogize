<template>

    <v-card
        color="deep-purple-lighten-1"
        variant="outlined"
        flat
        class="rounded-lg"
        density="compact">

        <v-card-title>
            <small>Nuevo elemento</small>
            <v-icon
                size="small"
                color="deep-purple-lighten-1"
                @click="show_help=!show_help">mdi-help-box</v-icon>
        </v-card-title>


        <v-card-text>

            {{brochure}}


            <v-row>

                <v-col cols="3">

                    <v-row>
                        <v-col cols="12">

                            <v-card

                                color="deep-purple-accent-1"
                                class="d-flex align-center rounded-xl"
                                dark
                                width="100%"
                                height="200"

                                @click="$refs.resource_ar.click()"
                            >
                                <v-scroll-y-transition>
                                    <div class="flex-grow-1 text-center">
                                        <v-icon  icon="mdi-plus"></v-icon>
                                    </div>
                                </v-scroll-y-transition>
                            </v-card>

                        </v-col>
                        <v-col cols="12">
                            <v-select
                                label="Tipo de Recurso *"
                                prepend-icon="mdi-alphabet-latin"
                                hint="Que tipo de serie quieres crear?"
                                density="compact"
                                persistent-hint
                                :rules="Rules.SelectorRules"
                                v-model="brochure.brochure_type_id"
                                :items="brochures_types"
                                :item-disabled="item => (item.status_id == 1)?false:true"
                                item-title="name"
                                item-value="id"
                            ></v-select>

                            <v-file-input
                                style="display: none"
                                label="Cargar recurso"
                                ref="resource_ar"
                                prepend-icon="mdi-alphabet-latin"
                                hint="Carga el recurso aquí"
                                density="compact"
                                persistent-hint
                                :accept="mimes"
                                :rules="Rules.image_long"
                                v-model="attached_resource"
                                @update:modelValue="__preview_resource"
                            ></v-file-input>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                label="Escala"
                                prepend-icon="mdi-alphabet-latin"
                                hint="Que tipo de serie quieres crear?"
                                density="compact"
                                persistent-hint
                                v-mask="'##'"
                                v-model="brochure.scale"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                label="Rotación (Radianes)"
                                prepend-icon="mdi-alphabet-latin"
                                hint="Que tipo de serie quieres crear?"
                                density="compact"
                                persistent-hint
                                v-mask="'###'"
                                v-model="brochure.radials"
                            ></v-text-field>
                        </v-col>

                    </v-row>

                </v-col>
                <v-col cols="9">

                    <v-row>

                        <v-col sm="12" xs="12" md="6">
                            <v-row>

                                <v-col cols="12">
                                    <v-text-field
                                        label="Titulo *"
                                        prepend-icon="mdi-alphabet-latin"
                                        hint="Como quieres nombrar la serie?"
                                        density="compact"
                                        persistent-hint
                                        v-model="brochure.name"
                                        :rules="Rules.text50"
                                        required
                                        counter="50"
                                    ></v-text-field>
                                </v-col>




                                <v-col cols="6">
                                    <v-switch
                                        label="Activador automático (QR)"
                                        density="compact"
                                        persistent-hint
                                        inset
                                        color="deep-purple-lighten-1"
                                        v-model="brochure.isExternalPattern"></v-switch>

                                </v-col>
                                <v-col cols="6">

                                    <PatternMaker
                                        @marker="brochure.marker  = $event"
                                        @previewer="brochure.preview_patt  = $event"
                                        @file="brochure.patt_file  = $event"
                                    ></PatternMaker>


                                </v-col>
                                <v-col cols="12">
                                    <v-textarea
                                        label="Descripción"
                                        prepend-icon="mdi-alphabet-latin"
                                        hint="Quieres agregar una descripción?"
                                        density="compact"
                                        persistent-hint

                                        v-model="brochure.description"
                                        counter="200"
                                    ></v-textarea>
                                </v-col>


                            </v-row>
                        </v-col>

                        <v-col sm="12" xs="12" md="6">


                            <v-row>


                                <v-col cols="12">

                                    <v-row>

                                        <v-col cols="12">
                                            <v-switch
                                                label="Es un enlace?"
                                                hint="Agrega cuanto cuesta tu producto"
                                                density="compact"
                                                persistent-hint
                                                inset
                                                color="deep-purple-lighten-1"
                                                v-model="brochure.isLink"></v-switch>


                                            <v-text-field
                                                label="Enlace al que dirige"
                                                prepend-icon="mdi-alphabet-latin"
                                                hint="Que tipo de serie quieres crear?"
                                                density="compact"
                                                persistent-hint
                                                v-model="brochure.link"
                                            ></v-text-field>

                                            <v-switch
                                                label="Reproducir Automáticamente"
                                                hint="Agrega cuanto cuesta tu producto"
                                                density="compact"
                                                persistent-hint
                                                inset
                                                color="deep-purple-lighten-1"
                                                v-model="brochure.autoplay"></v-switch>

                                            <v-switch
                                                label="Reproducir Audio"
                                                hint="Agrega cuanto cuesta tu producto"
                                                density="compact"
                                                persistent-hint
                                                inset
                                                color="deep-purple-lighten-1"
                                                v-model="brochure.playSound"></v-switch>
                                        </v-col>
                                    </v-row>

                                </v-col>
                            </v-row>

                        </v-col>
                    </v-row>
                </v-col>


            </v-row>

        </v-card-text>

        <v-card-actions>

            <v-spacer></v-spacer>

            <v-btn @click="$emit('push',record)">
                Guardar y crear nuevo
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>


import Rules from "../../../Resources/Variables/Rules.vue";
import Cats from "../../../Resources/Variables/Catalogs.vue";
import PatternMaker from "./PatternMaker.vue";
export default {
    name: "ar_item",
    components: {
        PatternMaker
    },
    data(){
        return {

            Rules,Cats,

            /*Loading Buttons */
            loading: false,

            /* Stepper */
            step: 1,

            /* Record to create */
            brochure: {},

            resource_tmp: null,
            resource: null,

            pattern_tmp: null,
            pattern: null,

            /* retrieve catalogs */
            brochures_types: [],
            patterns: [],

            /* Show Details in Section fields  */
            details: false,


            isExternalResource: false,
            isExternalPattern: false,
            showDetail: false,



            innerImageURL: null,
            fullMarkerURL: null,
            fullMarkerImage: null,
            imageName: null,
            pattFile: null,


        }

    },

    methods:{



        __download: function(){
            var self = this;
            if( this.innerImageURL === null ){
                alert('upload a file first')
                return
            }
            console.assert(this.innerImageURL)
            THREEx.ArPatternFile.encodeImageURL(this.innerImageURL,
                function onComplete(patternFileString){

                    self.pattFile = new Blob([patternFileString], {type: 'text/plain'})

                    self.emite();
                })
        },



    }
}
</script>
