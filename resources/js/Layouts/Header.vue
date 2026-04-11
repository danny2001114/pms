<script setup>
import { BNav, BNavItem } from 'bootstrap-vue-next';

// === props ==== //
defineProps({
  current: String
});

// ==== vars ==== //
const navList = [
  { url: "dashboard", label: "Dashboard" }
];
</script>
<template>
  <header>
    <BNav pills>
      <BNavItem 
        v-for="(item, index) in navList" 
        :key="index" 
        :href="route(item.url)" 
        :active="current === item.label">
        {{ item.label }}
      </BNavItem>
    </BNav>
  </header>
</template>
