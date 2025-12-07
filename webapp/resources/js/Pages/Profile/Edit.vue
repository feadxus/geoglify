<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>

    <Head :title="$t('global.profile.title')" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <v-breadcrumbs :items="[
                {
                    title: $t('global.common.home'),
                    disabled: false,
                    href: '/',
                },
                { title: $t('global.profile.title'), disabled: true },
            ]" divider="/" />
        </template>

        <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="mb-5" />

        <UpdatePasswordForm class="mb-5" />

        <DeleteUserForm />

    </AuthenticatedLayout>
</template>
