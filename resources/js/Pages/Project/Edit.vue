<script setup>
import BaseForm from '@/Pages/Project/BaseForm.vue';
import { useForm, router } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

// ==== props ==== //
const props = defineProps({
  project: Object,
  projectTypeOptions: Object,
  stateOptions: Object,
  priorityOptions: Object,
});

// ==== form ==== //
const form = useForm({
  title: props.project.title,
  owner_code: props.project.owner.code,
  state: props.project.state,
  type_id: props.project.type_id,
  priority: props.project.priority,
  active: props.project.active,
  start_date: props.project.start_date,
  end_date: props.project.end_date,
  description: props.project.description,
});

// ==== vars ==== //
const fields = {
  owner_code: {
    type: 'text',
  },
  state: {
    type: 'select',
    options: useSetOption(props.stateOptions)
  },
  type_id: {
    type: 'select',
    label: 'Type',
    options: useSetOption(props.projectTypeOptions)
  },
  priority: {
    type: 'select',
    options: useSetOption(props.priorityOptions)
  },
  start_date: {
    type: 'date'
  },
  end_date: {
    type: 'date'
  },
};
</script>
<template>
  <BaseForm :form="form" :fields="fields" action="Update" @onSubmit="form.put(route('project.update', project.id))"
    @onBack="router.visit(route('project.detail', project.id))" />
</template>
