<script setup lang="ts">
import { computed } from "vue";

interface Props {
    checked: boolean;
    value?: string;
}

interface Emits {
    (event: "update:checked", value: boolean): void;
}

const emit = defineEmits<Emits>();

const props = withDefaults(defineProps<Props>(), {
    checked: false,
    value: undefined,
});

const proxyChecked = computed({
    get: () => props.checked,
    set: (val) => emit("update:checked", val),
});
</script>

<template>
    <input
        v-model="proxyChecked"
        type="checkbox"
        :value="value"
        class="border border-black bg-2024-bg shadow-2024-blue outline-none transition-all checked:border-black checked:bg-2024-black hover:shadow checked:hover:border-black checked:hover:bg-2024-light-blue"
    />
</template>
