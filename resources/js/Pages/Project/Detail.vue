<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';
import Task from '@/Pages/Task/Index.vue';

const props = defineProps({
  project: Object
});
</script>
<template>
  <h3 class="m-0">Project Detail</h3>
  <hr>
  <BCard>
    <template #header>
      <div class="d-flex align-items-center">
        <h3>{{ project.name }}</h3>
        <BButton class="ms-auto" variant="primary" size="sm" @click="router.visit(route('project.edit', project.id))">
          Edit</BButton>
      </div>
    </template>

    <BRow class="my-2">
      <BCol cols="2">Code</BCol>
      <BCol cols="8">: {{ project.code }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">Owner</BCol>
      <BCol cols="8">: {{ project.owner.name }}({{ project.owner.code }})</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">Type</BCol>
      <BCol cols="8">: {{ project.type.label }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">State</BCol>
      <BCol cols="8">: {{ project.state_text }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">State</BCol>
      <BCol cols="8">: {{ project.priority_text }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">Start Date</BCol>
      <BCol cols="8">: {{ project.start_date }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">End Date</BCol>
      <BCol cols="8">: {{ project.end_date }}</BCol>
    </BRow>
    <hr>
    <p class="mt-3">Description</p>
    <p>{{ project.description }}</p>
  </BCard>
  <div class="my-3 d-flex justify-content-between">
    <BButton variant="outline-secondary" @click="router.visit(route('project.index'))">Back</BButton>
    <BButton variant="primary" @click="router.visit(route('project.task.create', project.id))">Add</BButton>
  </div>

  <Task :tasks="project.tasks" :projectId="project.id" />
</template>
