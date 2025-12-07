<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    roles: Array,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: "",
    password_confirmation: "",
    role_id: props.user.roles && props.user.roles[0] ? props.user.roles[0].id : null,
});

const updateUser = () => {
    form.put(route("users.update", props.user.id), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>

    <Head :title="$t('global.users.edit_title')" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <v-breadcrumbs :items="[
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
                { title: $t('global.actions.edit'), disabled: true },
            ]" divider="/" />
        </template>

        <v-form @submit.prevent="updateUser">
            <v-card class="mx-auto pa-3" :title="$t('global.users.edit_title')"
                :subtitle="$t('global.users.edit_subtitle')">
                <v-card-text>
                    <v-text-field v-model="form.name" :label="$t('global.common.fields.name')" required
                        variant="outlined" :error-messages="form.errors.name" class="mb-4" />

                    <v-text-field v-model="form.email" :label="$t('global.common.fields.email')" required
                        variant="outlined" :error-messages="form.errors.email" autocomplete="new-email" class="mb-4" />

                    <v-text-field v-model="form.password" :label="$t('global.common.fields.password')"
                        variant="outlined" :error-messages="form.errors.password" type="password"
                        autocomplete="new-password" class="mb-4" />

                    <v-text-field v-model="form.password_confirmation" :label="$t('global.common.fields.password_confirmation')
                        " variant="outlined" :error-messages="form.errors.password_confirmation" type="password"
                        autocomplete="new-password" class="mb-4" />


                    <v-select v-model="form.role_id" :label="$t('global.users.fields.role')" required variant="outlined"
                        :items="props.roles" item-value="id" item-title="title" :error-messages="form.errors.role_id"
                        class="mb-4"></v-select>
                </v-card-text>
                <v-card-actions class="px-4">
                    <v-btn :href="route('users.index')" color="primary" variant="tonal" class="mr-2">{{
                        $t("global.actions.cancel") }}</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn v-if="$page.props.auth.can.users_edit" type="submit" color="primary" variant="flat">{{
                        $t("global.actions.update") }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </AuthenticatedLayout>
</template>
