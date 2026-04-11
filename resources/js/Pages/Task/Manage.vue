<script setup>
import {
  BListGroup,
  BListGroupItem,
  BButton
} from 'bootstrap-vue-next';
import useTaskManage from "@/Composables/Task/Manage"

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

// ==== import ==== //
const {
  destroy
} = useTaskManage(props);
</script>
<template>
  <p>Total - {{ total }}</p>
  <BListGroup>
    <BListGroupItem 
      class="d-flex align-items-center"
      v-for="task in tasks" 
      :key="task.id" 
      v-if="total">
      {{ task.description }}
      <BButton 
        class="ms-auto"
        variant="warning" 
        :href="route('project.task.edit', [projectId, task.id])">
        Edit
      </BButton>
      <BButton 
        class="ms-2"
        variant="danger" 
        @click="destroy(task.id)">
        Delete
    </BButton>
    </BListGroupItem>
    <BListGroupItem v-else>No task assigned in this project</BListGroupItem>

    <BListGroupItem 
      variant="primary" 
      class="text-center" 
      :href="route('project.task.create', projectId)">Add +</BListGroupItem>
  </BListGroup>
</template>
