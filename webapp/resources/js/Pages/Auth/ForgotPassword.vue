<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <AuthLayout>

        <Head :title="$t('global.auth.forgot_password_title')" />

        <div class="d-flex justify-space-between align-center mb-5">
            <h6 class="text-h6 text-center mb-0">
                {{ $t("global.auth.forgot_password_title") }}
            </h6>
            <Link :href="route('login')" class="text-primary text-decoration-none">
                {{ $t("global.auth.back_to_login") }}
            </Link>
        </div>

        <div class="text-body-1 text-medium-emphasis mb-5">
            {{ $t("global.auth.forgot_password_message") }}
        </div>

        <v-alert v-if="status" color="success" class="mb-5" variant="tonal">
            {{ status }}
        </v-alert>

        <form @submit.prevent="submit" class="loginForm">
            <div class="mb-5">
                <v-label>{{ $t("global.common.fields.email") }}</v-label>
                <v-text-field v-model="form.email" :error-messages="form.errors.email" class="mt-2" required
                    hide-details="auto" variant="outlined" color="primary" autocomplete="username" autofocus
                    placeholder="demo@company.com"></v-text-field>
            </div>

            <v-btn color="primary" :loading="form.processing" block class="mt-2" variant="flat" size="large"
                type="submit">
                {{ $t("global.auth.reset_button") }}
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
