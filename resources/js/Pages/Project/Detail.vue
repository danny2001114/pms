<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import useProjectDetail from '@/Composables/Project/Detail';
import { useHumanizeStr } from '@/Utilities/helpers';
import BaseForm from '@/Pages/Project/BaseForm.vue';

const props = defineProps({
  project: Object,
  project_type_options: Object,
  state_options: Object,
  priority_options: Object,
});

const { form, fields, info, isEdit, edit, submit, back } = useProjectDetail(props);
</script>
<template>
  <div class="container mt-5" v-if="isEdit">
    <BaseForm :form="form" :fields="fields" action="Update"
    @onSubmit="submit" @onBack="back" />
  </div>
  <div class="container mt-5" v-else>
    <BCard>
      <template #header>
        <div class="d-flex justify-content-between">
          <h3>{{ project.title }}</h3>
          <BButton @click="edit">Edit</BButton>
        </div>
      </template>
      <BRow v-for="([label, value]) in Object.entries(info)" :key="label" class="my-2">
        <BCol cols="2">{{ useHumanizeStr(label) }}</BCol>
        <BCol cols="8">: {{ value }}</BCol>
      </BRow>
      <hr>
      <b class="mt-3">Description</b>
      <p>{{ project.description }}</p>
    </BCard>
  </div>
</template>
