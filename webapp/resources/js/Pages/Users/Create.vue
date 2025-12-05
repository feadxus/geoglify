<script setup>
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    roles: Array,
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    role_id: null,
});

const createUser = () => {
    form.post(route("users.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head :title="$t('global.users.create_title')" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <v-breadcrumbs
                :items="[
                    {
                        title: $t('global.common.home'),
                        disabled: false,
                        href: '/',
                    },
                    {
                        title: $t('global.users.title'),
                        disabled: false,
                        href: route('users.index'),
                    },
                    { title: $t('global.actions.create'), disabled: true },
                ]"
                divider="/"
            />
        </template>

        <v-form @submit.prevent="createUser">
            <v-card
                class="mx-auto pa-3"
                variant="flat"
                :title="$t('global.users.create_title')"
                :subtitle="$t('global.users.create_subtitle')"
            >
                <v-card-text>
                    <v-text-field
                        v-model="form.name"
                        :label="$t('global.common.fields.name')"
                        required
                        variant="outlined"
                        :error-messages="form.errors.name"
                        class="mb-4"
                    />

                    <v-text-field
                        v-model="form.email"
                        :label="$t('global.common.fields.email')"
                        required
                        variant="outlined"
                        :error-messages="form.errors.email"
                        autocomplete="new-email"
                        class="mb-4"
                    />

                    <v-text-field
                        v-model="form.password"
                        :label="$t('global.common.fields.password')"
                        required
                        variant="outlined"
                        :error-messages="form.errors.password"
                        type="password"
                        autocomplete="new-password"
                        class="mb-4"
                    />

                    <v-text-field
                        v-model="form.password_confirmation"
                        :label="
                            $t('global.common.fields.password_confirmation')
                        "
                        required
                        variant="outlined"
                        :error-messages="form.errors.password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        class="mb-4"
                    />

                    <v-select
                        v-model="form.role_id"
                        :label="$t('global.users.fields.role')"
                        outlined
                        dense
                        required
                        variant="outlined"
                        :items="props.roles"
                        item-value="id"
                        item-title="title"
                        class="mb-4"
                        :error-messages="form.errors.role_id"
                    ></v-select>
                </v-card-text>
                <v-card-actions class="px-4">
                    <v-btn
                        :href="route('users.index')"
                        color="primary"
                        variant="tonal"
                        class="mr-2"
                        >{{ $t("global.actions.cancel") }}</v-btn
                    >
                    <v-spacer></v-spacer>
                    <v-btn
                        v-if="$page.props.auth.can.users_create"
                        type="submit"
                        color="primary"
                        variant="flat"
                        >{{ $t("global.actions.create") }}</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-form>
    </AuthenticatedLayout>
</template>
