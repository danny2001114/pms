<script setup>
import { BNav, BNavItem } from 'bootstrap-vue-next';

defineProps({
    current: String
});

const navList = [
    {url: "dashboard", label: "Dashboard"}
];
</script>

<template>
    <header>
        <BNav pills>
            <BNavItem
                v-for="(item, index) in navList"
                :key="index"
                :href="route(item.url)"
                :active="current === item.label"
            >
                {{ item.label }}
            </BNavItem>
        </BNav>
    </header>
</template>
