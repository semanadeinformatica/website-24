<script setup lang="ts">
import type Event from "@/Types/Event";
import Ticket from "./Ticket.vue";

type EventTicket = Event & {
    joined: boolean;
    used: boolean;
};

const getTicketState = (t: EventTicket): "used" | "acquired" | "available" => {
    if (t.used) return "used";
    if (t.joined) return "acquired";
    return "available";
};
</script>

<template>
    <svg width="0" height="0" class="fixed">
        <clipPath id="ticket-clip-path" clipPathUnits="objectBoundingBox">
            <path
                clip-rule="evenodd"
                d="M0.032,0 C0.032,0.04,0.016,0.08,0,0.08 V0.12 C0.008,0.13,0.008,0.15,0,0.16 V0.2 C0.008,0.21,0.008,0.23,0,0.24 V0.28 C0.008,0.29,0.008,0.31,0,0.32 V0.36 C0.008,0.37,0.008,0.39,0,0.4 V0.44 C0.008,0.45,0.008,0.47,0,0.48 V0.52 C0.008,0.53,0.008,0.55,0,0.56 V0.6 C0.008,0.61,0.008,0.63,0,0.64 V0.68 C0.008,0.69,0.008,0.71,0,0.72 V0.76 C0.008,0.77,0.008,0.79,0,0.8 V0.84 C0.008,0.85,0.008,0.87,0,0.88 V0.92 C0.016,0.92,0.032,0.96,0.032,1 H0.288 C0.304,1,0.32,0.96,0.32,0.92 V1 H0.968 C0.968,0.96,0.984,0.92,1,0.92 V0.88 C0.992,0.87,0.992,0.85,1,0.84 V0.8 C0.992,0.79,0.992,0.77,1,0.76 V0.72 C0.992,0.71,0.992,0.69,1,0.68 V0.64 C0.992,0.63,0.992,0.61,1,0.6 V0.56 C0.992,0.55,0.992,0.53,1,0.52 V0.48 C0.992,0.47,0.992,0.45,1,0.44 V0.4 C0.992,0.39,0.992,0.37,1,0.36 V0.32 C0.992,0.31,0.992,0.29,1,0.28 V0.24 C0.992,0.23,0.992,0.21,1,0.2 V0.16 C0.992,0.15,0.992,0.13,1,0.12 V0.08 C0.984,0.08,0.968,0.04,0.968,0 H0.32 V0.08 C0.32,0.04,0.304,0,0.288,0 H0.032 M0.324,0.88 V0.795 H0.316 V0.88 H0.324 M0.316,0.745 H0.324 V0.66 H0.316 V0.745 M0.324,0.61 V0.525 H0.316 V0.61 H0.324 M0.316,0.475 H0.324 V0.39 H0.316 V0.475 M0.324,0.34 V0.255 H0.316 V0.34 H0.324 M0.316,0.205 H0.324 V0.12 H0.316 V0.205"
            />
        </clipPath>
        <clipPath id="ticket-left-clip-path" clipPathUnits="objectBoundingBox">
            <path
                d="M0,0.08 C0.049,0.08,0.099,0.04,0.099,0 H0.889 C0.938,0,0.988,0.04,0.988,0.08 V0.12 H0.975 V0.34 H1 V0.39 H0.975 V0.61 H1 V0.66 H0.975 V0.88 H0.988 V0.92 C0.988,0.96,0.938,1,0.889,1 H0.099 C0.099,0.96,0.049,0.92,0,0.92 V0.88 C0.025,0.87,0.025,0.85,0,0.84 V0.8 C0.025,0.79,0.025,0.77,0,0.76 V0.72 C0.025,0.71,0.025,0.69,0,0.68 V0.64 C0.025,0.63,0.025,0.61,0,0.6 V0.56 C0.025,0.55,0.025,0.53,0,0.52 V0.48 C0.025,0.47,0.025,0.45,0,0.44 V0.4 C0.025,0.39,0.025,0.37,0,0.36 V0.32 C0.025,0.31,0.025,0.29,0,0.28 V0.24 C0.025,0.23,0.025,0.21,0,0.2 V0.16 C0.025,0.15,0.025,0.13,0,0.12 V0.08"
            />
        </clipPath>
        <clipPath id="ticket-right-clip-path" clipPathUnits="objectBoundingBox">
            <path
                d="M0.006,0.88 H0.012 V0.795 H0 V0.745 H0.012 V0.525 H0 V0.475 H0.012 V0.255 H0 V0.205 H0.012 V0.12 H0.006 V0 H0.953 C0.953,0.04,0.977,0.08,1,0.08 V0.12 C0.988,0.13,0.988,0.15,1,0.16 V0.2 C0.988,0.21,0.988,0.23,1,0.24 V0.28 C0.988,0.29,0.988,0.31,1,0.32 V0.36 C0.988,0.37,0.988,0.39,1,0.4 V0.44 C0.988,0.45,0.988,0.47,1,0.48 V0.52 C0.988,0.53,0.988,0.55,1,0.56 V0.6 C0.988,0.61,0.988,0.63,1,0.64 V0.68 C0.988,0.69,0.988,0.71,1,0.72 V0.76 C0.988,0.77,0.988,0.79,1,0.8 V0.84 C0.988,0.85,0.988,0.87,1,0.88 V0.92 C0.977,0.92,0.953,0.96,0.953,1 H0.006 V0.88"
            />
        </clipPath>
    </svg>
    <p
        v-if="($page.props.tickets as EventTicket[]).length === 0"
        class="flex w-full flex-auto items-center justify-center pt-8 text-center text-2xl font-bold text-2024-light-blue"
    >
        Ainda não há eventos marcados. Verifica mais tarde!
    </p>
    <div
        v-else
        class="grid w-full items-center justify-center gap-10 self-center pt-8"
        style="grid-template-columns: repeat(auto-fill, 350px)"
    >
        <Ticket
            v-for="item in $page.props.tickets as EventTicket[]"
            :key="item.id"
            :state="getTicketState(item)"
            :event="item"
        ></Ticket>
    </div>
</template>
