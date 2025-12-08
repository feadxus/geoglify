<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    role: Object,
    permissions: Object,
});

const form = useForm({
    title: props.role.title,
    description: props.role.description,
    permissions: props.permissions.map((permission) => ({
        id: permission.id,
        title: permission.title,
        code: permission.code,
        selected:
            props.role.permissions.find((p) => p.id === permission.id) !==
            undefined,
    })),
});

// Group permissions by module (users_, roles_, etc.)
const groupedPermissions = computed(() => {
    const groups = {};

    form.permissions.forEach((permission) => {
        // Extract module name from permission code (e.g., "users" from "users_create")
        const moduleName = permission.code.split('_')[0];

        if (!groups[moduleName]) {
            groups[moduleName] = [];
        }

        groups[moduleName].push(permission);
    });

    return groups;
});

// Select/Deselect all permissions
const selectAll = () => {
    form.permissions.forEach(p => p.selected = true);
};

const deselectAll = () => {
    form.permissions.forEach(p => p.selected = false);
};

const updateRole = () => {
    // Create a new list containing only the IDs of selected permissions without modifying form.permissions
    const selectedPermissionIds = form.permissions
        .filter((permission) => permission.selected)
        .map((permission) => permission.id);

    // Submit form data, including selected permissions
    form.transform((data) => ({
        ...data,
        permissions: selectedPermissionIds,
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
            <v-card class="mx-auto pa-3" :title="$t('global.roles.edit_title')">
                <v-divider class="mx-5" />

                <v-card-text class="mt-5">
                    <v-text-field v-model="form.title" :label="$t('global.common.fields.name')" variant="outlined"
                        :error-messages="form.errors.title" class="mb-5" />

                    <v-text-field v-model="form.description" :label="$t('global.common.fields.description')"
                        variant="outlined" :error-messages="form.errors.description" class="mb-5" />

                    <!-- Permissions Selection -->
                    <v-card :title="$t('global.roles.permissions')" :subtitle="form.errors.permissions
                        ? form.errors.permissions
                        : $t('global.roles.select_permissions')
                        " variant="outlined" :color="form.errors.permissions ? 'red' : ''" :style="form.errors.permissions
                            ? ''
                            : 'border: 1px solid #6b728099'
                            ">
                        <v-card-text class="mt-5">
                            <!-- Global Select/Deselect buttons -->
                            <div class="mb-5">
                                <v-btn size="small" color="primary" variant="tonal" @click="selectAll" class="mr-2">
                                    {{ $t("global.actions.select_all") }}
                                </v-btn>
                                <v-btn size="small" color="secondary" variant="tonal" @click="deselectAll">
                                    {{ $t("global.actions.deselect_all") }}
                                </v-btn>
                            </div>

                            <!-- Grouped Permissions with Expansion Panels -->
                            <v-expansion-panels variant="accordion" multiple>
                                <v-expansion-panel v-for="(permissions, groupName) in groupedPermissions"
                                    :key="groupName" :value="groupName">
                                    <v-expansion-panel-title>
                                        <div class="d-flex align-center justify-space-between" style="width: 100%">
                                            <span class="text-capitalize font-weight-medium">
                                                {{ $t(`global.roles.groups.${groupName}`, groupName) }}
                                            </span>
                                            <v-chip size="small" color="primary" variant="tonal">
                                                {{permissions.filter(p => p.selected).length}} / {{ permissions.length
                                                }}
                                            </v-chip>
                                        </div>
                                    </v-expansion-panel-title>
                                    <v-expansion-panel-text>
                                        <v-row dense>
                                            <v-col v-for="permission in permissions" :key="permission.id" cols="12"
                                                sm="6" md="4" lg="3">
                                                <v-checkbox v-model="permission.selected"
                                                    :label="$t(`global.${permission.title}`)" hide-details
                                                    density="compact" />
                                            </v-col>
                                        </v-row>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </v-card-text>
                    </v-card>
                </v-card-text>

                <v-card-actions class="px-5">
                    <v-btn :href="route('roles.index')" color="primary" variant="tonal">{{ $t("global.actions.cancel")
                        }}</v-btn>

                    <v-spacer></v-spacer>

                    <v-btn v-if="$page.props.auth.can.roles_edit" type="submit" color="primary" variant="flat"
                        class="mt-5">{{
                            $t("global.actions.update") }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </AuthenticatedLayout>
</template>
