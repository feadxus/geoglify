<template>
    <div ref="mapContainer" class="map-container"></div>
</template>

<script setup>
import { onMounted, onUnmounted, ref, shallowRef } from "vue";
import maplibregl from "maplibre-gl";
import "maplibre-gl/dist/maplibre-gl.css";

const mapContainer = ref(null);
const map = shallowRef(null);

const props = defineProps({
    center: {
        type: Array,
        default: () => [0, 0],
    },
    zoom: {
        type: Number,
        default: 1,
    },
});

onMounted(() => {
    map.value = new maplibregl.Map({
        container: mapContainer.value,
        style: "https://demotiles.maplibre.org/style.json", // Using a demo style for now
        center: props.center,
        zoom: props.zoom,
    });

    map.value.addControl(new maplibregl.NavigationControl());
});

onUnmounted(() => {
    if (map.value) {
        map.value.remove();
    }
});
</script>

<style scoped>
.map-container {
    width: 100%;
    height: 100%;
}
</style>
