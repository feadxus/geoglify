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
    <section>
        <header>
            <h2 class="font-weight-black">
                {{ $t("global.profile.update_password_title") }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ $t("global.profile.update_password_description") }}
            </p>
        </header>

        <form class="mt-6 space-y-6" @submit.prevent="updatePassword">
            <v-text-field
                ref="currentPasswordInput"
                v-model="form.current_password"
                :label="$t('global.profile.fields.current_password')"
                outlined
                dense
                required
                autofocus
                variant="outlined"
                autocomplete="current-password"
                :error-messages="form.errors.current_password"
            ></v-text-field>

            <v-text-field
                ref="passwordInput"
                v-model="form.password"
                :label="$t('global.profile.fields.new_password')"
                outlined
                dense
                required
                variant="outlined"
                autocomplete="new-password"
                type="password"
                :error-messages="form.errors.password"
            ></v-text-field>

            <v-text-field
                v-model="form.password_confirmation"
                :label="$t('global.common.fields.password_confirmation')"
                outlined
                dense
                required
                variant="outlined"
                autocomplete="new-password"
                type="password"
                :error-messages="form.errors.password_confirmation"
            ></v-text-field>

            <v-alert
                v-if="form.recentlySuccessful"
                class="text-sm text-gray-600 dark:text-gray-400"
                >{{ $t("global.common.saved") }}</v-alert
            >

            <v-btn
                :readonly="form.processing"
                color="primary"
                elevation="0"
                :disabled="form.processing"
                @click="updatePassword"
                >{{ $t("global.actions.save") }}</v-btn
            >
        </form>
    </section>
</template>
