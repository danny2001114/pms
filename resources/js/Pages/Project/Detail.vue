<template>
  <div class="container mt-5">
    <h1 class="mb-4">{{ project.title }}</h1>
    <p>{{ project.description }}</p>
    <BButton variant="primary" :href="route('project.index')" class="me-2">
      Back to Posts
    </BButton>
    <BButton variant="warning" :href="route('project.edit', project.id)">
      Edit
    </BButton>
  </div>
</template>

<script setup>
import { BButton } from 'bootstrap-vue-next';

defineProps({
  project: Object,
});
</script>
