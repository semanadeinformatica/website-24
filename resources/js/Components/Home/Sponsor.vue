<script setup lang="ts">
import type { CompanyUser } from "@/Types/User";
import { OhVueIcon } from "oh-vue-icons";
import { ref } from "vue";
import { VueFinalModal } from "vue-final-modal";
import "vue-final-modal/style.css";

const options = ref({
    modelValue: false,
});

interface Props {
    company?: CompanyUser;
}

defineProps<Props>();
</script>

<template>
    <img
        v-bind="$attrs"
        class="col-span-2 h-full w-full cursor-pointer object-contain p-10"
        :src="company?.profile_photo_url"
        :alt="company?.name"
        @click="options.modelValue = true"
    />
    <VueFinalModal
        v-model="options.modelValue"
        class="flex items-center justify-center"
        content-class="max-w-xl min-w-[20em] mx-4 p-6 gap-7 bg-2024-bg border border-black border-solid flex relative justify-center items-center flex-col"
    >
        <img
            :src="company?.profile_photo_url"
            :alt="company?.name"
            class="mr-2 h-auto max-w-[20em] justify-center bg-2024-bg p-3"
        />
        <div class="flex w-full flex-col items-center gap-4 text-2023-red">
            <a
                v-if="company?.usertype?.social_media?.website"
                class="text-xl font-bold underline"
                :href="company.usertype.social_media.website"
                target="_blank"
            >
                {{ company.name }}
                <!-- TODO: CHANGE THIS EVERY YEAR -->
                <OhVueIcon
                    class="ml-1"
                    name="io-open"
                    fill="#0000aa"
                ></OhVueIcon>
            </a>
            <span v-else class="text-xl font-bold underline">
                {{ company?.name }}
            </span>
            <div
                class="prose break-words text-justify text-inherit max-md:h-96 max-md:overflow-y-scroll"
                v-html="company?.usertype?.description_html"
            ></div>
        </div>
    </VueFinalModal>
</template>
