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
            <v-breadcrumbs
                :items="[
                    {
                        title: $t('global.common.home'),
                        disabled: false,
                        href: '/',
                    },
                    { title: $t('global.profile.title'), disabled: true },
                ]"
                divider="/"
            />
        </template>

        <v-card class="mx-auto pa-3" border>
            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
            />
        </v-card>

        <v-card class="mx-auto pa-3 mt-4" border>
            <UpdatePasswordForm />
        </v-card>

        <v-card class="mx-auto pa-3 mt-4" border>
            <DeleteUserForm />
        </v-card>
    </AuthenticatedLayout>
</template>
