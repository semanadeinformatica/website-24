<script setup lang="ts">
import type Department from "@/Types/Department";
import TeamMember from "./TeamMember.vue";

const shadowColor: Record<string, string> = {
    orange: "shadow-2024-blue",
    "teal-dark": "shadow-2024-light-blue",
    "red-dark": "shadow-2024-black",
    red: "shadow-2024-blue",
    teal: "shadow-2024-black",
};

const textColor: Record<string, string> = {
    orange: "text-2024-blue",
    "teal-dark": "text-2024-light-blue",
    "red-dark": "text-2024-black",
    red: "text-2024-blue",
    teal: "text-2024-black",
};

defineProps<{
    department: Department;
    color: string;
}>();
</script>

<template>
    <section
        v-if="(department.staff?.length ?? 0) > 0"
        class="flex flex-col items-center gap-4"
    >
        <p
            class="w-fit border border-black p-2 px-6 text-center text-xl font-bold shadow"
            :class="textColor[color] || shadowColor[color]"
        >
            {{ department.name }}
        </p>
        <section class="flex flex-row flex-wrap justify-center gap-4">
            <div
                v-for="(staff, idx) in department.staff"
                :key="idx"
                class="flex flex-col items-center"
            >
                <TeamMember :staff="staff" :color="color"></TeamMember>
            </div>
        </section>
    </section>
</template>

<style></style>
