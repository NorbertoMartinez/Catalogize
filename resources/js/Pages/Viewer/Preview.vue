<script setup>
import ViewerLayout from '@/Layouts/Viewer.vue'
// import View from "@/Pages/Viewer/Partials/View";
import View from "@/Pages/Viewer/Partials/ViewDemo";



defineProps({
    catalog: Object,
    status: String,
})
</script>

<template>
<!--    <v-parallax :src="catalog.background">-->

    <ViewerLayout title="Catalogo vista previa">
        <template #header>

<!--            <v-app-bar flat>-->

        </template>
        <v-container fluid
                     class="fixed dark fill-height d-flex align-center">


            <v-col>
                <v-img cover size="sm" width="50" src="/logo.png">
                </v-img>
            </v-col>

            <v-btn
                v-for="link in 2"
                :key="link"
                variant="text"
            >
                {{ link }}
            </v-btn>

            <v-spacer></v-spacer>

            <v-responsive max-width="260">
                <v-text-field
                    density="compact"
                    hide-details
                    variant="solo"
                ></v-text-field>
            </v-responsive>
        </v-container>
<!--        <v-main class="bg-grey-lighten-1">-->


                <View
                    :resource="catalog"
                    :status="status"
                ></View>
<!--                -->
<!--        </v-main>-->


        <footer  class="mt-12">


            <v-divider></v-divider>
            <v-card color="black">
                <v-card-text>
                    <v-row>
                        <v-col class="text-center pa-12">
                            <v-img width="100" src="/logo.png">

                            </v-img>
                        </v-col>
                        <v-col>
                            <h6>About Us</h6>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusan-tium doloremque laudantium, totam rem aperiam,</p>
                        </v-col>
                        <v-col>
                            <div class="form-inner">
                                <input type="text" placeholder="Enter your mail">
                                <button>
                                    <span class="lnr lnr-envelope"></span>
                                </button>
                            </div>
                            <br>
                            <a href="##">
                                <i class="zmdi zmdi-twitter"></i>
                            </a>
                            <a href="##">
                                <i class="zmdi zmdi-facebook-box"></i>
                            </a>
                            <a href="##">
                                <i class="zmdi zmdi-linkedin"></i>
                            </a>
                            <a href="##">
                                <i class="zmdi zmdi-instagram"></i>
                            </a>
                        </v-col>
                        <v-col>
                            <h6>Contact Us</h6>
                            <p>No 40 Baria Sreet 133/2</p>
                            <p>+ (156) 1800-366-6666</p>
                            <p>Eric-82@example.com</p>
                            <p>www.royate.com</p>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col>

                            <div class="ft-bot">
                                <div class="container">
                                    adsasdasd
                                </div>
                            </div>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>

            <div class="ft-top" style="display: none">
                <div class="container">
                    <div class="ft-top-wrapper">

                        <div class="row justify-content-between justify-content-xl-start">
                            <div class="col-md-3  ft-col">
                                <h6>About Us</h6>
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusan-tium doloremque laudantium, totam rem aperiam,</p>
                            </div>
                            <div class="col-md-5  col-xl-4 offset-xl-1 ft-col">
                                <h6>Get news &amp; offers</h6>
                                <form action="##">
                                    <div class="form-inner">
                                        <input type="text" placeholder="Enter your mail">
                                        <button>
                                            <span class="lnr lnr-envelope"></span>
                                        </button>
                                    </div>
                                </form>
                                <div class="social">
                                    <a href="##">
                                        <i class="zmdi zmdi-twitter"></i>
                                    </a>
                                    <a href="##">
                                        <i class="zmdi zmdi-facebook-box"></i>
                                    </a>
                                    <a href="##">
                                        <i class="zmdi zmdi-linkedin"></i>
                                    </a>
                                    <a href="##">
                                        <i class="zmdi zmdi-instagram"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3 col-xl-2  ml-xl-auto ft-col">
                                <h6>Contact Us</h6>
                                <p>No 40 Baria Sreet 133/2</p>
                                <p>+ (156) 1800-366-6666</p>
                                <p>Eric-82@example.com</p>
                                <p>www.royate.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </ViewerLayout>
<!--    </v-parallax>-->

</template>

