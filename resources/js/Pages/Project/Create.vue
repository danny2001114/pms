<script setup>
import useProjectCreate from '@/Composables/Project/Create';
import BaseForm from '@/Pages/Project/BaseForm.vue';

const props = defineProps({
  project_type_options: Object,
  state_options: Object,
  priority_options: Object,
});

const { form, fields, submit, back } = useProjectCreate(props);
</script>
<template>
  <div class="container mt-5">
    <BaseForm :form="form" :fields="fields" action="Create"
    @onSubmit="submit" @onBack="back" />
  </div>
</template>
