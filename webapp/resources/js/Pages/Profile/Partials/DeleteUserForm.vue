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

        <v-divider class="mx-4" />

        <v-card-text class="mt-5">
            {{ $t("global.profile.delete_account_description") }}
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="error" variant="flat" @click="confirmUserDeletion">{{
                $t("global.profile.delete_account_button")
                }}</v-btn>
        </v-card-actions>

        <v-dialog v-model="confirmingUserDeletion" width="50%">
            <v-card>
                <v-card-title class="px-5 pt-5">
                    <span class="headline">{{
                        $t("global.profile.delete_confirmation_title")
                        }}</span>
                </v-card-title>

                <v-divider class="mx-4" />

                <v-card-text class="px-5">
                    <v-alert class="mb-5">
                        {{ $t("global.profile.delete_confirmation_message") }}
                    </v-alert>

                    <div class="mt-5">
                        <v-text-field v-model="form.password" type="password" class="mt-1 block"
                            :label="$t('global.profile.fields.password')" variant="outlined"
                            :placeholder="$t('global.profile.fields.password')" @keyup.enter="deleteUser"
                            :error-messages="form.errors.password" />
                    </div>
                </v-card-text>

                <v-card-actions class="px-5 pb-6">
                    <v-btn color="primary" variant="tonal" @click="closeModal">{{
                        $t("global.actions.cancel")
                        }}</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="red" variant="flat" @click="deleteUser">{{
                        $t("global.profile.delete_account_button")
                        }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>
