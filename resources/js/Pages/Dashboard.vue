<script setup>
import { BButton } from 'bootstrap-vue-next';
</script>

<template>
  <h1>Dashboard</h1>
  <p>Welcome to the PMS Dashboard.</p>
  <BButton variant="primary" :href="route('project.index')">
    Manage Project
  </BButton>
</template>
