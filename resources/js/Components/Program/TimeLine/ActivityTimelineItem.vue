<script setup lang="ts">
import type Event from "@/Types/Event";
import { isSpeaker } from "@/Types/User";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import route from "ziggy-js";

interface Props {
    event: Event;
}

const props = defineProps<Props>();

const event = computed(() => props.event);

const speakers = computed(() => event.value.users?.filter(isSpeaker));

const formatTimeString = (time: string): string => {
    return `1970-01-01T${time}.000000Z`;
};
</script>

<template>
    <article
        class="relative flex flex-col border-b-2 border-2024-light-blue pb-4"
    >
        <h2 class="text-2xl font-bold text-2024-blue">
            <em
                ><Link
                    :href="route('event.show', event)"
                    preserve-state
                    preserve-scroll
                    >{{ event.name }}</Link
                ></em
            >
        </h2>
        <p class="text-lg text-2024-light-blue">{{ event.topic }}</p>
        <ul v-if="speakers" class="flex flex-col">
            <li
                v-for="user in speakers"
                :key="user.id"
                class="font-bold text-2024-black"
            >
                {{ user.name
                }}<template v-if="user.usertype?.organization">
                    | {{ user.usertype.organization }}</template
                >
            </li>
        </ul>
        <span v-if="event.capacity" class="text-2024-black"
            >Capacidade:
            <span class="font-bold">{{ event.capacity }}</span></span
        >
        <span v-if="event.location" class="text-2024-black"
            >Local: <span class="font-bold">{{ event.location }}</span></span
        >
        <span class="text-2024-black">
            {{ $d(new Date(formatTimeString(event.time_start)), "hourMinute") }}
            -
            {{ $d(new Date(formatTimeString(event.time_end)), "hourMinute") }}
        </span>
        <span
            class="absolute -left-[calc(2rem+17.75px)] top-0 inline-flex h-8 w-8 items-center justify-center rounded-sm bg-2024-blue text-xl font-semibold text-white"
            >i</span
        >
    </article>
</template>
