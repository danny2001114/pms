<script setup>
import BaseForm from '@/Pages/Task/BaseForm.vue';
import { useForm } from '@inertiajs/vue3';
import { useSetOption } from '@/Utilities/helpers';

// ==== props ==== //
const props = defineProps({
  projectId: Number,
  priorityOptions: Object,
});

// ==== form ==== //
const form = useForm({
  description: '',
  priority: 1,
  start_date: new Date().toISOString().split('T')[0],
  end_date: '',
});

// ==== vars ==== //
const fields = {
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
  <BaseForm :form="form" :fields="fields" action="Create" :project-id="projectId"
    @onSubmit="form.post(route('project.task.store', projectId))" />
</template>
