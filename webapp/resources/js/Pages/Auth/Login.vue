<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <AuthLayout>

        <Head :title="$t('global.auth.login_title')" />

        <div class="d-flex justify-space-between align-center">
            <h6 class="text-h6 text-center mb-0">
                {{ $t("global.auth.login_title") }}
            </h6>
            <div>
                <Link :href="route('login.otp')" class="text-primary text-decoration-none mr-4">
                    {{ $t('global.auth.otp.login_code') }}
                </Link>
                <Link :href="route('register')" class="text-primary text-decoration-none">
                    {{ $t("global.auth.register_question") }}
                </Link>
            </div>
        </div>

        <form @submit.prevent="submit" class="mt-7 loginForm">
            <div class="mb-5">
                <v-label>{{ $t("global.common.fields.email") }}</v-label>
                <v-text-field v-model="form.email" :error-messages="form.errors.email" class="mt-2" required
                    hide-details="auto" variant="outlined" color="primary" autocomplete="username" autofocus
                    placeholder="email"></v-text-field>
            </div>

            <div class="mb-5">
                <v-label>{{ $t("global.common.fields.password") }}</v-label>
                <v-text-field v-model="form.password" :error-messages="form.errors.password" required variant="outlined"
                    color="primary" hide-details="auto" :type="showPassword ? 'text' : 'password'" class="mt-2"
                    autocomplete="current-password" :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'
                        " @click:append-inner="showPassword = !showPassword" placeholder="password"></v-text-field>
            </div>

            <div class="d-flex align-center mt-5 mb-7 mb-sm-0">
                <v-checkbox v-model="form.remember" :label="$t('global.auth.remember_me')" color="primary" class="ms-n2"
                    hide-details></v-checkbox>
                <div class="ml-auto">
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="text-darkText link-hover text-decoration-none">
                        {{ $t("global.auth.forgot_password") }}
                    </Link>
                </div>
            </div>

            <v-btn color="primary" :loading="form.processing" block class="mt-5" variant="flat" size="large"
                type="submit">
                {{ $t("global.auth.login_button") }}
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
