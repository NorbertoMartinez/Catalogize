import './bootstrap'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import VueApexCharts from "vue3-apexcharts";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';





// Vuetify
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import {
    VAlert, VAlertTitle, VApp, VAppBar, VAppBarNavIcon, VAppBarTitle, VAutocomplete, VAvatar, VBadge, VBanner, VBannerActions, VBannerText,
    VBottomNavigation, VBreadcrumbs, VBreadcrumbsDivider, VBreadcrumbsItem, VBtn, VBtnGroup, VBtnToggle, VCard, VCardActions, VCardItem,
    VCardSubtitle, VCardText, VCardTitle, VCarousel, VCarouselItem, VCheckbox, VCheckboxBtn, VChip, VChipGroup, VClassIcon, VCode, VCol,
    VColorPicker, VCombobox, VComponentIcon, VContainer, VCounter, VDefaultsProvider, VDialog, VDialogBottomTransition, VDialogTopTransition,
    VDialogTransition, VDivider, VExpandTransition, VExpandXTransition, VExpansionPanel, VExpansionPanelText, VExpansionPanelTitle, VExpansionPanels,
    VFabTransition, VFadeTransition, VField, VFieldLabel, VFileInput, VFooter, VForm, VHover, VIcon, VImg, VInput, VItem, VItemGroup, VKbd, VLabel, VLayout,
    VLayoutItem, VLazy, VLigatureIcon, VList, VListGroup, VListImg, VListItem, VListItemAction, VListItemMedia, VListItemSubtitle,
    VListItemTitle, VListSubheader, VLocaleProvider, VMain, VMenu, VMessages, VNavigationDrawer,
    VNoSsr, VOverlay, VPagination, VParallax, VProgressCircular, VProgressLinear, VRadio, VRadioGroup, VRangeSlider, VRating, VResponsive,
    VRow, VScaleTransition, VScrollXReverseTransition, VScrollXTransition, VScrollYReverseTransition,
    VScrollYTransition, VSelect, VSelectionControl, VSelectionControlGroup, VSheet, VSlideGroup,
    VSlideGroupItem, VSlideXReverseTransition, VSlideXTransition, VSlideYReverseTransition, VSlideYTransition, VSlider, VSnackbar, VSpacer, VSvgIcon,
    VSwitch, VSystemBar, VTab, VTable, VTabs, VTextField, VTextarea, VThemeProvider, VTimeline, VTimelineItem, VToolbar, VToolbarItems,
    VToolbarTitle, VTooltip, VValidation, VWindow, VWindowItem
}  from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { VDataTable } from 'vuetify/labs/VDataTable'

const vuetify = createVuetify({

    icons: {
        defaultSet: 'mdi', // This is already the default value - only for display purposes
    },
    components: {
        VDataTable,
        VAlert, VAlertTitle, VApp, VAppBar, VAppBarNavIcon, VAppBarTitle, VAutocomplete, VAvatar, VBadge, VBanner, VBannerActions, VBannerText,
        VBottomNavigation, VBreadcrumbs, VBreadcrumbsDivider, VBreadcrumbsItem, VBtn, VBtnGroup, VBtnToggle, VCard, VCardActions, VCardItem,
        VCardSubtitle, VCardText, VCardTitle, VCarousel, VCarouselItem, VCheckbox, VCheckboxBtn, VChip, VChipGroup, VClassIcon, VCode, VCol,
        VColorPicker, VCombobox, VComponentIcon, VContainer, VCounter, VDefaultsProvider, VDialog, VDialogBottomTransition, VDialogTopTransition,
        VDialogTransition, VDivider, VExpandTransition, VExpandXTransition, VExpansionPanel, VExpansionPanelText, VExpansionPanelTitle, VExpansionPanels,
        VFabTransition, VFadeTransition, VField, VFieldLabel, VFileInput, VFooter, VForm, VHover, VIcon, VImg, VInput, VItem, VItemGroup, VKbd, VLabel, VLayout,
        VLayoutItem, VLazy, VLigatureIcon, VList, VListGroup, VListImg, VListItem, VListItemAction, VListItemMedia, VListItemSubtitle,
        VListItemTitle, VListSubheader, VLocaleProvider, VMain, VMenu, VMessages, VNavigationDrawer,
        VNoSsr, VOverlay, VPagination, VParallax, VProgressCircular, VProgressLinear, VRadio, VRadioGroup, VRangeSlider, VRating, VResponsive,
        VRow, VScaleTransition, VScrollXReverseTransition, VScrollXTransition, VScrollYReverseTransition,
        VScrollYTransition, VSelect, VSelectionControl, VSelectionControlGroup, VSheet, VSlideGroup,
        VSlideGroupItem, VSlideXReverseTransition, VSlideXTransition, VSlideYReverseTransition, VSlideYTransition, VSlider, VSnackbar, VSpacer, VSvgIcon,
        VSwitch, VSystemBar, VTab, VTable, VTabs, VTextField, VTextarea, VThemeProvider, VTimeline, VTimelineItem, VToolbar, VToolbarItems,
        VToolbarTitle, VTooltip, VValidation, VWindow, VWindowItem
    },
    directives,
})

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Catalogize'

import { VueMaskDirective } from 'v-mask';

const vMaskV2 = VueMaskDirective;
const vMaskV3 = {
    beforeMount: vMaskV2.bind,
    updated: vMaskV2.componentUpdated,
    unmounted: vMaskV2.unbind
};


import Environment from './Resources/Variables/Environment.vue'
import Cats from "./Resources/Variables/Catalogs.vue";
// import loader from "vue-loader";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) => require(`./Pages/${name}.vue`),


    setup({ el, app, props, plugin }) {

        const Application = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(vuetify)
            .use(VueSweetalert2)
            .use(VueApexCharts)
            .directive('mask', vMaskV3)
            .mixin({ methods: { route } })
            .mixin({
                data(){
                  return {
                      Cats,Environment
                  }
                },
                mounted(){

                    if(Cats.loader == 0){


                        axios.get("/resources/availabilities")
                            .then(function(result){
                            console.log(result.data)
                                Cats.availabilities = result.data.data;
                        });
                        axios.get("/resources/statuses")
                            .then(function(result){
                            console.log(result.data)
                                Cats.statuses = result.data.data;
                        });
                        axios.get("/resources/bussiness-types")
                            .then(function(result){
                            console.log(result.data)
                                Cats.bussiness_types = result.data.data;
                        });
                        axios.get("/resources/brochures-types")
                            .then((result) => {
                                console.log(result.data)
                                Cats.brochures_types = result.data.data;
                        })

                        Cats.loader = 1;
                    }
                },

                methods: {


                    Toast : function (txt){
                        this.Environment.snackbar = true
                        this.Environment.snackbar_text = txt
                        this.Environment.timeout = 2000
                    },


                    notify: async function(title, msg){

                        return this.$swal({
                            title: title,
                            text: msg,
                            icon: "info",
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: "Continuar",
                            dangerMode: false,
                        });
                    },

                    confirm: async function(title, msg){

                        return this.$swal({
                            title: title,
                            text: msg,
                            icon: "warning",
                            showCancelButton: true,
                            showConfirmButton: true,
                            confirmButtonText: "Continuar",
                            cancelButtonText: "Cancelar",
                            dangerMode: false,
                        });
                    }
                }
            })
            .mount(el)


        Application.config.compilerOptions.isCustomElement = tag => tag === 'plastic-button'

        return Application;

    },


})

InertiaProgress.init({ color: '#5e35b1' })
