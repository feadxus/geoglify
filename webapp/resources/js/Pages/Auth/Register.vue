<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <AuthLayout>
        <Head :title="$t('global.auth.register_title')" />

        <div class="d-flex justify-space-between align-center">
            <h6 class="text-h6 text-center mb-0">
                {{ $t("global.auth.register_title") }}
            </h6>
            <Link
                :href="route('login')"
                class="text-primary text-decoration-none"
            >
                {{ $t("global.auth.already_have_account") }}
            </Link>
        </div>

        <form @submit.prevent="submit" class="mt-7 loginForm">
            <div class="mb-6">
                <v-label>{{ $t("global.common.fields.name") }}</v-label>
                <v-text-field
                    v-model="form.name"
                    :error-messages="form.errors.name"
                    class="mt-2"
                    required
                    hide-details="auto"
                    variant="outlined"
                    color="primary"
                    autocomplete="name"
                    placeholder="John Doe"
                ></v-text-field>
            </div>

            <div class="mb-6">
                <v-label>{{ $t("global.common.fields.email") }}</v-label>
                <v-text-field
                    v-model="form.email"
                    :error-messages="form.errors.email"
                    class="mt-2"
                    required
                    hide-details="auto"
                    variant="outlined"
                    color="primary"
                    autocomplete="username"
                    placeholder="demo@company.com"
                ></v-text-field>
            </div>

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
                    autocomplete="new-password"
                    placeholder="*****"
                    :append-inner-icon="
                        showPassword ? 'mdi-eye-off' : 'mdi-eye'
                    "
                    @click:append-inner="showPassword = !showPassword"
                ></v-text-field>
            </div>

            <div class="mb-6">
                <v-label>{{
                    $t("global.common.fields.password_confirmation")
                }}</v-label>
                <v-text-field
                    v-model="form.password_confirmation"
                    :error-messages="form.errors.password_confirmation"
                    required
                    variant="outlined"
                    color="primary"
                    hide-details="auto"
                    :type="showPassword ? 'text' : 'password'"
                    class="mt-2"
                    autocomplete="new-password"
                    placeholder="*****"
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
                {{ $t("global.auth.register_button") }}
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
