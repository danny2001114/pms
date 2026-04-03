<script setup>
import {
  BForm,
  BFormGroup,
  BFormInput, 
  BFormTextarea, 
  BFormSelect,
  BButton, 
  BFormInvalidFeedback,
  BFormCheckbox
} from 'bootstrap-vue-next';
import useProjectCreate from '@/Composables/Project/Create';
import { useSetOption } from '@/Utilities/helpers';

const props = defineProps({
  project_type_options: Object,
  state_options: Object,
  priority_options: Object,
});

const { form, submit } = useProjectCreate(props);
</script>
<template>
  <div class="container mt-5">
    <h1 class="mb-4">Create Project</h1>
    <BForm @submit.prevent="submit">
      <BFormGroup label="Title" label-for="title">
        <BFormInput id="title" v-model="form.title" :state="form.errors.title ? false : null"
          placeholder="Enter project title" />
        <BFormInvalidFeedback>{{ form.errors.title }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label="Order" label-for="order">
        <BFormInput id="order" type="number" v-model="form.order" :state="form.errors.order ? false : null" />
        <BFormInvalidFeedback>{{ form.errors.order }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label="Type" label-for="type">
        <BFormSelect id="type" v-model="form.type_id" :state="form.errors.type_id ? false : null"
         :options="useSetOption(project_type_options)" />
        <BFormInvalidFeedback>{{ form.errors.type_id }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label="State" label-for="state">
        <BFormSelect id="state" v-model="form.state" :state="form.errors.state ? false : null"
         :options="useSetOption(state_options)" />
        <BFormInvalidFeedback>{{ form.errors.state }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label="Priority" label-for="priority">
        <BFormSelect id="priority" v-model="form.priority" :state="form.errors.priority ? false : null"
         :options="useSetOption(priority_options)" />
        <BFormInvalidFeedback>{{ form.errors.priority }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label="Start Date" label-for="start_date">
        <BFormInput id="start_date" type="date" v-model="form.start_date" :state="form.errors.start_date ? false : null" />
        <BFormInvalidFeedback>{{ form.errors.start_date }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label="End Date" label-for="end_date">
        <BFormInput id="end_date" type="date" v-model="form.end_date" :state="form.errors.end_date ? false : null" />
        <BFormInvalidFeedback>{{ form.errors.end_date }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label-cols="4" label-cols-lg="2" label="Active" label-for="active" class="text-red">
        <BFormCheckbox id="active" class="my-auto" v-model="form.active" switch></BFormCheckbox>
        <BFormInvalidFeedback>{{ form.errors.active }}</BFormInvalidFeedback>
      </BFormGroup>

      <BFormGroup label="Description" label-for="description">
        <BFormTextarea id="description" v-model="form.description" :state="form.errors.description ? false : null"
          placeholder="Describe about the project info..." rows="5" />
        <BFormInvalidFeedback>{{ form.errors.description }}</BFormInvalidFeedback>
      </BFormGroup>

      <div class="mt-2 d-flex gap-2 justify-content-center">
        <BButton type="submit" variant="primary" :disabled="form.processing">
          Create
        </BButton>
        <BButton variant="secondary" :href="route('project.index')">
          Cancel
        </BButton>
      </div>
    </BForm>
  </div>
</template>
