<script setup lang="ts">
import type Paginated from "@/Types/Paginated";
import CRUDLayout from "@/Layouts/CRUDLayout.vue";
import HeaderRow from "@/Components/CRUD/HeaderRow.vue";
import Row from "@/Components/CRUD/Row.vue";
import Cell from "@/Components/CRUD/Cell.vue";
import Header from "@/Components/CRUD/Header.vue";
import { computed } from "vue";
import type EventDay from "@/Types/EventDay";
import type Edition from "@/Types/Edition";

interface Props {
    items: Paginated<EventDay>;
    with: {
        editions: Edition[];
    };
    isSearchable?: boolean;
}

const props = defineProps<Props>();

const editions = computed<Record<number, string>>(() =>
    Object.fromEntries(
        props.with.editions.map((edition) => [edition.id, edition.name]),
    ),
);
</script>

<template>
    <CRUDLayout
        title="Event"
        :items="items"
        name="eventDays"
        :is-searchable="isSearchable"
    >
        <template #heading>Events</template>

        <template #header>
            <HeaderRow>
                <Header filter-by="edition_id" :filter-values="editions"
                    >Edição</Header
                >
                <Header sort-by="theme">Tema (Ignorado na edição 2024)</Header>
                <Header sort-by="date">Data</Header>
            </HeaderRow>
        </template>

        <template #row="{ item }">
            <Row :item="item" name="eventDays">
                <Cell>{{ editions[item.edition_id] }}</Cell>
                <Cell>{{ item.theme }} </Cell>
                <Cell>{{ item.date }} </Cell>
            </Row>
        </template>
    </CRUDLayout>
</template>
