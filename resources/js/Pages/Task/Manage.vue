<script setup>
import {
  BListGroup,
  BListGroupItem,
  BButton
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

// ==== props ==== //
const props = defineProps({
  projectId: {
    type: Number,
    required: true
  },
  tasks: {
    type: Array,
    required: true
  },
  total: {
    type: Number,
    required: true
  },
});

// ==== actions ==== //
function destroy(id) {
  if (confirm('Are you sure you want to delete this task?')) {
    router.delete(route('project.task.destroy', [props.projectId, id]));
  }
}
</script>
<template>
  <p>Total - {{ total }}</p>
  <BListGroup>
    <BListGroupItem class="d-flex align-items-center" v-for="task in tasks" :key="task.id" v-if="total">
      {{ task.description }}
      <BButton class="ms-auto" variant="warning"
        @click="router.visit(route('project.task.edit', [projectId, task.id]))">
        Edit
      </BButton>
      <BButton class="ms-2" variant="danger" @click="destroy(task.id)">
        Delete
      </BButton>
    </BListGroupItem>
    <BListGroupItem v-else>No task assigned in this project</BListGroupItem>

    <BListGroupItem variant="primary" class="text-center" @click="router.visit(route('project.task.create', projectId))"
      button>Add +</BListGroupItem>
  </BListGroup>
</template>
