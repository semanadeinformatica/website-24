<script setup lang="ts">
import { ref, watch, type UnwrapRef, onMounted, computed } from "vue";
import { type Tabs } from "@/Types/ProfilePage";

type Props = {
    buttons: Tabs;
};

const props = defineProps<Props>();

const buttons = computed(() => props.buttons);

const selected = ref<HTMLElement | null>(null);

const firstType = Object.keys(buttons.value)[0];

const selectedType = ref<keyof typeof buttons.value>(firstType);

watch(selected, (newValue, oldValue) => {
    oldValue?.classList.toggle("selected");
    newValue?.classList.toggle("selected");

    selectedType.value =
        (newValue?.dataset.type as UnwrapRef<typeof selectedType>) ?? firstType;
});

const view = computed(() => {
    return buttons.value[selectedType.value]?.component;
});

const toggle = ({ target }: MouseEvent) => {
    selected.value = target as HTMLElement;
};

onMounted(() => {
    selected.value = document.querySelector<HTMLElement>(
        "#tab-picker > button:first-of-type",
    );

    if (selected.value)
        selectedType.value =
            (selected.value.dataset.type as UnwrapRef<typeof selectedType>) ??
            firstType;
});
</script>

<template>
    <section class="flex h-full w-full flex-1 flex-col pt-10">
        <div
            id="tab-picker"
            class="flex flex-row justify-center gap-4 pt-5 font-bold text-2024-black"
        >
            <button
                v-for="(button, id) in buttons"
                :key="id"
                class="transition"
                :data-type="id"
                @click="toggle"
            >
                {{ button.label }}
            </button>
        </div>
        <KeepAlive>
            <component :is="view"></component>
        </KeepAlive>
    </section>
</template>

<!-- TODO: CHANGE THIS EVERY YEAR -->
<style scoped>
.selected {
    color: rgb(0,0 , 170);
    text-decoration: underline;
}
</style>
