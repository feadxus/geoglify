<script>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head, // eslint-disable-line vue/no-reserved-component-names
    },
    data() {
        return {
            search: "",
            page: 1,
            itemsPerPage: 10,
            totalItems: 0,
            loading: false,
            serverItems: [],

            // Headers for the data table
            headers: [
                {
                    title: this.$t("global.common.fields.name"),
                    key: "name",
                    align: "start",
                    sortable: false,
                },
                {
                    title: this.$t("global.common.fields.email"),
                    key: "email",
                    align: "start",
                    sortable: false,
                },
                { title: "", key: "actions", align: "end", sortable: false },
            ],

            deleteModalOpen: false,
            deleteId: null,
        };
    },
    methods: {
        // Method to load items
        loadItems({ page, itemsPerPage, search }) {
            // Set loading to true
            this.loading = true;

            // Fetch items from the server
            fetch(route("users.list"), {
                method: "post",
                body: JSON.stringify({
                    page: page,
                    itemsPerPage: itemsPerPage,
                    search: search,
                }),
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    this.serverItems = data.items;
                    this.totalItems = data.total;
                    this.loading = false;
                })
                .catch(() => {
                    // Failed to fetch data from the server
                    this.loading = false;
                    this.serverItems = [];
                    this.totalItems = 0;
                });
        },

        // Method to delete a user
        openDeleteModal(id) {
            this.deleteId = id;
            this.deleteModalOpen = true;
        },

        // Method to close the modal
        closeModal() {
            this.deleteId = null;
            this.deleteModalOpen = false;
        },

        // Method to delete the user
        async deleteUser() {
            // Close the modal
            this.deleteModalOpen = false;

            // Delete the user
            await fetch(route("users.destroy", this.deleteId), {
                method: "DELETE",
            }).then(() => {
                // Reload the items
                this.loadItems({
                    page: this.page,
                    itemsPerPage: this.itemsPerPage,
                    search: this.search,
                });
            });
        },
    },
};
</script>

<template>
    <Head :title="$t('global.users.title')" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <v-breadcrumbs
                :items="[
                    {
                        title: $t('global.common.home'),
                        disabled: false,
                        href: '/',
                    },
                    { title: $t('global.users.title'), disabled: true },
                ]"
                divider="/"
            />
        </template>

        <v-card
            class="mx-auto pa-3"
            variant="flat"
            :title="$t('global.users.title')"
        >
            <template #append>
                <v-btn
                    v-if="$page.props.auth.can.users_create"
                    color="primary"
                    variant="flat"
                    :href="route('users.create')"
                    class="ml-2"
                    >{{ $t("global.actions.create") }}</v-btn
                >
            </template>

            <v-card-text>
                <v-text-field
                    v-model="search"
                    :label="$t('global.common.search')"
                    prepend-inner-icon="mdi-magnify"
                    variant="outlined"
                    hide-details
                    single-line
                ></v-text-field>

                <v-data-table-server
                    v-model:items-per-page="itemsPerPage"
                    :headers="headers"
                    :items="serverItems"
                    :items-length="totalItems"
                    :loading="loading"
                    :search="search"
                    @update:options="loadItems"
                >


                    <template #item.actions="{ item }">
                        <v-btn
                            v-if="$page.props.auth.can.users_edit"
                            color="black"
                            class="ml-2"
                            variant="text"
                            density="comfortable"
                            icon
                            :href="route('users.edit', item.id)"
                        >
                            <v-icon>mdi-pencil</v-icon>
                        </v-btn>
                        <v-btn
                            v-if="$page.props.auth.can.users_destroy"
                            color="red"
                            class="ml-2"
                            variant="text"
                            density="comfortable"
                            icon
                            @click="openDeleteModal(item.id)"
                        >
                            <v-icon>mdi-delete</v-icon>
                        </v-btn>
                    </template>
                </v-data-table-server>
            </v-card-text>
        </v-card>

        <v-dialog v-model="deleteModalOpen" width="500">
            <v-card>
                <v-card-title class="px-6">
                    <span class="headline px-3">{{
                        $t("global.users.delete_confirmation_title")
                    }}</span>
                </v-card-title>

                <v-card-text>
                    <v-alert class="mb-4">
                        {{ $t("global.users.delete_warning") }}
                    </v-alert>
                </v-card-text>

                <v-card-actions class="px-6">
                    <v-btn color="grey" @click="closeModal">{{
                        $t("global.actions.cancel")
                    }}</v-btn>
                    <v-btn
                        v-if="$page.props.auth.can.users_destroy"
                        color="red"
                        class="mr-2"
                        @click="deleteUser"
                        >{{ $t("global.actions.delete") }}</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </AuthenticatedLayout>
</template>
