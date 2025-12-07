<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <v-card class="mx-auto pa-3">
        <v-card-title>
            {{ $t("global.profile.update_password_title") }}
        </v-card-title>

        <v-card-subtitle>
            {{ $t("global.profile.update_password_description") }}
        </v-card-subtitle>

        <v-card-text class="mt-5">
            <v-text-field ref="currentPasswordInput" v-model="form.current_password"
                :label="$t('global.profile.fields.current_password')" outlined dense required autofocus
                variant="outlined" type="password" autocomplete="current-password"
                :error-messages="form.errors.current_password" class="mb-4"></v-text-field>

            <v-text-field ref="passwordInput" v-model="form.password" :label="$t('global.profile.fields.new_password')"
                outlined dense required variant="outlined" autocomplete="new-password" type="password"
                :error-messages="form.errors.password" class="mb-4"></v-text-field>

            <v-text-field v-model="form.password_confirmation" :label="$t('global.common.fields.password_confirmation')"
                outlined dense required variant="outlined" autocomplete="new-password" type="password"
                :error-messages="form.errors.password_confirmation" class="mb-4"></v-text-field>

            <v-alert v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">{{
                $t("global.common.saved") }}</v-alert>
        </v-card-text>

        <v-card-actions class="px-4">
            <v-spacer></v-spacer>
            <v-btn :readonly="form.processing" color="primary" variant="flat" :disabled="form.processing"
                @click="updatePassword">{{ $t("global.actions.save") }}</v-btn>
        </v-card-actions>
    </v-card>
</template>
