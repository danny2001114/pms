<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  team: Object
});
</script>
<template>
  <h3 class="m-0">Team Detail</h3>
  <hr>

  <BCard>
    <template #header>
      <div class="d-flex align-items-center">
        <h3>{{ team.name }}</h3>
        <BButton class="ms-auto" variant="primary" size="sm" @click="router.visit(route('team.edit', team.id))">Edit</BButton>
      </div>
    </template>
    
    <BRow class="my-2">
      <BCol cols="2">Team Leader</BCol>
      <BCol cols="8">: {{ team.leader.name }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">Team Leader Code</BCol>
      <BCol cols="8">: {{ team.leader.code }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">Total Members</BCol>
      <BCol cols="8">: {{ team.members_count }}</BCol>
    </BRow>
    <hr>
    <p class="mt-3">Description</p>
    <p>{{ team.description }}</p>
  </BCard>
  <div class="my-3">
    <BButton variant="outline-secondary" @click="router.visit(route('team.index'))">Back</BButton>
  </div>
</template>
