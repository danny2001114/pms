<template>
  <div class="container mt-5">
    <h1 class="mb-4">Edit Project</h1>
    <BForm @submit.prevent="submit">
      <BFormGroup label="Title" label-for="title">
        <BFormInput
          id="title"
          v-model="form.title"
          :state="form.errors.title ? false : null"
          placeholder="Enter title"
        />
        <BFormInvalidFeedback>{{ form.errors.title }}</BFormInvalidFeedback>
      </BFormGroup>
      <BFormGroup label="Description" label-for="description">
        <BFormTextarea
          id="description"
          v-model="form.description"
          :state="form.errors.description ? false : null"
          placeholder="Describe about the project info..."
          rows="5"
        />
        <BFormInvalidFeedback>{{ form.errors.description }}</BFormInvalidFeedback>
      </BFormGroup>
      <BButton type="submit" variant="primary" :disabled="form.processing">
        Update
      </BButton>
      <BButton variant="secondary" :href="route('project.index')" class="ms-2">
        Cancel
      </BButton>
    </BForm>
  </div>
</template>

<script setup>
import { BForm, BFormGroup, BFormInput, BFormTextarea, BButton, BFormInvalidFeedback } from 'bootstrap-vue-next';
import useProjectEdit from '@/Composables/Project/Edit';

const props = defineProps({
  project: Object,
});

const { form, submit } = useProjectEdit(props.project);
</script>
