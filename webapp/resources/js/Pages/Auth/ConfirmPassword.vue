<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    password: "",
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthLayout>
        <Head :title="$t('global.auth.confirm_password_title')" />

        <h6 class="text-h6 text-center mb-4">
            {{ $t("global.auth.confirm_password_title") }}
        </h6>

        <div class="text-body-1 text-medium-emphasis mb-6">
            {{ $t("global.auth.confirm_password_message") }}
        </div>

        <form @submit.prevent="submit" class="loginForm">
            <div class="mb-6">
                <v-label>{{ $t("global.common.fields.password") }}</v-label>
                <v-text-field
                    v-model="form.password"
                    :error-messages="form.errors.password"
                    required
                    variant="outlined"
                    color="primary"
                    hide-details="auto"
                    :type="showPassword ? 'text' : 'password'"
                    class="mt-2"
                    autocomplete="current-password"
                    autofocus
                    :append-inner-icon="
                        showPassword ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="showPassword = !showPassword"
                ></v-text-field>
            </div>

            <v-btn
                color="primary"
                :loading="form.processing"
                block
                class="mt-4"
                variant="flat"
                size="large"
                type="submit"
            >
                {{ $t("global.auth.confirm_button") }}
            </v-btn>
        </form>
    </AuthLayout>
</template>

<style lang="scss">
.loginForm {
    .v-text-field .v-field--active input {
        font-weight: 500;
    }
}
</style>
