<script setup lang="ts">
import type Staff from "@/Types/Staff";
import { OhVueIcon } from "oh-vue-icons";
import { computed } from "vue";

const borderColor: Record<string, string> = {
    orange: "border-2024-blue",
    "teal-dark": "border-2024-light-blue",
    "red-dark": "border-2024-black",
    red: "border-2024-blue",
    teal: "border-2024-black",
};

const textColor: Record<string, string> = {
    orange: "text-2024-blue",
    "teal-dark": "text-2024-light-blue",
    "red-dark": "text-2024-black",
    red: "text-2024-blue",
    teal: "text-2024-black",
};

const socialIcon: Record<string, string> = {
    github: "io-logo-github",
    linkedin: "io-logo-linkedin",
    website: "io-globe",
};

const bgColor: Record<string, string> = {
    orange: "bg-2024-blue",
    "teal-dark": "bg-2024-light-blue",
    "red-dark": "bg-2024-black",
    red: "bg-2024-blue",
    teal: "bg-2024-black",
};

const props = defineProps<{
    color: string;
    staff: Staff;
}>();

const staff = computed(() => props.staff);
const color = computed(() => props.color);

const socialMedia = computed(() => {
    return Object.fromEntries(
        Object.entries(staff.value.participant?.social_media ?? {}).filter(
            ([key, value]) =>
                ["github", "linkedin", "website"].includes(key) &&
                value != null,
        ),
    ) as Record<"github" | "linkedin" | "website", string>;
});
</script>

<template>
    <div
        class="group-hover group relative flex w-fit flex-col items-center overflow-y-hidden  border-4"
        :class="borderColor[color]"
    >
        <img
            :src="staff.participant?.user?.profile_photo_url"
            :alt="`${staff.participant?.user?.name}'s image`"
            class="h-40 w-40 object-cover"
        />
        <div
            v-if="Object.keys(socialMedia).length > 0"
            class="absolute -bottom-32 flex w-full flex-row items-center justify-center pb-10 pt-1 transition-all group-hover:-bottom-7"
            :class="bgColor[color]"
        >
            <a
                v-for="(social, key, idx) in socialMedia"
                :key="idx"
                :href="social"
                target="_blank"
            >
                <OhVueIcon
                    fill="white"
                    :name="socialIcon[key]"
                    scale="1.4"
                ></OhVueIcon>
            </a>
        </div>
    </div>
    <p class="max-w-[13em] text-center font-bold" :class="textColor[color]">
        {{ staff.participant?.user?.name }}
    </p>
</template>

<style></style>
