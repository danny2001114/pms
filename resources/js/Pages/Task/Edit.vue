<script setup>
import useTaskCreate from '@/Composables/Task/Edit';
import BaseForm from '@/Pages/Task/BaseForm.vue';

// ==== props ==== //
const props = defineProps({
  projectId: Number,
  task: Object,
  stateOptions: Object,
  priorityOptions: Object,
});

// ==== import ==== //
const { 
  form, 
  fields, 
  submit, 
  back 
} = useTaskCreate(props);
</script>
<template>
  <div class="container mt-5">
    <BaseForm 
    :form="form" 
    :fields="fields" 
    action="Update"
    @onSubmit="submit" 
    @onBack="back" />
  </div>
</template>
