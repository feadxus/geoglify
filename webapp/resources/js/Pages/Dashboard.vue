<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
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

        <v-card class="mx-auto pa-3" variant="flat">
            {{ $t("global.auth.logged_in_message") }}
        </v-card>
    </AuthenticatedLayout>
</template>
