<script setup>
import {
  BForm,
  BFormGroup,
  BFormInput,
  BFormSelect,
  BFormCheckbox,
  BFormInvalidFeedback,
  BFormRadioGroup,
  BCard,
  BFormTextarea,
  BButton
} from 'bootstrap-vue-next';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  projectId: Number,
  task: Object,
  states: Array,
  priorities: Array
});

const form = useForm({
  description: props.task.description,
  state: props.task.state,
  priority: props.task.priority,
  start_date: props.task.start_date,
  end_date: props.task.end_date,
});
</script>
<template>
  <h3 class="m-0">Edit Task</h3>
  <hr>

  <BForm @submit.prevent="form.put(route('project.task.update', [projectId, task.id]))">
    <BCard>
      <div class="d-flex flex-column gap-3">
        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="State">
          <BFormRadioGroup :options="states" id="state" v-model="form.state" />
          <div class="text-danger" v-if="form.errors.state">{{ form.errors.state }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="Priority">
          <BFormRadioGroup :options="priorities" id="priority" v-model="form.priority" />
          <div class="text-danger" v-if="form.errors.priority">{{ form.errors.priority }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="start_date" label="Start Date">
          <BFormInput type="date" id="start_date" v-model="form.start_date" />
          <div class="text-danger" v-if="form.errors.start_date">{{ form.errors.start_date }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="end_date" label="End Date">
          <BFormInput type="date" id="end_date" v-model="form.end_date" />
          <div class="text-danger" v-if="form.errors.end_date">{{ form.errors.end_date }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="description" label="Description">
          <BFormTextarea type="text" id="description" v-model="form.description" />
          <div class="text-danger" v-if="form.errors.description">{{ form.errors.description }}</div>
        </BFormGroup>
      </div>
    </BCard>

    <div class="d-flex gap-2 justify-content-start my-3">
      <BButton variant="outline-secondary" type="button" @click="router.visit(route('project.show', projectId))">Back</BButton>
      <BButton variant="primary" type="submit">Update</BButton>
    </div>
  </BForm>
</template>
