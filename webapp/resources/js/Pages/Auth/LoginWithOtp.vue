<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("login.otp.store"));
};
</script>

<template>
    <AuthLayout>

        <Head :title="$t('global.auth.otp.login_code')" />

        <div class="d-flex justify-space-between align-center">
            <h6 class="text-h6 text-center mb-0">
                {{ $t('global.auth.otp.login_code') }}
            </h6>
            <Link :href="route('login')" class="text-primary text-decoration-none">
                {{ $t('global.auth.otp.back_login') }}
            </Link>
        </div>

        <div class="text-body-2 text-medium-emphasis mt-2 mb-7">
            {{ $t('global.auth.otp.enter_email') }}
        </div>

        <form @submit.prevent="submit" class="mt-7 loginForm">
            <div class="mb-5">
                <v-label>{{ $t('global.common.fields.email') }}</v-label>
                <v-text-field v-model="form.email" :error-messages="form.errors.email" class="mt-2" required
                    hide-details="auto" variant="outlined" color="primary" autocomplete="username" autofocus
                    :placeholder="$t('global.common.fields.email')"></v-text-field>
            </div>

            <v-btn color="primary" :loading="form.processing" block class="mt-5" variant="flat" size="large"
                type="submit">
                {{ $t('global.auth.otp.send_code') }}
            </v-btn>
        </form>
    </AuthLayout>
</template>
