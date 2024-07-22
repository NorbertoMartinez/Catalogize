<template>
    <a-scene embedded arjs vr-mode-ui="enabled: false">
        <a-marker
            type="pattern"
            url="/pattern-logo.patt"
        >
            <a-entity
                position="0 0 0"
                scale="0.05 0.05 0.05"
                gltf-model="https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/scene.gltf"
            ></a-entity>
        </a-marker>
        <a-entity camera></a-entity>
    </a-scene>
</template>


<script>
import MapsDirections from "@/Pages/Viewer/Partials/MapDirections";
import MapsButton from "@/Pages/Viewer/Partials/MapsButton.vue";

export default {
    name: "AR-viewer",

    components: {
        MapsButton,
        MapsDirections,
    },
    data: () => ({
        directions: {
            car: {
                type: "car",
                via: "via Via Aurelia",
                time: "5 min",
                distance: "2.5 Km"
            },
            walking: {
                type: "walking",
                via: "via Via Aurelia",
                time: "26 min",
                distance: "2.1 Km"
            }
        }
    })
};
</script>
