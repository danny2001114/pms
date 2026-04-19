<script setup>
import BaseForm from '@/Pages/Task/BaseForm.vue';
import { useForm } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

// ==== props ==== //
const props = defineProps({
  projectId: Number,
  task: Object,
  stateOptions: Object,
  priorityOptions: Object,
});

// ==== form ==== //
const form = useForm({
  description: props.task.description,
  priority: props.task.priority,
  state: props.task.state,
  start_date: props.task.start_date,
  end_date: props.task.end_date,
});

// ==== vars ==== //
const fields = {
  state: {
    type: 'select',
    options: useSetOption(props.stateOptions)
  },
  priority: {
    type: 'select',
    options: useSetOption(props.priorityOptions)
  },
  start_date: {
    type: 'date',
  },
  end_date: {
    type: 'date'
  },
};
</script>
<template>
  <BaseForm :form="form" :fields="fields" action="Update" :project-id="projectId"
    @onSubmit="form.put(route('project.task.update', [props.projectId, props.task.id]))" />
</template>
