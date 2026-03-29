<script setup>
  import { BButton } from 'bootstrap-vue-next';
  import Header from '@/Layouts/Header.vue';
</script>

<template>
  <Header current="Dashboard" />
  <div class="container mt-5">
    <h1>Dashboard</h1>
    <p>Welcome to the PMS Dashboard.</p>
    <BButton variant="primary" :href="route('project.index')">
      Manage Project
    </BButton>
  </div>
</template>
