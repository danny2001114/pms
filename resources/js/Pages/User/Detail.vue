<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  user: Object
});

</script>
<template>
  <BCard>
    <template #header>
      <h3>User Detail</h3>
    </template>

    <BRow class="my-2">
      <BCol cols="2">Name</BCol>
      <BCol cols="8">: {{ user.name }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">Code</BCol>
      <BCol cols="8">: {{ user.code }}</BCol>
    </BRow>
    <BRow class="my-2">
      <BCol cols="2">Role</BCol>
      <BCol cols="8">: {{ user.role_text }}</BCol>
    </BRow>
    <template v-if="user.role !== 4">
      <BRow class="my-2">
        <BCol cols="2">Gender</BCol>
        <BCol cols="8">: {{ user.gender_text }}</BCol>
      </BRow>
      <BRow class="my-2">
        <BCol cols="2">Email</BCol>
        <BCol cols="8">: {{ user.email }}</BCol>
      </BRow>
      <BRow class="my-2">
        <BCol cols="2">Phone</BCol>
        <BCol cols="8">: {{ user.phone }}</BCol>
      </BRow>
    </template>
  </BCard>

  <div class="my-3">
    <BButton variant="outline-secondary" @click="router.visit(route('user.index'))">Back</BButton>
  </div>
</template>
