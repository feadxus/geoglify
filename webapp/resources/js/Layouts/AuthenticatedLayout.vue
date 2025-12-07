<script setup>
import { ref } from "vue";
import Sidebar from "@/Layouts/Partials/Sidebar.vue";
import Header from "@/Layouts/Partials/Header.vue";

const drawer = ref(true);
</script>

<template>
    <v-app>
        <Sidebar :drawer="drawer" />
        <Header v-model:drawer="drawer" />

        <v-main class="bg-grey-lighten-5">
            <v-container fluid class="pa-6">
                <slot name="breadcrumbs" />
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>

<style lang="scss">
.v-main {
    min-height: 100vh;
}
</style>
