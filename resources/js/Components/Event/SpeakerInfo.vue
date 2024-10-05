<script setup lang="ts">
import type { SpeakerUser } from "@/Types/User";
import { OhVueIcon } from "oh-vue-icons";

interface Props {
    user: SpeakerUser;
    reverse?: number;
    color: string;
}

defineProps<Props>();

const socials = {
    facebook: {
        icon: "io-logo-facebook",
    },
    linkedin: {
        icon: "io-logo-linkedin",
    },
    github: {
        icon: "io-logo-github",
    },
    twitter: {
        icon: "io-logo-twitter",
    },
    instagram: {
        icon: "io-logo-instagram",
    },
    website: {
        icon: "io-logo-globe",
    },
};

const textColor: Record<string, string> = {
    orange: "text-2024-blue",
    "teal-dark": "text-2024-light-blue",
    "red-dark": "text-2024-black",
    red: "text-2024-blue",
    teal: "text-2024-black",
};

const shadowColor: Record<string, string> = {
    orange: "shadow-2024-blue",
    "teal-dark": "shadow-2024-light-blue",
    "red-dark": "shadow-2024-black",
    red: "shadow-2024-blue",
    teal: "shadow-2024-black",
};

const iconColor: Record<string, string> = {
    orange: "#f29325",
    "teal-dark": "#025259",
    "red-dark": "#b15d5d",
    red: "#d94f04",
    teal: "#007172",
};
</script>

<template>
    <div
        class="flex w-fit flex-row flex-wrap gap-8"
        :class="reverse ? 'flex-row-reverse self-end' : ''"
    >
        <div class="flex flex-col items-center gap-5">
            <img
                class="h-52 w-52 border-2 border-black object-cover shadow-lg"
                :class="shadowColor[color]"
                :src="user.profile_photo_url"
                :alt="
                    user.usertype?.display_name ?? user.name + ' profile photo'
                "
            />
            <div class="flex items-center gap-1">
                <template v-for="(social, key) in socials" :key="key">
                    <a
                        v-if="user.usertype?.social_media?.[key]"
                        :href="user.usertype?.social_media?.[key]"
                    >
                        <!-- TODO: CHANGE THIS EVERY YEAR -->
                        <OhVueIcon
                            :name="social.icon"
                            fill="#0000aa"
                            scale="1.4"
                        ></OhVueIcon>
                    </a>
                </template>
            </div>
        </div>
        <div
            class="flex flex-col justify-center gap-10"
            :class="textColor[color]"
        >
            <div
                class="flex w-fit flex-row justify-center gap-6"
                :class="reverse ? 'flex-row-reverse self-end' : ''"
            >
                <div
                    :class="reverse ? 'flex flex-col items-end text-right' : ''"
                >
                    <h2 class="text-3xl font-bold uppercase">
                        {{ user.usertype?.display_name ?? user.name }}
                    </h2>
                    <h3 class="text-xl font-bold">
                        {{ user.usertype?.title }}
                    </h3>
                    <h3 class="text-xl font-bold">
                        {{ user.usertype?.organization }}
                    </h3>
                </div>
            </div>
            <div
                class="prose col-span-2 row-start-2 max-w-4xl break-words text-inherit"
                :class="reverse ? 'text-right' : ''"
                v-html="user.usertype?.description_html"
            ></div>
        </div>
    </div>
</template>

<style></style>
