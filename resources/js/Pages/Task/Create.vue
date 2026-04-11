<script setup>
import useTaskCreate from '@/Composables/Task/Create';
import BaseForm from '@/Pages/Task/BaseForm.vue';

// ==== props ==== //
const props = defineProps({
  projectId: Number,
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
    action="Create"
    @onSubmit="submit" 
    @onBack="back" />
  </div>
</template>
