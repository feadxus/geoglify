<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    drawer: {
        type: Boolean,
        required: true,
    },
});

const menuItems = [
    {
        title: "global.navigation.dashboard",
        icon: "mdi-view-dashboard-outline",
        to: "dashboard",
    },
    {
        title: "global.navigation.users",
        icon: "mdi-account-group-outline",
        to: "users.index",
    },
    {
        title: "global.navigation.roles",
        icon: "mdi-shield-account-outline",
        to: "roles.index",
    },
];
</script>

<template>
    <v-navigation-drawer
        :model-value="drawer"
        left
        elevation="0"
        rail-width="60"
        mobile-breakpoint="lg"
        app
        class="leftSidebar"
        expand-on-hover
    >
        <div class="pa-5">
            Geoglify
        </div>

        <v-list class="pa-4">
            <template v-for="(item, i) in menuItems" :key="i">
                <Link :href="route(item.to)" as="div" class="text-decoration-none">
                    <v-list-item
                        :value="item"
                        color="primary"
                        rounded="md"
                        class="mb-1"
                        :class="{
                            'v-list-item--active': route().current(item.to),
                        }"
                    >
                        <template v-slot:prepend>
                            <v-icon :icon="item.icon" size="small"></v-icon>
                        </template>

                        <v-list-item-title class="text-subtitle-1">
                            {{ $t(item.title) }}
                        </v-list-item-title>
                    </v-list-item>
                </Link>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<style lang="scss">
.leftSidebar {
    .v-list-item--active {
        background: rgb(var(--v-theme-primary));
        color: rgb(var(--v-theme-on-primary));
        .v-icon {
            color: rgb(var(--v-theme-on-primary));
        }
    }
}
</style>
