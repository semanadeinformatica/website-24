<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AdminNavbar from "@/Components/AdminNavbar.vue";
import Footer from "../Components/Footer.vue";
import Banner from "@/Components/Banner.vue";

interface Props {
    title: string;
}

defineProps<Props>();
</script>

<template>
    <div>
        <Head :title="title" />
        <Banner />
        <div>
            <AdminNavbar />
            <main class="min-h-screen bg-2024-bg">
                <slot />
            </main>
            <Footer />
        </div>
    </div>
</template>
