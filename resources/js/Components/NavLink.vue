<script setup lang="ts">
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

interface Props {
    href: string;
    active?: boolean;
}

const props = defineProps<Props>();

const classes = computed(() => {
    return props.active
        ? "inline-flex items-center px-1 py-1 border-b border-2024-black text-lg lg:text-lg font-medium leading-5 text-2024-black focus:outline-none focus:border-2024-black transition duration-150 ease-in-out"
        : "inline-flex items-center px-1 py-1 border-b border-transparent text-lg lg:text-lg font-medium leading-5 text-2024-black hover:border-2024-black focus:outline-none focus:border-2024-black transition duration-150 ease-in-out";
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
