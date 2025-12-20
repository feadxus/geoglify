
<template>
    <div ref="mapContainer" class="map-container"></div>
</template>

<script setup>
import { onMounted, onUnmounted, ref, shallowRef } from "vue";
import maplibregl from "maplibre-gl";
import "maplibre-gl/dist/maplibre-gl.css";
import { Protocol } from "pmtiles";

import { protomapsStyle } from "./protomaps-style.js";

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
    const protocol = new Protocol();
    maplibregl.addProtocol("pmtiles", protocol.tile);

    map.value = new maplibregl.Map({
        container: mapContainer.value,
        style: protomapsStyle,
        center: props.center,
        zoom: props.zoom,
        maxBounds: [
            [-8.7368, 41.0845], // Southwest coordinates
            [-8.5536, 41.2357]  // Northeast coordinates
        ]
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
