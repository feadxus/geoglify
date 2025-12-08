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
    // Client-side validation
    if (!form.name || form.name.trim() === '') {
        form.errors.name = 'The name field is required.';
        return;
    }

    // Clear any previous errors
    form.clearErrors('name');

    form.patch(route("profile.update"), {
        onFinish: () => (form.recentlySuccessful = true),
    });
};
</script>

<template>
    <v-card class="mx-auto pa-3">
        <v-card-title>
            {{ $t("global.profile.information_title") }}
        </v-card-title>

        <v-divider class="mx-4" />

        <v-card-text class="mt-5">
            <v-text-field v-model="form.name" :label="$t('global.common.fields.name')" required variant="outlined"
                autocomplete="name" :error-messages="form.errors.name" class="mb-5"></v-text-field>

            <v-text-field v-model="form.email" :label="$t('global.common.fields.email')" required variant="outlined"
                autocomplete="username" :error-messages="form.errors.email" class="mb-5"></v-text-field>

            <v-alert v-if="mustVerifyEmail && user.email_verified_at === null"
                class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                {{ $t("global.profile.email_unverified") }}

                <v-btn variant="text" :href="route('verification.send')">
                    {{ $t("global.profile.resend_verification") }}
                </v-btn>

                <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-400">
                    {{ $t("global.profile.verification_sent") }}
                </div>
            </v-alert>

            <v-alert v-if="form.recentlySuccessful" class="mt-5" type="success">{{
                $t("global.common.saved") }}</v-alert>
        </v-card-text>

        <v-card-actions class="px-5">
            <v-spacer></v-spacer>
            <v-btn :readonly="form.processing" color="primary" variant="flat" :disabled="form.processing"
                @click.prevent="submit">{{ $t("global.actions.save") }}</v-btn>
        </v-card-actions>
    </v-card>
</template>
