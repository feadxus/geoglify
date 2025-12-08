<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import OtpInput from "@/Components/OtpInput.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
});

const form = useForm({
    email: props.email,
    otp: "",
});

const submit = () => {
    form.post(route("login.otp.confirm"), {
        onFinish: () => form.reset("otp"),
    });
};

const onFinish = (code) => {
    form.otp = code;
    submit();
};
</script>

<template>
    <AuthLayout>

        <Head :title="$t('global.auth.otp.verify_code')" />

        <div class="d-flex justify-space-between align-center">
            <h6 class="text-h6 text-center mb-0">
                {{ $t('global.auth.otp.verify_code') }}
            </h6>
            <Link :href="route('login.otp')" class="text-primary text-decoration-none">
                {{ $t('global.auth.otp.change_email') }}
            </Link>
        </div>

        <div class="text-body-2 text-medium-emphasis mt-2 mb-7">
            {{ $t('global.auth.otp.enter_code', { email: email }) }}
        </div>

        <form @submit.prevent="submit" class="mt-7 loginForm">
            <div class="mb-5 d-flex justify-center">
                <OtpInput v-model="form.otp" @finish="onFinish" />
            </div>

            <div v-if="form.errors.otp" class="text-error text-caption text-center mb-4">
                {{ form.errors.otp }}
            </div>

            <v-btn color="primary" :loading="form.processing" block class="mt-5" variant="flat" size="large"
                type="submit">
                {{ $t('global.auth.otp.verify_login') }}
            </v-btn>

            <div class="text-center mt-6">
                <div class="text-body-2 text-medium-emphasis">
                    {{ $t('global.auth.otp.no_code') }}
                    <Link :href="route('login.otp.store')" method="post" :data="{ email: email }" as="button"
                        class="text-primary text-decoration-none font-weight-bold ml-1">
                        {{ $t('global.auth.otp.resend') }}
                    </Link>
                </div>
            </div>
        </form>
    </AuthLayout>
</template>
