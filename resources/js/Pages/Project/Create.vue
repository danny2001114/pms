<script setup>
import BaseForm from '@/Pages/Project/BaseForm.vue';
import useProjectCreate from '@/Composables/Project/Create';

// ==== props ==== //
const props = defineProps({
  projectTypeOptions: Object,
  stateOptions: Object,
  priorityOptions: Object,
});

// ==== import ==== //
const { 
  form, 
  fields, 
  submit,
  back
} = useProjectCreate(props);
</script>
<template>
  <div class="container mt-5">
    <BaseForm 
      :form="form" 
      :fields="fields" 
      action="Create"
      @onSubmit="submit"
      @onBack="back"/>
  </div>
</template>
