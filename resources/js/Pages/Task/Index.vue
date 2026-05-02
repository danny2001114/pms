<script setup>
import {
  BButton,
  BTable
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  projectId: Number,
  tasks: Object
});

const fields = [
  { key: 'serial', label: '.No' },
  { key: 'code', label: 'Code' },
  { key: 'priority', label: 'Priority' },
  { key: 'state', label: 'State' },
  { key: 'percentage', label: 'Percentage' },
  { key: 'start_date', label: 'Start Date' },
  { key: 'end_date', label: 'End Date' },
  { key: 'actions', label: 'Actions' }
];
</script>
<template>
  <div class="scrollable-table mt-3">
    <BTable :items="tasks" :fields="fields" striped hover>
      <template #cell(serial)="data">{{ data.index + 1 }}</template>
      <template #cell(actions)="data">
        <BButton variant="warning" class="me-1" size="sm"
          @click="router.visit(route('project.task.edit', [projectId, data.item.id]))">
          Edit
        </BButton>
        <BButton variant="danger" size="sm"
          @click="router.delete(route('project.task.destroy', [projectId, data.item.id]))">
          Delete
        </BButton>
      </template>
    </BTable>
  </div>
</template>
