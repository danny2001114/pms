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
import { back } from '@/Utilities/helpers';

const props = defineProps({
  project: Object,
  projectTypes: Array,
  states: Array,
  priorities: Array,
});

const form = useForm({
  title: props.project.title,
  owner_code: props.project.owner.code,
  state: props.project.state,
  type_id: props.project.type_id,
  priority: props.project.priority,
  active: Boolean(props.project.active),
  start_date: props.project.start_date,
  end_date: props.project.end_date,
  description: props.project.description,
});
</script>
<template>
  <h3 class="m-0">Edit Project</h3>
  <hr>

  <BForm @submit.prevent="form.put(route('project.update', project.id))">
    <BCard>
      <template #header>
        <BFormInput type="text" id="title" placeholder="Enter Project Title ..." v-model="form.title" />
        <div class="text-danger" v-if="form.errors.title">{{ form.errors.title }}</div>
      </template>
      <div class="d-flex flex-column gap-3">
        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="type_id" label="Type">
          <BFormSelect :options="projectTypes" id="type_id" v-model="form.type_id" :disabled="!projectTypes.length" />
          <div class="text-danger" v-if="!projectTypes.length">There is no project type found.</div>
          <div class="text-danger" v-else-if="form.errors.type_id">{{ form.errors.type_id }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="State">
          <BFormRadioGroup :options="states" id="state" v-model="form.state" />
          <div class="text-danger" v-if="form.errors.state">{{ form.errors.state }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="Priority">
          <BFormRadioGroup :options="priorities" id="priority" v-model="form.priority" />
          <div class="text-danger" v-if="form.errors.priority">{{ form.errors.priority }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="active" label="Active">
          <BFormCheckbox id="active" v-model="form.active" switch />
          <div class="text-danger" v-if="form.errors.active">{{ form.errors.active }}</div>
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
      <BButton variant="outline-secondary" type="button" @click="back">Back</BButton>
      <BButton variant="primary" type="submit">Update</BButton>
    </div>
  </BForm>
</template>
