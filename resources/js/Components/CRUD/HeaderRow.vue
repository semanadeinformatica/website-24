<script setup lang="ts">
import Header from "./Header.vue";
</script>

<template>
    <tr class="border border-black bg-2024-light-blue text-white">
        <Header sort-by="id">ID</Header>
        <slot></slot>
        <Header>Ações</Header>
    </tr>
</template>
