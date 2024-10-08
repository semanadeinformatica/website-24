<script setup lang="ts">
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import ActionSection from "@/Components/ActionSection.vue";
import DialogModal from "@/Components/DialogModal.vue";
import TextInput from "@/Components/TextInput.vue";
import route from "ziggy-js";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password: "",
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value?.focus(), 250);
};

const deleteUser = () => {
    form.delete(route("current-user.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title> Apagar conta</template>

        <template #description> Apaga permanentemente a tua conta. </template>

        <template #content>
            <div class="max-w-xl text-sm text-2024-black">
                Depois de a tua conta ser excluída, todos os teus recursos e
                dados serão apagados permanentemente. Antes de apagares a tua
                conta, por favor faz o download de todos os dados ou informações
                que desejas reter.
            </div>

            <div class="mt-5">
                <PrimaryButton color="red" @click="confirmUserDeletion">
                    Apagar conta
                </PrimaryButton>
            </div>

            <!-- Delete Account Confirmation Modal -->
            <DialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title> Apagar conta </template>

                <template #content>
                    Tens a certeza de que desejas apagar a tua conta? Uma vez
                    que a tua conta é excluída, todos os teus recursos e dados
                    serão apagados permanentemente. Por favor, insere a tua
                    password para confirmar que queres apagar permanentemente a
                    tua conta.

                    <TextInput
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        label="Password"
                        autocomplete="current-password"
                        :error-message="form.errors.password"
                        @keyup.enter="deleteUser"
                    />
                </template>

                <template #footer>
                    <PrimaryButton @click="closeModal"> Cancel </PrimaryButton>

                    <PrimaryButton
                        class="ml-3"
                        color="red"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </PrimaryButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
