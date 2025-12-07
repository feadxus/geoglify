<template>
    <v-menu>
        <template v-slot:activator="{ props }">
            <v-btn
                icon
                v-bind="props"
                variant="text"
                size="small"
            >
                <v-icon>mdi-translate</v-icon>
            </v-btn>
        </template>
        <v-list>
            <v-list-item
                @click="changeLocale('en')"
                :active="locale === 'en'"
            >
                <template v-slot:prepend>
                    <img
                        :src="usFlag"
                        alt="English"
                        style="width: 24px; height: 16px; margin-right: 8px;"
                    />
                </template>
                <v-list-item-title>English</v-list-item-title>
            </v-list-item>
            <v-list-item
                @click="changeLocale('pt')"
                :active="locale === 'pt'"
            >
                <template v-slot:prepend>
                    <img
                        :src="ptFlag"
                        alt="Português"
                        style="width: 24px; height: 16px; margin-right: 8px;"
                    />
                </template>
                <v-list-item-title>Português</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>

<script setup>
import { useI18n } from 'vue-i18n';
import { router } from '@inertiajs/vue3';
import US from 'country-flag-icons/string/3x2/US';
import PT from 'country-flag-icons/string/3x2/PT';

const { locale } = useI18n();

// Convert SVG strings to data URLs
const usFlag = `data:image/svg+xml;base64,${btoa(US)}`;
const ptFlag = `data:image/svg+xml;base64,${btoa(PT)}`;

const changeLocale = (newLocale) => {
    locale.value = newLocale;
    
    // Send locale change to Laravel backend
    router.post('/locale/set', 
        { locale: newLocale },
        {
            preserveState: true,
            preserveScroll: true,
            only: ['locale'],
        }
    );
};
</script>
