<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';
import { useHumanizeStr } from '@/Utilities/helpers';
import TaskManage from '@/Pages/Task/Manage.vue';

// ==== props ==== //
const props = defineProps({
  project: Object,
  tasks: Object
});

// ==== computors ==== //
const info = {
  code: props.project.code,
  owner: props.project.owner.name + `(${props.project.owner.code})`,
  state: props.project.state_text,
  type: props.project.type.label,
  priority: props.project.priority_text,
  start_date: props.project.start_date,
  end_date: props.project.end_date,
};
</script>
<template>
  <BCard>
    <template #header>
      <div class="d-flex justify-content-between">
        <h3>{{ project.title }}</h3>
        <BButton @click="router.visit(route('project.edit', project.id))">Edit</BButton>
      </div>
    </template>
    <BRow v-for="([label, value]) in Object.entries(info)" :key="label" class="my-2">
      <BCol cols="2">{{ useHumanizeStr(label) }}</BCol>
      <BCol cols="8">: {{ value }}</BCol>
    </BRow>
    <hr>
    <p class="mt-3">Description</p>
    <p>{{ project.description }}</p>
  </BCard>
  <div class="my-3">
    <BButton variant="outline-secondary" @click="router.visit(route('project.index'))">Back</BButton>
  </div>

  <TaskManage :projectId="project.id" :tasks="tasks.data" :total="tasks.total" />
</template>
