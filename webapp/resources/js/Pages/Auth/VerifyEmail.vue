<script setup>
import { computed } from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"));
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent",
);
</script>

<template>
    <AuthLayout>
        <Head :title="$t('global.auth.verify_email_title')" />

        <h6 class="text-h6 text-center mb-4">
            {{ $t("global.auth.verify_email_title") }}
        </h6>

        <div class="text-body-1 text-medium-emphasis mb-6">
            {{ $t("global.auth.verify_email_message") }}
        </div>

        <v-alert
            v-if="verificationLinkSent"
            class="mb-4"
            variant="tonal"
            color="success"
        >
            {{ $t("global.auth.verification_link_sent") }}
        </v-alert>

        <form @submit.prevent="submit">
            <v-btn
                color="primary"
                :loading="form.processing"
                block
                class="mt-4"
                variant="flat"
                size="large"
                type="submit"
            >
                {{ $t("global.auth.resend_verification") }}
            </v-btn>

            <div class="d-flex justify-center mt-4">
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="text-primary text-decoration-none"
                >
                    {{ $t("global.auth.logout") }}
                </Link>
            </div>
        </form>
    </AuthLayout>
</template>
