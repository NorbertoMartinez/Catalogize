<template>

    <v-card >


        <v-card-text>
            <v-card-text>

                <span v-show="section_selected"></span>

                <v-switch
                    color="deep-purple-lighten-1"
                    ref="b2bSearch"
                    v-model="b2b_search"
                    label="Cargar productos de la empresa">
                </v-switch>


                <v-select
                    variant="outlined"
                    multiple
                    label="Productos para asignar"
                    v-model="record.products"
                    :items="products"

                    item-title="name"
                    :item-value="item => item.id"
                >
                    <template v-slot:no-data>
                      <p class="px-5">No hay registros, intenta buscar por Empresa</p>
                    </template>
                </v-select>



                {{record.section}}
                <v-select
                    variant="outlined"
                    label="Elegir Sección"
                    :items="sections"
                    :item-title="item => item.section.title"
                    :item-value="item => item.section.id"
                    v-model="record.section"

                ></v-select>
            </v-card-text>


        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>

            <v-btn
                @click="$emit('back', true)"
                variant="text"
            >
                Regresar al inicio
            </v-btn>

            <v-spacer></v-spacer>
            <v-btn


                color="deep-purple-lighten-1"
                variant="flat"
                @click="__attach_product"

            >
                Asignar
            </v-btn>

        </v-card-actions>
    </v-card>

</template>


<script>


export default {
    name: "assigner-product",

    props: {
        section_selected: {},
        b2b_id: null,
        catalog_id: null,
    },

    components: {

    },

    computed: {


    },

    data(){
        return {

            products: [],
            sections: [],
            record: {
                section: null,
                products: {}
            },

            b2b_search: false,
        }
    },

    watch: {
        b2b_search: function (nv, ov){
            this.__fetch_items()
        }
    },
    mounted() {


        // this.record.section = this.section_selected;


        this.__fetch_sections();
        this.__fetch_items();
    },

    methods: {


        __attach_product(){

            axios.post("/op/section-products/"+this.record.section, this.record)
                .then((result) => {
                    if(result.data.status == "success"){
                        this.$emit("success", true);
                        this.$emit("update", true);
                    } else {
                        this.$emit("error", true);
                    }
                })
        },


        __fetch_sections: function() {
            axios.get("/op/catalog-sections/"+this.catalog_id)
                .then((result) => {
                    this.sections = result.data.data;
                })
        },

        __fetch_items : function (){

            var self = this;
            if(this.b2b_search)
            {
                axios.get("/op/b2b-products/"+this.b2b_id)
                    .then((result) => {
                        self.record.products = [];
                        self.products = result.data.data;
                    })
            }else{
                axios.get("/op/catalog-products/"+this.b2b_id+"/"+this.catalog_id)
                    .then((result) => {
                        self.record.products = [];
                        self.products = result.data.data;
                    })
            }
        },

    }
}
</script>
