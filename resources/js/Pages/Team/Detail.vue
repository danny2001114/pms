<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';
import MemberManage from '@/Pages/Team/Member/Manage.vue';

// ==== props ==== //
const props = defineProps({
  team: Object
});

</script>
<template>
  <BCard>
    <template #header>
      <div class="d-flex justify-content-between">
        <h3>{{ team.name }}</h3>
        <BButton @click="router.visit(route('team.edit', team.id))">Edit</BButton>
      </div>
    </template>
    <BRow class="my-2">
      <BCol cols="2">Team Leader</BCol>
      <BCol cols="8">: {{ team.leader }}</BCol>
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

  <MemberManage :team-id="team.id" :leader-id="team.leader_id" :members="team.members" />
</template>
