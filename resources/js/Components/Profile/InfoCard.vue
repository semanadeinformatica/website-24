<script setup lang="ts">
import { type User, isAdmin, isParticipant, isCompany } from "@/Types/User";
import { OhVueIcon } from "oh-vue-icons";
import "vue-final-modal/style.css";
import { Link } from "@inertiajs/vue3";
import route from "ziggy-js";
import QRCode from "./QRCode.vue";

interface Props {
    user?: User;
    isStaff: boolean;
}

defineProps<Props>();

const socials = {
    facebook: {
        icon: "io-logo-facebook",
        color: "red",
    },
    linkedin: {
        icon: "io-logo-linkedin",
        color: "red-dark",
    },
    github: {
        icon: "io-logo-github",
        color: "teal-dark",
    },
    twitter: {
        icon: "io-logo-twitter",
        color: "orange",
    },
    instagram: {
        icon: "io-logo-instagram",
        color: "red-dark",
    },
    website: {
        icon: "io-logo-globe",
        color: "teal",
    },
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
        class="m-4 flex justify-between border border-solid border-black bg-2024-bg p-3 text-2024-black shadow-xl shadow-2024-black max-md:m-2 md:min-w-[30vw]"
    >
        <div class="flex-col">
            <div>
                <p class="font-bold">
                    {{ user?.name }}
                    <span v-if="isStaff" title="Staff">
                        <OhVueIcon
                            name="io-ribbon-outline"
                            scale="1.3"
                        ></OhVueIcon>
                    </span>
                </p>
                <p>
                    {{ user?.email }}
                </p>
            </div>
            <div class="mt-10 flex">
                <template v-for="(social, key) in socials" :key="key">
                    <a
                        v-if="
                            !isAdmin(user) &&
                            user?.usertype?.social_media?.[key]
                        "
                        class="flex w-fit rounded-full p-2.5"
                        target="_blank"
                        :href="user.usertype.social_media[key]"
                    >
                        <OhVueIcon
                            :name="social.icon"
                            scale="1.3"
                            :fill="iconColor[social.color]"
                        ></OhVueIcon>
                    </a>
                </template>
            </div>
        </div>
        <div class="flex flex-col items-center justify-between">
            <Link
                v-if="$page.props.auth.user?.id == user?.id"
                class="self-start p-2.5"
                :href="route('profile.edit')"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-8 text-2024-black"
                    viewBox="0 0 512 512"
                >
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="36"
                        d="M384 224v184a40 40 0 01-40 40H104a40 40 0 01-40-40V168a40 40 0 0140-40h167.48"
                    />
                    <path
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="24"
                        d="M459.94 53.25a16.06 16.06 0 00-23.22-.56L424.35 65a8 8 0 000 11.31l11.34 11.32a8 8 0 0011.34 0l12.06-12c6.1-6.09 6.67-16.01.85-22.38zM399.34 90L218.82 270.2a9 9 0 00-2.31 3.93L208.16 299a3.91 3.91 0 004.86 4.86l24.85-8.35a9 9 0 003.93-2.31L422 112.66a9 9 0 000-12.66l-9.95-10a9 9 0 00-12.71 0z"
                    />
                </svg>
            </Link>
            <template v-if="isAdmin(user) || isStaff || isCompany(user)">
                <!-- TODO: this does not bring problems to us because we can only see other people's profiles if we are admins or companies (under certain conditions) which already would have the scan button enabled -->
                <Link
                    class="flex w-fit cursor-pointer rounded-full text-2024-black"
                    :href="route('user.scan-code')"
                >
                    <OhVueIcon name="io-camera" scale="1.4"></OhVueIcon>
                </Link>
            </template>
            <QRCode
                v-if="isParticipant(user) && user.usertype"
                :participant="user.usertype"
            ></QRCode>
        </div>
    </div>
</template>
