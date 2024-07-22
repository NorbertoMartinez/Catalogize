<template>

    <v-card>


        <v-card-text>
            <v-row>
                <v-col cols="3">
                    <v-card flat>
                        <v-card-text>
                            <v-img
                                class="mb-4"
                                contain
                                height="128"
                                :src="'data:image/png;base64, ' + record.qr_code"
                            ></v-img>

                            <v-btn block size="small" color="deep-purple-lighten-1" prepend-icon="mdi-download">Descargar</v-btn>
                            <v-divider></v-divider>
                            <v-btn block
                                   :href="record.url"
                                   target="_blank"
                                   size="small"
                                   variant="text"
                                   color="deep-purple-lighten-1"
                                   prepend-icon="mdi-eye">Vista previa</v-btn>
                        </v-card-text>
                    </v-card>
                    <v-spacer></v-spacer>
                    <v-card
                        flat
                    >
                        <v-list density="compact">
                            <v-list-subheader>Opciones</v-list-subheader>

                            <v-list-item
                                active-color="deep-purple-lighten-1"
                            >
                                <template v-slot:prepend>
                                    <v-icon icon="mdi-table-column"></v-icon>
                                </template>

                                <v-list-item-title>

                                    <a href="#" @click="$emit('tab', 'Secciones')">
                                        Administrar secciones
                                    </a>

                                </v-list-item-title>
                            </v-list-item>
                            <v-list-item
                                active-color="deep-purple-lighten-1"
                            >
                                <template v-slot:prepend>
                                    <v-icon icon="mdi-format-list-checks"></v-icon>
                                </template>

                                <v-list-item-title>
                                    <a href="#" @click="$emit('tab', 'Productos')">
                                        Administrar productos</a> </v-list-item-title>
                            </v-list-item>
                            <v-list-item
                                active-color="deep-purple-lighten-1"
                            >
                                <template v-slot:prepend>
                                    <v-icon icon="mdi-qrcode"></v-icon>
                                </template>

                                <v-list-item-title><a href="">Generar nuevo QR</a> </v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-card>

                </v-col>

                <v-col>



                    <v-card flat>
                        <template v-slot:title>
                            Nombre


                            <v-btn
                                variant="text"
                                v-show="record.show_edit_catalog_name"
                                @click="__update_item">
                            <v-icon icon="mdi-content-save"></v-icon>
                            </v-btn>

                            <v-btn
                                @click="record.show_edit_catalog_name = !record.show_edit_catalog_name"
                                variant="text">
                            <v-icon :icon="record.show_edit_catalog_name ? 'mdi-close' : 'mdi-pencil'"></v-icon>
                            </v-btn>
                        </template>

                        <template v-slot:subtitle>
                            Asi aparece a tus clientes
                        </template>

                        <template v-slot:text>
                          <span
                              v-show="!record.show_edit_catalog_name">
                                {{ (record.name)?record.name:'Sin datos' }}
                        </span>
                            <v-text-field
                                v-on:keyup.enter="__update_item"
                                variant="outlined"
                                counter="50"
                                v-show="record.show_edit_catalog_name"
                                v-model="record.name"
                                label="Editar nombre"></v-text-field>

                        </template>
                    </v-card>
                    <v-card flat>
                        <template v-slot:title>
                            Descripción


                            <v-btn
                                v-show="record.show_edit_catalog_description"
                                variant="text"
                                @click="__update_item">
                            <v-icon icon="mdi-content-save"></v-icon>
                            </v-btn>

                            <v-btn
                                @click="record.show_edit_catalog_description = !record.show_edit_catalog_description"
                                variant="text">
                            <v-icon :icon="record.show_edit_catalog_description ? 'mdi-close' : 'mdi-pencil'"></v-icon>
                            </v-btn>
                        </template>

                        <template v-slot:subtitle>
                            Esta es la breve resenha que tienen tus clientes para conocer el contenido de tu catálogo
                        </template>

                        <template v-slot:text>
                            <span
                                v-show="!record.show_edit_catalog_description">
                                        {{ (record.description)?record.description:'Sin datos' }}
                                    </span>

                            <v-textarea
                                v-on:keyup.enter="__update_item"
                                counter="200"
                                variant="outlined"
                                v-show="record.show_edit_catalog_description"
                                v-model="record.description"
                                label="Descripción del catálogo"></v-textarea>

                        </template>
                    </v-card>




                    <v-row>
                        <!--                        <v-col cols="12">-->
                        <!--                            <v-text-field label="Responsable" disabled-->
                        <!--                                          v-model="record.name"></v-text-field>-->
                        <!--                        </v-col>-->
                        <v-col cols="7">

                            <v-card flat>
                                <template v-slot:title>
                                    Estado del catálogo


                                    <v-btn
                                        variant="text"
                                        v-show="record.show_edit_catalog_status"
                                        @click="__update_item">
                                        <v-icon icon="mdi-content-save">
                                        </v-icon>
                                    </v-btn>


                                    <v-btn
                                        variant="text"
                                        @click="record.show_edit_catalog_status = !record.show_edit_catalog_status">
                                        <v-icon
                                            :icon="record.show_edit_catalog_status ? 'mdi-close' : 'mdi-pencil'">

                                        </v-icon>
                                    </v-btn>
                                </template>

                                <template v-slot:subtitle>
                                    Define si el catálogo es accesible, se encuentra temporalmente fuera de servicio o lo que creas conveniente
                                </template>

                                <template v-slot:text>
                                    <span
                                        v-show="!record.show_edit_catalog_status">
                                        {{ (record.status.name)?record.status.name:'Sin datos' }}
                                    </span>
                                    <v-select
                                        v-show="record.show_edit_catalog_status"
                                        variant="outlined"
                                        label="Estado"
                                        item-title="name"
                                        :item-value="item => item.id"
                                        :items="Cats.statuses"
                                        v-model="record.status_id"
                                    ></v-select>
                                </template>
                            </v-card>
                        </v-col>

                    </v-row>


                </v-col>
            </v-row>


        </v-card-text>



    </v-card>

</template>


<script>
import Rules from "@/Resources/Variables/Rules.vue";
import Cats from "@/Resources/Variables/Catalogs";

export default {
    name: "form-catalog",

    props: {
        record: {}
    },
    data(){
        return {
            Cats,
            Rules
        }
    },


    methods: {


        __update_item(){
            var self=this;
            this.confirm('Actualización de registro', 'Desea continuar con la actualización de este registro, para un SI, presione Continuar.')
            .then(function (result){

                if(result.isConfirmed){

                    axios.put("/op/catalogs/"+self.record.id, self.record).then(function (result){
                        self.Toast("Registro modificado")
                    });

                } else {
                    self.Toast("El registro no ha sido modificado")
                }

            })
        }
    }
}
</script>
