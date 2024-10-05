<script setup lang="ts">
import type { ButtonHTMLAttributes } from "vue";

interface Props {
    type?: ButtonHTMLAttributes["type"];
    color?: string;
    shadow?: string;
    textSize?: string;
    padding?: string;
}

const buttonColor: Record<string, string> = {
    orange: "bg-2024-blue",
    "teal-dark": "bg-2024-light-blue",
    "red-dark": "bg-2024-black",
    red: "bg-2024-blue",
    teal: "bg-2024-black",
};

const shadowColor: Record<string, string> = {
    orange: "shadow-2024-blue",
    "teal-dark": "shadow-2024-light-blue",
    "red-dark": "shadow-2024-black",
    red: "shadow-2024-blue",
    teal: "shadow-2024-black",
};

withDefaults(defineProps<Props>(), {
    type: "submit",
    color: "teal",
    shadow: "orange",
    textSize: "text-md",
    padding: "",
});
</script>

<template>
    <button
        :type="type"
        class="text-md relative inline-flex items-center border border-black px-2 py-2 font-semibold text-white transition-shadow hover:shadow-md active:shadow-none"
        :class="[buttonColor[color], shadowColor[shadow], textSize, padding]"
    >
        <slot />
    </button>
</template>
