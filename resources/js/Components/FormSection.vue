<script setup lang="ts">
import { computed, useSlots } from "vue";
import SectionTitle from "./SectionTitle.vue";

interface Emits {
    (event: "submitted"): void;
}

defineEmits<Emits>();

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div class="flex flex-col">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0">
            <form @submit.prevent="$emit('submitted')">
                <div class="bg-2024-bg px-4 py-5 sm:p-6">
                    <div class="flex flex-col gap-5">
                        <slot name="form" />
                    </div>
                </div>

                <div
                    v-if="hasActions"
                    class="flex items-center justify-end bg-2024-bg px-4 py-3 text-right sm:px-6"
                >
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
