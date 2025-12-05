<script setup>
import { useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route("profile.update"), {
        onFinish: () => (form.recentlySuccessful = true),
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="font-weight-black">
                {{ $t("global.profile.information_title") }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ $t("global.profile.information_description") }}
            </p>
        </header>

        <form class="mt-6 space-y-6">
            <v-text-field
                v-model="form.name"
                :label="$t('global.common.fields.name')"
                required
                variant="outlined"
                class="mt-4"
                autocomplete="name"
                :error-messages="form.errors.name"
            ></v-text-field>

            <v-text-field
                v-model="form.email"
                :label="$t('global.common.fields.email')"
                required
                variant="outlined"
                class="mt-4"
                autocomplete="username"
                :error-messages="form.errors.email"
            ></v-text-field>

            <v-alert
                v-if="mustVerifyEmail && user.email_verified_at === null"
                class="text-sm mt-2 text-gray-800 dark:text-gray-200"
            >
                {{ $t("global.profile.email_unverified") }}

                <v-btn variant="text" :href="route('verification.send')">
                    {{ $t("global.profile.resend_verification") }}
                </v-btn>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-400"
                >
                    {{ $t("global.profile.verification_sent") }}
                </div>
            </v-alert>

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
                @click.prevent="submit"
                >{{ $t("global.actions.save") }}</v-btn
            >
        </form>
    </section>
</template>
