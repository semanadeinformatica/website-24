<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import SpeakersCarousel from "@/Components/Home/SpeakersCarousel.vue";
import SponsorBanner from "@/Components/Home/SponsorBanner.vue";
import EnrollSection from "@/Components/Home/EnrollSection.vue";
import InfoPopup from "@/Components/Home/InfoPopup.vue";
import type Edition from "@/Types/Edition";
import type EventDay from "@/Types/EventDay";
import type { User } from "@/Types/User";
import { OhVueIcon } from "oh-vue-icons";
import type SponsorTier from "@/Types/SponsorTier";
import { default as MapComponent } from "@/Components/Home/Map.vue";

interface Props {
    edition: Edition;
    sponsorTiers: SponsorTier[];
    speakers: User[];
    days: EventDay[];
    activityCount: number;
    talkCount: number;
    standCount: number;
    canEnroll: boolean;
}

defineProps<Props>();

const formattedDate = (
    startDate: string,
    separator: string,
    endDate: string,
) => {
    const startDateArray = startDate.split(" ");
    const endDateArray = endDate.split(" ");

    let pointer = 0;

    while (
        startDateArray[startDateArray.length - pointer - 1] ===
        endDateArray[endDateArray.length - pointer - 1]
    )
        pointer++;

    startDate = startDateArray
        .slice(0, startDateArray.length - pointer)
        .join(" ");

    return `${startDate} ${separator} ${endDate}`;
};
</script>

<template>
    <AppLayout title="Home">
        <InfoPopup v-if="$page.props.auth.user && canEnroll" />
        <a
            v-if="canEnroll"
            href="#enroll-wrapper"
            class="group fixed bottom-10 right-12 z-50 cursor-pointer border border-black bg-2024-black p-2 px-3 font-bold text-white shadow shadow-2024-black"
        >
            <OhVueIcon name="io-arrow-down" fill="white" />
        </a>
        <!-- LOGO & DATE -->
        <section
            class="relative flex min-h-screen flex-col content-center items-center justify-evenly gap-16 py-16"
        >
            <img
                id="svg-1"
                class="absolute left-[7%] w-36 animate-2023-maintenance-jump opacity-50 max-ml:hidden"
                src="images/cy-sinf.svg"
                alt="Stylized SINF logo"
            />
            <img
                id="svg-2"
                class="absolute right-[7%] top-16 w-32 animate-2023-maintenance-jump opacity-50 max-ml:hidden"
                src="images/rc-sinf.svg"
                alt="Stylized SINF logo"
            />
            <img
                id="svg-3"
                class="absolute bottom-24 right-[15%] w-24 animate-2023-maintenance-jump opacity-50 max-ml:hidden"
                src="images/oc-sinf.svg"
                alt="Stylized SINF logo"
            />

            <div class="relative">
                <img
                    class="w-96 max-ml:w-[300px]"
                    src="images/sinf logo.png"
                    alt="Stylized SINF logo"
                />
                <span
                    class="margin-0 absolute -bottom-5 right-0 text-xl font-bold text-2024-black"
                    >{{ edition.year }}</span
                >
            </div>
            <p
                class="mr-2 border border-solid border-black p-2.5 px-8 text-lg font-bold text-2024-black shadow-md shadow-2024-black"
            >
                semana_de_informática
            </p>
            <p class="margin-0 text-2xl font-bold text-2024-black font-custom">
                {{
                    days.length > 0
                        ? formattedDate(
                              $d(new Date(days[0].date), "long"),
                              $t("general.to"),
                              $d(new Date(days[days.length - 1].date), "long"),
                          )
                        : ""
                }}
            </p>
        </section>
        <!-- ABOUT US -->
        <section
            class="relative grid grid-flow-row grid-cols-2 border-t border-black bg-2024-light-blue text-justify max-lg:grid-flow-col max-lg:grid-cols-1 max-lg:grid-rows-2"
        >
            <h2
                id="aboutus"
                class="absolute -top-9 left-[calc(50%-88.2415px)] border border-solid border-black bg-2024-blue p-3 text-3xl font-bold text-white shadow-md shadow-2024-bg"
            >
                Sobre nós
            </h2>
            <p class="p-20 text-lg text-white max-lg:pb-10">
                {{ $t("homePage.aboutUsText1") }}
            </p>
            <p class="p-20 text-lg text-white max-lg:py-10">
                {{ $t("homePage.aboutUsText2") }}
            </p>
        </section>
        <!-- GENERAL INFO -->
        <section class="relative flex flex-col py-24 max-xs:items-center">
            <h2
                class="absolute left-[calc(10%+70px)] top-14 w-fit border border-solid border-black bg-2024-blue p-2 text-2xl font-bold text-white shadow-md shadow-2024-light-blue max-xs:relative max-xs:left-0 max-xs:top-6"
            >
                Este ano temos...
            </h2>
            <template
                v-if="
                    days.length !== 0 ||
                    standCount !== 0 ||
                    talkCount !== 0 ||
                    activityCount !== 0
                "
            >
                <div
                    class="mx-[10%] grid gap-4 border border-solid border-black p-12 text-xl font-bold text-2024-black shadow-2xl shadow-2024-blue max-lg:grid-cols-2 max-xs:grid-cols-1 md:flex md:flex-row md:items-center md:justify-around"
                >
                    <span v-if="days.length !== 0" class="text-center"
                        >{{ days.length }} dias</span
                    >
                    <span v-if="standCount !== 0" class="text-center"
                        >{{ standCount }} bancas</span
                    >
                    <span v-if="talkCount !== 0" class="text-center"
                        >{{ talkCount }} palestras</span
                    >
                    <span v-if="activityCount !== 0" class="text-center"
                        >{{ activityCount }} atividades</span
                    >
                </div>
            </template>
            <template v-else>
                <div
                    class="mx-[10%] flex items-center justify-center gap-4 border border-solid border-black p-12 text-xl font-bold text-2024-black shadow-2xl shadow-2024-blue max-lg:grid-cols-2 max-xs:grid-cols-1"
                >
                    Muitas novidades para ti! Está quase...
                </div>
            </template>
        </section>
        <!-- SPEAKERS -->
        <section
            id="speakers"
            class="grid-rows-[repeat(3, 1fr)] my-10 mb-5 grid grid-cols-1 gap-10"
        >
            <p
                class="mr-[5px] flex w-fit place-self-center border border-solid border-black bg-2024-black p-3 text-2xl font-bold text-white shadow shadow-2024-bg"
            >
                Oradores
            </p>
            <template v-if="speakers.length != 0">
                <SpeakersCarousel :speakers="speakers ?? []"></SpeakersCarousel>
            </template>
            <template v-else>
                <p
                    class="flex w-fit place-self-center text-2xl font-bold text-2024-light-blue"
                >
                    Em breve...
                </p>
            </template>
        </section>
        <!-- SPONSORS -->
        <section id="sponsors" class="flex flex-col gap-10 px-20 py-20">
            <p
                v-if="sponsorTiers.length != 0"
                class="mr-[5px] flex w-min place-self-center border border-solid border-black bg-2024-light-blue p-3 text-2xl font-bold text-white shadow shadow-2024-bg"
            >
                Patrocínios
            </p>
            <SponsorBanner
                v-for="(tier, idx) in sponsorTiers"
                :key="tier.id"
                :title="tier.name"
                :sponsors="tier.sponsors ?? []"
                :color="tier.color"
                :idx="idx"
            ></SponsorBanner>
        </section>
        <!-- CALL TO ACTION -->
        <EnrollSection v-if="canEnroll" id="enroll-wrapper" />
        <!-- MAP -->
        <section class="bg-2024-light-blue p-10">
            <MapComponent />
        </section>
    </AppLayout>
</template>

<style>
#svg-1 {
    animation-delay: -0.5s;
}

#svg-2 {
    animation-delay: -1s;
}

#svg-3 {
    animation-delay: -0.8s;
}
</style>
