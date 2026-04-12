<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';
import { useHumanizeStr } from '@/Utilities/helpers';
import BaseForm from '@/Pages/Project/BaseForm.vue';
import TaskManage from '@/Pages/Task/Manage.vue';
import useProjectDetail from '@/Composables/Project/Detail';

// ==== props ==== //
const props = defineProps({
  project: Object,
  tasks: Object,
  projectTypeOptions: Object,
  stateOptions: Object,
  priorityOptions: Object,
});

// ==== import ==== //
const { 
  form, 
  fields, 
  info, 
  isEdit, 
  edit, 
  submit, 
  back 
} = useProjectDetail(props);
</script>
<template>
  <div class="container mt-5" v-if="isEdit">
    <BaseForm 
      :form="form" 
      :fields="fields" 
      action="Update"
      @onSubmit="submit" 
      @onBack="back" />
  </div>
  <div class="container mt-5" v-else>
    <BCard>
      <template #header>
        <div class="d-flex justify-content-between">
          <h3>{{ project.title }}</h3>
          <BButton @click="edit">Edit</BButton>
        </div>
      </template>
      <BRow 
        v-for="([label, value]) in Object.entries(info)" 
        :key="label" class="my-2">
        <BCol cols="2">{{ useHumanizeStr(label) }}</BCol>
        <BCol cols="8">: {{ value }}</BCol>
      </BRow>
      <hr>
      <p class="mt-3">Description</p>
      <p>{{ project.description }}</p>
    </BCard>
    <div class="my-3">
      <BButton 
        variant="outline-secondary" 
        @click="router.visit(route('project.index'))">Back</BButton>
    </div>
    <TaskManage 
      :projectId="project.id" 
      :tasks="tasks.data" 
      :total="tasks.total" />
  </div>
</template>
