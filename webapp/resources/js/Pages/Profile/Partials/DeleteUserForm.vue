<script setup>
import { useForm } from "@inertiajs/vue3";
import { nextTick, ref } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route("profile.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="font-weight-black">
                {{ $t("global.profile.delete_account_title") }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ $t("global.profile.delete_account_description") }}
            </p>
        </header>

        <v-btn color="red" elevation="0" @click="confirmUserDeletion">{{
            $t("global.profile.delete_account_button")
        }}</v-btn>

        <v-dialog v-model="confirmingUserDeletion" width="500">
            <v-card>
                <v-card-title class="px-6">
                    <span class="headline px-3">{{
                        $t("global.profile.delete_confirmation_title")
                    }}</span>
                </v-card-title>

                <v-card-text>
                    <v-alert class="mb-4">
                        {{ $t("global.profile.delete_confirmation_message") }}
                    </v-alert>

                    <v-text-field
                        v-model="form.password"
                        :label="$t('global.common.fields.password')"
                        outlined
                        dense
                        required
                        variant="outlined"
                        autocomplete="current-password"
                        type="password"
                        :error-messages="form.errors.password"
                    ></v-text-field>
                </v-card-text>

                <v-card-actions class="px-6">
                    <v-btn color="grey" @click="closeModal">{{
                        $t("global.actions.cancel")
                    }}</v-btn>
                    <v-btn color="red" @click="deleteUser">{{
                        $t("global.profile.delete_account_button")
                    }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </section>
</template>
