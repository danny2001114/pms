<script setup>
import BaseForm from '@/Pages/Project/BaseForm.vue';
import { useForm, router } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

// ==== props ==== //
const props = defineProps({
  projectTypeOptions: Object,
  stateOptions: Object,
  priorityOptions: Object,
});

// ==== form ==== //
const form = useForm({
  title: '',
  state: 1,
  type_id: '',
  priority: 1,
  active: true,
  start_date: new Date().toISOString().split('T')[0],
  end_date: '',
  description: '',
});

// ==== vars ==== //
const fields = {
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
  <BaseForm :form="form" :fields="fields" action="Create" @onSubmit="form.post(route('project.store'))"
    @onBack="router.visit(route('project.index'))" />
</template>
