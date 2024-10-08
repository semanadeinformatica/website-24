<script setup lang="ts">
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import ActionSection from "@/Components/ActionSection.vue";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import route from "ziggy-js";
import type Session from "@/Types/Session";

interface Props {
    sessions: Session[];
}

defineProps<Props>();

const confirmingLogout = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password: "",
});

const confirmLogout = () => {
    confirmingLogout.value = true;

    setTimeout(() => passwordInput.value?.focus(), 250);
};

const logoutOtherBrowserSessions = () => {
    form.delete(route("other-browser-sessions.destroy"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingLogout.value = false;

    form.reset();
};
</script>

<template>
    <ActionSection>
        <template #title> Sessões do Browser</template>

        <template #description>
            Gere e regista as tuas sessões ativas em outros navegadores e
            dispositivos.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-2024-light-blue">
                Se necessário, podes terminar a sessão de todos os outros
                navegadores em todos os teus dispositivos. Algumas das tuase
                sessões recentes estão listadas abaixo; No entanto, esta lista
                pode não estar completa. Se achas que a tua conta foi
                comprometida, também deves atualizar a tua senha.
            </div>

            <!-- Other Browser Sessions -->
            <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div
                    v-for="(session, i) in sessions"
                    :key="i"
                    class="flex items-center"
                >
                    <div>
                        <svg
                            v-if="session.agent.is_desktop"
                            class="h-8 w-8 text-2024-light-blue"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"
                            />
                        </svg>

                        <svg
                            v-else
                            class="h-8 w-8 text-2024-light-blue"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"
                            />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-2024-light-blue">
                            {{
                                session.agent.platform
                                    ? session.agent.platform
                                    : "Unknown"
                            }}
                            -
                            {{
                                session.agent.browser
                                    ? session.agent.browser
                                    : "Unknown"
                            }}
                        </div>

                        <div>
                            <div class="text-xs text-2024-blue">
                                {{ session.ip_address }},

                                <span
                                    v-if="session.is_current_device"
                                    class="font-semibold text-2024-blue"
                                    >This device</span
                                >
                                <span v-else
                                    >Last active {{ session.last_active }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 flex items-center">
                <PrimaryButton @click="confirmLogout">
                    Terminar sessão noutros navegadores
                </PrimaryButton>

                <ActionMessage :on="form.recentlySuccessful" class="ml-3">
                    Pronto.
                </ActionMessage>
            </div>

            <!-- Log Out Other Devices Confirmation Modal -->
            <DialogModal :show="confirmingLogout" @close="closeModal">
                <template #title>Terminar sessão noutros navegadores </template>

                <template #content>
                    Por favor, digite sua senha para confirmar que você gostaria
                    de registrar fora de suas outras sessões de navegador em
                    todas as suas dispositivos.

                    <TextInput
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        label="Password"
                        autocomplete="current-password"
                        :error-message="form.errors.password"
                        @keyup.enter="logoutOtherBrowserSessions"
                    />
                </template>

                <template #footer>
                    <PrimaryButton @click="closeModal"> Cancel </PrimaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="logoutOtherBrowserSessions"
                    >
                        Terminar sessão noutros navegadores
                    </PrimaryButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
@/Types/Session
