<script setup>
import BaseForm from '@/Pages/Task/BaseForm.vue';
import useTaskCreate from '@/Composables/Task/Create';

// ==== props ==== //
const props = defineProps({
  projectId: Number,
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
