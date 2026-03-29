<template>
  <div class="container mt-5">
    <h1 class="mb-4">Projects</h1>
    <BButton variant="primary" :href="route('posts.create')" class="mb-3">
      Create New Project
    </BButton>
    <BTable :items="projects.data" :fields="fields" striped hover>
      <template #cell(actions)="data">
        <BButton
          variant="info"
          size="sm"
          :href="route('project.show', data.item.id)"
          class="me-2"
        >
          Show
        </BButton>
        <BButton
          variant="warning"
          size="sm"
          :href="route('project.edit', data.item.id)"
          class="me-2"
        >
          Edit
        </BButton>
        <BButton
          variant="danger"
          size="sm"
          @click="destroy(data.item.id)"
        >
          Delete
        </BButton>
      </template>
    </BTable>
  </div>
</template>

<script setup>
import { BButton, BTable } from 'bootstrap-vue-next';
import useProjectIndex from '@/Composables/Project/Index';

defineProps({
  projects: Object,
});

const { fields, destroy } = useProjectIndex();
</script>
