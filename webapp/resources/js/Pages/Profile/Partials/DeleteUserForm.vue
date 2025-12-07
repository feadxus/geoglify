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
    <v-card class="mx-auto pa-3">
        <v-card-title>
            {{ $t("global.profile.delete_account_title") }}
        </v-card-title>

        <v-card-subtitle>
            {{ $t("global.profile.delete_account_description") }}
        </v-card-subtitle>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="error" variant="flat" @click="confirmUserDeletion">{{
                $t("global.profile.delete_account_button")
                }}</v-btn>
        </v-card-actions>

        <v-dialog v-model="confirmingUserDeletion" width="50%">
            <v-card>
                <v-card-title class="px-6 pt-6">
                    <span class="headline">{{
                        $t("global.profile.delete_confirmation_title")
                        }}</span>
                </v-card-title>

                <v-card-text>
                    <v-alert class="mb-4">
                        {{ $t("global.profile.delete_confirmation_message") }}
                    </v-alert>

                    <v-text-field v-model="form.password" :label="$t('global.common.fields.password')" outlined dense
                        required variant="outlined" autocomplete="current-password" type="password"
                        :error-messages="form.errors.password"></v-text-field>
                </v-card-text>

                <v-card-actions class="px-5">
                    <v-btn variant="text" @click="closeModal">{{
                        $t("global.actions.cancel")
                        }}</v-btn>
                    <v-btn color="error" variant="flat" @click="deleteUser">{{
                        $t("global.profile.delete_account_button")
                        }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>
