<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import ShopItem from "@/Components/Shop/ShopItem.vue";
import { type BuyableProduct } from "@/Types/ShopPage";

interface Props {
    products: BuyableProduct[];
    points?: number;
    isEnrolled: boolean;
    isParticipant: boolean;
}

defineProps<Props>();
</script>

<template>
    <AppLayout title="Loja">
        <template v-if="products.length > 0">
            <div
                class="flex content-center items-center justify-center self-center py-10"
            >
                <h1
                    class="w-fit border border-black bg-2024-blue p-2 px-5 text-2xl font-bold text-white shadow-md shadow-2024-bg"
                >
                    Loja
                </h1>
            </div>
            <p
                v-if="points !== null"
                class="py-5 text-center text-xl font-bold text-2024-light-blue"
            >
                Tens {{ points }}
                <img
                    class="inline w-5 align-text-top"
                    alt="SINFrão"
                    title="SINFrão"
                    src="/images/cy-sinf-small.svg"
                />
            </p>
            <section
                class="align-center grid justify-center gap-10 px-32"
                style="
                    grid-template-columns: repeat(
                        auto-fill,
                        minmax(18em, 20em)
                    );
                "
            >
                <ShopItem
                    v-for="product in products"
                    :key="product.id"
                    :product="product"
                    :is-participant="isParticipant"
                    :is-enrolled="isEnrolled"
                />
            </section>
        </template>
        <template v-else>
            <div class="flex items-center justify-center">
                <p
                    class="pt-80 text-center text-5xl font-bold text-2024-light-blue"
                >
                    Em breve...
                </p>
            </div>
        </template>
    </AppLayout>
</template>
