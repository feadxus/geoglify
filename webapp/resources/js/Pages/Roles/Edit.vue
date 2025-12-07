<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    role: Object,
    permissions: Object,
});

const form = useForm({
    title: props.role.title,
    description: props.role.description,
    permissions: props.permissions.map((permission) => ({
        id: permission.id,
        description: permission.description,
        selected:
            props.role.permissions.find((p) => p.id === permission.id) !==
            undefined,
    })),
});

const updateRole = () => {
    // Create a new list containing only the IDs of selected permissions without modifying form.permissions
    const selectedPermissions = form.permissions
        .filter((permission) => permission.selected)
        .map((permission) => permission.id);

    // Submit form data, including selected permissions
    form.transform((data) => ({
        ...data,
        permissions: selectedPermissions,
    })).put(route("roles.update", props.role.id), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>

    <Head :title="$t('global.roles.edit_title')" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <v-breadcrumbs :items="[
                {
                    title: $t('global.common.home'),
                    disabled: false,
                    href: '/',
                },
                {
                    title: $t('global.roles.title'),
                    disabled: false,
                    href: route('roles.index'),
                },
                { title: $t('global.actions.edit'), disabled: true },
            ]" divider="/" />
        </template>

        <v-form @submit.prevent="updateRole">
            <v-card class="mx-auto pa-3" :title="$t('global.roles.edit_title')"
                :subtitle="$t('global.roles.edit_subtitle')">
                <v-card-text>
                    <v-text-field v-model="form.title" :label="$t('global.common.fields.name')" variant="outlined"
                        :error-messages="form.errors.title" class="mb-4" />

                    <v-text-field v-model="form.description" :label="$t('global.common.fields.description')"
                        variant="outlined" :error-messages="form.errors.description" class="mb-4" />

                    <v-card :title="$t('global.roles.permissions')" :subtitle="form.errors.permissions
                            ? form.errors.permissions
                            : $t('global.roles.select_permissions')
                        " variant="outlined" :color="form.errors.permissions ? 'red' : ''" :style="form.errors.permissions
                                ? ''
                                : 'border: 1px solid #6b728099'
                            ">
                        <v-card-text>
                            <v-row dense>
                                <v-col v-for="permission in form.permissions" :key="permission.id" cols="12" md="3">
                                    <v-checkbox v-model="permission.selected" :label="permission.description"
                                        hide-details />
                                </v-col>
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-card-text>

                <v-card-actions class="px-4">
                    <v-btn :href="route('roles.index')" color="primary" variant="tonal">{{ $t("global.actions.cancel")
                        }}</v-btn>

                    <v-spacer></v-spacer>

                    <v-btn v-if="$page.props.auth.can.roles_edit" type="submit" color="primary" variant="flat"
                        class="mt-4">{{
                            $t("global.actions.update") }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </AuthenticatedLayout>
</template>
