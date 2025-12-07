<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Map from "@/Components/Map.vue";
</script>

<template>
    <Head :title="$t('global.navigation.dashboard')" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <v-breadcrumbs
                :items="[
                    {
                        title: $t('global.common.home'),
                        disabled: false,
                        href: '/',
                    },
                    {
                        title: $t('global.navigation.dashboard'),
                        disabled: true,
                    },
                ]"
                divider="/"
            />
        </template>

        <v-card class="mx-auto pa-3">
            <Map />
        </v-card>
    </AuthenticatedLayout>
</template>

<style scoped>
.v-card {
    height: calc(100vh - 170px);
}
</style>
