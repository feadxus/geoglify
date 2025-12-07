<script setup>
import { Link } from "@inertiajs/vue3";
import LanguageSwitcher from '@/Components/LanguageSwitcher.vue';

defineProps({
    drawer: {
        type: Boolean,
        required: true,
    },
});

defineEmits(["update:drawer"]);
</script>

<template>
    <v-app-bar elevation="0" height="60" class="border-b">
        <v-btn
            class="text-secondary mr-3"
            color="darkText"
            icon
            rounded="sm"
            variant="text"
            size="small"
            @click="$emit('update:drawer', !drawer)"
        >
            <v-icon
                :icon="drawer ? 'mdi-menu-open' : 'mdi-menu'"
                size="20"
            ></v-icon>
        </v-btn>

        <v-spacer />

        <!-- Language Switcher -->
        <LanguageSwitcher />

        <v-menu :close-on-content-click="false" offset="8, 0">
            <template v-slot:activator="{ props }">
                <v-btn
                    class="profileBtn"
                    variant="text"
                    rounded="sm"
                    v-bind="props"
                >
                    <div class="d-flex align-center">
                        <v-avatar class="mr-sm-2 mr-0 py-2" size="32" color="primary">
                            <span class="text-h6 text-white">{{
                                $page.props.auth.user.name.charAt(0)
                            }}</span>
                        </v-avatar>
                        <h6 class="text-subtitle-1 mb-0 d-sm-block d-none">
                            {{ $page.props.auth.user.name }}
                        </h6>
                    </div>
                </v-btn>
            </template>
            <v-sheet rounded="md" width="200" elevation="10" class="mt-2">
                <v-list class="py-0">
                    <v-list-item>
                        <template v-slot:prepend>
                            <v-icon
                                icon="mdi-account-outline"
                                size="small"
                            ></v-icon>
                        </template>
                        <v-list-item-title>
                            {{ $t("global.profile.title") }}
                        </v-list-item-title>
                    </v-list-item>
                    
                    <v-divider></v-divider>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="div"
                        class="text-decoration-none"
                    >
                        <v-list-item link color="primary">
                            <template v-slot:prepend>
                                <v-icon
                                    icon="mdi-logout"
                                    size="small"
                                ></v-icon>
                            </template>
                            <v-list-item-title>
                                {{ $t("global.auth.logout") }}
                            </v-list-item-title>
                        </v-list-item>
                    </Link>
                </v-list>
            </v-sheet>
        </v-menu>
    </v-app-bar>
</template>

<style scoped>
/* Reduce excessive spacing in list item prepend */
:deep(.v-list-item__prepend) {
    display: block !important;
}
</style>

