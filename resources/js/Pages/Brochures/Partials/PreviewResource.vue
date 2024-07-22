<template>
    <div>
        <video
            v-if="type === 1 && src!=null"
            :aspect-ratio="1"
            :src="src"
            controls></video>

        <v-img
            :src="src"
            v-if="type === 2 && src!=null"
            cover
            max-height="500"
            @click="$event('update', 1)"
        ></v-img>
    </div>
</template>
<script>

export default {
    props: {
        src: null,
        type: null
    }
}
</script>
